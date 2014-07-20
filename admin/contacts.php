<?php
require_once('include/bootstrap.php');
$user = new Users($db_connection);
$user->isLoggedIn();
$contacts = new Contacts($db_connection);
$result = $contacts->getAll();

if (isset($_GET['action'])) {

	switch ($_GET['action']) {
		case 'delete':
			$contacts->delete($_GET['id']);
			redirect('contacts.php?action=success');
		break;
		case 'success':
			$deleteMsg = 'Изтриването успешно';
			break;
		default:
			redirect('contacts.php');
			break;
	}
}

require_once('include/header.php');
?>
<div class="content">
	<a href="contacts.php">Контакти</a>
    <br/><br/>
	<table>
		<tr>
			<th width="20%">Име</th>
			<th width="50%">Е-майл</th>
			<th width="20%">Телефон</th>
			<th width="10%">Съдържание</th>
			<th>Действие</th>
		</tr>
		<?php foreach ($result as $key => $value) :?>
		<tr>
			<td><?=$value['name']?></td>
			<td><?=$value['email']?></td>
			<td><?=$value['phone']?></td>
			<td><?=$value['content']?></td>
			<td><a href="contacts.php?action=delete&id=<?=$value['id']?>">Изтрий</a></td>
		</tr>
		<?php endforeach; ?>
		<?php if (isset($deleteMsg)) : ?>
		<tr>
			<th colspan="5"><?= $deleteMsg ?></th>
		</tr>
		<?php endif; ?>
	</table>
	<br>
</div>
<?php
require_once('include/footer.php');