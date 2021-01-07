<?php
/**
 * Description of Category Class
 *
 * @author shticri
 */
class Category {
  
    // database connection and table name
    private $conn;
    private $table_name = "categories";
  
    // object properties
    public $category_name;
  
    public function __construct($db) {
        $this->conn = $db;
    }
  
    function getAllCategories() {
        //select all categories
        $request = "SELECT * FROM $this->table_name ORDER BY category_name";

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute(); // execute the statement
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $result ? $stmt->fetchAll() : [];

        return $rows;
    }
}

?>