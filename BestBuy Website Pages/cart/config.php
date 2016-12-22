<?php
$currency = '&#x24; '; //Currency Character or code

$db_username = 'zz';
$db_password = '1';
$db_name = 'grocery_website';
$db_host = 'localhost';

$shipping_cost      = 1.50; //shipping cost
                     
//connect to MySql                      
$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);                        
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
?>