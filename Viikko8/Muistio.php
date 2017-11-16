<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header('Location: home.html');
	}
?>

<!dOCTYPE html>
<html>
	<head>
	<title>Muistio</title>
		<meta content="text/html; charset=UTF-8">
		<link rel="Stylesheet" href="style.css" type="text/css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>	
		<!--<script src="Muistio.js" type="text/javascript"></script>-->
	</head>

	<body>
		<div style="background: url(Muistio.png); width:423px;height: 493px; position:relative; ">	<!--position:relative-->
			<div style="padding-left: 50px; padding-top: 1px">
			<h1 style="padding-left: 20px">ToDo</h1>
			<div style="height: 26px">
			<form onsubmit="return SendToDb()">
				<input type="text" name="NoteToBeAdded" style="padding-left: 20px">
				<input type="submit" name="Submit">					
			</div>	
			<ul style="padding-left: 20px; padding-top: 9px">
			<?php
				$con = mysql_connect("localhost","root","");
				if(!$con){
					die('Could not connect to the database: '. mysql_error());
				}

				mysql_select_db("todolist",$con);

				if($_SESSION['admin']){
					$sql = "SELECT ID,Note FROM Notesuser";	
					echo 'Admin';				
				}else{
					$sql = "SELECT ID,Note FROM Notesuser WHERE User='". $_SESSION['username'] ."'";					
				}

				$result = mysql_query($sql,$con);

				if(mysql_num_rows($result)>0){
					while($row = mysql_fetch_array($result)){
						echo '<li>'. $row['Note'] .' <button onclick="RemoveFromDb(' . $row['ID'] . ')" href="#">Remove</button></li>';
					};
				}else{
					echo '<li>No results</li>';
				};
				mysql_close($con);
			?>

			<script type="text/javascript">
				function SendToDb(){
					text = $('input[type="text"]').val();
					if(text.length > 0){
						$.ajax({
							method: "POST",
							url: "Insert.php",
							data: {NoteToBeAdded: text}
						}).done(function(){
							location.reload();
						});					
					}

					return false;
				}

				function RemoveFromDb(id){
					$.ajax({
						method: "GET",
						url: "DeleteRecord.php",
						data: {Note: id}
					}).done(function(){
						location.reload();
					});
					
					return false;
				}
			</script>

			</ul>
			</div>
		</div>
		<a href="Logout.php">Logout</a>
	</body>
</html>