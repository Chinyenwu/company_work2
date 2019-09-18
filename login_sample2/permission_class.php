<?php
// Initialize the session
// Include config file
require_once "config.php";
$username= $_GET['username'];
// Define variables and initialize with empty values
// Processing form data when form is submitted
$sql = "SELECT * FROM members WHERE username = '$username'; ";
$result = $link->query($sql);
if ($result->num_rows > 0) {

	while($row = $result->fetch_assoc()) {
		$permission = $row["permission"];
    	if($permission=="super_manager"){
        	header("location: Permission/super_manager.php");
    	}
    	else{
        	header("location: Permission/manager.php");
    	}		
	}
    //echo "New record change successfully .";
}
else {
    echo "0 results";
	}
mysqli_close($link);
?>

