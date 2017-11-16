<!Doctype html>
<html>
<head>
<title>Sää</title>
</head>
<body>
	<form method="post">
        <fieldset>
            <legend>Choose cities</legend>
                <input type="checkbox" name="Lappeenranta" value="Lappeenranta" />
                Lappeenranta <br />
                <input type="checkbox" name="Helsinki" value="Helsinki" />Helsinki <br />
                <input type="checkbox" name="Kouvola" value="Kouvola" />Kouvola <br />
                <br>
                <input type="submit" value="Get weather data" name="submit" />
        </fieldset>
	</form>

	<form method="post">
		<select name="Cities" multiple>
			<?php
				$JSON = file_get_contents('city.list.json');
				$JSON = json_decode($JSON);

				$Cities = $JSON->list;

				foreach($Cities as $city){
					echo '<option value="'. $city->name .'">'. $city->name .'</option>';
				}
			?>
			<input type="submit" name="submitN" value="Get weather data" >
		</select>
	</form>

	<?php
		if(isset($_POST['submitN'])){
			$request = 'http://api.openweathermap.org/data/2.5/group?id=';

			foreach($Cities as $city){
				if(isset($_POST[$city->name])){
					echo $city->name;
				}
			}
		}

		if(isset($_POST['submit'])){
			$request = 'http://api.openweathermap.org/data/2.5/group?id=';

			if(isset($_POST['Lappeenranta'])){
				$request = $request. '648901,';
			}
			if(isset($_POST['Helsinki'])){
				$request = $request. '658225,';
			}
			if(isset($_POST['Kouvola'])){
				$request = $request. '650861,';
			}

			$request = substr($request, 0, strlen($request) - 1);

			$request = $request. '&units=metric&APPID=f6f34066ff9732aeaa923764cb604ca0';

			$response = file_get_contents($request);

			$response = json_decode($response);

			$list = $response->list;

			foreach($list as $city){
				echo '<div style="border:1px black solid;">';
				echo '<h2>City: '. $city->name .'</h2>';				
				echo 'Temperature: '. $city->main->temp .' C<br>';
				echo 'Humidity: '. $city->main->humidity .'%<br>';
				echo 'Description: '. $city->weather[0]->description;
				echo '</div>';
			}
		}
	?>

</body>
</html>