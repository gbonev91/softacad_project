<?php

class ProductsImages implements ICRUD {

	private $db;

	public function __construct($db) {
		$this->db = $db;
	}


	public function add(IItem $item) {
		$sql = '
			INSERT INTO products_images (image_name, products_id) 
			VALUES (
				"'.$item->mainImage.'",
				"'.$item->products_id.'"
			)
		';
		mysqli_query($this->db, $sql);
	}

	public function update($id, IItem $item) {}


	public function delete($id) {

		$sql = '
			DELETE FROM products_images WHERE id = '. $id;

		mysqli_query($this->db, $sql);

	}

	public function get($id) {}

	public function getAll() {}

	public function getAllforProduct($products_id) {
		$sql = 'SELECT * FROM products_images WHERE products_id = '.$products_id;
		$res = mysqli_query($this->db, $sql);
		$result = array();
		while ( $row = mysqli_fetch_assoc($res) ) {
			$result[] = $row;
		}
	
		return $result;
	 }
	
	public function deleteAll($products_id) {
		$sql = '
		DELETE FROM products_images WHERE products_id = '.$products_id;
	
		mysqli_query($this->db, $sql);
	
	 }

}