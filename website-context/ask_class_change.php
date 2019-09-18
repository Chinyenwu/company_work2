<?php
// Initialize the session
// Include config file
require_once "../login_sample2/config.php";
 
$id = $_POST['id'];
$class=$_POST["class"];

// Processing form data when form is submitted
$sql = "UPDATE ask_class SET class = '$class' WHERE id = '$id'; ";
   
if ($link->query($sql) === TRUE) {
    //echo "New record change successfully .";
    header("location: ask_class.php");
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

mysqli_close($link);

?>

