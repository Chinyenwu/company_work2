<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE members SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="Permission/manager/list.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
 <div style="position:absolute;  top:0; left:0; ">
        <ul style="float:left;">
            <li style="list-style-type:none;"><button onclick="location.href='../website-context/font_main.php'" class="btn btn-warning">前台首頁</button></li>
        </ul>
        <ul style="float:left;">
            <li style="list-style-type:none;"><button onclick="location.href='Permission/super_manager.php'" class="btn btn-warning">個人資料修改</button></li>
        </ul>
        <ul style="float:left;">
            <li style="list-style-type:none;"><button onclick="location.href='reset-password.php'" class="btn btn-warning">更改密碼</button></li>
        </ul> 
        <ul style="float:left;">
            <li style="list-style-type:none;"  class="member"><button onclick="location.href='#" class="btn btn-warning"> 會員</button></li>
            <li style="list-style-type:none; display:none; " class="memberl"><button onclick="location.href='Permission/manager/permission.php'" class="btn btn-warning">列表</button></li>
            <li style="list-style-type:none; display:none; " class="memberl"><button onclick="location.href='Permission/manager/member_add.php'" class="btn btn-warning">新增使用者</button></li>
            <li style="list-style-type:none; display:none; " class="memberl"><button onclick="location.href='Permission/manager/position_list.php'" class="btn btn-warning">職稱調整</button></li>
            <li style="list-style-type:none; display:none; " class="memberl"><button onclick="location.href='Permission/manager/position_add.php'" class="btn btn-warning">新增職稱</button></li>
        </ul>
        <ul style="float:left;">
            <li style="list-style-type:none;"  class="member2"><button onclick="location.href='#'" class="btn btn-warning">其他</button></li>
            <li style="list-style-type:none; display:none; " class="member3"><button onclick="location.href='manager/permission.php'" class="btn btn-warning">其他1</button></li>
            <li style="list-style-type:none; display:none; " class="member3"><button onclick="location.href='manager/member_add.php'" class="btn btn-warning">其他2</button></li>
        </ul>
</div>  
    <p style="position:absolute; top:0; right:0;">
        <button onclick="location.href='logout.php'" class="btn btn-danger">登出</button>
        <button onclick="location.href='../website-context/back_main.php'" class="btn btn-danger">網站功能</button>
        <button onclick="location.href='manager/super_manager.php'" class="btn btn-danger">會員管理</button>

    </p>
    <div class="wrapper">
        <h2>改變密碼</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>新密碼</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>確認密碼</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <button class="btn btn-link" onclick="location.href='Permission/guest.php'">Cancel</button>
            </div>
        </form>
    </div>    
</body>
</html>