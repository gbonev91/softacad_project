<?php
require_once('include/bootstrap.php');
$user = new Users($db_connection);
$user->isLoggedIn();
$data = $user->getAll();
require_once('include/header.php');
?>

<div class="content">
    <a href="add_user.php">Добави потребител</a>
    <br/><br/>
    <table>
        <tr>
            <th>#</th>
            <th>Потребител</th>
            <th>Действие</th>
        </tr>
        <?php foreach($data as $key => $value):?>
            <tr>
                <td><?php echo $value['id'];?></td>
                <td><?php echo $value['username'];?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $value['id'];?>">Редактирай</a>
                    <?php if($value['id'] != $_SESSION['user']['id']): ?>
                    <a href="delete_user.php?id=<?php echo $value['id'];?>">Изтрий</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>

<?php
require_once('include/footer.php');