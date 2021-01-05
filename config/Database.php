<?php

class Database {

	// MySQL DB connection details
	private $host = 'localhost';
	private $user = 'root';
	private $password = '';
	private $database = 'poo_db';
	private $conn;

	public function getConnection() {
		$this->conn = null;
		$options = array (
		    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		    PDO::ATTR_EMULATE_PREPARES => false
		);

		// Connect to MySQL and instantiate our PDO object
		try {
			$this->conn = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8", $this->user, $this->password, $options);
			// echo "Connected successfully using classes!";
		} catch (PDOException $e) {
			die("Connection failed: " . $e->getMessage());
		}

		return $this->conn;
	}
}

?>