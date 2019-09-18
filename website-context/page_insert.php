<?php
// Initialize the session
// Include config file
require_once "../login_sample2/config.php";
// Define variables and initialize with empty values
$id = $_POST["id"];
$class = $_POST["class"];
$editer = $_POST["editer"];
$title = $_POST["title"];
$content = $_POST["content"];
$editer_time = $_POST["editer_time"];
// Processing form data when form is submitted
$sql = "UPDATE page SET  class='$class' ,title = '$title',editer = '$editer',content = '$content',editer_time = '$editer_time' WHERE id = '$id'; ";
if ($link->query($sql) === TRUE) {
    //echo "New record change successfully .";
    header("location: page_list.php");
} else {
    //echo "<script>alert('失敗');</script>";
    echo "Error: " . $sql . "<br>" . $link->error;
}
mysqli_close($link);
?>
