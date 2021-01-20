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
  
    function getCurrentOrder($connected, $user_id) {
        $sessionID = session_id();

        if ($connected) {
            // $request = "SELECT * FROM $this->table_name WHERE user_session IS NULL AND user_id = '$user_id' AND payment_status = 'false'";
            $request = "SELECT * FROM $this->table_name WHERE user_session = 'NULL' AND user_id = '$user_id' AND payment_status = 'false'";
        } else {
            $request = "SELECT * FROM $this->table_name WHERE user_session = '$sessionID' AND user_id = '$user_id' AND payment_status = 'false'";
        }
        // var_dump($request);

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute(); // execute the statement
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result ? $stmt->fetch() : null;

        return $row;
    }

    function updateTotalPrice($price, $order_id) {
        $request = "UPDATE $this->table_name SET `total_price` = $price WHERE `order_id` = $order_id";

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute(); // execute the statement
        $row = $stmt->rowCount() > 0 ? true : false;

        return $row;
    }

    function updateSessionID($user_id, $session_id) {
        $request = "UPDATE $this->table_name SET `user_session` = '$session_id' WHERE `user_id` = $user_id";
        // var_dump($session_id, $request);

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute(); // execute the statement
        $row = $stmt->rowCount() > 0 ? true : false;

        return $row;
    }

    function create($userId, $userSession, $connected) {
        if ($connected) {
            $request = "INSERT INTO $this->table_name (user_id) VALUES ('$userId')";
        } else {
            $request = "INSERT INTO $this->table_name (user_id, user_session) VALUES ('$userId', '$userSession')";
        }

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute();
    }

    function delete($id) {
        $query = "DELETE FROM $this->table_name WHERE order_id = $id";
      
        // use exec() because no results are returned
        $this->conn->exec($query);
    }
}

?>