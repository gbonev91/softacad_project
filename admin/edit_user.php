<?php
require_once('include/bootstrap.php');
$users = new Users($db_connection);
$user->isLoggedIn();
$user = $users->get($_GET['id']);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $addUser = new DBUser();
    $addUser->username = $_POST['username'];
    $addUser->password = md5($_POST['password']);
    $users->update($_GET['id'], $addUser);
    redirect('users.php');
}
require_once('include/header.php');

?>

<div class="content">
    <form action="" method="POST">
        <div>
            <label for="">Потребител:</label>
            <input type="text" name="username" id="" value="<?php echo $user['username'];?>"/>
        </div>

        <div>
            <label for="">Парола:</label>
            <input type="password" name="password" id=""/>
        </div>

        <button type="submit">Редактирай</button>
    </form>
</div>

<?php
require_once('include/footer.php');