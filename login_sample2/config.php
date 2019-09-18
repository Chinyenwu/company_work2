<?php

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'eggcat654321');
define('DB_NAME', 'company_work');


 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
 mysqli_query($link,"SET NAMES 'UTF8'");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
//118.163.14.220
?>

