window.addEventListener("load", event => {
    const emailField = document.querySelector("input[type='email']");
    const passwordField = document.querySelector("input[type='password']");
    const formstatus = document.querySelector("section#changearea form div.formstatus");
    const footer = document.getElementById("footer");
    footer.classList.add("hide");
    formstatus.classList.add("hide");
    const submitbtn = document.querySelector("section#changearea form button#submitbtn");
    const changearea= document.querySelector("section#changearea");
    const emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ ;
    
    const errors =[
        "This account was not found, Contact your administrator for help.",
        "Invalid Password, check your info and try again",
        "You did not provide a valid, please check and try again",
        "We are unable to start your session at this time. Try again later"
    ];
    submitbtn.addEventListener("click", event => {

        event.preventDefault();

        if ( (emailField.value.length == 0 || !emailRegex.test(emailField.value.toLowerCase())) && passwordField.value.length !=0){
            formstatus.classList.remove("hide");
            formstatus.classList.remove("success");
            formstatus.classList.add("fail");
            emailField.classList.remove("inputnormal");
            emailField.classList.add("inputerror");
            passwordField.classList.remove("inputerror");
            passwordField.classList.add("inputnormal");
            formstatus.innerHTML = "Please check your email field and try again.";
        }
        else if (passwordField.value.length == 0 && emailField.value.length !=0){

            formstatus.classList.remove("hide");
            formstatus.classList.remove("success");
            formstatus.classList.add("fail");
            passwordField.classList.remove("inputnormal");
            passwordField.classList.add("inputerror");
            emailField.classList.remove("inputerror");
            emailField.classList.add("inputnormal");
            formstatus.innerHTML = "You must enter a password";

        }
        else if (passwordField.value.length == 0 && emailField.value.length == 0){

            formstatus.classList.remove("hide");
            formstatus.classList.remove("success");
            formstatus.classList.add("fail");
            emailField.classList.remove("inputnormal");
            emailField.classList.add("inputerror");
            passwordField.classList.remove("inputnormal");
            passwordField.classList.add("inputerror");
            formstatus.innerHTML = "The email and password fields can't be empty.";

        } else{
            let formData = {
                email: emailField.value,
                password: passwordField.value,
            };
            const cleanUrl = "scripts/login.php".replace( /"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g,'');
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
                    formstatus.classList.add("fail");
                    formstatus.innerHTML = errors[parseInt(resp)];
                }
                else if (parseInt(resp) === 4){
                    document.getElementsByTagName("aside")[0].classList.remove("hide");
                    document.getElementsByTagName("aside")[0].classList.add("asidestyle");
                    document.querySelector("div#central").classList.add("centralstyle");
                    changearea.style.width="85%";
                    changearea.innerHTML = "";
                    const listUrl = new URL('http://localhost/info2180-finalproject/scripts/homepage.php');
                    let params = {btn: "all"};
                    listUrl.search = new URLSearchParams(params).toString();
                    fetch(listUrl, {method : 'GET'})
                    .then(resp => resp.text())
                    .then(resp=>{
                        changearea.innerHTML =resp;
                        document.querySelector("table#contacttable").classList.add("contacttable");
                    })


                }
                
            })
            
        }
    });    
    
});