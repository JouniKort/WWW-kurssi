<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta content="text/html; charset=UTF-8">
</head>
<body>
<!--Keke M4kkonen123 -->
	<?php 
		if(isset($_POST['submit'])){
			$name = $_POST['username'];
			$pass = $_POST['password'];

			$con = mysql_connect("localhost","root","");
			if(!$con){
				die('Could not connect to the database: '. mysql_error());
			}

			mysql_select_db("login_test",$con);

			$sql = "SELECT Hash,Admin FROM users WHERE name='". $name. "'";

			$result = mysql_query($sql,$con);

			$row = mysql_fetch_array($result);

			mysql_close($con);

			if(!password_verify($pass ,$row['Hash'])){
				echo 'Incorrect username or password!';
			}else{
				$_SESSION['username'] = $name;
				if($row['Admin'] == 1){
					$_SESSION['admin'] = true;
				}else{
					$_SESSION['admin'] = false;
				}
				header("Location:Canvas.html");
				exit;
			}
		}
	 ?>
	<form action="Login.php" method="POST">
	Username:<br>
	<input type="text" name="username">
	<p>Password:<br>
	<input type="password" name="password">
	<p>
	<input type="submit" name="submit" value="Login">
	</form>
</body>
</html>