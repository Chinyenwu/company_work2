<?php
// Initialize the session
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

$name = $_POST['username'];
$permission=$_POST["permission"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$e_mail = $_POST["e_mail"];
$staff_number = $_POST["staff_number"];
$contact_phone = $_POST["contact_phone"];
$fax = $_POST["fax"];
$cellphone = $_POST["cellphone"];
$gender = $_POST["gender"];
$birthday = $_POST["birthday"];
$contact_address = $_POST["contact_address"];

// Processing form data when form is submitted
$sql = "UPDATE members SET  permission='$permission' ,first_name = '$first_name',last_name = '$last_name',e_mail = '$e_mail',staff_number = '$staff_number',contact_phone = '$contact_phone',fax = '$fax',cell_phone = '$cellphone',gender = '$gender',contact_address = '$contact_address',birthday = '$birthday' WHERE username = '$_POST[username]'; ";
   

if ($link->query($sql) === TRUE) {
    //echo "New record change successfully .";
    if($permission=="super_manager"){
        header("location: super_manager.php");
    }
    else{
        header("location: manager.php");
    }
    
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

mysqli_close($link);
?>

