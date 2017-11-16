<?php
	session_start();
?>

<!dOCTYPE html>
<html>
	<head>
	<title>Muistio</title>
		<meta content="text/html; charset=UTF-8">
		<link rel="Stylesheet" href="style.css" type="text/css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>	
		<script src="Muistio.js" type="text/javascript"></script>
        <script src="Muistio_jQuery.js" type="text/javascript"></script>
	</head>
	<body>
		<?php
			$con = mysql_connect("localhost","root","");
			if(!$con){
				die('Could not connect to the database: '. mysql_error());
			}

			mysql_select_db("todolist",$con);

			$sql = "INSERT INTO Notesuser (Note,user) VALUES ('". $_POST['NoteToBeAdded'] ."','". $_SESSION['username'] ."')";

			if(!mysql_query($sql,$con)){
				die('Could not inset into the database: '. mysql_error());
			}
			mysql_close($con);

			header("Location:Muistio.php");
			exit;
		?>
	</body>
</html>