<?php
// Include config file
require_once "../../config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $first_name = $last_name = $e_mail = $staff_number = $contact_phone = $fax = $cellphone = $gender = $birthday = $contact_address = $class = "";
$username_err = $password_err = $confirm_password_err = $staff_number_err="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "請輸入帳號";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM members WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt)!=null){
                    $username_err = "已經有這個帳號了";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "請輸入密碼";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "密碼至少要6個字";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "請輸入確認密碼";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "密碼不一致";
        }
    }
    
    
    if(empty(trim($_POST["staff_number"]))){
        $staff_number_err = "請輸入員工編號";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM members WHERE staff_number = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            //var_dump($stmt);
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_staff_number);
            
            // Set parameters
            $param_staff_number = trim($_POST["staff_number"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt)!=null){
                    $staff_number_err = "已經有這個員工編號了";
                } else{
                    $staff_number = trim($_POST["staff_number"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }


    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($staff_number_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO members (username, password ,first_name,last_name,e_mail,staff_number,contact_phone,fax,cell_phone,gender,contact_address,class,position,birthday) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssssss", $param_username, $param_password,$first_name,$last_name,$e_mail,$staff_number,$contact_phone,$fax,$cellphone,$gender,$contact_address,$class,$position,$birthday);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
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
            $class = $_POST["class"];
            $position = $_POST["position"];
            $birthday = $_POST["birthday"];
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo "<script>alert('新增成功'); location.href = 'member_add.php';</script>";
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection

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
        body{ font: 14px sans-serif; }
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
            <li style="list-style-type:none;"  class="member"><button onclick="location.href='#" class="btn btn-warning"> 會員</button></li>
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
    <div align="center" >
    <div class="wrapper">       
        <h2>新增成員</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>帳號</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>密碼</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>確認密碼</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="form-group ">
                <label>姓</label>
                <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
            </div>

            <div class="form-group ">
                <label>名</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
            </div>

            <div class="form-group ">
                <label>電子信箱 </label>
                <input type="text" name="e_mail" class="form-control" value="<?php echo $e_mail; ?>">
            </div>

            <div class="form-group <?php echo (!empty($staff_number_err)) ? 'has-error' : ''; ?>">
                <label>員工編號</label>
                <input type="text" name="staff_number" class="form-control" value="<?php echo $staff_number; ?>">
                <span class="help-block"><?php echo $staff_number_err; ?></span>
            </div> 

            <div class="form-group ">
                <label>連絡電話</label>
                <input type="text" name="contact_phone" class="form-control" value="<?php echo $contact_phone; ?>">
            </div>

            <div class="form-group ">
                <label>傳真</label>
                <input type="text" name="fax" class="form-control" value="<?php echo $fax; ?>">
            </div>

            <div class="form-group ">
                <label>手機</label>
                <input type="text" name="cellphone" class="form-control" value="<?php echo $cellphone; ?>">
            </div>

            <div class="form-group ">
                <label>性別</label>
                <input type="radio" name="gender" <?php if (isset($gender) && $gender=="男性") echo "gender";?> value="男性">男性
                <input type="radio" name="gender" <?php if (isset($gender) && $gender=="女性") echo "gender";?> value="女性">女性
            </div>
            <!--
            <div class="form-group ">
                <label>性別</label>
                <input type="text" name="gender" class="form-control" value="<?php //echo $gender; ?>">
            </div>
            -->
            <!--<div class="form-group ">
                <label>生日</label>
                <input type="text" name="birthday" class="form-control" value="<?php //echo $birthday; ?>">
            </div>-->

            <div class="form-group ">
                <label>生日</label>
                <input type="date" name="birthday" class="form-control" value="<?php if($birthday==null){echo "1990-01-01";}else{echo $birthday;} ?>">
            </div>

            <div class="form-group ">
                <label>地址</label>
                <input type="text" name="contact_address" class="form-control" value="<?php echo $contact_address; ?>">
            </div>

            <div class="form-group ">
                <label>職務性質</label>
                <input type="radio" name="class" id="teacher" <?php if (isset($class) && $class=="教師") echo "class";?> value="教師">教師
                <input type="radio" name="class" id="staff" <?php if (isset($class) && $class=="行政人員") echo "class";?> value="行政人員">行政人員
            </div>

            <div class="form-group " id="teacher2" style="display:none">
                <label>教師</label>
                <?php
                require_once "../../config.php";
                $sql = "SELECT * FROM position WHERE class='教師' ";
                $result = $link->query($sql);
    

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                    $jsrow=json_encode($row);
                    $class=$row["class"];
                    $position=$row["position"];
                    //echo $jsrow;   
                    //echo " 帳號: " . $row["username"]. " 權限: " . $row["permission"];
                    ?>
                    <input type="radio" name="position" value="<?php echo  $position; ?>"><?php echo $position; ?>   
             <?php
                }
            }
            
            ?>
            </div>

            <div class="form-group " id="staff2" style="display:none">
                <label>行政人員</label>
                <?php
                require_once "../../config.php";
                $sql = "SELECT * FROM position WHERE class='行政人員' ";
                $result = $link->query($sql);
    

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                    $jsrow=json_encode($row);
                    $class=$row["class"];
                    $position=$row["position"];
                    //echo $jsrow;   
                    //echo " 帳號: " . $row["username"]. " 權限: " . $row["permission"];
                    ?>
                    <input type="radio" name="position" value="<?php echo  $position; ?>"><?php echo $position; ?>   
             <?php
                }
            }
            mysqli_close($link);
            ?>
            </div>


            <div id="teacher2"></div>
            <div id="class"></div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>

            <!--<p>Already have an account? <button onclick="location.href='login.php">Login here</button>.</p>!-->
        </form>
    </div>    
</div>
</body>
</html>
<!--<button onclick="location.onclick="location.href='ask_class.php'" type="button" class="btn btn-warning">類別</button>-->
