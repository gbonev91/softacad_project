<?php
require_once('include/bootstrap.php');
$user = new Users($db_connection);
$user->isLoggedIn();
$pages = new Pages($db_connection);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($_POST['title'] != '' && $_POST['content'] != '') {

		$addPage = new DbPage();
		$addPage->title = $_POST['title'];
		$addPage->content = $_POST['content'];
		$pages->add($addPage);

	}

	redirect('pages.php');
}

require_once('include/header.php');

?>
<div class="content">

	<h2> Добави страница </h2>
	<form action="" method="post">
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
		<button type="submit">Запази</button>
		<button type="reset">Изчисти</button>
	</form>
</div>

<?php
require_once('include/footer.php');