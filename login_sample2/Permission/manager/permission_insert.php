<?php
// Initialize the session
// Include config file
require_once "../../config.php";
 
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
$class = $_POST["class"];
$position = $_POST["position"];

// Processing form data when form is submitted
$sql = "UPDATE members SET  permission='$permission' ,first_name = '$first_name',last_name = '$last_name',e_mail = '$e_mail',staff_number = '$staff_number',contact_phone = '$contact_phone',fax = '$fax',cell_phone = '$cellphone',gender = '$gender',contact_address = '$contact_address',class='$class' ,position = 'position',birthday = 'birthday' WHERE username = '$_POST[username]'; ";
   

if ($link->query($sql) === TRUE) {
    //echo "New record change successfully .";
    header("location: permission.php");
    
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

mysqli_close($link);
/*
        $sql = "UPDATE members SET  permission=? ,first_name = ?,last_name = ?,e_mail = ?,staff_number = ?,contact_phone = ?,fax = ?,cellphone = ?,gender = ?,contact_address = ? WHERE username = ? ";
        
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssss",$permission, $first_name,$last_name,$e_mail,$staff_number,$contact_phone,$fax,$cellphone,$gender,$contact_address,$name);
            
            // Set parameters
            //$param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $e_mail = $_POST["e_mail"];
            $staff_number = $_POST["staff_number"];
            $contact_phone = $_POST["contact_phone"];
            $fax = $_POST["fax"];
            $cellphone = $_POST["cellphone"];
            $gender = $_POST["gender"];
            //$birthday = $_POST["birthday"];
            $contact_address = $_POST["contact_address"];
            $permission=$_POST["permission"];
            $name = $_POST['username'];
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                //session_destroy();
                header("location: permission.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";

            }
        }
        var_dump($stmt);
        mysqli_stmt_close($stmt);     
        // Close statement
*/    
?>

