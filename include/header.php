<?php

require_once('include/bootstrap.php');
// $sql = 'SELECT title FROM pages';
$page = new Pages($db_connection);
// $data = db_select($sql);
$data = $page->getAll();
?>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style/styles.css">
</head>
<body>
    <div id="wrapper">
        <header>
            <a href="index.php">
                <img src="images/logo.png" alt="logo" id="logo">
            </a>
            <a href="index.php">
                <img src="images/title.png" alt="title" id="title">
            </a>
        </header>
        <div class="spacer"></div>
        <nav>
            <ul>
               <li><a href="index.php">Home</a></li>
               <li><a href="about.php">About Us</a></li>
               <li><a href="contact.php">Contact Us</a></li>
               <li><a href="catalog.php">Catalog</a></li>
               <li><a href="products.php">Products</a></li>
               <li><a href="blog.php">Blog</a></li>
               <!-- <li><a href="news.php">News</a></li> -->
              <?php foreach($data as $key => $value) : ?>
               <li><a href="<?=$value['content']?>"><?=$value['title']?></a></li>
              <?php endforeach; ?>
            </ul>
        </nav>
        <div id="content">