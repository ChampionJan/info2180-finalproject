<?php
session_start();
require "dbconnect.php";
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_SESSION['first_name'])&& isset($_SESSION['last_name'])){
    $id= $_GET['contactid'];

    $_SESSION['contactid'] = $id;
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
  $createdday = date('F j, Y',strtotime($contact['created_at']));

  $contact_id = $id;
  $notessql = "SELECT * FROM notes WHERE contact_id = :contact_id";
        $notesstmt = $conn->prepare($notessql);
        $notesstmt->execute(array(
            ':contact_id' => $contact_id
        ));
        $contactnotes = $notesstmt->fetchAll(PDO::FETCH_ASSOC);


  $usersql = "SELECT * FROM users";
  $usersstmt = $conn->prepare($usersql);
  $usersstmt->execute();
  $allusers = $usersstmt->fetchAll(PDO::FETCH_ASSOC);

  if($updated == "0000-00-00 00:00:00"){
    $updated = "- -";
  } else{
    $updated= date('F j, Y',strtotime($updated));
  }

  $otherrole = "Support";
  if($contact['type'] == "Support"){
    $otherrole = "Sales Lead";
  }

  $singlecontact = "
            <div id=\"contactpage\"> 
               <div id=\"contactparent\"> 
                <section id= \"contacthead\"> 
                    <div id= \"contactdetails\" >
                        <div id= \"contactimage\" >
                            <img src= \"images/profile.png\"/>
                        </div>
                        <div id= \"contacttext\" >
                            <h2> {$contact['title']} {$contact['firstname']} {$contact['lastname']}</h2>
                            <span>Created on {$createdday} by {$creator['firstname']} {$creator['lastname']} <br> </span>
                            <span id=\"updated\">Updated on {$updated}</span>
                        </div>
                    </div>
                    <div id= \"contactbuttons\" >
                        <button chk =\"{$contact['id']}\"id=\"assigntome\"> <img src=\"images/hand.png\"/> Assign to me </button>
                        <button chk =\"{$contact['id']}\" id=\"switchtoother\"> <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 448 512\"> <path d=\"M438.6 150.6c12.5-12.5 12.5-32.8 0-45.3l-96-96c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.7 96 32 96C14.3 96 0 110.3 0 128s14.3 32 32 32l306.7 0-41.4 41.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l96-96zm-333.3 352c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 416 416 416c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0 41.4-41.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-96 96c-12.5 12.5-12.5 32.8 0 45.3l96 96z\"/></svg> Switch to {$otherrole} </button>
                    </div>
                </section>
                <section id=\"contactinfo\">
                    <table id=\"contactinfotable\">
                        <tr>
                            <td>
                                <span class=\"label\">Email</span>
                            </td>
                            <td>
                                <span class=\"label\">Telephone</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>{$contact['email']}</span>
                            </td>
                            <td>
                                <span>{$contact['telephone']}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class=\"label\">Company</span>
                            </td>
                            <td>
                                <span class=\"label\">Assigned To</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>{$contact['company']}</span>
                            </td>
                            <td>
                                <span id=\"assigned\">{$assigneduser['firstname']} {$assigneduser['lastname']}</span>
                            </td>
                        </tr>
                    </table>
                </section>
                
                <section id=\"contactnotes\"> 
                    <div>
                    <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><path d=\"M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z\"/></svg>
                        <h5> Notes </h5>
                        </div><hr>";

                    foreach($contactnotes as $contactnote){
                        /*$namesql = "SELECT * FROM contacts WHERE contact_id = :contact_id";
                        $namestmt = $conn -> prepare($namesql);
                        $namestmt->execute(array(
                            ':contact_id' => $contactnote['id']
                        ));
                        $user = $namestmt->fetch(PDO::FETCH_ASSOC); */

                        if($contactnote['contact_id'] == $contact['id']){
                            $notecreatorname = "";
                            $notedate = date('F j, Y',strtotime($contactnote['created_at']));
                            $notetime = date('g a',strtotime($contactnote['created_at']));
                            $notecreator = $contactnote['created_by'];
                            foreach($allusers as $oneuser){
                                if($oneuser['id'] == $notecreator){
                                    $notecreatorname .= $oneuser['firstname']." ".$oneuser['lastname'];
                                    break;
                                }
                            }
                            $singlecontact .= 
                            "<div>
                                <p><b> {$notecreatorname} </b></p>
                                <p> {$contactnote['comment']} </p>
                                <p> {$notedate} at {$notetime}</p></div>";
                        }  
                    }

                    $singlecontact .= "<div>

                    <form id='noteform'>
                    <table id='noteformtable'>
                        <tr>
                            <td>
                                <h5 class='formtitle'>Add a note about {$contact['firstname']}</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <textarea form='issueform' rows='5' cols='50' class='txtANormal' placeholder=\" Enter details here\" id='comment'></textarea>
                            </td>
                        </tr>
                    </table>
                    <table id='notebuttontable'>
                        <tr>
                            <td>
                                <div class='formstatus' id='notestatus'> </div>
                            </td>
                            <td>
                                <button type= 'submit' name='addnotebtn' id='addnotebtn'> Add Note </button>
                            </td>
                        </tr>
                    </table>
                    </form>
                        </div></section></div></div>";

                echo $singlecontact;
}
