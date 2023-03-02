<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
 $conn = new mysqli('sql8.freesqldatabase.com','sql8599297','yuaCF2Ur1Q','sql8599297');
        if($conn->connect_error){
            die( $conn->connect_error);
        }

$data = json_decode(file_get_contents('php://input'), true);

$functionName = $data["function"];

if ($functionName == 'Login') {
    $params = $data['params'];
    $ussername = $params['username'];
    $password = $params['password'];
     $sql = "SELECT * FROM users WHERE username = '$ussername'";
        $result = $conn->query($sql);
if($result){
   if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        if($row['password'] == $password){
        $_SESSION['uid'] = $row['id'];
         echo json_encode($row['id']);
        } else {
             echo json_encode("0");
        }
    }
    
    
    } else {
        echo json_encode("0");
    }
} else {
     echo json_encode("0");
}
} 

if($functionName == "Register"){
    $params = $data['params'];
     $ussername = $params['username'];
    $password = $params['password'];
    $address = $params['address'];
    $name = $params['name'];
      $sql = "SELECT * FROM users WHERE username = '$ussername'";
        $result = $conn->query($sql);
    if($result){
   if($result->num_rows > 0){
      echo json_encode("0");
    } else {
        
          $sql = "INSERT INTO `users`(`nickName`, `username`, `password`, `address`) VALUES ('$name','$ussername','$password','$address') ";
        $result = $conn->query($sql);
        if($result){
            $sql = "SELECT * FROM users WHERE username = '$ussername'";
            $result = $conn->query($sql);
            if($result){
            if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
             $_SESSION['uid'] = $row['id'];
        }
    
        echo json_encode($_SESSION['uid']);
    } else {
        echo json_encode("0");
    }
} else {
     echo json_encode("0");
}
        } else{
             echo json_encode("0");
        }
    }
} else {
     echo json_encode("0");
}
}

if ($functionName == 'getData') {
    $params = $data['params'];
    $ID = $params['ID'];

     $sql = "SELECT * FROM users WHERE id = '$ID'";
        $result = $conn->query($sql);
if($result){
   if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
       
         echo json_encode($row);
        
    }
    
    
    } else {
        echo json_encode("0");
    }
} else {
     echo json_encode("0");
}
} 
 
?>