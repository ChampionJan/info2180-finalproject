<?php
session_start();
require "dbconnect.php";
if (isset($_SESSION['first_name'])&& isset($_SESSION['last_name'])){
    $usertableconstruct = "";
    $sql = "SELECT * FROM users";
        $stmt = $conn->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $usertableconstruct= "
            <section class=\"userlistheadparent\">
                <h2 class=\"userlisthead\"> Users </h2>
                <button id=\"createuserbtn\"> Add User </button>
            </section>
            <section class=\"userlistfootparent\">
            <table id='usertable'>
                <thead>
                    <th>Name</th> 
                    <th>Email</th>
                    <th>Role</th> 
                    <th>Created</th>  
                </thead>";
    
                foreach($users as $user){

                    $properrole = ucfirst($user['role']);
                    $userdate = date('Y-m-d h:i',strtotime($user['created_at']));
                    $usertableconstruct .= 
                    "<tr class=\"temprow\"> 
                    <td><span class=\"fullname\">{$user['firstname']} {$user['lastname']}</span></td>
                    <td>{$user['email']} </td>
                    <td>{$properrole} </td>
                    <td>{$userdate} </td>
                    </tr>";  
                 }
    
                 $usertableconstruct.=  "</table></section>";

    echo $usertableconstruct;
}
