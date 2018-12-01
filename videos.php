
<!------------------------------------------------------------------
WanderList(YOUTUBE VIDEOS)
Travel Website
This website shows the picturs, videos and reviews of the destination searched
Developed by: Kajol Shah, Nina Guarino, Kattie Hilliard
Last Updated: December 1st, 2018
Languages & UI: PHP, SQL, CURL, PYTHON, BOOTSTRAP, HTML, CSS, JAVASCRIPT
APIs Used: Geolocation API, Flickr API, Youtube API, Yelp Fusion API
Developed at Rowan University(2018)
-------------------------------------------------------------------->

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

<div class="container" style="width:1500px;">
  <div class="row">
    <div class="col-sm-4">
	<form action="home.php" method="post">
    <input type="text" style="width:300px; height:45px; padding:10px; margin:10px;" name="address"/>
	<button type="submit" class="btn btn-warning btn-lg">Submit</button>
	</form>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="http://elvis.rowan.edu/~shahk5/capstone/pictures.php">Flickr Pictures <img width="35" height="35" src="flickr_logo.png"></img></a></li>
        <li><a href="http://elvis.rowan.edu/~shahk5/capstone/videos.php">Youtube Videos <img width="35" height="35" src="youtube.jpg"></img></a></li>
        <li><a href="http://elvis.rowan.edu/~shahk5/capstone/yelp.php">Yelp Reviews <img width="35" height="35" src="yelp.png"></img></a></li>
      </ul>
      <hr class="hidden-sm hidden-md hidden-lg">
    </div>
	
<div class="col-sm-8">

<?php
$servername = "localhost";
$username = "shahk5";
$password = "warmmuffins";
$dbname = "shahk5";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//SQL QUERY to get latitude and longitude values from database
$sql = "SELECT search_id, latitude, longitude FROM geo order by search_id Desc limit 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #echo "Latitude: " . $row["latitude"]. " Longitude: " . $row["longitude"]. "<br>";
    }
} else {
    echo "0 results";
}

//SQL QUERY to get youtube videos from database
$sql = "select  video, title, description
from videos tt
INNER JOIN (select MAX(searchid) as MaxScore from videos) tt2
ON tt.searchid = tt2.MaxScore";
$result = $conn->query($sql); ?>


<?php
//Display vidoes
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	
    $width = '800px';
    $height = '450px';
?>
<iframe id="ytplayer" type="text/html" width="<?php echo $width ?>" height="<?php echo $height ?>" style="padding:10px; margin:10px;"
    src="<?php echo $row['video']; ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
    frameborder="0" allowfullscreen><div><font size="20"></iframe> 

  <?php
    } ?><div class="row">
	</div>
</div><?php 
	
} else {
    echo "0 results";
}

//Close database connection
$conn->close();
?>

</body>
</html>