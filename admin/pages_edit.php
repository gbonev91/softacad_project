<?php
require_once('include/bootstrap.php');
$user = new Users($db_connection);
$user->isLoggedIn();
$pages = new Pages($db_connection);
$data = $pages->get($_GET['id']);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// $data = array(
	// 	'title' => $_POST['title'],
	// 	'content' => $_POST['content']
	// );
	// db_update('pages', $data, $_GET['id']);
	$addPage = new DBPage();
	$addPage->title = $_POST['title'];
	$addPage->content = $_POST['content'];
	$pages->update($_GET['id'], $addPage);

	redirect('pages.php');
}

require_once('include/header.php');

?>
<div class="content">
	<h2> Редактирай новина: <em><?php echo $data['title']?></em> </h2>
	<form action="" method="post">
		<label>
			Заглавие
			<input type="text" name="title" value="<?php echo $data['title']?>">
		</label>
		<br>
		<label>
			Съдържание
			<textarea name="content"><?php echo $data['content']?></textarea>
		</label>
		<br>
		<button type="submit">Запази</button>
		<button type="reset">Изчисти</button>
	</form>
</div>

<?php
require_once('include/footer.php');