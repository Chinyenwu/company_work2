<?php
// Initialize the session
// Include config file
require_once "../login_sample2/config.php";

// Define variables and initialize with empty values
$name = $_POST['id'];
// Processing form data when form is submitted
$sql = "DELETE FROM imformation_class WHERE id = '$_POST[id]'; ";
if ($link->query($sql) === TRUE) {
    //echo "New record change successfully .";
    echo "<script>alert('確定刪除?');</script>";
    header("location: information_class.php");
    
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}
mysqli_close($link);    
?>

