<?php

class Comments implements ICRUD {

	private $db;

	public function __construct($db) {
		$this->db = $db;
	}


	public function add(IItem $item) {
		$sql = '
			INSERT INTO comments (name, content, date_added, news_id) 
			VALUES (
				"'.$item->name.'",
				"'.$item->content.'",
				"'.date('Y-m-d H:i:s').'",
				"'.$item->news_id.'"
			)
		';
		mysqli_query($this->db, $sql);
	}

	public function update($id, IItem $item) {

		$sql = '
			UPDATE comments 
			SET 
			name = "' . $item->name . '",
			content = "' . $item->content . '",
			date_added = "'.date('Y-m-d H:i:s').'",
			news_id = "'.$item->news_id.'"

			WHERE id = ' . $id;

		mysqli_query($this->db, $sql);

	}


	public function delete($id) {

		$sql = '
			DELETE FROM comments WHERE id = '. $id;

		mysqli_query($this->db, $sql);

	}

	public function get($id) {

		$sql = '
			SELECT * FROM comments 
			WHERE id = '.$id;

		$res = mysqli_query($this->db, $sql);
		return mysqli_fetch_assoc($res);

	}

	public function getAll() {

		$sql = 'SELECT * FROM comments';
		$res = mysqli_query($this->db, $sql);
		$result = array();
		while ( $row = mysqli_fetch_assoc($res) ) {
			$result[] = $row;
		}

		return $result;

	}



}

