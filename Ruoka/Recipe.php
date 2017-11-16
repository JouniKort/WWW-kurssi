<?php
	session_start();
?>
<!--For showing a recipe-->
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
					$recipeName = $_GET['recipeName'];
					header('Content-type: text/html; charset=utf-8');
					$dir = new DirectoryIterator(getcwd() .'/Recipes/'. $recipeName);
					//Search the full image
					foreach($dir as $filename){
						if(strpos($filename,'.jpg') !== false & strpos($filename,'thumbnail') === false){
							echo '<div id="recipeImageDiv">
							<img id="RecipeImage" src="/Ruoka/Recipes/'. $recipeName .'/'. $filename .'"></div>';
							break;
						};
					};
					//The xml load was given errors because of encoding => loaded the file through encoding and replaced unwanted characters
					$Recipe = utf8_encode(file_get_contents(getcwd() .'/Recipes/'. $recipeName .'/'. basename(getcwd() .'/Recipes/'. $recipeName) .'.xml'));
					$Recipe = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $Recipe);
					$RecipeXml = simplexml_load_string($Recipe);

					//Name of the recipe
					echo '<div id="RecipeText"><h2>'. $RecipeXml->Header[0]->Name .'</h2>';
					//Author and date
					echo '<h4>'. $RecipeXml->Header[0]->Author .' '. $RecipeXml->Header[0]->Date .'<br></h4>';
					//description
					echo '<h3>'. $RecipeXml->Description[0] .'</h3>';

					//Ingredients
					echo '<p><h2>Ingredients</h2></p>';
					echo '<ul id="ListOfIngredients">';
					foreach($RecipeXml->Ingredients->Item as $Item){
						echo '<span class="RecipeTextStyle"><li class="IngredientItem"><strong>'. $Item->Amount .'</strong> '. $Item->Name .'</li></span>';
					}
					echo '</ul>';

					//Directions
					echo '<p><h2>Directions</h2></p>';
					echo '<ol id="ListOfSteps">';
					foreach($RecipeXml->Directions->Step as $Step){
						echo '<span class="RecipeTextStyle"><li>'. $Step .'</li></span>';
					}
					echo '</ol>';
					//Source
					echo '<p><h3><a href="'. $RecipeXml->Header[0]->Source .'">'. $RecipeXml->Header[0]->Source .'</a></h3></p>';

					echo '<form action="Insert.php?Recipe='. $RecipeXml->Header[0]->Name .'" method="post"><input type="submit" value="Add to your favorites"></form></div>';
				?>
			</div>
		</div>
		<div id="footer">
			<p>Jouni Kortelainen<br>0418271</p>
		</div>
	</body>
</html>