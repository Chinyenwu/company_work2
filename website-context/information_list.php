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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="list2.js"></script>
<body>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: left; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1 style="text-align: center;">歡迎, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>這裡是網站功能-公告列表</h1>
    </div>
    <p style="position:absolute; top:0; right:0;">
        <button onclick="location.href='../login_sample2/logout.php'" type="button" class="btn btn-danger">登出</button>
        <button onclick="location.href='back_main.php'" type="button" class="btn btn-danger">網站功能</button>
        <button onclick="location.href='../login_sample2/permission_class.php?username=<?php echo htmlspecialchars($_SESSION["username"]); ?>'" type="button" class="btn btn-danger">會員管理</button>
    </p>

<div style="position:absolute;  left:0; top:0">
        <ul style="float:left">
            <li style="list-style-type:none;" ><butto button onclick="location.href='font_main.php'" type="button" class="btn btn-warning">前台首頁</button></li>
        </ul>       
        <ul style="float:left">
            <li style="list-style-type:none;" class="member"><button onclick="location.butto href='#'" type="button" class="btn btn-warning">公告</a></li>
            <li style="list-style-type:none; display:none; " class="memberl"><button onclick="location.href='information_list.php'" type="button" class="btn btn-warning">列表</button></li>
            <li style="list-style-type:none; display:none; " class="memberl"><button onclick="location.href='information_add.php'" type="button" class="btn btn-warning">新增</button></li>
            <li style="list-style-type:none; display:none; " class="memberl"><button onclick="location.href='information_class.php'" type="button" class="btn btn-warning">類別</button></li>
        </ul>

        <ul style="float:left">
            <li style="list-style-type:none;" class="member2"><butto href="#" class="btn btn-warning">檔案室</button></li>
            <li style="list-style-type:none; display:none; " class="member3"><button onclick="location.href='fileroom_list.php'" type="button" class="btn btn-warning">列表</button></li>
            <li style="list-style-type:none; display:none; " class="member3"><button onclick="location.href='fileroom_add.php'" type="button" class="btn btn-warning">新增</button></li>
            <li style="list-style-type:none; display:none; " class="member3"><button onclick="location.href='fileroom_class.php'" type="button" class="btn btn-warning">類別</button></li>
        </ul>

        <ul style="float:left">
            <li style="list-style-type:none;" class="member4"><butto href="#" class="btn btn-warning">問與答</a></li>
            <li style="list-style-type:none; display:none; " class="member5"><button onclick="location.href='ask_list.php'" type="button" class="btn btn-warning">列表</button></li>
            <li style="list-style-type:none; display:none; " class="member5"><button onclick="location.href='ask_add.php'" type="button" class="btn btn-warning">新增</button></li>
            <li style="list-style-type:none; display:none; " class="member5"><button onclick="location.href='ask_class.php'" type="button" type="button" class="btn btn-warning">類別</button></li>
        </ul>

        <ul style="float:left">
            <li style="list-style-type:none;" class="member6"><butto href="#" class="btn btn-warning">頁面</a></li>
            <li style="list-style-type:none; display:none; " class="member7"><button onclick="location.href='page_list.php'" type="button" class="btn btn-warning">列表</button></li>
            <li style="list-style-type:none; display:none; " class="member7"><button onclick="location.href='page_add.php'" type="button" class="btn btn-warning">新增</button></li>
            <li style="list-style-type:none; display:none; " class="member7"><button onclick="location.href='page_class.php'" type="button" class="btn btn-warning">類別</button></li>
        </ul>

</div>
    <p>        
    <?php
    require_once "../login_sample2/config.php";
    $sql = "SELECT * FROM imformation ";
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
         while($row = $result->fetch_assoc()) {
           $jsrow=json_encode($row);
           $class=$row["class"];
           $start_date=$row["start_date"];
           $end_date=$row["end_date"];
           $title=$row["title"];
           $person=$row["person"];
           $id=$row["id"];
             ?>
             <form action="information_change.php" method="post" style="display: inline;">
                <label>類別:</label>
                <input type="text" name="class"  disabled="disabled" value="<?php echo $class; ?>">
                <label>開始日期:</label>
                <input type="text" name="start_date"  disabled="disabled" value="<?php echo $start_date; ?>">
                <label>結束日期:</label>
                <input type="text" name="end_date"  disabled="disabled" value="<?php echo $end_date; ?>">
                <label>標題:</label>
                <input type="text" name="title"  disabled="disabled" value="<?php echo $title; ?>">
                <label>編輯人:</label>
                <input type="text" name="person"  disabled="disabled" value="<?php echo $person; ?>">
                <input class="btn btn-primary" type="submit" name="action1" value="編輯"/>
                <input type="hidden" name="id" value="<?php echo $id; ?>"/> 
             </form> 
             <form action="information_delete.php" method="post" style="display: inline;">
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
</body>
</html>
<!--<li style="list-style-type:none; display:none; " class="member5"><button onclick="location.href='ask_class.php'" type="button" class="btn btn-warning">類別</button></li>--> 


