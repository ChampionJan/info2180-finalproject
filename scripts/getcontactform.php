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
" <section class=\"formheadparent\">
<h2 class='formtitle'>New Contact</h2>
<div class='newcontactstat'> </div>
  </section>
  <section class=\"formfootparent\">
    <table id= 'contactformtable'>
        <form id='contactform'>
            <tr>
                <td>
                    <label for='title'>Title</label>
                </td>
            </tr>
            <tr>
                <td>   
                    <select class='inputnormal contactinput' name='title' id='title'>
                        <option value='Mr'>Mr.</option>
                        <option value='Ms'>Ms.</option>
                        <option value='Mrs'>Mrs.</option>
                        <option value='Dr'>Dr.</option>
                        <option value='Prof'>Prof.</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label>First Name</label>
                </td>
                <td>
                    <label>Last Name</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input id ='firstname' class='inputnormal contactinput' type='text' placeholder='Jane' name='firstname' required>
                </td>
                <td>
                    <input id ='lastname' class='inputnormal contactinput' type='text' placeholder='Doe' name='lastname' required>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Email</label>
                </td>
                <td>
                    <label>Telephone</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input id ='email' class='inputnormal contactinput' type='text' placeholder='something@example.com' name='email' required>
                </td>
                <td>
                    <input id ='telephone' class='inputnormal contactinput' type='text' name='telephone' required>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Company</label>
                </td>
                <td>
                    <label for='Type'>Type</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input id ='company' class='inputnormal contactinput' type='text' name='company' required>
                </td>
                <td>
                    <select class='inputnormal contactinput' name='type' id='type'>
                        <option value='Sales Lead'>Sales Lead</option>
                        <option value='Support'>Support</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for='assign'>Assigned To</label>
                </td>
            </tr>
            <tr>
                <td>
                    <select class='inputnormal contactinput' name='assign' id='assign'>";
                        foreach($users as $user){
                            $formconstruct .= "<option value= \"{$user['firstname']} {$user['lastname']} \"> {$user['firstname']} {$user['lastname']} </option> ";  
                        }
                        $formconstruct.= 
                            "</select>
                            </td>
                            <td>
                                <div class='formstatus' id='contactstatus'> </div>
                            </td>
                            </tr>
            <tr class='buttonrow'>
                <td>
                </td>
                <td>
                    <button type= 'submit' name='addcontactbtn' id='addcontactbtn'> Save </button>
                </td>
            </tr>
        </form></table></section>";

        echo $formconstruct;

} 
?>