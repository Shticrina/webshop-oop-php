<?php
/**
 * Description of Wishlist Class
 *
 * @author shticri
 */
class Wishlist {
  
    // database connection and table name
    private $conn;
    private $table_name = "wishlist";
  
    // object properties
    public $user_id;
    public $product_id;
  
    public function __construct($db) {
        $this->conn = $db;
    }
  
    function getAllByUser($userId) {
        $query = "SELECT * FROM $this->table_name 
            JOIN products ON $this->table_name.product_id = products.id
            WHERE $this->table_name.user_id = $userId";
      
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $result ? $stmt->fetchAll() : [];

        return $rows;
    }

    function create($productId, $userId) {
        $request = "INSERT INTO $this->table_name (user_id, product_id) VALUES ('$userId', '$productId')";

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute();
    }

    function delete($userId) {
        $query = "DELETE FROM $this->table_name WHERE wishlist_id = $userId";
      
        // use exec() because no results are returned
        $this->conn->exec($query);
    }
}

?>