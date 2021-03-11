const FORM = document.querySelector('form');

FORM.addEventListener('submit',(e)=>{
    e.preventDefault();
    let ajax=new XMLHttpRequest();

    ajax.addEventListener('readystatechange',()=>{
        if (ajax.readyState==4 && ajax.status!=200){
            alert('Erreur de récupération Ajax: '+ajax.status)
        }
    })
    ajax.open('POST',FORM.getAttribute('action'));
    //ajax.setRequestHeader('');
    ajax.send(new FormData(FORM));
})