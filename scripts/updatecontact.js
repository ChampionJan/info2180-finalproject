window.addEventListener("load", (event)=>{

    let updatecontactcheck = setInterval( ()=>{
        
        const btnparent = document.getElementById("contacthead");
        if(document.contains(btnparent)){
            let assigntome = document.getElementById("assigntome");
            let assigntomeval = assigntome.getAttribute("chk");
            let switchtoother = document.getElementById("switchtoother");
            let updated = document.getElementById("updated");
            let assigned = document.getElementById("assigned")
            let updateContactUrl = "";
                
                assigntome.onclick = event => {
                    event.preventDefault();
                    updateContactUrl = new URL(`http://localhost/info2180-finalproject/scripts/updatecontact.php`);
                    let params = {check: "assigntome", contactid: assigntomeval};
                    updateContactUrl.search = new URLSearchParams(params).toString();
                    fetch(updateContactUrl, {
                        method : 'POST',  
                    })
                    .then(resp => resp.text())
                    .then(resp=>{
                        console.log(resp);
                        updated.innerHTML= resp.substring(0, resp.indexOf('*'))
                        assigned.innerHTML = resp.substring(resp.indexOf('*') + 1);
                    }) 
                     
                }
                switchtoother.onclick = event => {
                    event.preventDefault();
                    updateContactUrl = new URL(`http://localhost/info2180-finalproject/scripts/updatecontact.php`);
                    let params = {check: "switchtoother", contactid: assigntomeval};
                    updateContactUrl.search = new URLSearchParams(params).toString();
                    let buttoncheck = setInterval( ()=>{
                    fetch(updateContactUrl, {
                        method : 'POST',
                    })
                    .then(resp => resp.text())
                    .then(resp=>{
                        
                        updated.innerHTML= resp.substring(0, resp.indexOf('*'));
                        switchtoother.innerText = switchtoother.textContent = resp.substring(resp.indexOf('*') + 1);
                        clearInterval(buttoncheck);
                        })
                    }, 1000);  
                }   
        }
    }, 1000);

});