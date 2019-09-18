<?php
// Initialize the session
// Include config file
require_once "../../config.php";
// Define variables and initialize with empty values
$name = $_POST['username2'];
// Processing form data when form is submitted
$sql = "DELETE FROM members WHERE username = '$_POST[username2]'; ";
if ($link->query($sql) === TRUE) {
    //echo "New record change successfully .";
    header("location: permission.php");
    
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}
mysqli_close($link);    
?>

