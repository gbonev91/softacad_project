<?php
	require_once('include/bootstrap.php');
	
	$comments = new Comments($db_connection);
	$news = new News($db_connection);
	
	if (isset($_GET['id'])) {
		$param = $_GET['id'];
	} else {
		$param = 1;
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		    $name = trim(addslashes(strip_tags($_POST['name'])));
		    $content = trim(addslashes(strip_tags($_POST['comment'])));
		    
		    $addComment = new DBComment();
		    $addComment->name = $name;
		    $addComment->content = $content;
		    $addComment->date_added = date('Y-m-d H:i:s');
		    $addComment->news_id = $param;
		    $comments->add($addComment);
		}
		
		$result = $news->get($param);
		$commentsData = $news->getComments($param);

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
	<meta charset="utf8">
</head>
<body>
	<?php include 'header.php'; ?>
	
	<div id="container">
		<section>
				<div class="title">
					<h2>News</h2>
				</div>
		</section>	
		<section>	
			<div class="news">
				<p class="news_title"><?= $result['title'] ?></p>
				<p class="news_date"><?= $result['date_added'] ?> by <?= $result['title'] ?></p>
				<img src="images/<?= $result['image'] ?>" width="300">
				<p class="news_content"><?= $result['comment'] ?></p>
				<form action="" method="post">
					<fieldset id="fieldComments">
						<legend>Comments</legend>
						<?php foreach ($commentsData as $key => $value) { ?>
						<p class="BlogPost_name"><?=$value['name']?></p>
						<p class="BlogPost_date">on: <?=date('Y-m-d H:i', strtotime('now'))?></p>
						<p class="BlogPost_content"><?=$value['content']?></p>
						<br><br><br>
						<hr>
						<?php } ?>
					</fieldset>
				</form>
				<form action="" method="post">
					<fieldset id="fieldYouComment">
						<legend>Comment here:</legend>
						<p><label class="blogfield" for="name">
						Name: <input id="name" name="name" value="" />
						</label></p>						
						<p><textarea id="comment" name="comment"></textarea></p>
						<p><button type="submit" name="postbutton" id="postbutton">Post</button></p>
					</fieldset>
				</form>
			</div>
		</section>
	</div>
	<?php include 'footer.php'; ?>
</body>

</html>