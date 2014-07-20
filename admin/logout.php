<?php
require_once('include/bootstrap.php');
$user = new Users($db_connection);
$user->logOut();
