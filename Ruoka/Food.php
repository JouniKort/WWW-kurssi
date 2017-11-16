<?php
	session_start();
?>
<!--Homepage-->
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
					header('Content-type: text/html; charset=utf-8');
					$dir = new RecursiveDirectoryIterator('Recipes/');
					foreach(new RecursiveIteratorIterator($dir) as $filename => $file){
						if(strpos($file,'thumbnail') !== false){
							//Passing variable through a href, ?RecipeName=[variable]
							echo '
							<li class="card">				
								<a href="/Ruoka/Recipe.php?recipeName='. basename(dirname($filename)) .'">
									<div class="imageDiv">
										<img class="thumbnail" src="'. $filename .'">
									</div>
								</a>
								<div class="description">
									'. basename(dirname($filename)) .'
								</div>			
							</li>
							';														
						};
					};
				?>
			</ul>
		</div>
		<div id="footer">
			<p>Jouni Kortelainen<br>0418271</p>
		</div>
	</body>
</html>