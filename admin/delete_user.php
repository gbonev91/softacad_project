<?php
require_once('include/bootstrap.php');
$users = new Users($db_connection);
$user->isLoggedIn();
$users->delete($_GET['id']);

redirect('users.php');
