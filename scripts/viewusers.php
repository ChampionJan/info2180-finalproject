<?php
session_start();
require "dbconnect.php";
if (isset($_SESSION['first_name'])&& isset($_SESSION['last_name'])){
    $usertableconstruct = "";
    $sql = "SELECT * FROM users";
        $stmt = $conn->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $usertableconstruct= "
           <section id=\"userlistheaduniverse\">
            <section class=\"userlistheadparent\">
                <h1 class=\"userlisthead\"> Users </h1>
                <button id=\"createuserbtn\"> Add User </button>
            </section>
            <table id='usertable'>
                <thead>
                    <th>Name</th> 
                    <th>Email</th>
                    <th>Role</th> 
                    <th>Created</th>  
                </thead>";
    
                foreach($users as $user){
                    $namesql = "SELECT * FROM users WHERE id = :id";
                    $namestmt = $conn -> prepare($namesql);
                    $user = $namestmt->fetch(PDO::FETCH_ASSOC);
                    $usertableconstruct .= 
                    "<tr class=\"temprow\"> 
                    <td><span class=\"fullname\">{$user['title']} {$user['firstname']} {$user['lastname']}</span></td>
                    <td>{$user['email']} </td>
                    <td>{$user['role']} </td>
                    <td>{$user['created_at']} </td>
                    </tr>";  
                 }
    
                 $usertableconstruct.=  "</table>
                                        </section>";

    echo $usertableconstruct;
}
