window.addEventListener("load", event =>{

    const newnote =  document.querySelector("aside div.menu button#newnote");
    const changearea= document.querySelector("section#changearea");
    const cleanUrl = "scripts/viewcontact.php".replace( /"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g,'');
    const parserObj = new DOMParser();

    let noteForm = setInterval( ()=>{
        if(document.contains(document.getElementById("noteform"))){
            const addnotebtn = document.querySelector("form#noteform button#addnotebtn");
            const cleanUrl2 = "scripts/newnote.php".replace( /"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g,'');
            const comment = document.querySelector("form#noteform input#comment");
            const formstatus = document.querySelector("section#changearea form#noteform div.newnotestat");

            addnotebtn.onclick = (event)=>{
                event.preventDefault();
                if (comment.value.length == 0){
                    formstatus.classList.remove("hide");
                    formstatus.classList.remove("success");
                    formstatus.classList.add("fail");
                    descript.classList.remove("txtANormal");
                    descript.classList.add("txtAErr");
                    return;
                }
                else{
                    const formData = {
                        comment: comment.value,
                    };
                    fetch(cleanUrl2, {
                        method : 'POST',
                        headers: {
                            "Content-Type" : "application/json",
                            "Accept" : "application/json",
                        },
                        body: JSON.stringify(formData),
                        mode: "cors",
                    })
                    .then(resp => resp.text())
                    .then(resp => {
                        formstatus.classList.remove("hide");
                        formstatus.classList.remove("fail");
                        formstatus.classList.add("success");
                        console.log(resp);
                        if (resp == "OK"){
                            formstatus.classList.add("success");
                            formstatus.classList.remove("fail");
                            formstatus.innerHTML = "New contact added successfully!"
                        }
                        else if(resp == "NO"){
                            formstatus.classList.remove("success");
                            formstatus.classList.add("fail");
                            formstatus.innerHTML = "Unable to create contact.";
                        }

                        comment.classList.remove("txtAErr");
                        comment.classList.add("txtANormal");
                    })
                }
            };  
        }
    }, 1000 );

    newform.onclick = (event) =>{
        event.preventDefault();
        changearea.innerHTML = "";
        fetch(cleanUrl, {method : 'GET'})
        .then(resp => resp.text())
        .then(resp=>{
            let parsedDom = parserObj.parseFromString(resp, "text/html");
            changearea.appendChild(parsedDom.getElementById("noteform"));
        })
    }
});