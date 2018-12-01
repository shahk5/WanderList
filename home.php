
<!------------------------------------------------------------------
WanderList(HOME PAGE)
Travel Website
This website shows the picturs, videos and reviews of the destination searched
Developed by: Kajol Shah, Nina Guarino, Kattie Hilliard
Last Updated: December 1st, 2018
Languages & UI: PHP, SQL, CURL, PYTHON, BOOTSTRAP, HTML, CSS, JAVASCRIPT
APIs Used: Geolocation API, Flickr API, Youtube API, Yelp Fusion API
Developed at Rowan University(2018)
-------------------------------------------------------------------->

<?php
//datbase connection
require 'database.php';

//limit youtube vidoes
define("MAX_RESULTS", 15);

//Main
if ($_POST['address'])
{   

//Redirect URL
$url='http://elvis.rowan.edu/~shahk5/capstone/pictures.php';
echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';

	$address = $_POST['address'];
	$string = str_replace (" ", "+", urlencode($address));
	
	//Get the JSON data from geolocation API
	$geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$string.'&key=AIzaSyD5Dqe3SK3kKOZqKT5Rxk_JZskcoCf4J3g');
	$output=json_decode($geocode, true);
	?><div align="center"><img src="loading.gif"></img></div><?php
	
	//Parse the latitude and longitude from JSON data
	$lat = $output['results'][0]['geometry']['location']['lat'];
    $lon = $output['results'][0]['geometry']['location']['lng'];

	//Get the JSON data from flickr API
    $insta = file_get_contents('https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=eabad3d02e824ce76245158db270c855&lat='.$lat.'&lon='.$lon.'&per_page=20&format=json&nojsoncallback=1');
    $out = json_decode($insta);
	
	//Get the JSON data from youtube API
	$apikey = 'AIzaSyDROWvxxRucoRNPMFotvr602cfc6GDljV4'; 
    $googleApiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . $string . '&maxResults=' . MAX_RESULTS . '&key=' . $apikey;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($response);
    $value = json_decode(json_encode($data), true);
				
		for ($i = 0; $i < MAX_RESULTS; $i++) {
            $videoId = $value['items'][$i]['id']['videoId'];
            $title = $value['items'][$i]['snippet']['title'];
            $description = $value['items'][$i]['snippet']['description'];
			$url = 'http://www.youtube.com/embed/'.$videoId. '';
				
			//SQL INSERT QUERY for youtube data
			$sql = "INSERT INTO videos (video, title, description, searchid) VALUES ('".$url."','".$title."','".$description."',  (select MAX(search_id) from geo))";

			if ($db->query($sql) !== False) {
				#echo "New record created successfully";
			} 
			else {
				echo " ";
				} 
							
		}

	//SQL INSERT QUERY for geolocation data
	$sql = "INSERT INTO geo (latitude, longitude) VALUES ($lat, $lon)";

		if ($db->query($sql) !== False) {
			#echo "New record created successfully";
		} 
		else {
				echo "Record Entry Failed";
			}
		
                                
	$photos = $out->photos->photo;
	foreach($photos as $photo) {
		$id= $photo->id;
		$owner = $photo->owner;
		$secret = $photo->secret;
		$server = $photo->server;
		$farm = $photo->farm;
		$title= $photo->title;
		$url = 'http://farm'.$photo->farm.'.staticflickr.com'.'/'.$photo->server.'/'.$photo->id.'_'.$photo->secret.'_c'.'.jpg';
		
		//SQL INSERT QUERY for flickr data
		$sql = "INSERT INTO flickr (id, owner, secret, server, farm, title, filename, search_id) VALUES ('".$id."', '".$owner."', '".$secret."', '".$server."', '".$farm."', '".$title."', '".$url."', (select MAX(search_id) from geo))";
			if ($db->query($sql) !== false) {
			#echo '';
			} 
			else{
				echo "FAILED";
			}	
		}	
		
	//close database connection	
	$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Website Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  .fakeimg {
	float: left;
    padding: 10px;
	margin: 10px;
    background: #ffffff;
  }
  .fakeimg img {
    opacity: 0.8; 
    cursor: pointer; 
  }

  .fakeimg img:hover {
    opacity: 1;
  }
  .footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 100px;
    color: black;
    text-align: center;
  }
  </style>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:10px; background-color:#10e0e0; height:250px; overflow: auto;" class="clear_fix">
  <h1>WanderList</h1>
  <p>Your go to travel website!</p> 
</div>

<nav class="navbar navbar-inverse" style="background-color:#368cb; overflow: auto;" class="clear_fix">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="http://elvis.rowan.edu/~shahk5/capstone/home.php">Home</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="http://elvis.rowan.edu/~shahk5/capstone/about">About Us</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center" >
  <div><br></br></div><div><br></br></div>
<form action="" method="post">
    <input type="text" style="width:500px; height:45px;" name="address"/>
	<button type="submit" class="btn btn-warning btn-lg">Submit</button>
	</form>
	<div><br></br></div>
      <h3 style="color: #2E86C1;">Search</h3>
      <h3 style="color: #2E86C1;">Your next dream destination.</h3>
</div>

<div align="center">
<a href="https://www.flickr.com/"><img width="75" height="75" src="flickr_logo.png"></img></a>
<a href="https://www.youtube.com/"><img width="75" height="75" src="youtube.jpg"></img></a>
<a href="https://www.yelp.com/"><img width="75" height="75" src="yelp.png"></img></a>
</div>

<div class="footer" style="background-color:#ffc440; overflow: auto;" class="clear_fix">
<h2>WanderList © 2018</h2>
<p>Kajol Shah - Nina Guarino - Katie Hilliard<p>
</div>

</body>
</html>
