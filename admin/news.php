<?php
require_once('include/bootstrap.php');
$news = new News($db_connection);
$user = new Users($db_connection);
$user->isLoggedIn();
$results = $news->getCommentsCount();


if (isset($_GET['action'])) {

	switch ($_GET['action']) {
		case 'delete':
			$news->delete($_GET['id']);
			redirect('news.php?action=success');
		break;
		case 'success':
			$deleteMsg = 'Изтриването успешно';
			break;
		default:
			redirect('news.php');
			break;
	}
}


require_once('include/header.php');
?>
<div class="content">
	<a href="news_add.php">Добави Новина</a>
    <br/><br/>
	<table>
		<tr>
			<th width="50%">Заглавие</th>
			<th width="10%">Коментари</th>
			<th>Действие</th>
		</tr>
		<?php
		foreach ($results as $key => $value) {
		?>
		<tr>
			<td><?php echo $value['title']?></td>
			<td><a href="comments.php?id=<?=$value['id']?>"><?php echo $value['cnt']?></a></td>
			<td><a href="news_edit.php?id=<?=$value['id']?>">Редактирай</a> / <a href="news.php?action=delete&id=<?=$value['id']?>">Изтрий</a></td>
		</tr>
		<?php
		}
		?>
		<?php if (isset($deleteMsg)) : ?>
		<tr>
			<th colspan="3"><div class="success"><?= $deleteMsg ?></div></th>
		</tr>
		<?php endif; ?>
	</table>
	<br>
</div>
<?php
require_once('include/footer.php');