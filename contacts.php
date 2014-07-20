<?php

	require_once('include/bootstrap.php');
	
	$info = new Contacts($db_connection);
	$contact = new DBContacts($db_connection);

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$contact->name = $_POST['name'];
		$contact->email = $_POST['email'];
		$contact->phone = $_POST['phone'];
		$contact->content = $_POST['content'];
		
		$info->add($contact);
	}
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
			<img src="images/phone.gif" class="phone_img">
			<div class="title">
				<h2>Contact us</h2>
				<p>
				  <strong>Name for contacts </strong> &#8658 Georgi Bonev<br>
				  <strong>Phone </strong> &#8658 0888 888 888<br>
				  <strong>Fax </strong> &#8658 0889 889 889<br>
				  <strong>E-mail </strong> &#8658 <a href="mailto:g.bon@abv.bg">g.bon@abv.bg</a><br>
				  <strong>Address </strong> &#8658 bul. Bulgaria №150
				</p>

				<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3&sensor=false"></script>
				<div id="gmap_canvas" style="height:500px; width:60%; margin-bottom: 3%;"></div>
				<style type="text/css" media="screen">#gmap_canvas img{max-width:none !important;background:none !important;}.gm-style-iw span{height:auto !important;display:block;white-space:nowrap;overflow:hidden !important;}.gm-style-iw strong{font-weight:400;}.map-data{ position:absolute;top:-1668px;}.gm-style-iw{ height:auto !important;color:#000000;display:block;white-space:nowrap;width:auto !important;line-height:18px;overflow:hidden !important;}
				</style>
				<iframe id="data" src="http://www.addmap.org/maps.php" class="map-data"></iframe><a id="get-map-data" href="http://www.gutscheinportal.com/5-eur-ernstings-family-gutschein/"class="map-data">seite</a>
				<script type="text/javascript">function init_map(){ var myOptions={zoom:14, center: new google.maps.LatLng (42.159318,24.745250599999963), mapTypeId: google.maps.MapTypeId.SATELLITE}; map = new google.maps.Map (document.getElementById("gmap_canvas"), myOptions); marker = new google.maps.Marker({map: map, position: new google.maps.LatLng (42.159318,24.745250599999963)}); infowindow = new google.maps.InfoWindow ({content:"<span style='height:auto !important; display:block; white-space:nowrap; overflow:hidden !important;'><strong style='font-weight:400;'>CarPartsCompany</strong><br>bul. Bulgaria 120<br> Plovdiv</span>" }); google.maps.event.addListener (marker, "click", function(){ infowindow.open(map,marker);}); infowindow.open(map,marker);} google.maps.event.addDomListener (window, "load", init_map);
				</script>

				<form action="" method="post">
					<fieldset id="fieldForm">
						<legend><h2>Ask form:</h2></legend>
						<p><label class="field" for="name">
							Name: 
							<input id="name" name="name" value="" />
						</label></p>
						<p><label class="field" for="email">
							Email: 
							<input id="email" name="email" value="" />
						</label></p>
						<p><label class="field" for="phone">
							Phone: 
							<input class="field" id="phone" name="phone" value="" />
						</label></p>
						<p><label class="field" for="content">
							Contact us:
						<p><textarea id="content" name="content"></textarea><p>
						</label></p>
						<p><button type="submit">Send</button></p>
					</fieldset>
				</form>
				<div class="spacer"></div>
			</div>
		</section>
	</div>
	<?php include 'footer.php'; ?>
</body>

</html>