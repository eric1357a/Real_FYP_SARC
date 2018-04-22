<?php
    class Restaurant{
        private $conn;
        private $table_name = "Restaurant";

        public $id;
        public $name;
        public $address;
        public $price;
        public $type1;
        public $type2;
        public $type3;
		public $type4;
		public $region;
		public $avg_price;
		public $simp_type;
		public $Districts;
		public $lon;
		public $lat;
		public $telephone;

        public function __construct($db){
            $this->conn = $db;
        }

        function getAllRestaurantInfo(){
            $query = "SELECT * FROM Restaurant ORDER BY id ASC ";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            // execute query
            $stmt->execute();

            return $stmt;
        }
        
		function getOneInfo(){
 
    		// query to read single record
    		$query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
 
    		// prepare query statement
    		$stmt = $this->conn->prepare( $query );
 
    		// bind id of product to be updated
    		$stmt->bindParam(1, $this->id);
 
    		// execute query
    		$stmt->execute();
			return $stmt;
 
		}
		function getRegion() {
			
			$query = "SELECT DISTINCT region FROM " . $this->table_name;
			// prepare query statement
            $stmt = $this->conn->prepare($query);

            // execute query
            $stmt->execute();

            return $stmt;
		}
		function getResType() {
			
			$query = "SELECT DISTINCT simp_type FROM " . $this->table_name;
			// prepare query statement
            $stmt = $this->conn->prepare($query);

            // execute query
            $stmt->execute();

            return $stmt;
		}
		function getPriceType() {
			$query = "SELECT DISTINCT price FROM " . $this->table_name ." ORDER BY price DESC";
			// prepare query statement
            $stmt = $this->conn->prepare($query);

            // execute query
            $stmt->execute();

            return $stmt;
		
		}
		function getRegionRestaurant($keywords) {
			
    		// query to read single record
    		$query = "SELECT * FROM " . $this->table_name . " WHERE region LIKE ?";
 
    		// prepare query statement
    		$stmt = $this->conn->prepare( $query );
			
			$keywords=htmlspecialchars(strip_tags($keywords));
			$keywords = "%{$keywords}%";
			
    		// bind id of product to be updated
    		$stmt->bindParam(1, $keywords);
 
    		// execute query
    		$stmt->execute();
			return $stmt;
 
		}
		function getSearchRestaurant($keywords,$keywords2) {
			
    		// query to read single record
    		$query = "SELECT * FROM " . $this->table_name . " WHERE simp_type = ? AND price = ?";
 
    		// prepare query statement
    		$stmt = $this->conn->prepare( $query );
			
			$keywords=htmlspecialchars(strip_tags($keywords));
			$keywords2=htmlspecialchars(strip_tags($keywords2));
			
    		// bind id of product to be updated
    		$stmt->bindParam(1, $keywords);
			$stmt->bindParam(2, $keywords2);
 
    		// execute query
    		$stmt->execute();
			return $stmt;
 
		}
		function searchRestaurant($keywords){
		// query to read single record
    		$query = "SELECT * FROM " . $this->table_name . " WHERE name LIKE ?";
 
    		// prepare query statement
    		$stmt = $this->conn->prepare( $query );
			
			$keywords=htmlspecialchars(strip_tags($keywords));
			$keywords = "%{$keywords}%";
			
    		// bind id of product to be updated
    		$stmt->bindParam(1, $keywords);
 
    		// execute query
    		$stmt->execute();
			return $stmt;
		}
    }
?>