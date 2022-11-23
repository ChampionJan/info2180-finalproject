window.addEventListener("load", event => {
    const viewusersbtn =  document.querySelector("aside div.menu button#viewusers");
    const changearea= document.querySelector("section#changearea");
    const cleanUrl = "scripts/viewusers.php".replace( /"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g,'');
    const parserObj = new DOMParser();

    viewusersbtn.onclick = (event) =>{
        event.preventDefault();
        changearea.innerHTML = "";
        fetch(cleanUrl, {method : 'GET'})
        .then(resp => resp.text())
        .then(resp=>{
            changearea.innerHTML =resp;
            document.querySelector("table#usertable").classList.add("usertable");
        })
    }
});