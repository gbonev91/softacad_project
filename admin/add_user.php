<?php
require_once('include/bootstrap.php');
$user = new Users($db_connection);
$user->isLoggedIn();

$success = false;
$errors = false;
$exists = false;
$username = '';
$users = new Users($db_connection);
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $found = $users->getUser($username);

    if(validate_field($username) && validate_field($password)){
        if(count($found) == 0){
            $addUser = new DBUser();
            $addUser->username = $_POST['username'];
            $addUser->password = md5($_POST['password']);
            $users->add($addUser);
            $success = true;
            redirect('users.php');
        } else {
            $exists = true;
        }

    } else {
        $errors = true;
    }
}
require_once('include/header.php');

?>

    <div class="content">
        <?php if($success == true): ?>
        <div class="success">Потребителя е добавен успешно!</div>
        <?php endif; ?>

        <?php if($errors == true && $exists == false): ?>
            <div class="errors">Попълнете формата правилно!</div>
        <?php endif; ?>

        <?php if($errors == false && $exists == true): ?>
            <div class="errors">Този потребител вече съществува!</div>
        <?php endif; ?>

        <form action="" method="POST">
            <div>
                <label for="">Потребител:</label>
                <input type="text" name="username" id="" value=""/>
            </div>

            <div>
                <label for="">Парола:</label>
                <input type="password" name="password" id=""/>
            </div>

            <button type="submit">Добави</button>
        </form>
    </div>

<?php
require_once('include/footer.php');