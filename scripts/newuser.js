window.addEventListener("load", event => {
    const adduser =  document.getElementById("createuserbtn");
    const changearea= document.querySelector("section#changearea");
    const cleanUrl = "scripts/getuserform.php".replace( /"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g,'');

    setInterval( ()=>{

        const adduser =  document.getElementById("createuserbtn");
        const getformUrl = "scripts/getuserform.php".replace( /"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g,'');
        if (document.contains(adduser)){
            adduser.onclick= (event) =>{
                fetch(getformUrl, {method : 'GET'})
                .then(resp => resp.text())
                .then(resp=>{
                    changearea.innerHTML = resp;
                })
            }   
        }
    },1000);      
    
    let newuserform = setInterval( ()=>{
        if (document.contains(document.getElementById("userform"))){
            const createuserbtn = document.getElementById("adduserbtn");
            const cleanUrl = "scripts/newuser.php".replace( /"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g,'');
            const firstname = document.getElementById("firstname");
            const lastname = document.getElementById("lastname");
            const email = document.getElementById("email");
            const password = document.getElementById("password");
            const role = document.getElementById("role");
            const formstatus = document.getElementById("userstatus");
            const emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ ;
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/g;
            let errors =[
                "Your email is invalid, please check and try again.",
                "Your first name is not of the correct format. Please check and try again.",
                "Your last name is not of the correct format. Please check and try again.",
                "An account with this email address already exists. Contact your Administrator for help.",
                
            ];

            createuserbtn.onclick = (event) =>{
                event.preventDefault();

                if(firstname.value.length == 0){
                    formstatus.classList.remove("hide");
                    formstatus.classList.remove("success");
                    formstatus.classList.add("fail");                    
                    firstname.classList.remove("inputnormal");
                    firstname.classList.add("inputerror");
                    email.classList.remove("inputerror");
                    email.classList.add("inputnormal");
                    password.classList.remove("inputerror");
                    password.classList.add("inputnormal");
                    lastname.classList.remove("inputerror");
                    lastname.classList.add("inputnormal");
                    formstatus.innerHTML = "You must enter a firstname.";
                    return;
                }

                if(lastname.value.length == 0){
                    formstatus.classList.remove("hide");
                    formstatus.classList.remove("success");
                    formstatus.classList.add("fail");
                    firstname.classList.remove("inputnormal");
                    firstname.classList.add("inputerror");
                    email.classList.remove("inputerror");
                    email.classList.add("inputnormal");
                    password.classList.remove("inputerror");
                    password.classList.add("inputnormal");
                    lastname.classList.remove("inputnormal");
                    lastname.classList.add("inputerror");
                    formstatus.innerHTML = "You must enter a lastname.";
                    return;
                }

                if (email.value.length == 0 || !emailRegex.test(email.value.toLowerCase())){
                    formstatus.classList.remove("hide");
                    formstatus.classList.remove("success");
                    formstatus.classList.add("fail");
                    email.classList.remove("inputnormal");
                    email.classList.add("inputerror");
                    firstname.classList.remove("inputerror");
                    firstname.classList.add("inputnormal");
                    lastname.classList.remove("inputerror");
                    lastname.classList.add("inputnormal");
                    password.classList.remove("inputerror");
                    password.classList.add("inputnormal");
                    formstatus.innerHTML = "Please check the email field and try again.";
                    return;
                }

                if(password.value.length == 0 || !passwordRegex.test(password.value)){

                    formstatus.classList.remove("hide");
                    formstatus.classList.remove("success");
                    formstatus.classList.add("fail");
                    password.classList.remove("inputnormal");
                    password.classList.add("inputerror");
                    firstname.classList.remove("inputerror");
                    firstname.classList.add("inputnormal");
                    lastname.classList.remove("inputerror");
                    lastname.classList.add("inputnormal");
                    email.classList.remove("inputerror");
                    email.classList.add("inputnormal");
                    formstatus.innerHTML = "Your password must be at least 8 characters, with at least 1 capital letter, lowercase letter and number.";
                    return;
                }
                else{
                    const formData = {
                        firstname: firstname.value,
                        lastname: lastname.value,
                        password: password.value,
                        email: email.value,
                        role: role.value,
                    };
                    fetch(cleanUrl, {
                        method : 'POST',
                        headers: {
                            "Content-Type" : "application/json",
                            "Accept" : "application/json",
                        },
                        body: JSON.stringify(formData),
                        mode: "cors",
                    })
                    .then(resp => resp.text())
                    .then(resp =>{
                        if (parseInt(resp) === 0 || parseInt(resp) === 1 || parseInt(resp) === 2 || parseInt(resp) === 3){
                            formstatus.classList.remove("hide");
                            formstatus.classList.remove("success");
                            formstatus.classList.add("fail");
                            formstatus.innerHTML = errors[parseInt(resp)];
                        }
                        else if (parseInt(resp) === 4){
                            formstatus.classList.remove("hide");
                            formstatus.classList.remove("fail");
                            formstatus.classList.add("success");
                            formstatus.innerHTML = "New user added successfully!"

                        }
                        else{
                            formstatus.classList.remove("hide");
                            formstatus.innerHTML = resp; 
                            }
                        })
                }
            }
        }
    },1000);
})
