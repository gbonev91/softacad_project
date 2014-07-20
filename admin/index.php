<?php

require_once('include/bootstrap.php');
$user = new Users($db_connection);

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true ) {
    header('Location: welcome.php');
    exit;
}

$wrong_login = false;
if(isset($_SESSION['errors']) && $_SESSION['errors'] == true) {
    $wrong_login = true;
    $_SESSION['errors'] = false;
}

?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css"/>
    <style>
        body {  background:#567; margin: 50px auto; font-family:'Open Sans',sans-serif; }
        form{ background:#f0f0f0; padding:6% 4%; }
        input[type="text"],input[type="password"]{
            width:92%;
            background:#fff;
            margin-bottom:4%;
            border:1px solid #ccc;
            padding:4%;
            font-family:'Open Sans',sans-serif;
            font-size:95%;
            color:#555;
        }
        button[type="submit"]{
            width:100%;
            background:#3399cc;
            border:0;
            padding:4%;
            font-family:'Open Sans',sans-serif;
            font-size:100%;
            color:#fff;
            cursor:pointer;
            transition:background .3s;
            -webkit-transition:background .3s;
        }
        button[type="submit"]:hover{
            background:#2288bb;
        }
        #login { 
            width:400px;
            margin:0 auto;
            margin-top:15px;
            transition:opacity 1s;
            -webkit-transition:opacity 1s;
        }
        #login h1{
            background:#3399cc;
            padding:20px 0;
            font-size:140%;
            font-weight:300;
            text-align:center;
            color:#fff;
        }
        #triangle{
            width:0;
            border-top:12x solid transparent;
            border-right:12px solid transparent;
            border-bottom:12px solid #3399cc;
            border-left:12px solid transparent;
            margin:0 auto;
        }
    </style>
    <title>Админ Панел</title>
</head>
<body>
<div class="container">
    <div class="content">
        <div id="login">
            <div id="triangle"></div>
            <h1>Администрация</h1>
            <form action="login.php" method="POST">
                <?php if($wrong_login): ?>
                <div class="errors">Грешно име или парола</div>
                <?php endif; ?>
                <div>
                    <input type="text" name="username" id="username" placeholder="Потребителско име"/>
                </div>
                <div>
                    <input type="password" name="password" id="password" placeholder="Парола"/>
                </div>
                <button type="submit" class="button">Вход</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>