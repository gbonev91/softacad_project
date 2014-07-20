<?php

class Products implements ICRUD {

	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function add(IItem $item) {
		$sql = '
			INSERT INTO products (title, content, price, main_image) 
			VALUES (
				"'.$item->title.'",
				"'.$item->content.'",
				"'.$item->price.'",
				"'.$item->mainImage.'"
			)
		';
		mysqli_query($this->db, $sql);
	}

	public function update($id, IItem $item) {

		$sql = '
			UPDATE products
			SET 
			title = "' . $item->title . '",
			content = "' . $item->content . '",
			price = "'.$item->price.'",
			main_image = "'.$item->mainImage.'"
			WHERE id = ' . $id;

		mysqli_query($this->db, $sql);

	}

	public function delete($id) {

		$sql = '
			DELETE FROM products WHERE id = '. $id;

		mysqli_query($this->db, $sql);

	}

	public function get($id) {

		$sql = '
			SELECT * FROM products 
			WHERE id = '.$id;

		$res = mysqli_query($this->db, $sql);
		return mysqli_fetch_assoc($res);

	}

	public function getAll() {

		$sql = 'SELECT * FROM products';
		$res = mysqli_query($this->db, $sql);
		$result = array();
		while ( $row = mysqli_fetch_assoc($res) ) {
			$result[] = $row;
		}

		return $result;

	}

	public function getProductsImagesCount() {

	     $sql ='
	        SELECT products.id, products.title, products.price, products.main_image, COUNT(products_images.id) as cnt
	        FROM products
	        LEFT JOIN products_images ON products.id = products_images.products_id
	        GROUP BY products.id
    	';
	    $res = mysqli_query($this->db, $sql);
	    $result = array();
		while ( $row = mysqli_fetch_assoc($res) ) {
			$result[] = $row;
		}

		return $result;
	}

	public function getProductsAllImages($products_id) {
	    $sql = '
	        SELECT id, image_name, products_id
	        FROM products_images
        	WHERE products_id = '.$products_id;
	    $res = mysqli_query($this->db, $sql);
    	$result = array();
		while ( $row = mysqli_fetch_assoc($res) ) {
			$result[] = $row;
		}

		return $result;
	}

	public function getProductImage($id, $products_id) {

	    $sql = '
	        SELECT id, image_name
	        FROM products_images
	        WHERE id='.$id.' AND products_id='.$products_id;
	        
	    $res = mysqli_query($this->db, $sql);
	    return mysqli_fetch_assoc($res);

	}


}
