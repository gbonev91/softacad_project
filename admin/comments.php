<?php
require_once('include/bootstrap.php');
$user = new Users($db_connection);
$user->isLoggedIn();

$news = new News($db_connection);
$result = $news->getComments($_GET['id']);
$comments = new Comments($db_connection);

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $comments->delete($_GET['comment_id']);
    redirect('comments.php?id='.$_GET['id']);
}


require_once('include/header.php');
?>
<div class="content">
    <table>
        <tr>
            <th width="20%">Дата</th>
            <th width="10%">Име</th>
            <th width="50%">Коментар</th>
            <th>Действие</th>
        </tr>
        <?php foreach ($result as $key => $value) { ?>
        <tr>
            <td><?=date('H:i d.m.Yг.', strtotime($value['date_added'])); ?></td>
            <td><?=$value['name']?></td>
            <td><?=$value['content']?></td>
            <td><a href="comments.php?action=delete&id=<?=$_GET['id']?>&comment_id=<?=$value['id']?>">Изтрий</a></td>
        </tr>
        <?php } ?>
    </table>
    <br>
</div>
<?php
require_once('include/footer.php');