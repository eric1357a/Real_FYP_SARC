<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../Config/Database.php';
include_once '../Model/Restaurant.php';

$database = new Database();
$db = $database->getConnection();

$restaurant = new Restaurant($db);
$stmt = $restaurant->getPriceType();
$countNum = $stmt->rowCount();

if($countNum > 0){
 
    $price_arr = array();
    $price_arr["price_list"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $price_items = array(
            "price" => $price
        );
 
        array_push($price_arr["price_list"], $price_items);
    }
 
    echo json_encode($price_arr);
}else{
    echo json_encode(
        array("message" => "No price info found.")
    );
}
?>