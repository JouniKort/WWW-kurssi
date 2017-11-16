<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Food</title>
		<meta content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="/Ruoka/style.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script   src="http://code.jquery.com/ui/1.12.0/jquery-ui.min.js"   integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="   crossorigin="anonymous"></script>	
		<script type="text/jscript" src="/Ruoka/Food_jQuery.js"></script>
		<script type="text/jscript" src="/Ruoka/Food.js"></script>
	</head>
	<body>
		<div id="header">
			<p><h1>FoodBook</h1></p>
		</div>

		<!--Nav placeholder-->
		<?php include('nav.php'); ?>

		<div id="content">

		<?php
		if(isset($_POST['submit'])){
			$Recipe = new SimpleXMLElement('<Recipe />');

			$Header = $Recipe->addChild('Header');
			$Header->addChild('Name',$_POST['Name']);
			$Header->addChild('Author',$_POST['Author']);
			$Header->addChild('Date','');
			$Header->addChild('Source',$_POST['Source']);

			$Recipe->addChild('Description',$_POST['Description']);

			$Ingredients = $Recipe->addChild('Ingredients');

			$AmountList = $_POST['Amount'];
			$ItemList = $_POST['Item'];

			for ($ind = 0; $ind<count($AmountList); $ind++){
				$Item = $Ingredients->addChild('Item');
				$Item->addChild('Name',$ItemList[$ind]);
				$Item->addChild('Amount',$AmountList[$ind]);
			}

			$StepList = $_POST['Step'];

			$Directions = $Recipe->addChild('Directions');

			foreach($StepList as $iStep){
				$Directions->addChild('Step',$iStep);
			}
			if (!file_exists(getcwd() .'/Recipes/'. $_POST['Name'] .'/')) {
			    mkdir(getcwd() .'/Recipes/'. $_POST['Name'] .'/', 0777, true);
			}

			$Recipe->saveXML(getcwd() .'/Recipes/'. $_POST['Name'] .'/'. $_POST['Name'] .'.xml');

			move_uploaded_file($_FILES['fullImage']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] .'/Ruoka/Recipes/'. $_POST['Name'] .'/'. $_POST['Name'] .'.jpg');

			move_uploaded_file($_FILES['thumbnail']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] .'/Ruoka/Recipes/'. $_POST['Name'] .'/thumbnail.jpg');

			header("Location:Recipe.php?recipeName=". $_POST['Name']);
			exit;
		}
		?>
			<!--Cannot add list elements dynamicly without onsubmit="return false;", the custom function return false when element is added-->
			<form action="NewRecipe.php" method="POST" id="EntryForm" enctype="multipart/form-data" onsubmit="return validateSubmission()">
				<input type="file" name="fullImage" accept="image/jpg" value="fullImage">
				<input type="file" name="thumbnail" accept="image/jpg" value="thumbnail">
				<input type="text" name="Name" value="Name of the recipe">
				<input type="text" name="Author" value="Author's name">
				<input type="text" name="Source" value="Source">
				<input type="text" name="Description" value="Description">

				<!--Empty li:s are not saved -> they need to be filled before submission-->
				<button class="NewEntryButton" onclick="newIngredient()">Add ingredient</button>
				<ul class="newEntryList" id="newAmount">		
					<li class="newEntryAmount"><input type="text" name="Amount[]" class="inputEntryList"></li>
				</ul>

				<ul class="newEntryList" id="newItem">		
					<li class="newEntryItem"><input type="text" name="Item[]" class="inputEntryList"></li>
				</ul>
				<button class="NewEntryButton" onclick="deleteIngredient()">Delete the last ingredient</button>

				<button class="NewEntryButton" onclick="newStep()">Add step</button>
				<ul class="newEntryList" id="newStepList">
					<li class="newEntryIngredient"><input type="text" name="Step[]"></li>
				</ul>
				<button class="NewEntryButton" onclick="deleteStep()">Delete the last step</button>
				<input class="NewEntryButton" type="submit" name="submit" value="Submit a new entry">
			</form>
		</div>
		<div id="footer">
			<p>Jouni Kortelainen<br>0418271</p>
		</div>
	</body>
</html>