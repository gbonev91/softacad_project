<?php
require_once('include/bootstrap.php');
$user = new Users($db_connection);
$user->isLoggedIn();
$news = new News($db_connection);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($_POST['title'] != '' && $_POST['content'] != '') {

		if ($_FILES['image']['tmp_name'] != '') {//tmp_name 
			$filename = rand(1, 10000).$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], '../images/'.$filename);
		} else {
			$filename = '';
		}

		$addNew = new DBNew();
		$addNew->title = $_POST['title'];
		$addNew->content = $_POST['content'];
		$addNew->date_added = date('Y-m-d H:i:s');
		$addNew->image = $filename;
		$news->add($addNew);


	}

	redirect('news.php');
}

require_once('include/header.php');

?>
<div class="content">

	<h2> Добави новина </h2>
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
		<button type="submit">Запази</button>
		<button type="reset">Изчисти</button>
	</form>
</div>

<?php
require_once('include/footer.php');