<!--Left nav-->
<div id="nav">
	<a class="navItem" href="/Ruoka/Food.php">
		<div class="Panel">
			Home
		</div>
	</a>		
	<?php
	if(isset($_SESSION['Username'])){
		echo '	<a class="navItem" href="/Ruoka/Favorite.php">
			<div class="Panel">
				Favorites
			</div>
		</a>';
		echo '<a class="navItem" href="/Ruoka/NewRecipe.php">
			<div class="Panel">
				New entry
			</div>
		</a>';
	}
?>	
	
	<a class="navItem" href="/Ruoka/Login.php">
		<div class="Panel">
			Login
		</div>
	</a>	
	<?php
		if(isset($_SESSION['Username'])){
			echo '<a class="navItem" href="/Ruoka/Logout.php">
			<div class="Panel">
			'. $_SESSION['Username'] .'
			</div>
			</a>';
		}
	?>			
</div>