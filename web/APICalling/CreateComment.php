<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../Config/Database.php';
include_once '../Model/Comment.php';

 
$database = new Database();
$db = $database->getConnection();
 
$comment = new Comment($db);
 
// get posted data
 $comment->res_id = isset($_POST['res_id']) ? $_POST['res_id'] : die();
 $comment->content = isset($_POST['content']) ? $_POST['content'] : die();

 $comment->res_id = $_POST['res_id'];
 $comment->content = $_POST['content'];

 if($comment->insertComment()){
    echo '{';
        echo '"message":'. $_POST['content'];
    echo '}';
}
 
else{
    echo '{';
        echo '"message": "Failed to comment."';
    echo '}';
}
?>