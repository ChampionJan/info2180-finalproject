<?php
session_start(); 
require "dbconnect.php";

if (!isset($_SESSION['uid'], $_SESSION['first_name'], $_SESSION['last_name'])){
    echo "Oops, your session was disrupted, try again later.";
}
else {

$sql = "SELECT * FROM users";
$stmt = $conn->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);


$formconstruct = 
" <form id='contactform'>
        <h3 class='formtitle'>New Contact</h3>
            <div class='newcontactstat'> </div>
            <div class='formstatus'> </div>
            <div class='formgrp'> 
                <label for='title'>Title</label>
                <select class='inputnormal' name='title' id='title'>
                    <option value='Mr'>Mr.</option>
                    <option value='Ms'>Ms.</option>
                    <option value='Mrs'>Mrs.</option>
                    <option value='Dr'>Dr.</option>
                    <option value='Prof'>Prof.</option>
                </select>
            </div>
            <div class='formgrp'> 
                <label>First Name</label>
                <input id ='firstname' class='inputnormal' type='text' placeholder='Jane' name='firstname' required>
            </div>
            <div class='formgrp'> 
                <label>Last Name</label>
                <input id ='lastname' class='inputnormal' type='text' placeholder='Doe' name='lastname' required>
            </div>
            <div class='formgrp'> 
                <label>Email</label>
                <input id ='email' class='inputnormal' type='text' placeholder='something@example.com' name='email' required>
            </div>
            <div class='formgrp'> 
                <label>Telephone</label>
                <input id ='telephone' class='inputnormal' type='text' name='telephone' required>
            </div>
            <div class='formgrp'> 
                <label>Company</label>
                <input id ='company' class='inputnormal' type='text' name='company' required>
            </div>
            <div class='formgrp'> 
                <label for='Type'>Type</label>
                <select class='inputnormal' name='type' id='type'>
                    <option value='Sales Lead'>Sales Lead</option>
                    <option value='Support'>Support</option>
                </select>
            </div>
            <div class='formgrp'> 
                <label for='assign'>Assigned To</label>
                <select class='inputnormal' name='assign' id='assign'>";

                foreach($users as $user){
                  $formconstruct .= "<option value= \"{$user['firstname']} {$user['lastname']} \"> {$user['firstname']} {$user['lastname']} </option> ";  
               }
             $formconstruct.= 
             "</select>
            </div>
            <button type= 'submit' name='addcontactbtn' id='addcontactbtn'> Save </button>
        </form>";

        echo $formconstruct;

} 
?>