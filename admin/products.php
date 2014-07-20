<?php
require_once('include/bootstrap.php');

$user = new Users($db_connection);
$user->isLoggedIn();
$products = new Products($db_connection);
$productsImages = new ProductsImages($db_connection); 
$results = $products->getProductsImagesCount();
if (isset($_GET['action'])) {

	switch ($_GET['action']) {
		case 'delete':
			$GaP = $productsImages->getAllforProduct($_GET['id']);
			foreach ($GaP as $key => $value) {
				unlink('../images/' . $value['image_name']);
			}
            $productsImages->deleteAll($_GET['id']);
			$products->delete($_GET['id']);
			redirect('products.php?action=success');
		break;
		case 'success':
			$deleteMsg = 'Изтриването успешно';
			break;
		default:
			redirect('products.php');
			break;
	}
}

require_once('include/header.php');
?>
<div class="content">
	<a href="products_add.php">Добави Продукт</a>
    <br/><br/>
	<table>
		<tr>
			<th width="30%">Заглавие</th>
			<th width="10%">Основна снимка</th>
			<th width="20%">Цена</th>
			<th width="10%">Снимки</th>
			<th width="20%">Действие</th>
		</tr>
		<?php foreach ($results as $key => $value) : ?>
		<tr>
			<td><?=$value['title']?></td>
			<?php 
			if($value['main_image'] != '' && file_exists('../images/'.$value['main_image'])) { 
				echo '<td>
						<img src="../images/'.$value['main_image'].'" alt="" width="100">
					</td>';
			} else {
				echo '<td>Няма снимка за продукта</td>';
			}
			?>
			<td><?=$value['price']?></td>
			<td><a href="products_images.php?id=<?=$value['id']?>"><?=$value['cnt']?></a></td>
			<td><a href="products_edit.php?id=<?=$value['id']?>">Редактирай</a> / <a href="products.php?action=delete&id=<?=$value['id']?>">Изтрий</a></td>
		</tr>
		<?php endforeach; ?>
		<?php if (isset($deleteMsg)) : ?>
		<tr>
			<th colspan="5"><div class="success"><?= $deleteMsg ?></div></th>
		</tr>
		<?php endif; ?>
	</table>
	<br>
</div>
<?php
require_once('include/footer.php');