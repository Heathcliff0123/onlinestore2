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

if($functionName == "getOrders"){
    $params = $data['params'];
    $usserID = $params['ID'];
        
        $sql = "SELECT * FROM orders where uid = '$usserID' order by id desc";
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

if($functionName == "addOrder"){
    $params = $data['params'];
    $usserID = $params['usserID'];
    $total = $params['total'];
    $orderDate = $params['date'];
    $deliveryDate = $params['deliveryDate'];   
   
          $sql = "INSERT INTO `orders`(`uid`,`orderDate`,`deliveryDate`,`total`) VALUES ('$usserID','$orderDate','$deliveryDate','$total')";
        $result = $conn->query($sql);
        if($result){ 
        echo json_encode("1");
    } else {
        echo json_encode("0");
    }
}


?>