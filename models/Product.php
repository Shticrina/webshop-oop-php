<?php
/**
 * Description of Product Class
 *
 * @author shticri
 */
class Product {
    
    // database connection and table name
    private $conn;
    private $table_name = "products";
  
    // object properties
    public $name;
    public $price;
    public $description;
    public $category_id;
    public $category_name;
    public $category_slug;
  
    public function __construct($db) {
        $this->conn = $db;
    }

    function getAllProducts() {
        $query = "SELECT * FROM $this->table_name JOIN categories ON categories.category_id = $this->table_name.category_id ORDER BY id";

        $stmt = $this->conn->prepare($query); // prepare the request in a statement
		$stmt->execute(); // execute the statement

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$rows = $result ? $stmt->fetchAll() : [];

		return $rows;
    }

    function getProductsByCat($catId) {
        $query = "SELECT $this->table_name.name, $this->table_name.description, $this->table_name.price, $this->table_name.stock FROM $this->table_name JOIN categories ON categories.category_id = $this->table_name.category_id WHERE $this->table_name.category_id = $catId";
      
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $result ? $stmt->fetchAll() : [];

        return $rows;
    }
  
    // create product
    function create() {
        // write query
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, price=:price, description=:description, category_id=:category_id";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
  
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":category_id", $this->category_id);
  
        /*if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }*/

        return $stmt->execute();
    }

    function getProduct($id) {
	    $query = "SELECT * FROM $this->table_name JOIN categories ON categories.category_id = $this->table_name.category_id WHERE $this->table_name.id = ?";
	  
	    $stmt = $this->conn->prepare($query);
	    $stmt->bindParam(1, $id);
	    $stmt->execute();

	    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $result ? $stmt->fetch() : null;
		
	    return $row;
	}
}
