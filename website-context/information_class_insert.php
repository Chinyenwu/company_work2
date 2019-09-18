<?php
// Include config file
require_once "../login_sample2/config.php";
$class = "";
// Define variables and initialize with empty values
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    // Check input errors before inserting in database     
        // Prepare an insert statement

        $sql = "INSERT INTO imformation_class (class) VALUES (?)";        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $class);       
            // Set parameters
            $class = $_POST["class"];
            // Creates a password hash
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo "<script> location.href = 'information_class.php';</script>";
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }       
        // Close statement
        mysqli_stmt_close($stmt);  
    // Close connection
    mysqli_close($link);
}
?>