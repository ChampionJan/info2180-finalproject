<?php
session_start();
require "dbconnect.php";
$cleanedfirstname = "";
$cleanedlastname="";
$cleanedemail= "";
$password = "";
$cleanedrole= "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['first_name'], $_SESSION['last_name'])){

    $jsn = file_get_contents('php://input');
    $data = json_decode($jsn);
    $cleanedemail = filter_var($data->email, FILTER_VALIDATE_EMAIL);
    $cleanedfirstname = filter_var($data->firstname, FILTER_SANITIZE_SPECIAL_CHARS);
    $cleanedlastname = filter_var($data->lastname, FILTER_SANITIZE_SPECIAL_CHARS);
    $cleanedrole = filter_var($data->role, FILTER_SANITIZE_SPECIAL_CHARS);

    date_default_timezone_set('US/Eastern');
    
    if (!filter_var($cleanedemail, FILTER_VALIDATE_EMAIL)){
        echo"0";
    }
    if (!filter_var($cleanedfirstname, FILTER_SANITIZE_SPECIAL_CHARS)){
        echo"1";
    }
    if (!filter_var($cleanedlastname, FILTER_SANITIZE_SPECIAL_CHARS)){
        echo"2";
    }
   
    $password = password_hash($data->password, PASSWORD_DEFAULT);
    $checksql = "SELECT * FROM users WHERE email= :email";
    $stmt = $conn->prepare($checksql);
    $stmt->execute(array(':email' =>  $cleanedemail));
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() == 1){
        echo"3";
    }
    else{
        $addsql = "INSERT INTO users (firstname, lastname, password, email, role) 
        VALUES ( :firstname, :lastname, :password, :email, :role)";

        $prep = $conn -> prepare($addsql);

        if ($prep->execute( array(':firstname' => $cleanedfirstname, ':lastname' => $cleanedlastname, ':password'=>$password, ':email' => $cleanedemail, ':role' => $cleanedrole))){
            echo "4";
        }

    }    
}
else{
    echo "We can't process your request at this time";
}