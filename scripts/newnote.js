window.addEventListener("load", event =>{

    const newnote =  document.querySelector("aside div.menu button#newnote");
    const changearea= document.querySelector("section#changearea");
    const cleanUrl = "scripts/viewcontact.php".replace( /"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g,'');
    const parserObj = new DOMParser();

    let noteForm = setInterval( ()=>{
        if(document.contains(document.getElementById("noteform"))){
            const addnotebtn = document.getElementById("addnotebtn");
            const cleanUrl2 = "scripts/newnote.php".replace( /"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g,'');
            let comment = document.getElementById("comment");
            const formstatus = document.getElementById("notestatus");

            addnotebtn.onclick = (event)=>{
                event.preventDefault();
                if (parseInt(comment.value.length) == 0){
                    formstatus.classList.remove("hide");
                    formstatus.classList.remove("success");
                    formstatus.classList.add("fail");
                    comment.classList.remove("txtANormal");
                    comment.classList.add("txtAErr");
                    formstatus.innerHTML = "You must enter a comment.";
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
                        if(resp == "NO"){
                            formstatus.classList.remove("success");
                            formstatus.classList.add("fail");
                            formstatus.innerHTML = "Unable to create note.";
                        }else if(resp == "We can't process your request at this time"){
                            formstatus.innerHTML = "We can't process your request at this time";
                        }
                        else{
                            formstatus.classList.add("success");
                            formstatus.classList.remove("fail");
                            formstatus.innerHTML = "New note added successfully! Press a button to continue."
                            updated.innerHTML= resp.substring(0, resp.indexOf('*'));
                        }

                        comment.classList.remove("txtAErr");
                        comment.classList.add("txtANormal");
                    })
                }
            };  
        }
    }, 1000 );

    newnote.onclick = (event) =>{
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