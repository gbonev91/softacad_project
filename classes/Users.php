<?php

class Users implements ICRUD {

	private $db;

	public function __construct($db) {
		$this->db = $db;
	}


	public function add(IItem $item) {
		$sql = '
			INSERT INTO users (username, password) 
			VALUES (
				"'.$item->username.'",
				"'.$item->password.'"
			)
		';
		mysqli_query($this->db, $sql);
	}

	public function update($id, IItem $item) {

		$sql = '
			UPDATE users 
			SET 
			username = "' . $item->username . '",
			password = "' . $item->password . '"
			WHERE id = ' . $id;

		mysqli_query($this->db, $sql);

	}


	public function delete($id) {

		$sql = '
			DELETE FROM users WHERE id = '. $id;

		mysqli_query($this->db, $sql);

	}

	public function get($id) {

		$sql = '
			SELECT * FROM users 
			WHERE id = '.$id;

		$res = mysqli_query($this->db, $sql);
		return mysqli_fetch_assoc($res);

	}

	public function getAll() {

		$sql = 'SELECT * FROM users';
		$res = mysqli_query($this->db, $sql);
		$result = array();
		while ( $row = mysqli_fetch_assoc($res) ) {
			$result[] = $row;
		}

		return $result;

	}

	public function getUser($username) {
	    $sql = "SELECT username FROM users WHERE username = '" . $username . "'";
	    $res = mysqli_query($this->db, $sql);
		$result = array();
		while ( $row = mysqli_fetch_assoc($res) ) {
			$result[] = $row;
		}
		return $result;
	}

	public function isExist($username, $password) {
	   $sql = "
	        SELECT *
	        FROM users
	        WHERE username = '" . $username . "'
	        AND password = '".$password."'";

        $res = mysqli_query($this->db, $sql);
        $data = mysqli_fetch_assoc($res);
        return $data;

	}

	public function isLoggedIn()
	{
	    if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == false) {
	        header('Location: index.php');
	        exit;
	    }
	}

	public function logOut() 
	{
		unset($_SESSION['logged_in']);
		unset($_SESSION['user']);
		header('Location: index.php');
		exit;
	}


}