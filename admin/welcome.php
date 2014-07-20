<?php
require_once('include/bootstrap.php');
$user = new Users($db_connection);
$user->isLoggedIn();
require_once('include/header.php');
?>
<div class="content">
    Hellowwww www
</div>

<?php require_once('include/footer.php'); ?>