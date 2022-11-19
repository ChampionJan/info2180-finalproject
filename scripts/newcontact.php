<?php
session_start();
require "dbconnect.php";
$cleanedtitle= "";
$cleanedfirstname= "";
$cleanedlastname= "";
$cleanedemail= "";
$cleanedtelephone= "";
$cleanedcompany= "";
$cleanedtype= "";
$cleanedassign= "";
$status = "Open";
$createdby = $_SESSION['uid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $jsn = file_get_contents('php://input');
    $data = json_decode($jsn);
    $cleanedtitle = filter_var($data->title, FILTER_SANITIZE_SPECIAL_CHARS);
    $cleanedfirstname = filter_var($data->firstname, FILTER_SANITIZE_SPECIAL_CHARS);
    $cleanedlastname = filter_var($data->lastname, FILTER_SANITIZE_SPECIAL_CHARS);
    $cleanedemail = filter_var($data->email, FILTER_SANITIZE_SPECIAL_CHARS);
    $cleanedtelephone = filter_var($data->telephone, FILTER_SANITIZE_SPECIAL_CHARS);
    $cleanedcompany = filter_var($data->company, FILTER_SANITIZE_SPECIAL_CHARS);
    $cleanedtype = filter_var($data->type, FILTER_SANITIZE_SPECIAL_CHARS);
    $cleanedassign = filter_var($data->assign, FILTER_SANITIZE_SPECIAL_CHARS);
    $cleanedassign = explode(" ", $cleanedassign);
    $fname= $cleanedassign[0];
    $lname= $cleanedassign[1];
    date_default_timezone_set('US/Eastern');
    $currentdate = date("Y-m-d");

    $idsql = "SELECT * FROM users WHERE firstname = :fname AND lastname = :lname";
    $idstmt =  $conn -> prepare($idsql);
    $idstmt->execute(array(
        ':fname' => $fname,
        ':lname' => $lname
    ));
    $user = $idstmt->fetch(PDO::FETCH_ASSOC);
    $cleanedassign = $user['id'];
   
    $sql = "INSERT INTO contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) 
    VALUES (:title, :firstname, :lastname, :email, :telephone, :company, :type, :assigned_to, :createdby, :created_at, :updated_at)";

     $prep = $conn -> prepare($sql);
     

    if ($prep -> execute( array(
        ':title' => $cleanedtitle,
        ':firstname' => $cleanedfirstname,
        ':lastname' => $cleanedlastname,
        ':email' => $cleanedemail,
        ':telephone' => $cleanedtelephone,
        ':company' => $cleanedcompany, 
        ':type' => $cleanedtype, 
        ':assigned_to' => $cleanedassign, 
        ':createdby' => $createdby, 
        ':created_at' => $currentdate,
        ':updated_at' => $currentdate) ) ) 
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