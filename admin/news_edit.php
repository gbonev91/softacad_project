<?php
require_once('include/bootstrap.php');
$user = new Users($db_connection);
$user->isLoggedIn();
$n = new News($db_connection);
$news = $n->get($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if (isset($_GET['action']) && $_GET['action'] == 'delete') {
		unlink('news_images/'.$news['image']);
		// unset($data['image']);
		$news['image'] = '';
	}
	if ($_FILES['image']['tmp_name'] != '') {

		$filename = rand(1, 10000).$_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'], '../images/'.$filename);
		$news['image'] = $filename;

	}

	$addNew = new DBNew();
	$addNew->title = $_POST['title'];
	$addNew->content = $_POST['content'];
	$addNew->date_added = date('Y-m-d H:i:s');
	$addNew->image = $news['image'];
	$n->update($_GET['id'], $addNew);
	redirect('news.php');
}

require_once('include/header.php');

?>
<div class="content">
	<h2> Редактирай новина: <em><?php echo $news['title']?></em> </h2>
	<form action="" method="post" enctype="multipart/form-data">
		<label>
			Заглавие
			<input type="text" name="title" value="<?php echo $news['title']?>">
		</label>
		<br>
		<label>
			Съдържание
			<textarea name="content"><?php echo $news['content']?></textarea>
		</label>
		<br>
		<?php if ($news['image'] != '' && $_GET['action'] != 'delete') { ?>
		<img src="../images/<?php echo $news['image']?>" width="100"><a href="news_edit.php?id=<?=$news['id'] ?>&action=delete" style="position: absolute;">[X]</a>
		<br>
		<?php } ?>
		<label>
			Качете нова картинка
			<input type="file" name="image">
		</label>
		<br>
		<button type="submit">Запази</button>
		<button type="reset">Изчисти</button>
	</form>
</div>

<?php
require_once('include/footer.php');