window.addEventListener("load", event =>{

    const newcontact =  document.querySelector("aside div.menu button#newcontact");
    const changearea= document.querySelector("section#changearea");
    const cleanUrl = "scripts/getcontactform.php".replace( /"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g,'');
    const parserObj = new DOMParser();

    let contactForm = setInterval( ()=>{
        if(document.contains(document.getElementById("contactform"))){
            const addcontactbtn = document.querySelector("form#contactform button#addcontactbtn");
            const cleanUrl2 = "scripts/newcontact.php".replace( /"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g,'');
            const title = document.querySelector("form#contactform select#title");
            const firstname = document.querySelector("form#contactform input#firstname");
            const lastname = document.querySelector("form#contactform input#lastname");
            const email = document.querySelector("form#contactform input#email");
            const telephone = document.querySelector("form#contactform input#telephone");
            const company = document.querySelector("form#contactform input#company");
            const type = document.querySelector("form#contactform select#type");
            const assign = document.querySelector("form#contactform select#assign");
            const formstatus = document.querySelector("section#changearea form#contactform div.newcontactstat");

            addcontactbtn.onclick = (event)=>{
                event.preventDefault();
                if (firstname.value.length == 0){
                    formstatus.classList.remove("hide");
                    formstatus.classList.remove("success");
                    formstatus.classList.add("fail");
                    firstname.classList.remove("inputnormal");
                    firstname.classList.add("inputerror");
                    lastname.classList.remove("inputerror");
                    lastname.classList.add("inputnormal");
                    email.classList.remove("inputerror");
                    email.classList.add("inputnormal");
                    telephone.classList.remove("inputerror");
                    telephone.classList.add("inputnormal");
                    company.classList.remove("inputerror");
                    company.classList.add("inputnormal");
                    return;
                }
                else if (lastname.value.length == 0){
                    formstatus.classList.remove("hide");
                    formstatus.classList.remove("success");
                    formstatus.classList.add("fail");
                    firstname.classList.remove("inputerror");
                    firstname.classList.add("inputnormal");
                    lastname.classList.remove("inputnormal");
                    lastname.classList.add("inputerror");
                    email.classList.remove("inputerror");
                    email.classList.add("inputnormal");
                    telephone.classList.remove("inputerror");
                    telephone.classList.add("inputnormal");
                    company.classList.remove("inputerror");
                    company.classList.add("inputnormal");
                    return;
                }
                else if (email.value.length == 0){
                    formstatus.classList.remove("hide");
                    formstatus.classList.remove("success");
                    formstatus.classList.add("fail");
                    firstname.classList.remove("inputerror");
                    firstname.classList.add("inputnormal");
                    lastname.classList.remove("inputerror");
                    lastname.classList.add("inputnormal");
                    email.classList.remove("inputnormal");
                    email.classList.add("inputerror");
                    telephone.classList.remove("inputerror");
                    telephone.classList.add("inputnormal");
                    company.classList.remove("inputerror");
                    company.classList.add("inputnormal");
                    return;
                }
                else if (telephone.value.length == 0){
                    formstatus.classList.remove("hide");
                    formstatus.classList.remove("success");
                    formstatus.classList.add("fail");
                    firstname.classList.remove("inputerror");
                    firstname.classList.add("inputnormal");
                    lastname.classList.remove("inputerror");
                    lastname.classList.add("inputnormal");
                    email.classList.remove("inputerror");
                    email.classList.add("inputnormal");
                    telephone.classList.remove("inputnormal");
                    telephone.classList.add("inputerror");
                    company.classList.remove("inputerror");
                    company.classList.add("inputnormal");
                    return;
                }
                else if (company.value.length == 0){
                    formstatus.classList.remove("hide");
                    formstatus.classList.remove("success");
                    formstatus.classList.add("fail");
                    firstname.classList.remove("inputerror");
                    firstname.classList.add("inputnormal");
                    lastname.classList.remove("inputerror");
                    lastname.classList.add("inputnormal");
                    email.classList.remove("inputerror");
                    email.classList.add("inputnormal");
                    telephone.classList.remove("inputerror");
                    telephone.classList.add("inputnormal");
                    company.classList.remove("inputnormal");
                    company.classList.add("inputerror");
                    return;
                }
                else{
                    const formData = {
                        title: title.options[title.selectedIndex].value,
                        firstname: firstname.value,
                        lastname: lastname.value,
                        email: email.value,
                        telephone: telephone.value,
                        company: company.value,
                        type: type.options[type.selectedIndex].value,
                        assign: assign.options[assign.selectedIndex].value,
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

                        firstname.classList.remove("inputerror");
                        firstname.classList.add("inputnormal");
                        lastname.classList.remove("inputerror");
                        lastname.classList.add("inputnormal");
                        email.classList.remove("inputerror");
                        email.classList.add("inputnormal");
                        telephone.classList.remove("inputerror");
                        telephone.classList.add("inputnormal");
                        company.classList.remove("inputerror");
                        company.classList.add("inputnormal");
                    })
                }
            };  
        }
    }, 1000 );

    newcontact.onclick = (event) =>{
        event.preventDefault();
        changearea.innerHTML = "";
        fetch(cleanUrl, {method : 'GET'})
        .then(resp => resp.text())
        .then(resp=>{
            let parsedDom = parserObj.parseFromString(resp, "text/html");
            changearea.appendChild(parsedDom.getElementById("contactform"));
        })
    }
});