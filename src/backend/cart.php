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

if($functionName == "addCart"){
    $params = $data['params'];
    $productID = $params['productID'];
    $usserID = $params['usserID'];
        
          $sql = "INSERT INTO `cart`(`pid`, `uid`) VALUES ('$productID','$usserID')";
        $result = $conn->query($sql);
        if($result){ 
        echo json_encode("1");
    } else {
        echo json_encode("0");
    }
}

if ($functionName == "getCart") {
    $params = $data['params'];
    $usserID = $params['usserID'];
     $sql = "SELECT cart.id, thumbnail,name,price FROM cart inner join users on users.id = cart.uid inner join products on products.id = cart.pid  where uid = '$usserID'";
        $result = $conn->query($sql);
if($result){
   if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data3[] = $row;
        }
        echo json_encode($data3);
     
    } else {
        echo json_encode("0");
    }
} else {
    echo "2";
}
} 

if($functionName == "removeCart"){
    $params = $data['params'];
    $cartID = $params['cartID'];
        
          $sql = "DELETE FROM`cart`WHERE id = '$cartID'";
        $result = $conn->query($sql);
        if($result){ 
        echo json_encode("1");
    } else {
        echo json_encode("0");
    }
}

if($functionName == "removeUsserCart"){
    $params = $data['params'];
    $usserID = $params['usserID'];
        
          $sql = "DELETE FROM`cart`WHERE uid = '$usserID'";
        $result = $conn->query($sql);
        if($result){ 
        echo json_encode("1");
    } else {
        echo json_encode("0");
    }
}
       

?>