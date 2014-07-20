<?php

class DB {

	private $dbHost = 'localhost';
	private $dbUser = 'root';
	private $dbPass = '';
	private $dbName = 'softacad_project';
	private static $instance = null;

	private function __construct() {

	}

	public static function getInstance() {
		if ( $instance == null ) {
			self::$instance = new DB();
			return self::$instance;
		}
		return false;
	}

	public function dbConnect() {
		return mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
	}

}

$db = DB::getInstance();
$dbConnect = $db->dbConnect();

