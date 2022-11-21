<?php
require "dbconnect.php";
$cleanedemail= "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" ){
  
    $jsn = file_get_contents('php://input');
    $passregex = "^(?=.*?[A-Z])(?=.*?[0-9]).{8,}$^";
    $data = json_decode($jsn);
    $cleanedemail = filter_var($data->email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($cleanedemail, FILTER_VALIDATE_EMAIL)){
        echo "2";
    }
    else{
        $password = $data->password;
        $sql = "SELECT * FROM users WHERE email= :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':email' =>  $cleanedemail));
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() == 1){
            if (!password_verify($password, $record["password"])){
                echo "1";
            }
            else{
                session_start(); 
                $_SESSION['uid'] = $record['id'];
                $_SESSION['first_name'] = $record['firstname'];
                $_SESSION['last_name'] = $record['lastname'];
                $_SESSION['role'] = $record['role'];
                if (isset($_SESSION['first_name'])&& isset($_SESSION['last_name'])){
                    echo "4";
                }
                else{
                    echo "3";
                }
            } 
        }
        else{
            echo "0";
        }
    }
}




