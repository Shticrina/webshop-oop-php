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
    public $id;
    public $name;
  
    public function __construct($db) {
        $this->conn = $db;
    }
  
    // used by select drop-down list
    function listAll() {
        //select all data
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY name";
  
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
  
        return $stmt;
    }
}

?>