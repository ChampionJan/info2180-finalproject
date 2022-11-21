<?php
session_start();
require "dbconnect.php";
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_SESSION['first_name'])&& isset($_SESSION['last_name'])){
    $id= $_GET['contactid'];

  $contactsql = "SELECT * FROM contacts WHERE id = :id";
  $contactstmt = $conn -> prepare($contactsql);
  $contactstmt->execute(array(
      ':id' => $id
  ));
  $contact = $contactstmt->fetch(PDO::FETCH_ASSOC);

  $updated = $contact['updated_at'];
  $updatedday = date('F jS, Y',strtotime($updated));

  $assignsql = "SELECT * FROM users WHERE id = :id";
  $assignstmt = $conn -> prepare($assignsql);
  $assignstmt->execute(array(
        ':id' => $contact['assigned_to']
  ));
  $assigneduser = $assignstmt->fetch(PDO::FETCH_ASSOC);

  $creatorsql = "SELECT * FROM users WHERE id = :id";
  $creatorstmt = $conn -> prepare($creatorsql);
  $creatorstmt->execute(array(
        ':id' => $contact['created_by']
  ));
  $creator = $creatorstmt->fetch(PDO::FETCH_ASSOC);
  $createdday = date('F n, Y',strtotime($contact['created_at']));

  $contact_id = $id;
  $notessql = "SELECT * FROM notes WHERE contact_id = :contact_id";
        $notesstmt = $conn->prepare($notessql);
        $notesstmt->execute(array(
            ':contact_id' => $contact_id
        ));
        $contactnotes = $notesstmt->fetchAll(PDO::FETCH_ASSOC);

  if($updated == "0000-00-00 00:00:00"){
    $updated = "- -";
  }
  $singlecontact = "
               <div id=\"contactparent\"> 
                <section id= \"contacthead\"> 
                    <h2> {$contact['title']} {$contact['firstname']} {$contact['lastname']}</h2>
                    <span>Created on {$createdday} by {$creator['firstname']} {$creator['lastname']} <br> </span>
                    <span>Updated on {$updated}</span>
                    <button chk =\"{$contact['id']}\"id=\"assigntome\"> Assign to me </button>
                    <button chk =\"{$contact['id']}\" id=\"switchsaleslead\"> Switch to Sales Lead </button>
                </section>
                <section id=\"contactinfo\"> 
                    <div class=\"infogrp\">
                        <span class=\"label\">Email</span>
                        <span>{$contact['email']}</span>
                    </div>
                    <div class=\"infogrp\">
                        <span class=\"label\">Telephone</span>
                        <span>{$contact['telephone']}</span>
                    </div>
                    <div class=\"infogrp\">
                        <span class=\"label\">Company</span>
                        <span>{$contact['company']}</span>
                    </div>
                    <div class=\"infogrp\">
                        <span class=\"label\">Assigned To</span>
                        <span>{$assigneduser['firstname']} {$assigneduser['lastname']}</span>
                    </div>
                </section>
                
                <section id=\"contactnotes\"> 
                    <h6> Notes </h6>
                    <hr>";

                    foreach($contactnotes as $contactnote){
                        $namesql = "SELECT * FROM contacts WHERE contact_id = :contact_id";
                        $namestmt = $conn -> prepare($namesql);
                        $namestmt->execute(array(
                            ':id' => $supportcontact['assigned_to']
                        ));
                        $user = $namestmt->fetch(PDO::FETCH_ASSOC);
        
                        $singlecontact .= 
                        "<p> {$contactnote['created_by']} </p>
                         <p> {$contactnote['comment']} </p>
                         <p> {$contactnote['created_at']}</p>";  
                    }

                    $singlecontact .= "</section>

                    <form id='noteform'>
                    <h6 class='formtitle'>Add a note about {$contact['firstname']}</h6>
                    <div class='newnotestat'> </div>
                    <div class='formstatus'> </div>
                    <div class='formgrp'> 
                    <label for='Comment'>Comment</label>
                    <textarea form='issueform' rows='5' cols='50' class='txtANormal' placeholder='Enter details here' id='comment'> </textarea>
                    </div>

                    <button type= 'submit' name='addnotebtn' id='addnotebtn'> Add Note </button>
                    
                                        </div>";

                echo $singlecontact;
}
