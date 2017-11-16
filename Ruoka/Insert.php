<?php
	session_start();
?>
<!--For inserting a favorite record to the database, and showing the result-->
<!DOCTYPE html>
<html>
	<head>
		<title>Food</title>
		<meta content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="/Ruoka/style.css">
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
			<div id="recipe">
				<?php
					$con = mysql_connect("localhost","root","");
					if(!$con){
						die('Could not connect to the database: '. mysql_error());
					}

					mysql_select_db("food_database", $con);

					$sql = "INSERT INTO favorite (User, Recipe) VALUES ('". $_SESSION['Username'] ."','". $_GET['Recipe'] ."')";

					if(!mysql_query($sql,$con)){
						die("Could not insert into the database: ". mysql_error());
					}
					echo '<span class="RecipeTextStyle">Record added</span>';

					mysql_close($con);
				?>
			</div>
		</div>
		<div id="footer">
			<p>Jouni Kortelainen<br>0418271</p>
		</div>
	</body>
</html>