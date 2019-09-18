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
    <title>Permission/manager</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="list.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: left; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1 style="text-align: center;">  <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>這裡是職稱列表</h1>
    </div>
    <p style="position:absolute; top:0; right:0;">
        <button onclick="location.href='../../logout.php'" class="btn btn-danger">登出</button>
        <button onclick="location.href='../../../website-context/back_main.php'" class="btn btn-danger">網站功能</button>
        <button onclick="location.href='../super_manager.php'" class="btn btn-danger">會員管理</button>
    </p>
<div style="position:absolute;  left:0; top:0;">
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
            <div class="form-group ">
                <label>職務性質</label>
                <input type="radio" name="class" id="teacher"  value="教師">教師
                <input type="radio" name="class" id="staff" value="行政人員">行政人員
                <input type="radio" name="class" id="all" value="全部">全部
            </div>
    
<div id="teacher2">
    <p >        
    <?php
    require_once "../../config.php";
    $sql = "SELECT * FROM position WHERE class='教師'";
    $result = $link->query($sql);
    

    if ($result->num_rows > 0) {
        // output data of each row
         while($row = $result->fetch_assoc()) {
           $jsrow=json_encode($row);
           $position=$row["position"];
           $class=$row["class"];
           $id=$row["id"]; 
           //echo $jsrow;   
             //echo " 職稱: " . $row["position"]. " 職務性質: " . $row["class"];
             ?>
            <form  action="position_change.php" method="post" style="display: inline;">
                <label>職稱:</label>
                <input type="text" name="first_name" disabled="disabled" class="position" value="<?php echo $position; ?>">
                <label>職務性質:</label>
                <input type="text" name="last_name" disabled="disabled" class="class" value="<?php echo $class; ?>">
                <input class="btn btn-primary" type="submit" name="action1" class="position_submit" value="編輯"/>
                <input type="hidden" name="id" value="<?php echo $id; ?>"/> 
            </form>         
             <form action="position_delete.php" method="post" style="display: inline;">
                <input type="hidden" name="id" value="<?php echo $id; ?>"/> 
                <input class="btn btn-danger" type="submit" name="delete" value="刪除"/>
             </form> 
             <br/>
            <?php
         }
    }
   ?>
  </p>
  </div>
  <div id="staff2" >
    <p >        
    <?php
    require_once "../../config.php";
    $sql = "SELECT * FROM position WHERE class='行政人員'";
    $result = $link->query($sql);
    

    if ($result->num_rows > 0) {
        // output data of each row
         while($row = $result->fetch_assoc()) {
           $jsrow=json_encode($row);
           $position=$row["position"];
           $class=$row["class"];
           $id=$row["id"]; 
           //echo $jsrow;   
             //echo " 職稱: " . $row["position"]. " 職務性質: " . $row["class"];
             ?>
            <form  action="position_change.php" method="post" style="display: inline;">
                <label>職稱:</label>
                <input type="text" name="first_name" disabled="disabled" class="position" value="<?php echo $position; ?>">
                <label>職務性質:</label>
                <input type="text" name="last_name" disabled="disabled" class="class" value="<?php echo $class; ?>">
                <input class="btn btn-primary" type="submit" name="action1" class="position_submit" value="編輯"/>
                <input type="hidden" name="id" value="<?php echo $id; ?>"/> 
            </form>         
             <form action="position_delete.php" method="post" style="display: inline;">
                <input type="hidden" name="id" value="<?php echo $id; ?>"/> 
                <input class="btn btn-danger" type="submit" name="delete" value="刪除"/>
             </form> 
             <br/>
            <?php
         }
    }
    mysqli_close($link);
   ?>
  </p>
  </div>

</body>
</html>
