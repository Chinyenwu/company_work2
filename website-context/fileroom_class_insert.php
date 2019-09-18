<?php
// Include config file
require_once "../login_sample2/config.php";
$class = "";
$class_id = "";
// Define variables and initialize with empty values
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    // Check input errors before inserting in database     
        // Prepare an insert statement
        $sql = "INSERT INTO file_class (class,class_id) VALUES (?,?)";        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $class,$class_id);       
            // Set parameters
            $class = $_POST["class"];
            $class_id = $_POST["class_id"];
            $file_path = 'uploads/'.$class_id;
            // Creates a password hash
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
               if(!file_exists($file_path)){
                    mkdir($file_path,0777,true);
                }else{
                    echo '資料夾已存在';
                }
                echo "<script> location.href = 'fileroom_class.php';</script>";
                
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