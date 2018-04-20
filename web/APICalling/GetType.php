<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../Config/Database.php';
include_once '../Model/Restaurant.php';

$database = new Database();
$db = $database->getConnection();

$restaurant = new Restaurant($db);
$stmt = $restaurant->getResType();
$countNum = $stmt->rowCount();

if($countNum > 0){
 
    $type_arr = array();
    $type_arr["type_list"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $type_items = array(
            "simp_type" => $simp_type
        );
 
        array_push($type_arr["type_list"], $type_items);
    }
 
    echo json_encode($type_arr);
}else{
    echo json_encode(
        array("message" => "No type info found.")
    );
}

?>