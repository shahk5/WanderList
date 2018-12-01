
<!------------------------------------------------------------------
WanderList(Database connection file)
Travel Website
This website shows the picturs, videos and reviews of the destination searched
Developed by: Kajol Shah, Nina Guarino, Kattie Hilliard
Last Updated: December 1st, 2018
Languages & UI: PHP, SQL, CURL, PYTHON, BOOTSTRAP, HTML, CSS, JAVASCRIPT
APIs Used: Geolocation API, Flickr API, Youtube API, Yelp Fusion API
Developed at Rowan University(2018)
-------------------------------------------------------------------->

<?php
    $dsn = 'mysql:host=localhost; dbname=shahk5';
    $username = 'shahk5';
    $password = 'warmmuffins';
    
    try{
        $db = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include('database_error.php');
            exit();
        }

?>
