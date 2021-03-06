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
  
    function getAllByUserAndOrder($userId, $orderId) {
        $query = "SELECT $this->table_name.id, $this->table_name.order_id, $this->table_name.product_id, $this->table_name.price, $this->table_name.quantity, $this->table_name.image, products.name, products.slug, products.stock, orders.total_price FROM $this->table_name
            JOIN orders ON $this->table_name.order_id = orders.order_id
            JOIN products ON $this->table_name.product_id = products.id
            WHERE orders.user_id = $userId AND $this->table_name.order_id = $orderId";
      
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $result ? $stmt->fetchAll() : [];

        return $rows;
    }

    function getAll($orderId) {
        $query = "SELECT * FROM $this->table_name WHERE order_id = $orderId";
        // var_dump($query, $orderId);
      
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $result ? $stmt->fetchAll() : [];

        return $rows;
    }

    function getById($id) {
        $request = "SELECT * FROM $this->table_name 
        JOIN orders ON $this->table_name.order_id = orders.order_id
        WHERE id = $id";

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result ? $stmt->fetch() : null;

        return $row;
    }

    function getByOrderAndProductId($orderId, $productId) {
        $request = "SELECT $this->table_name.id, $this->table_name.order_id, $this->table_name.product_id, $this->table_name.price, $this->table_name.quantity, $this->table_name.image, products.name, products.slug 
        FROM $this->table_name 
        JOIN products ON $this->table_name.product_id = products.id
        WHERE $this->table_name.order_id = $orderId AND $this->table_name.product_id = $productId";

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result ? $stmt->fetch() : null;

        return $row;
    }

    function updateQty($id, $qty) {
        $request = "UPDATE $this->table_name SET `quantity` = $qty WHERE `id` = $id";

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute(); // execute the statement
        $row = $stmt->rowCount() > 0 ? true : false;

        return $row;
    }

    function create($orderId, $productId, $price, $image, $quantity) {
        $request = "INSERT INTO $this->table_name (order_id, product_id, price, image, quantity) VALUES ('$orderId', '$productId', '$price', '$image', '$quantity')";

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute();
    }

    function delete($id) {
        $query = "DELETE FROM $this->table_name WHERE id = $id";

        // use exec() because no results are returned
        $this->conn->exec($query);
    }
}

?>