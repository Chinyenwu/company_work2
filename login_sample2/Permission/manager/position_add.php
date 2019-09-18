<?php
// Include config file
require_once "../../config.php";
$position = $class = "";
// Define variables and initialize with empty values
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    // Check input errors before inserting in database     
        // Prepare an insert statement

        $sql = "INSERT INTO position (position, class) VALUES (?,?)";        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $position, $class);       
            // Set parameters
            $position = $_POST["position"];
            $class = $_POST["class"];
            // Creates a password hash
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo "<script>alert('新增成功'); location.href = 'position_add.php';</script>";
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
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="list.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: left; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>

 <div style="position:absolute;  top:0; left:0; ">
        <ul style="float:left;">
            <li style="list-style-type:none;"><button onclick="location.href='../../../website-context/font_main.php'" class="btn btn-warning">前台首頁</button></li>
        </ul>
        <ul style="float:left;">
            <li style="list-style-type:none;"><button onclick="location.href='../super_manager.php'" class="btn btn-warning">個人資料修改</button></li>
        </ul>
        <ul style="float:left;">
            <li style="list-style-type:none;"><button onclick="location.href='../../reset-password.php'" class="btn btn-warning">更改密碼</button></li>
        </ul> 
        <ul style="float:left;">
            <li style="list-style-type:none;"  class="member"><button onclick="location.href='#'" class="btn btn-warning"> 會員</button></li>
            <li style="list-style-type:none; display:none; " class="memberl"><button onclick="location.href='permission.php'" class="btn btn-warning">列表</button></li>
            <li style="list-style-type:none; display:none; " class="memberl"><button onclick="location.href='member_add.php'" class="btn btn-warning">新增使用者</button></li>
            <li style="list-style-type:none; display:none; " class="memberl"><button onclick="location.href='position_list.php'" class="btn btn-warning">職稱調整</button></li>
            <li style="list-style-type:none; display:none; " class="memberl"><button onclick="location.href='position_add.php'" class="btn btn-warning">新增職稱</button></li>
        </ul>
        <ul style="float:left;">
            <li style="list-style-type:none;"  class="member2"><button onclick="location.href='#'" class="btn btn-warning">其他</button></li>
            <li style="list-style-type:none; display:none; " class="member3"><button onclick="location.href='permission.php'" class="btn btn-warning">其他1</button></li>
            <li style="list-style-type:none; display:none; " class="member3"><button onclick="location.href='member_add.php'" class="btn btn-warning">其他2</button></li>
        </ul>
</div>   
    <p style="position:absolute; top:0; right:0;">
        <button onclick="location.href='../../logout.php'" class="btn btn-danger">登出</button>
        <button onclick="location.href='../../../website-context/back_main.php'" class="btn btn-danger">網站功能</button>
        <button onclick="location.href='../super_manager.php'" class="btn btn-danger">會員管理</button>
    </p>
    <div align="center">
    <div class="wrapper">       
        <h2>新增職稱</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group ">
                <label>職位</label>
                <input type="text" name="position" class="form-control" value="<?php echo $position; ?>">
            </div>    

            <div class="form-group ">
                <label>職務性質</label>
                <input type="radio" name="class" <?php if (isset($gender) && $gender=="教師") echo "class";?> value="教師">教師
                <input type="radio" name="class" <?php if (isset($gender) && $gender=="行政人員") echo "class";?> value="行政人員">行政人員
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>

        </form>
    </div>    
</div>
</body>
</html>