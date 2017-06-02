<?php
/**
* DataGenerator
*
* @package 		datagenerator.database
* @author 		Rohith
* @since 		Version 1.0
*/
//-----------------------------------------------------------------

/*
* Mysql database class - only one connection alowed
*/
class DBHandler {
	private $_connection;
	private static $_instance; //The single instance
	private $_host = "localhost";
	private $_username = "anything";
	private $_password = "anything";
	private $_database = "datagenerator";

	private $_mysqli,
			$_query,
			$_results = array(),
			$_count = 0;
	/*
	Get an instance of the Database
	@return Instance
	*/
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	// Constructor
	private function __construct() {
		$this->_connection = new mysqli($this->_host, $this->_username, 
			$this->_password, $this->_database);
	
		// Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
				 E_USER_ERROR);
		}
	}
	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }
	
	// Get mysqli connection
	public function getConnection() {
		return $this->_connection;
	}

	public function query($sql){
		if ($this->_query = $this->_mysqli->query($sql)) {
			while ($row = $this->$_query->fetch_object()) {
				$this->_results[] = $row;
			}
		}
		return $this;
	}
	public function results(){
		return $this->_results;
	}

}
?>