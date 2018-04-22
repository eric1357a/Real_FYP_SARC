<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../Config/Database.php';
include_once '../Model/Restaurant.php';

$database = new Database();
$db = $database->getConnection();

$restaurant = new Restaurant($db);

$keywords=isset($_GET["type"]) ? $_GET["type"] : "";
$keywords2=isset($_GET["price"]) ? $_GET["price"] : "";

$stmt = $restaurant->getSearchRestaurant($keywords,$keywords2);
$countNum = $stmt->rowCount();

if($countNum > 0){
 
    $restaurant_arr = array();
    $restaurant_arr["restaurant_list"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
$restaurant_items = array(
            "id" => $id,
            "name" => $name,
            "address" => html_entity_decode($address),
            "price" => $price,
            "type1" => $type1,
			"type2" => $type2,
			"type3" => $type3,
			"type4" => $type4,
			"region" => $region,
			"avg_price" => $avg_price,
            "simp_type" => html_entity_decode($simp_type),
			"Districts" => $Districts,
			"lon" => $lon,
            "lat" => $lat,
			"telephone" => $telephone
        );
 
        array_push($restaurant_arr["restaurant_list"], $restaurant_items);
    }
 
    echo json_encode($restaurant_arr);
}else{
    echo json_encode(
        array("message" => "No restaurant info found")
    );
}
?>