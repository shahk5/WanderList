
<!------------------------------------------------------------------
WanderList(ABOUT PAGE)
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
  <p>App Version: 1.0.0</p>
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

<div class="jumbotron text-center">
<h2>WanderList is a Travel website where you can Lookup your dream destination.</h2>
	  <p>WanderList lets you navigate through some amazing pictures, videos and reviews about your favourite destination and helps you plan your next vacation.</p>
	  <div><br></br></div>
<div align="center">
<a href="https://console.cloud.google.com/marketplace/details/google/geolocation.googleapis.com?filter=category:maps&id=b87d2884-ba68-47f9-aaf0-b29ae1919bb7&pli=1"><img width="75" height="75" src="geolocation.png"></img></a>
<a href="https://www.flickr.com/services/api/"><img width="75" height="75" src="flickr_logo.png"></img></a>
<a href="https://developers.google.com/youtube/v3/"><img width="75" height="75" src="youtube.jpg"></img></a>
<a href="https://www.yelp.com/fusion"><img width="75" height="75" src="yelp.png"></img></a>
</div>
	  <p>This Website is a part of Final Project for Capstone, developed at Rowan University</p>
	  <h2>Developers</h2>
	  <p>Kajol Shah - Nina Guarino - Katie Hilliard</p>
</div>

<div class="footer" style="background-color:#ffc440; overflow: auto;" class="clear_fix">
<h2>WanderList © 2018</h2>
<p>Kajol Shah - Nina Guarino - Katie Hilliard<p>
</div>

</body>
</html>