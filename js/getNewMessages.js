let date=new Date();
var lastCheck=`${date.getFullYear()}/${date.getMonth()}/${date.getDate()} ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`;

function getMessages(lastCheck){
    let ajax=new XMLHttpRequest();

    ajax.addEventListener('readystatechange',()=>{
        if (ajax.readyState==4){
            if(ajax.status==200){
                alert('recup:'+ajax.responseText);
                //setTimeout(getMessages(lastCheck),10000);
                return;
            }
            alert('Erreur de récupération Ajax: '+ajax.status)
        }
    })
    let date=new Date();
    lastCheck=`${date.getFullYear()}/${date.getMonth()}/${date.getDate()} ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`;

    ajax.open('GET','get_new_messages.php?min='+lastCheck);
    ajax.send();
}

setTimeout(getMessages(lastCheck),10000);