<?php
// Initialize the session
// Include config file
require_once "../../config.php";
// Define variables and initialize with empty values
$name = $_POST['id'];
// Processing form data when form is submitted
$sql = "DELETE FROM position WHERE id = '$_POST[id]'; ";
if ($link->query($sql) === TRUE) {
    //echo "New record change successfully .";
    header("location: position_list.php");
    
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}
mysqli_close($link);    
?>

