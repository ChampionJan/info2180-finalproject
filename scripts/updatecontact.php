<?php
session_start();
require "dbconnect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['first_name'])&& isset($_SESSION['last_name'])){

$check = $_GET['check'];
$contactid = $_GET['contactid'];
date_default_timezone_set('US/Eastern');
$updated =  date('Y-m-d H:i:s');
$typesupport = "Support";
$typesaleslead = "Sales Lead";

$contactsql = "SELECT * FROM contacts WHERE id = :id";
  $contactstmt = $conn -> prepare($contactsql);
  $contactstmt->execute(array(
      ':id' => $contactid
  ));
$contact = $contactstmt->fetch(PDO::FETCH_ASSOC);
$updatedday= date('F n, Y',strtotime($updated));
$updatedtime = date('h:i A',strtotime($updated));

$updater_id = $_SESSION['uid'];

if($check == "assigntome"){
   $timesql = "UPDATE contacts SET updated_at = :updated_at WHERE id = :id";
   $timestmt = $conn -> prepare($timesql);
   $timestmt->execute(array(
       ':updated_at' => $updated,
       ':id' => $contactid
   ));

   $assignedsql = "UPDATE contacts SET assigned_to = :assigned_to WHERE id = :id ";
   $assignedstmt = $conn->prepare($assignedsql);
   $assignedstmt->execute(array(
       ':assigned_to' => $updater_id,
       ':id' => $contactid
   ));

   echo "Updated on {$updatedday} * <span id=\"statuspan\">{$_SESSION['first_name']} {$_SESSION['last_name']}</span>";
}
else if( $check == "switchtoother"){

   $timesql = "UPDATE contacts SET updated_at = :updated_at WHERE id = :id";
   $timestmt = $conn -> prepare($timesql);
   $timestmt->execute(array(
       ':updated_at' => $updated,
       ':id' => $contactid
   ));

   $typecontactsql = "SELECT type from contacts WHERE id = :id";
   $typecontactstmt = $conn -> prepare($typecontactsql);
   $typecontactstmt->execute(array(
    'id' => $contactid
    ));
    $returnedtype = $typecontactstmt->fetch(PDO::FETCH_ASSOC);

    $typesql = "UPDATE contacts SET type = :type WHERE id = :id";
    $typestmt = $conn->prepare($typesql);

   if ($returnedtype["type"] == "Support"){
    $typestmt->execute(array(
        ':type' => $typesaleslead,
        ':id' => $contactid
    ));
 
    echo "Updated on {$updatedday} * <span id=\"statuspan\">Switch to {$typesaleslead}</span>";
   } else{
    $typestmt->execute(array(
        ':type' => $typesupport,
        ':id' => $contactid
    ));
 
    echo "Updated on {$updatedday} * <span id=\"statuspan\">Switch to {$typesupport}</span>";
   }
   

}
}