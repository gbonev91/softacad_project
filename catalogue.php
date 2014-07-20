<?php

	require_once('include/bootstrap.php');
	
	$products = new Products($db_connection);
	$allProducts = $products->getAll();

	$pagination = new Pagination($allProducts, 2);
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
	<meta charset="utf8">
</head>
<body>
	<?php include 'header.php'; ?>
	
	<div id="container">
		<section>
				<div class="title">
					<h2>Catalogue</h2>
					<form id="searchForm" action="" method="post">
						<fieldset id="fieldSearch">
							<input id="search" type="text" />
           					<input type="submit" value="Search" id="submitSearch" />
           					<select name="order" id="order">
								<option value="orderBy">Order By</option>
								<option value="acs">Ascending</option>
								<option value="desc">Descending</option>	
							</select>
						</fieldset>
					</form>	
				</div>
		</section>	
		<section>
			<?php foreach ($pagination->pieces() as $key => $value) : ?>
			<div class="productCat">
				<img src="images/<?=$value['main_image'] ?>">
				<p class="productCat_name"><?=$value['title'] ?></p>
				<p class="productCat_price"><?=$value['price'] ?></p>
				<p class="productCat_descr"><?=$value['content'] ?></p>
			</div>
			<?php endforeach; ?>
		</section>
		<div class="spacer"></div>

		<div id="pageList">
			<section>
				<p><?=$pagination->pages() ?></p>
			</section>
		</div>

	</div>
	<?php include 'footer.php'; ?>
</body>

</html>