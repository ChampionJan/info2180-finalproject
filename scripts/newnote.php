<?php
session_start();
require "dbconnect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $cleanedcomment= "";
    $createdby = $_SESSION['uid'];
    $contactid = $_GET['contactid'];
    date_default_timezone_set('US/Eastern');
    $updated =  date('Y-m-d H:i:s');
    $contactsql = "SELECT * FROM contacts WHERE id = :id";
    $contactstmt = $conn -> prepare($contactsql);
    $contactstmt->execute(array(
      ':id' => $contactid
    ));
    $contact = $contactstmt->fetch(PDO::FETCH_ASSOC);
    $updatedday= date('F n, Y',strtotime($updated));
    $updatedtime = date('h:i A',strtotime($updated));

    $jsn = file_get_contents('php://input');
    $data = json_decode($jsn);
    $cleanedcomment = filter_var($data->comment, FILTER_SANITIZE_SPECIAL_CHARS);
    date_default_timezone_set('US/Eastern');
   
    $sql = "INSERT INTO notes (contact_id, comment, created_by) 
    VALUES (:contact_id, :comment, :createdby)";

     $prep = $conn -> prepare($sql);
     

    if ($prep -> execute( array(
        ':contact_id' => $_SESSION['contactid'],
        ':comment' => $cleanedcomment,
        ':createdby' => $createdby) ) ) 
        {
            $timesql = "UPDATE contacts SET updated_at = :updated_at WHERE id = :id";
            $timestmt = $conn -> prepare($timesql);
            $timestmt->execute(array(
                ':updated_at' => $updated,
                ':id' => $contactid
            ));   
        echo "Updated on {$updatedday} * $cleanedcomment";
    }
    else{
        echo "NO";
    }

}
else{
    echo "We can't process your request at this time";
}