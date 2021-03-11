const FORM = document.querySelector('form');

FORM.addEventListener('submit', e => {
	e.preventDefault();
	let ajax = new XMLHttpRequest();

	ajax.addEventListener('readystatechange', () => {
		if (ajax.readyState == 4) {
			if (ajax.status != 200)
				return alert('Erreur de récupération Ajax: ' + ajax.status);
			document.querySelector('input[name=content]').value = '';
		}
	});
	ajax.open('POST', FORM.getAttribute('action'));
	//ajax.setRequestHeader('');
	ajax.send(new FormData(FORM));
});
