<?php
// Initialize the session
// Include config file
require_once "../login_sample2/config.php";
// Define variables and initialize with empty values
$id = $_POST["id"];
$class = $_POST["class"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];
$title = $_POST["title"];
$second_title = $_POST["second_title"];
$website = $_POST["website"];
$person = $_POST["person"];
$context = $_POST["context"];
// Processing form data when form is submitted
$sql = "UPDATE imformation SET  class='$class',start_date = '$start_date',end_date = '$end_date',title = '$title',second_title = '$second_title',website = '$website',person = '$person',context = '$context' WHERE id = '$id'; ";
if ($link->query($sql) === TRUE) {
    //echo "New record change successfully .";
    header("location: information_list.php");
} else {
    //echo "<script>alert('失敗');</script>";
    echo "Error: " . $sql . "<br>" . $link->error;
}
mysqli_close($link);
?>
