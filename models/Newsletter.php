<?php
/**
 * Description of Newsletter Class
 *
 * @author shticri
 */
class Newsletter {
  
    // database connection and table name
    private $conn;
    private $table_name = "newsletters";
  
    // object properties
    public $email;
  
    public function __construct($db) {
        $this->conn = $db;
    }
  
    function create($email) {
        $this->email = $email;

        $request = "INSERT INTO $this->table_name (email) VALUES ('$this->email')";

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute();
    }

    function emailExists($email) {
        $request = "SELECT * FROM $this->table_name WHERE email = '$email'";

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute(); // execute the statement
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result ? $stmt->fetch() : null;

        return $row;
    }
}

?>