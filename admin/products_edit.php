<?php
require_once('include/bootstrap.php');

$user = new Users($db_connection);
$user->isLoggedIn();
$products = new Products($db_connection);
$product = $products->get($_GET['id']);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($_POST['title'] != '' && $_POST['content'] != '' && $_POST['price'] != '') {
		if (isset($_GET['action']) && $_GET['action'] == 'delete') {
		unlink('../images/'.$product['main_image']);
		$product['main_image'] = '';
	}
	if ($_FILES['image']['tmp_name'] != '') {

		$filename = 'main_image_'.rand(1, 10000).$_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'], '../images/'.$filename);
		$product['main_image'] = $filename;

	}
		$price = $_POST['price'];
		if (strpos($price, ',')) $price = str_replace(',', '.', $price);
		$addProduct = new DBProduct();
		$addProduct->title = $_POST['title'];
		$addProduct->content = $_POST['content'];
		$addProduct->price = $price;
		$addProduct->mainImage = $product['main_image'];
		$products->update($_GET['id'], $addProduct);
	}

	redirect('products.php');
}

require_once('include/header.php');

?>
<div class="content">
	<h2> Редактирай продукт: <em><?php echo $product['title']?></em> </h2>
	<form action="" method="post" enctype="multipart/form-data">
		<label>
			Заглавие
			<input type="text" name="title" value="<?php echo $product['title']?>">
		</label>
		<br>
		<br>
		<label>
			Съдържание
			<textarea name="content"><?php echo $product['content']?></textarea>
		</label>
		<br>
		<?php if ($product['main_image'] != '' && $_GET['action'] != 'delete') { ?>
		<img src="../images/<?php echo $product['main_image']?>" width="100"><a href="products_edit.php?id=<?=$product['id'] ?>&action=delete" style="position: absolute;">[X]</a>
		<br>
		<?php } ?>
		<label>
			Качете нова картинка
			<input type="file" name="image">
		</label>
		<br>
		<label>
			Цена
			<input type="text" name="price" value="<?php echo $product['price']?>">
		</label>
		<br>
		<button type="submit">Запази</button>
	</form>
</div>

<?php
require_once('include/footer.php');
?>