window.addEventListener("load", event =>{

    const newcontact =  document.querySelector("aside div.menu button#newcontact");
    const changearea= document.querySelector("section#changearea");
    const cleanUrl = "scripts/getcontactform.php".replace( /"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g,'');

    let contactForm = setInterval( ()=>{
        if(document.contains(document.getElementById("contactform"))){
            const addcontactbtn = document.getElementById("addcontactbtn");
            const cleanUrl2 = "scripts/newcontact.php".replace( /"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g,'');
            const title = document.getElementById("title");
            const firstname = document.getElementById("firstname");
            const lastname = document.getElementById("lastname");
            const email = document.getElementById("email");
            const telephone = document.getElementById("telephone");
            const company = document.getElementById("company");
            const type = document.getElementById("type");
            const assign = document.getElementById("assign");
            const formstatus = document.getElementById("contactstatus");
            const emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ ;
            const numberRegex = /^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/;
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
                    formstatus.innerHTML = "You must enter a firstname.";
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
                    formstatus.innerHTML = "You must enter a lastname.";
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
                    formstatus.innerHTML = "You must enter an email.";
                    return;
                }
                else if (!emailRegex.test(email.value.toLowerCase())){
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
                    formstatus.innerHTML = "You must enter a valid email address.";
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
                    formstatus.innerHTML = "You must enter a telephone number.";
                    return;
                }
                else if (!numberRegex.test(telephone.value)){
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
                    formstatus.innerHTML = "You must enter a valid 10-digit telephone number.";
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
                    formstatus.innerHTML = "You must enter a company name.";
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
                            formstatus.innerHTML = "New contact added successfully! Press a button to continue."
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
            changearea.innerHTML =resp;
            document.querySelector("form#contactform").classList.add("contactform");
            })
    }
});