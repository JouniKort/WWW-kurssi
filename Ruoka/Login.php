<?php
	session_start();
?>
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

		<!--Keke M4kk0Nen123
		Porkkana V4rsIselleri-->
		<?php
			if(isset($_POST['SubmitNew'])){
				$name = $_POST['Username'];
				$pass = $_POST['Password'];

				if(preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z]{8,256}$/', $pass)){
					$options = [
					    'cost' => 10,
					    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
					];

					$hash = password_hash($pass, PASSWORD_BCRYPT, $options);

					$con = mysql_connect("localhost","root","");
					if(!$con){
						die('Could not connect to the database: '. mysql_error());
					}

					mysql_select_db("food_database",$con);

					$sql = "INSERT INTO Users (Username,Hash) VALUES ('". $name ."','". $hash ."')";

					if(!mysql_query($sql,$con)){
						die('Could not inset into the database: '. mysql_error());
					}
					mysql_close($con);

					header("Location:Food.php");
					exit;
				}
			}else if(isset($_POST['SubmitOld'])){
				$name = $_POST['Username'];
				$pass = $_POST['Password'];

				$con = mysql_connect("localhost","root","");
				if(!$con){
					die('Could not connect to the database: '. mysql_error());
				}

				mysql_select_db("food_database",$con);

				$sql = "SELECT Hash FROM users WHERE username='". $name. "'";

				$result = mysql_query($sql,$con);

				$row = mysql_fetch_array($result);

				mysql_close($con);

				if(!password_verify($pass ,$row['Hash'])){
					$_SESSION['NotOK'] = 'NotOk';
				}else{
					$_SESSION['Username'] = $name;
					header("Location:Food.php");
					exit;
				}
			}
		?>

		<div id="content">
			<div id="LoginForm">
				<form action="Login.php" method="POST">
					<h3 class="LoginPageH2">Username:</h3>
					<input type="text" name="Username">
					<br>
					<h3 class="LoginPageH2">Password:</h3>
					<input type="Password" name="Password">
					<br>
					<table style="width:80%;margin-left: 50px;margin-right: 50px">
						<tr>
							<td style="width:50%">
								<input type="submit" value="Login" name="SubmitOld" class="LoginPageSubmit">
							</td>
							<td style="width:50%">
								<input type="submit" value="New user" name="SubmitNew" class="LoginPageSubmit">
							</td>
						</tr>
					</table>
				</form>
				<?php
					if(isset($_SESSION['NotOK'])){
						echo '<br><h3>Wrong username or password!</h3>';
						unset($_SESSION['NotOK']);
					}
				?>
			</div>
		</div>
		<div id="footer">
			<p>Jouni Kortelainen<br>0418271</p>
		</div>
	</body>
</html>