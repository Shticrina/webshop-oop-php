<?php
/**
 * Description of Order Class
 *
 * @author shticri
 */
class Order {
  
    // database connection and table name
    private $conn;
    private $table_name = "orders";
  
    // object properties
    public $user_id;
    public $user_session;
    public $total_price;
    public $payment_status;
    public $is_delivered;
    public $shipping_address;
    public $shipping_country;
    public $shipping_city;
    public $shipping_postal_code;
  
    public function __construct($db) {
        $this->conn = $db;
    }
  
    /*function getAllByUser($userId) {
        $query = "SELECT * FROM $this->table_name 
            JOIN order_items ON $this->table_name.order_id = order_items.order_id
            WHERE $this->table_name.user_id = $userId";
      
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $result ? $stmt->fetchAll() : [];

        return $rows;
    }*/

    function updateTotalPrice($price, $order_id) {
        $request = "UPDATE $this->table_name SET `total_price` = $price WHERE `order_id` = $order_id";

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute(); // execute the statement
        $row = $stmt->rowCount() > 0 ? true : false;

        return $row;
    }

    /*function create($productId, $userId) {
        $request = "INSERT INTO $this->table_name (user_id, product_id) VALUES ('$userId', '$productId')";

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute();
    }*/

    function delete($id) {
        $query = "DELETE FROM $this->table_name WHERE order_id = $id";
      
        // use exec() because no results are returned
        $this->conn->exec($query);
    }
}

?>