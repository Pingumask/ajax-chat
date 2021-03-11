function getMessages(lastId) {
	let ajax = new XMLHttpRequest();

	ajax.addEventListener('readystatechange', () => {
		if (ajax.readyState == 4) {
			if (ajax.status == 200) {
				let newMessages = JSON.parse(ajax.responseText);
				if (newMessages.length > 0) {
					newMessages.forEach(message => {
						document.querySelector('#message_list').innerHTML += `
                            <div class="message" id="message${message.id_message}">
                                <div class="user">${message.user}</div>
                                <div class="creation_time">${message.creation_time}</div>
                                <div class="content">${message.content}</div>
                            </div>
                        `;
                    });
                    document.querySelector(`#message${newMessages[newMessages.length - 1].id_message}`).scrollIntoView();
					timeOut = setTimeout(
						getMessages,
						500,
						newMessages[newMessages.length - 1].id_message,
					);
					return;
				}
				timeOut = setTimeout(getMessages, 500, lastId);
				return;
			}
			console.error('Erreur de récupération Ajax: ' + ajax.status);
		}
	});

	ajax.open('GET', 'get_new_messages.php?min=' + lastId);
	ajax.send();
}
