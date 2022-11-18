window.addEventListener("load",event=>{

    window.onbeforeunload = function() {
        alert("Don't")
    }

    let home= document.querySelector("aside div.menu button#home");
    let changearea= document.querySelector("section#changearea");
    let contactlinks = document.querySelectorAll("table#contacttable tr td a");
    let filterurl = "";
    home.onclick= event=>{
        changearea.innerHTML="";
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

    contactlinks.forEach((contactlink)=>{
        contactlink.onclick = event => {
            event.preventDefault();
            let id = issuelink.getAttribute("href");
            let contactUrl = new URL('http://localhost/info2180-finalproject/scripts/singlecontact.php');
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

    setInterval( ()=>{

        const homecreatebtn =  document.querySelector("section.contactlistheadparent button#createcontactbtn");
        const getformUrl = "scripts/getcontactform.php".replace( /"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g,'');
        if (document.contains(homecreatebtn)){
            let filterall = document.querySelector("section#filter button#all");
            let filtersupport = document.querySelector("section#filter button#Support");
            let filtersalesleads = document.querySelector("section#filter button#SalesLeads");
            let filterassigned = document.querySelector("section#filter button#assigned");
            homecreatebtn.onclick=event=>{
                fetch(getformUrl, {method : 'GET'})
                .then(resp => resp.text())
                .then(resp=>{
                    changearea.innerHTML = resp;
                })
            }
            filtersupport.onclick =(event)=>{
                filterurl = new URL('http://localhost/info2180-finalproject/scripts/homepage.php');
                let params = {btn: "Support"};
                filterurl.search = new URLSearchParams(params).toString();
                fetch(filterurl, {method : 'GET'})
                .then(resp => resp.text())
                .then(resp=>{
                    changearea.innerHTML = resp;
                    document.querySelector("table#contacttable").classList.add("contacttable");
                })
        
            }
            filtersalesleads.onclick =(event)=>{
                filterurl = new URL('http://localhost/info2180-finalproject/scripts/homepage.php');
                let params = {btn: "SalesLeads"};
                filterurl.search = new URLSearchParams(params).toString();
                fetch(filterurl, {method : 'GET'})
                .then(resp => resp.text())
                .then(resp=>{
                    changearea.innerHTML = resp;
                    document.querySelector("table#contacttable").classList.add("contacttable");
                })
        
            }
            filterassigned.onclick =(event)=>{
                filterurl = new URL('http://localhost/info2180-finalproject/scripts/homepage.php');
                let params = {btn: "assigned"};
                filterurl.search = new URLSearchParams(params).toString();
                fetch(filterurl, {method : 'GET'})
                .then(resp => resp.text())
                .then(resp=>{
                    changearea.innerHTML = resp;
                    document.querySelector("table#contacttable").classList.add("contacttable");
                })
        
            }

            filterall.onclick =(event)=>{
                filterurl = new URL('http://localhost/info2180-finalproject/scripts/homepage.php');
                let params = {btn: "all"};
                filterurl.search = new URLSearchParams(params).toString();
                fetch(filterurl, {method : 'GET'})
                .then(resp => resp.text())
                .then(resp=>{
                    changearea.innerHTML = resp;
                    document.querySelector("table#contacttable").classList.add("contacttable");
                })
        
            }

        }
           

    },1000);


});