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

$functionName = $data['function'];
if ($functionName == "getProducts") {
  
     $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
if($result){
   if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data2[] = $row;
        }
        echo json_encode($data2);
     
    } else {
        echo json_encode("0");
    }
} else {
    echo "2";
}
} 
?>