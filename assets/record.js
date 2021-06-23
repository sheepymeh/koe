(async () => {
const wordlist_req = await fetch('config.php');
const wordlist = await wordlist_req.json();

if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
	if (!localStorage.getItem('microphonePerms')) alert('Please enable the microphone after clicking "OK"');

	let stream;
	try {
		stream = await navigator.mediaDevices.getUserMedia({audio: true});
		localStorage.microphonePerms = true;
	}
	catch (e) {
		alert('An error occured.');
		console.error('getUserMedia error occurred: ' + e);
	}

	const record = document.getElementById('record-button');
	const recordPrompt = document.getElementById('record-prompt');
	const wordElem = document.getElementsByTagName('h1')[0];
	const wordPrompt = document.getElementById('word-prompt');
	let toUpload = false;
	const mediaRecorder = new MediaRecorder(stream, {
		audioBitsPerSecond: 96000
	});
	mediaRecorder.ondataavailable = e => chunks.push(e.data);
	mediaRecorder.onstop = async _ => {
		if (!toUpload) {
			newWord();
			return;
		}
		const formData = new FormData();
		const blob = new Blob(chunks, {'type': chunks[0].type});
		formData.append('audio', blob);
		formData.append('word', currentword);
		try {
			await fetch('upload.php', {
				method: 'POST',
				body: formData
			});
			newWord();
		}
		catch (e) {
			alert('Failed to upload sound clip');
			console.error(e);
		}
	}

	let chunks;
	let mousestart;
	let currentword;
	let prevword;
	let wordindex;
	function startRecord(e) {
		e.preventDefault();
		mediaRecorder.start();
		mousestart = new Date();
		recordPrompt.innerText = 'Recording...';
	}
	async function stopRecord() {
		if (new Date() - mousestart < 350) {
			toUpload = false;
			alert('Recording too short. Please record for at least 350ms.')
			newWord();
		}
		else toUpload = true;
		setTimeout(() => mediaRecorder.stop(), 150);
		// record.classList.add('disabled');
		recordPrompt.innerText = 'Uploading...';

		record.removeEventListener('mousedown', startRecord);
		record.removeEventListener('mouseup', stopRecord);
		record.removeEventListener('touchstart', startRecord);
		record.removeEventListener('touchend', stopRecord);
	}
	function newWord() {
		// record.classList.remove('disabled');
		recordPrompt.innerText = 'Hold to Record';
		chunks = [];
		// if (currentword && prevword == currentword) {
		// 	prevword = currentword;
		// 	let templist = wordlist.slice();
		// 	templist.splice(wordindex, 1);
		// 	currentword = templist[Math.floor(Math.random() * templist.length)];
		// }
		// else {
			wordindex = Math.floor(Math.random() * wordlist.length);
			prevword = currentword;
			currentword = wordlist[wordindex];
		// }
		wordPrompt.innerText = `Say the word${prevword == currentword ? ' again' : ''}`;
		wordElem.innerText = currentword;
		record.addEventListener('mousedown', startRecord);
		record.addEventListener('mouseup', stopRecord);
		record.addEventListener('touchstart', startRecord);
		record.addEventListener('touchend', stopRecord);
	}

	newWord();
}
else {
	alert('Your browser does not support recording.');
}})();
