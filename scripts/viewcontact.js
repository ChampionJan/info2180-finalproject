window.addEventListener("load", (event)=>{

    let singlecontact = setInterval( ()=>{
        let contactlinks = document.querySelectorAll("table#contacttable tr td a");
        let changearea= document.querySelector("section#changearea");
            contactlinks.forEach((contactlink)=>{
                contactlink.onclick = event => {
                    event.preventDefault();
                    let id = contactlink.getAttribute("href");
                    let contactUrl = new URL('http://localhost/info2180-finalproject/scripts/viewcontact.php');
                    let params = {contactid: id};
                    contactUrl.search = new URLSearchParams(params).toString();
                    fetch(contactUrl, {
                        method : 'GET',  
                        headers: {
                            "Content-Type" : "application/json",
                            "Accept" : "application/json",
                        },
                    })
                    .then(resp => resp.text())
                    .then(resp=>{
                        changearea.innerHTML = "";
                        changearea.innerHTML = resp;
                    }) 
                }

            });
        
    }, 1000);

});