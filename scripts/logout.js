window.addEventListener("load",event=>{

    const logout= document.querySelector("aside div.menu button#logout");
    const combo  = document.querySelector("section#flex-parent div#central");
    const changearea= document.querySelector("section#changearea");
    const loginform  =  document.querySelector("section#changearea form#login");
    logout.onclick= event=>{
        changearea.innerHTML="";
        const logoutPath = "scripts/logout.php".replace( /"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g,'');
        fetch(logoutPath, {method : 'POST'})
        .then(resp => resp.text())
        .then(resp=>{
            if (resp == "CLEAR"){
                combo.innerHTML ="";
                location.replace("http://localhost/info2180-finalproject/");
            }
        })
    }

});