<?php
require_once('include/bootstrap.php');
$user = new Users($db_connection);
$user->isLoggedIn();
$pages = new Pages($db_connection);
$result = $pages->getAll();

if (isset($_GET['action'])) {

	switch ($_GET['action']) {
		case 'delete':
			$pages->delete($_GET['id']);
			redirect('pages.php?action=success');
		break;
		case 'success':
			$deleteMsg = 'Изтриването успешно';
			break;
		default:
			redirect('pages.php');
			break;
	}
}

require_once('include/header.php');
?>
<div class="content">
	<a href="pages_add.php">Добави Страница</a>
    <br/><br/>
	<table>
		<tr>
			<th width="50%">Заглавие</th>
			<th width="10%">Съдържание</th>
			<th>Действие</th>
		</tr>
		<?php foreach ($result as $key => $value) :?>
		<tr>
			<td><?=$value['title']?></td>
			<td><?=$value['content']?></td>
			<td><a href="pages_edit.php?id=<?=$value['id']?>">Редактирай</a> / <a href="pages.php?action=delete&id=<?=$value['id']?>">Изтрий</a></td>
		</tr>
		<?php endforeach; ?>
		<?php if (isset($deleteMsg)) : ?>
		<tr>
			<th colspan="3"><?= $deleteMsg ?></th>
		</tr>
		<?php endif; ?>
	</table>
	<br>
</div>
<?php
require_once('include/footer.php');