<?php
session_start();
require "dbconnect.php";
$cleanedcomment= "";
$createdby = $_SESSION['uid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

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
        echo "OK";
    }
    else{
        echo "NO";
    }

}
else{
    echo "We can't process your request at this time";
}