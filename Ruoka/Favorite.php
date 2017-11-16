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
			<ul id="ImageList">
				<?php
					//Fetching the data
					$con = mysql_connect("localhost","root","");
					if(!$con){
						die('Could not connect to the database: '. mysql_error());
					}

					mysql_select_db("food_database", $con);

					$sql = "SELECT Recipe FROM favorite WHERE user='". $_SESSION['Username'] ."'";

					$result = mysql_query($sql,$con);

					//Filling the list according to the fetched data
					if(mysql_num_rows($result) > 0){
						while($row = mysql_fetch_array($result)){
							echo '
							<li class="card">				
								<a href="/Ruoka/Recipe.php?recipeName='. $row['Recipe'] .'">
									<div class="imageDiv">
										<img class="thumbnail" src="/Ruoka/Recipes/'. $row['Recipe'] .'/thumbnail.jpg">
									</div>
								</a>
								<div class="description">
									'. $row['Recipe'] .'
								</div>			
							</li>
							';														
						};
					}else{
						echo '<span class="RecipeTextStyle">You have no favorites!</span>';
						die(mysql_error());
					}
				?>
			</ul>
		</div>
		<div id="footer">
			<p>Jouni Kortelainen<br>0418271</p>
		</div>
	</body>
</html>