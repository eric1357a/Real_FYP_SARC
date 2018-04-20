<?php
    class Comment{
        private $conn;
        private $table_name = "Comment";

        public $comment_id;
        public $content;
		public $category;
		public $AMBIENCEGENERAL;
		public $DRINKSPRICES;
		public $DRINKSQUALITY;
		public $DRINKSSTYLE_OPTIONS;
		public $FOODPRICES;
		public $FOODQUALITY;
		public $FOODSTYLE_OPTIONS;
		public $LOCATIONGENERAL;
		public $RESTAURANTGENERAL;
		public $RESTAURANTMISCELLANEOUS;
		public $RESTAURANTPRICES;
		public $SERVICEGENERAL;
        public $res_id;
        public $post_date;

        public function __construct($db){
            $this->conn = $db;
        }
		
        function getAllComment(){
            $query = "SELECT * FROM " . $this->table_name . " WHERE res_id = ? ORDER BY post_date DESC";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

			// bind id of product to be updated
    		$stmt->bindParam(1, $this->id);
			
            // execute query
            $stmt->execute();

            return $stmt;
        }
        
		function getOneResInfo(){
			$query = "SELECT * FROM " . $this->table_name . " WHERE restaurant_id = ? ORDER BY post_date DESC";
            // prepare query statement
            $stmt = $this->conn->prepare($query);
			// bind id of product to be updated
    		$stmt->bindParam(1, $this->id);
            // execute query
            $stmt->execute();

            return $stmt;
 /*
    		// query to read single restaurant record
    		$query = "SELECT * FROM " . $this->table_name . " WHERE restaurant_id = ? LIMIT 0,1";
 
    		// prepare query statement
    		$stmt = $this->conn->prepare( $query );
 
    		// bind id of product to be updated
    		$stmt->bindParam(1, $this->id);
 
    		// execute query
    		$stmt->execute();
 
    		// get retrieved row
    		$row = $stmt->fetch(PDO::FETCH_ASSOC);
 
   			// set values to object properties
    		$this->comment_id = $row['comment_id'];
    		$this->comment_content = $row['comment_content'];
    		$this->restaurant_id = $row['restaurant_id'];
			$this->post_date = $row['post_date'];
			*/
		}
	function insertComment(){
	// query to insert record
	$query = "INSERT INTO Comment(comment_id, content, category, AMBIENCEGENERAL, DRINKSPRICES, 
	DRINKSQUALITY, DRINKSSTYLE_OPTIONS, FOODPRICES, FOODQUALITY, 
	FOODSTYLE_OPTIONS, LOCATIONGENERAL, RESTAURANTGENERAL, 
	RESTAURANTMISCELLANEOUS, RESTAURANTPRICES, SERVICEGENERAL, 
	res_id, post_date) VALUES (NULL, '" . $this->content . "', NULL, NULL, NULL, NULL, NULL, 
	NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '" . $this->res_id . "', '2018-04-21')";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->content=htmlspecialchars(strip_tags($this->content));
    $this->res_id=htmlspecialchars(strip_tags($this->res_id));
 
    // bind values
    $stmt->bindParam(":content", $_POST['content']);
    $stmt->bindParam(":res_id", $_POST['res_id']);
	
	//$content = $_POST['content'];
	//$res_id = $_POST['res_id'];

 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
		}
		
    }
?>