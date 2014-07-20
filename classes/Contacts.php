<?php

class Contacts implements ICRUD {

	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function add(IItem $item) {
		$sql = '
			INSERT INTO contacts (name, email, phone, content) 
			VALUES (
				"'.$item->name.'",
				"'.$item->email.'",
				"'.$item->phone.'",
				"'.$item->content.'"
			)
		';
		mysqli_query($this->db, $sql);
	}

	public function update($id, IItem $item) {

		$sql = '
			UPDATE contacts 
			SET 
			name = "' . $item->name . '",
			email = "' . $item->email . '",
			phone = "'. $item->phone .'",
			content = "' . $item->content . '"

			WHERE id = ' . $id;

		mysqli_query($this->db, $sql);

	}


	public function delete($id) {

		$sql = '
			DELETE FROM contacts WHERE id = '. $id;

		mysqli_query($this->db, $sql);

	}

	public function get($id) {}

	public function getAll() {
		$sql = 'SELECT * FROM contacts';
		$res = mysqli_query($this->db, $sql);
		$result = array();
		while ( $row = mysqli_fetch_assoc($res) ) {
			$result[] = $row;
		}

		return $result;
	}
}
