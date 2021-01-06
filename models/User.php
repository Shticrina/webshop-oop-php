<?php
/**
 * Description of User Class
 *
 * @author shticri
 */
class User {
    
    // database connection and table name
    private $conn;
    private $table_name = "users";
  
    // object properties
    public $first_name;
    public $last_name;
    public $pseudo;
    public $email;
    public $password;
    public $photo;
    public $description;
    public $role;
  
    public function __construct($db) {
        $this->conn = $db;
    }

    function listAll() {
        $query = "SELECT * FROM $this->table_name ORDER BY last_name LIMIT 10";

        $stmt = $this->conn->prepare($query); // prepare the request in a statement
		$stmt->execute(); // execute the statement

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$rows = $result ? $stmt->fetchAll() : [];
		$this->countProducts = $stmt->rowCount();

		return $rows; // we will use rowCount();
    }
  
    function create($user) {
        $this->first_name = $user["first_name"];
        $this->last_name = $user["last_name"];
        $this->email = $user["email"];
        $this->password = $user["password"];

        $request = "INSERT INTO $this->table_name (first_name, last_name, email, password, is_connected) 
                    VALUES ('$this->first_name', '$this->last_name', '$this->email', '$this->password', true)";

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute();
    }

    function getUserByEmail($email) {
	    $request = "SELECT * FROM $this->table_name WHERE email = '$email'";

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute(); // execute the statement
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result ? $stmt->fetch() : null;

        return $row;
	}

    function updateUserByConnection($id, $is_connected) {
        $request = "UPDATE $this->table_name SET `is_connected` = $is_connected WHERE `user_id` = $id";

        $stmt = $this->conn->prepare($request); // prepare the request in a statement
        $stmt->execute(); // execute the statement
        $row = $stmt->rowCount() > 0 ? true : false;

        return $row;
    }
}
