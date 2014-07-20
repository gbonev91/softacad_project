<?php

	require_once('include/bootstrap.php');

	$news = new News($db_connection);
	$blogText = $news->getAll();
	
	$pagination = new Pagination($blogText, 2);

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
	<meta charset="utf8">
	<title>Blog</title>
</head>
<body>
	<?php include 'header.php'; ?>
	
	<div id="container">
				<div class="title">
					<h2>Blog</h2>
				</div>
		<div class="BlogPost">
			<section>
				<?php foreach ($pagination->pieces() as $key => $value) { ?>
				<p class="BlogPost_name"><a href="news.php?id=<?= $value['id'] ?>"><?=$value['title']?></a></p>
				<p class="BlogPost_date">on: <?=$value['date_added']?></p>
				<p class="BlogPost_content"><?=$value['content']?></p>
				<br><br><br>
				<hr>
				<?php } ?>
			</section>
		</div>
		
		<div id="pageList">
			<section>
				<p><?=$pagination->pages() ?></p>
			</section>
		</div>
		<section>
				
				<form action="" method="post">
					<fieldset id="blogForm">
						<legend><h2>Write your thoughts:</h2></legend>
						<p><label class="blogfield" for="name">
						Name: <input id="name" name="name" value="" />
						</label></p>						
						<p><textarea id="blogtext" name="blogtext"></textarea></p>
						<p><button type="submit" name="postbutton" id="postbutton">Post</button></p>
					</fieldset>
				</form>				
		</section>
		
	</div>
	<?php include 'footer.php'; ?>
</body>

</html>