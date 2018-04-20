<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../Config/Database.php';
include_once '../Model/Comment.php';

$database = new Database();
$db = $database->getConnection();

$comment = new Comment($db);
$comment->id = isset($_GET['id']) ? $_GET['id'] : die();
$stmt = $comment->getAllComment();
$countNum = $stmt->rowCount();

if($countNum > 0){
 
    $comment_arr = array();
    $comment_arr["comment_list"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $comment_items = array(
            "comment_id" => $comment_id,
            "content" => $content,
			"category" => $category,
			"AMBIENCEGENERAL" => $AMBIENCEGENERAL,
			"DRINKSPRICES" => $DRINKSPRICES,
			"DRINKSQUALITY" => $DRINKSQUALITY,
			"DRINKSSTYLE_OPTIONS" => $DRINKSSTYLE_OPTIONS,
			"FOODPRICES" => $FOODPRICES,
			"FOODQUALITY" => $FOODQUALITY,
			"FOODSTYLE_OPTIONS" => $FOODSTYLE_OPTIONS,
			"LOCATIONGENERAL" => $LOCATIONGENERAL,
			"RESTAURANTGENERAL" => $RESTAURANTGENERAL,
			"RESTAURANTMISCELLANEOUS" => $RESTAURANTMISCELLANEOUS,
			"RESTAURANTPRICES" => $RESTAURANTPRICES,
			"SERVICEGENERAL" => $SERVICEGENERAL,
            "res_id" => $res_id,
            "post_date" => $post_date
        );
 
        array_push($comment_arr["comment_list"], $comment_items);
    }
 
    echo json_encode($comment_arr);
}else{
    echo json_encode(
        array("message" => "No Comment found.")
    );
}

?>