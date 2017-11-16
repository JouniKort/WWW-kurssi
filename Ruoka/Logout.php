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

		<?php
			if(isset($_POST['Logout'])){
				session_destroy();
				header("Location:Food.php");
				exit;
			}
		?>

		<div id="content">
			<div id="LoginForm">
				<form action="Logout.php" method="POST">
					<table style="width:80%;margin-left: 50px;margin-right: 50px">
						<tr>
							<td style="width:100%">
								<input type="submit" value="Logout" name="Logout" class="LoginPageSubmit">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<div id="footer">
			<p>Jouni Kortelainen<br>0418271</p>
		</div>
	</body>
</html>