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
		<div style="background: url(Muistio.png); width:423px;height: 493px; position:relative; ">	<!--position:relative-->
			<div style="padding-left: 50px; padding-top: 1px">
			<h1 style="padding-left: 20px">ToDo</h1>
			<div style="height: 26px">
			<form action="Insert.php" method="POST">
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

				$sql = "SELECT ID,Note FROM notes";

				$result = mysql_query($sql,$con);

				if(mysql_num_rows($result)>0){
					while($row = mysql_fetch_array($result)){
						echo '<li>'. $row['Note'] .' <a href="/Viikko6/DeleteRecord.php?Note='. $row['ID'] .'">Remove</a></li>';
					};
				}else{
					echo '<li>No results</li>';
				};
				mysql_close($con);
			?>
			</ul>
			</div>
		</div>
	</body>
</html>