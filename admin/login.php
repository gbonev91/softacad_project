<?php
require_once('include/bootstrap.php');
$user = new Users($db_connection);
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $data = $user->isExist($username, $password);
    if (count($data) > 0) {
        $_SESSION['logged_in'] = true;
        $_SESSION['errors'] = false;
        $_SESSION['user'] = $data;

        redirect('welcome.php');
        
    } else {
        $_SESSION['logged_in'] = false;
        $_SESSION['errors'] = true;
        redirect('index.php');       
    }
} else {
    redirect('index.php');
}
