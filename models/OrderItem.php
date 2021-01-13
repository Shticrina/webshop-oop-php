<?php
/**
 * Description of OrderItem Class
 *
 * @author shticri
 */
class OrderItem {
  
    // database connection and table name
    private $conn;
    private $table_name = "order_items";
  
    // object properties
    public $order_id;
    public $product_id;
    public $price;
    public $quantity;
    public $image;
  
    public function __construct($db) {
        $this->conn = $db;
    }
  
    function getAllByUser($userId) {
        $query = "SELECT * FROM $this->table_name 
            JOIN orders ON $this->table_name.order_id = orders.order_id
            JOIN products ON $this->table_name.product_id = products.id
            WHERE orders.user_id = $userId";
      
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $result ? $stmt->fetchAll() : [];

        return $rows;
    }

    /*function create($productId, $userId) {
        $request = "INSERT INTO $this->table_name (user_id, product_id) VALUES ('$userId', '$productId')";

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute();
    }

    function delete($userId) {
        $query = "DELETE FROM $this->table_name WHERE wishlist_id = $userId";
      
        // use exec() because no results are returned
        $this->conn->exec($query);
    }*/
}

?>