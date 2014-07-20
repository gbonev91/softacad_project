<?php
require_once('include/bootstrap.php');

$user = new Users($db_connection);
$user->isLoggedIn();
$products = new Products($db_connection);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($_POST['title'] != '' && $_POST['content'] != '' && $_POST['price'] != '') {
		$price = $_POST['price'];
		if (strpos($price, ',')) $price = str_replace(',', '.', $price);

		if ($_FILES['image']['tmp_name'] != '') {//tmp_name 
			$filename = 'main_image_'.rand(1, 10000).$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], '../images/'.$filename);
		} else {
			$filename = '';
		}

		$addProduct = new DBProduct();
		$addProduct->title = $_POST['title'];
		$addProduct->content = $_POST['content'];
		$addProduct->price = $price;
		$addProduct->mainImage = $filename;
		$products->add($addProduct);
	}

	redirect('products.php');
}

require_once('include/header.php');

?>
<div class="content">

	<h2> Добави продукт </h2>
	<form action="" method="post" enctype="multipart/form-data">
		<label>
			Заглавие
			<input type="text" name="title">
		</label>
		<br>
		<label>
			Съдържание
			<textarea name="content"></textarea>
		</label>
		<br>
		<label>
			Качете картинка
			<input type="file" name="image">
		</label>
		<br>
		<label>
			Цена на продукта
			<input type="text" name="price">
		</label>
		<br>
		<button type="submit">Запази</button>
		<button type="reset">Изчисти</button>
	</form>
</div>

<?php
require_once('include/footer.php');