<?php
// Initialize the session
// Include config file
require_once "../../config.php";
 
$id = $_POST['id'];
$class=$_POST["class"];
$position = $_POST["position"];

// Processing form data when form is submitted
$sql = "UPDATE position SET  position='$position' ,class = '$class' WHERE id = '$_POST[id]'; ";
   
if ($link->query($sql) === TRUE) {
    //echo "New record change successfully .";
    header("location: position_list.php");
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

mysqli_close($link);

?>

