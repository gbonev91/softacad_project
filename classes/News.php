<?php

class News implements ICRUD {

	private $db;

	public function __construct($db) {
		$this->db = $db;
	}


	public function add(IItem $item) {
		$sql = '
			INSERT INTO news (title, content, date_added, image) 
			VALUES (
				"'.$item->title.'",
				"'.$item->content.'",
				"'.date('Y-m-d H:i:s').'",
				"'.$item->image.'"
			)
		';
		mysqli_query($this->db, $sql);
	}

	public function update($id, IItem $item) {

		$sql = '
			UPDATE news 
			SET 
			title = "' . $item->title . '",
			content = "' . $item->content . '",
			date_added = "'.date('Y-m-d H:i:s').'",
			image = "'.$item->image.'"

			WHERE id = ' . $id;

		mysqli_query($this->db, $sql);

	}


	public function delete($id) {

		$sql = '
			DELETE FROM news WHERE id = '. $id;

		mysqli_query($this->db, $sql);

	}

	public function get($id) {

		$sql = '
			SELECT * FROM news 
			WHERE id = '.$id;

		$res = mysqli_query($this->db, $sql);
		return mysqli_fetch_assoc($res);

	}

	public function getAll() {

		$sql = 'SELECT * FROM news';
		$res = mysqli_query($this->db, $sql);
		$result = array();
		while ( $row = mysqli_fetch_assoc($res) ) {
			$result[] = $row;
		}

		return $result;

	}

	public function getComments($news_id) {
	    $sql = '
	        SELECT id, name, content, date_added
	        FROM comments
	        WHERE news_id = '.$news_id;
	    $res = mysqli_query($this->db, $sql);
    	$result = array();
		while ( $row = mysqli_fetch_assoc($res) ) {
			$result[] = $row;
		}

		return $result;
	}

	public function getCommentsCount() {

	    $sql ='
	        SELECT news.id, news.title, COUNT(comments.id) as cnt
	        FROM news
	        LEFT JOIN comments ON news.id = comments.news_id
	        GROUP BY news.id
	    ';
	    $res = mysqli_query($this->db, $sql);
	    $result = array();
		while ( $row = mysqli_fetch_assoc($res) ) {
			$result[] = $row;
		}

		return $result;
	}

}