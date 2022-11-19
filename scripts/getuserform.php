<?php
session_start(); 

if (!isset($_SESSION['uid'], $_SESSION['first_name'], $_SESSION['last_name'])){
    echo "Oops, your session was disrupted, try again later.";
}
else {

echo " <form id='newuserform'>
        <h2 class='formtitle'>New User</h2>
            <div class='adduserstat'> </div>
            <div class='formstatus'> </div>
            <div class='formgrp'> 
                <label>Firstname</label>
                <input id ='fname'class='inputnormal' type='text' placeholder='Jane' name='firstname' required>
            </div>
            <div class='formgrp'> 
                <label>Lastname</label>
                <input id='lname'class='inputnormal' type='text' placeholder='Doe' name='lastname' required>
            </div>
            <div class='formgrp'> 
                <label>Email</label>
                <input id='email' class='inputnormal' type='email' placeholder='something@example.com' name='email' required>
            </div>
            <div class='formgrp'> 
                <label>Password</label>
                <input id='password'class='inputnormal' type='password' name='password' required>
            </div>
            <div class='formgrp'> 
                <label for='Role'>Role</label>
                <select class='inputnormal' name='role' id='role'>
                    <option value='Member'>Member</option>
                    <option value='Admin'>Admin</option>
                </select>
            </div>
            <button type= 'submit' name='adduserbtn' id='adduserbtn'> Save </button>
        </form>";

} 


