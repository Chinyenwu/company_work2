<?php
// Initialize the session
session_start();
 header("Cache-control: private");
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Permission/guide</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="manager/list.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: left; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1 style="text-align: center;"> 歡迎, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. 您是這個網站的管理者</h1>
    </div>
    <p style="   position:absolute; top:0; right: 0">
        
        <button onclick="location.href='../logout.php'" class="btn btn-danger">登出</button>
        <button onclick="location.href='../../website-context/back_main.php'" class="btn btn-danger">網站功能</button>
    </p>
<div style="position:absolute;  left:0; top:0;">
        <ul style="float:left;">
            <li style="list-style-type:none;"><button onclick="location.href='../../website-context/font_main.php'" class="btn btn-warning">前台首頁</button></li>
        </ul> 
        
        <ul style="float:left;">
            <li style="list-style-type:none;"><button onclick="location.href='manager.php'" class="btn btn-warning">個人資料修改</button></li>
        </ul> 
        <ul style="float:left;">
            <li style="list-style-type:none;"><button onclick="location.href='../reset-password.php'" class="btn btn-warning">重置密碼</button></li>
        </ul> 
        <ul style="float:left;">
            <li style="list-style-type:none;"  class="member2"><button onclick="location.href='#'" class="btn btn-warning">其他</button></li>
            <li style="list-style-type:none; display:none; " class="member3"><button onclick="location.href='manager/permission.php'" class="btn btn-warning">其他1</button></li>
            <li style="list-style-type:none; display:none; " class="member3"><button onclick="location.href='manager/member_add.php'" class="btn btn-warning">其他2</button></li>
        </ul>
</div>
    <?php
        //$new_password = $confirm_password = $first_name = $last_name = $e_mail =  $staff_number = $contact_phone = $fax = $cellphone = $gender = $contact_address = "";
        $name = $_SESSION["username"];
        //var_dump($name);
        echo "帳號：".$name ."<br>";  
        require_once "../config.php";
        $sql = "SELECT * FROM members where username='$name' ";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
         while($row = $result->fetch_assoc()) {
           //$jsrow=json_encode($row);
           $UserName=$row["username"];
           $Permission=$row["permission"];
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $e_mail = $row["e_mail"];
            $staff_number = $row["staff_number"];
            $contact_phone = $row["contact_phone"];
            $fax = $row["fax"];
            $cellphone = $row["cell_phone"];
            $gender = $row["gender"];
            $birthday = $row["birthday"];
            $contact_address = $row["contact_address"];
            //echo "id: " . $row["id"]. " - Name: " . $row["username"]. " Permission: " . $row["permission"]."<br>";
          }
         }
    ?>

<div class="wrapper">
            <form action="permission_insert_manager.php" method="post" >
               <input  type="hidden" name="username" value="<?php echo $name; ?>"><br>
            <div class="form-group ">
                <label>姓</label>
                <input type="text" name="first_name"  value="<?php echo $first_name; ?>">
            </div>

            <div class="form-group ">
                <label>名</label>
                <input type="text" name="last_name"  value="<?php echo $last_name; ?>">
            </div>

            <div class="form-group ">
                <label>電子信箱 </label>
                <input type="text" name="e_mail"  value="<?php echo $e_mail; ?>">
            </div>

            <div class="form-group ">
                <label>員工編號</label>
                <input type="text" name="staff_number"  value="<?php echo $staff_number; ?>">
            </div>

            <div class="form-group ">
                <label>連絡電話</label>
                <input type="text" name="contact_phone"  value="<?php echo $contact_phone; ?>">
            </div>

            <div class="form-group ">
                <label>傳真</label>
                <input type="text" name="fax"  value="<?php echo $fax; ?>">
            </div>

            <div class="form-group ">
                <label>手機</label>
                <input type="text" name="cellphone"  value="<?php echo $cellphone; ?>">
            </div>

            <div class="form-group ">
                <label>性別</label>
                <input type="radio" name="gender" id="gender_male" <?php if (isset($gender) && $gender=="男性") echo "gender";?> value="男性">男性
                <input type="radio" name="gender" id="gender_female" <?php if (isset($gender) && $gender=="女性") echo "gender";?> value="女性">女性
            </div>

            <div class="form-group ">
                <label>生日</label>
                <input type="date" name="birthday"  value="<?php echo strftime('%Y-%m-%d',strtotime($birthday)); ?>">
            </div>

            <div class="form-group ">
                <label>職務性質</label>
                <input type="radio" name="class" id="teacher" <?php if (isset($class) && $class=="教師") echo "class";?> value="教師">教師
                <input type="radio" name="class" id="staff" <?php if (isset($class) && $class=="行政人員") echo "class";?> value="行政人員">行政人員
            </div>

            <div class="form-group " id="teacher2" style="display:none">
                <label>教師</label>
                <?php
                require_once "../config.php";
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
                    <input type="radio" name="position" value="<?php echo  $position; ?>">"<?php echo $position; ?>"   
             <?php
                }
            }
            
            ?>
            </div>

            <div class="form-group " id="staff2" style="display:none">
                <label>行政人員</label>
                <?php
                require_once "../config.php";
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
                    <input type="radio" name="position" value="<?php echo  $position; ?>">"<?php echo $position; ?>"   
             <?php
                }
            }
            mysqli_close($link);
            ?>
            </div>

            <div class="form-group ">
                <label>地址</label>
                <input type="text" name="contact_address"  value="<?php echo $contact_address; ?>">
            </div>
            <div class="form-group ">
             <label>權限</label>
               <input type="text" name="permission"  value="<?php echo $Permission; ?>">
            </div>
               <br>
               <input class="btn btn-primary" type="submit" class="btn btn-primary" value="Submit">
             </form> 
        </div>

</body>
</html>

