<?php

	$weather = "";
	$error = "";
	
	if (array_key_exists('location', $_GET)) {
		
		$location = str_replace(' ', '', $_GET['location']);
		
		$file_headers = @get_headers("https://www.weather-forecast.com/locations/".$location."/forecasts/latest");
		if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
			
			$error = "That city could not be found.";
			
		} else {
		
		$forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$location."/forecasts/latest");
		
		$pageArray = explode('(1&ndash;3 days)</div><p class="b-forecast__table-description-content"><span class="phrase">', $forecastPage);
		
		if (sizeof($pageArray) > 1) {
		
				$secondPageArray = explode('</span></p></td>', $pageArray[1]);
				
				if (sizeof($secondPageArray) > 1 ) {
				
				$weather = $secondPageArray[0];
				
				} else {
					
					$error = "That city could not be found.";
					
				}
			
			} else {
				
				$error = "That city could not be found.";
				
			}
		
		}
		
	}

?>

<!doctype html>

<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	
	<script src="https://use.fontawesome.com/b66b450317.js"></script>

    <title>Weather Scraper</title>
	
	<link rel="stylesheet" href="weather-stylesheet.css">
	
	</head>
	
	<body>
	
		<div class="container">
		
			<h1>What Is Today's Forecast?</h1>
			
			<p>Enter the name of the city you would like a forecast for.</p>
		
			<form>
			  <div class="form-group">
					<label for="location"></label>
					<input type="text" class="form-control" id="location" name="location" placeholder="Enter City" value="<?php
					
						if (array_key_exists('location', $_GET)) {
					
						echo $_GET['location'];
						
						}
						
						?>">
			  </div>
			  <button type="submit" class="btn btn-primary">Submit</button>
			</form>
			
			<div id="weather"><?php
			
				if ($weather) {
					
					echo '<div class="alert alert-success" role="alert">
							'.$weather.'
						  </div>';
					
				} else if ($error) {
					
					echo '<div class="alert alert-danger" role="alert">
							'.$error.'
						  </div>';
					
				}
			
			?></div>
		
		</div>

	
	
	


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	
	<script scr="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.7/js/tether.min.js"></script>
	
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	
		<script type="text/javascript">
		
			
		
		</script>
	
	</body>
	
</html>