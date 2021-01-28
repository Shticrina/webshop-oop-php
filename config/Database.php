<?php

class Database {

	// MySQL DB connection details
	private $host;
	private $user;
	private $password;
	private $database;
	private $conn;

	public function __construct($host, $user, $password, $database) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
    }

	public function getConnection() {
		$this->conn = null;
		$options = array (
		    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		    PDO::ATTR_EMULATE_PREPARES => false
		);

		// Connect to MySQL and instantiate our PDO object
		try {
			$this->conn = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8", $this->user, $this->password, $options);
			// echo "Connected successfully!";
		} catch (PDOException $e) {
			die("Connection failed: " . $e->getMessage());
		}

		return $this->conn;
	}
}

?>