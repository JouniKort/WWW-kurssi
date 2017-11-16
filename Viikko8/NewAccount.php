<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta content="text/html; charset=UTF-8">
</head>
<body>
	<?php 
		if(isset($_POST['submit'])){
			$name = $_POST['username'];
			$pass = $_POST['password'];

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

				mysql_select_db("login_test",$con);

				$sql = "INSERT INTO Users (Name,Hash) VALUES ('". $name ."','". $hash ."')";

				if(!mysql_query($sql,$con)){
					die('Could not inset into the database: '. mysql_error());
				}
				mysql_close($con);

				header("Location:Home.html");
				exit;
			}
		}
	 ?>
	<form action="NewAccount.php" method="POST">
	Username:<br>
	<input type="text" name="username">
	<p>Password:<br>
	<input type="password" name="password">
	<p>
	<input type="submit" name="submit" value="Create an account">
	</form>
</body>
</html>