const wordlist = ['snake', 'falcon'];

(async () => {
	let choice = false;
	let audioObj = new Audio();
	const playButton = document.getElementById('play-button');
	const answerButtons = document.getElementsByClassName('icon-rect');
	const prompt = document.getElementsByTagName('h3')[0];
	let src;

	audioObj.addEventListener('loadedmetadata', play);
	audioObj.addEventListener('ended', () => {
		playButton.innerText = 'play_arrow';
		playButton.addEventListener('click', play);
	});

	async function newWord() {
		playButton.removeEventListener('click', newWord);
		playButton.innerText = 'refresh';
		const req = await fetch('verify_file.php');
		src = await req.text();
		if (src == 'ERR - No more recordings') {
			alert('No more recordings are available. Please record words instead.');
			location.href = 'record.php';
		}
		audioObj.src = src;
		choice = true;
	}
	function play() {
		for (const button of answerButtons) button.classList.remove('disabled');
		prompt.innerText = 'What did the recording say?';
		playButton.innerText = 'volume_up';
		audioObj.play();
	}
	async function makechoice(e) {
		// missing randomization
		if (!choice || e.target === e.currentTarget || e.target.dataset.word == undefined) return;
		choice = false;
		for (const button of answerButtons) button.classList.add('disabled');
		prompt.innerText = 'Loading...';
		e.stopPropagation();
		await fetch('verify_answer.php', {
			method: 'POST',
			body: `word=${e.target.dataset.word}&filename=${src}`,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			}
		});
		playButton.removeEventListener('click', play);
		playButton.addEventListener('click', newWord);
		newWord();
	}

	playButton.addEventListener('click', newWord);
	document.getElementById('answer-button').addEventListener('click', makechoice);
})();