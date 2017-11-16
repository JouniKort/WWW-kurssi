<?php
	session_start();
	if(!isset($_SESSION['Username'])){
		header("Location:Food.php");
	};
?>
<!--Fetching facorite recors out from the database and building a list according to the result-->
<!DOCTYPE html>
<html>
	<head>
		<title>Food</title>
		<meta content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>	
		<script   src="http://code.jquery.com/ui/1.12.0/jquery-ui.min.js"   integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="   crossorigin="anonymous"></script>
		<script type="text/jscript" src="/Ruoka/Food_jQuery.js"></script>
	</head>
	<body>
		<div id="header">
			<p><h1>FoodBook</h1></p>
		</div>

		<!--Nav placeholder-->
		<?php include('nav.php'); ?>

		<div id="content">
			
		</div>
		<div id="footer">
			<p>Jouni Kortelainen<br>0418271</p>
		</div>
	</body>
</html>