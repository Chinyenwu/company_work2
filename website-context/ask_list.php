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
        <h1 style="text-align: center;"> 歡迎, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>這裡是問與答列表</h1>
    </div>
    <p style="position:absolute; top:0; right:0;">
        <button onclick="location.href='../login_sample2/logout.php'" class="btn btn-danger">登出</button>
        <button onclick="location.href='back_main.php'" class="btn btn-danger">網站功能</button>
        <button onclick="location.href='../login_sample2/permission_class.php?username=<?php echo htmlspecialchars($_SESSION["username"]); ?>'" class="btn btn-danger">會員管理</button>

    </p>

<div style="position:absolute;  left:0; top:0">
        <ul style="float:left">
            <li style="list-style-type:none;" ><button onclick="location.href='font_main.php'" class="btn btn-warning">前台首頁</button></li>
        </ul>       
        <ul style="float:left">
            <li style="list-style-type:none;" class="member"><button onclick="location.href='#'" class="btn btn-warning">公告</button></li>
            <li style="list-style-type:none; display:none; " class="memberl"><button onclick="location.href='information_list.php'" class="btn btn-warning">列表</button></li>
            <li style="list-style-type:none; display:none; " class="memberl"><button onclick="location.href='information_add.php'" class="btn btn-warning">新增</button></li>
            <li style="list-style-type:none; display:none; " class="memberl"><button onclick="location.href='information_class.php'" class="btn btn-warning">類別</button></li>
        </ul>

        <ul style="float:left">
            <li style="list-style-type:none;" class="member2"><button onclick="location.href='#'" class="btn btn-warning">檔案室</button></li>
            <li style="list-style-type:none; display:none; " class="member3"><button onclick="location.href='fileroom_list.php'" class="btn btn-warning">列表</button></li>
            <li style="list-style-type:none; display:none; " class="member3"><button onclick="location.href='fileroom_add.php'" class="btn btn-warning">新增</button></li>
            <li style="list-style-type:none; display:none; " class="member3"><button onclick="location.href='fileroom_class.php'" class="btn btn-warning">類別</button></li>
        </ul>

        <ul style="float:left">
            <li style="list-style-type:none;" class="member4"><button onclick="location.href='#'" class="btn btn-warning">問與答</button></li>
            <li style="list-style-type:none; display:none; " class="member5"><button onclick="location.href='ask_list.php'" class="btn btn-warning">列表</button></li>
            <li style="list-style-type:none; display:none; " class="member5"><button onclick="location.href='ask_add.php'" class="btn btn-warning">新增</button></li>
            <li style="list-style-type:none; display:none; " class="member5"><button onclick="location.href='ask_class.php'" class="btn btn-warning">類別</button></li>          
        </ul>

        <ul style="float:left">
            <li style="list-style-type:none;" class="member6"><button onclick="location.href='#'" class="btn btn-warning">頁面</button></li>
            <li style="list-style-type:none; display:none; " class="member7"><button onclick="location.href='ask_list.php'" class="btn btn-warning">列表</button></li>
            <li style="list-style-type:none; display:none; " class="member7"><button onclick="location.href='ask_add.php'" class="btn btn-warning">新增</button></li>
            <li style="list-style-type:none; display:none; " class="member7"><button onclick="location.href='ask_class.php'" class="btn btn-warning">類別</button></li>
        </ul>

</div>
    <p>        
    <?php
    require_once "../login_sample2/config.php";
    $sql = "SELECT * FROM ask ";
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
           $class=$row["class"];
           $asker=$row["asker"];
           $context=$row["context"];
           $time = $row["time"];
           $id=$row["id"];
             ?>
             <form action="ask_answer.php" method="post" style="display: inline;">
                <label>類別:</label>
                <input type="text" name="class"  disabled="disabled" value="<?php echo $class; ?>">
                <label>提問者:</label>
                <input type="text" name="asker"  disabled="disabled" value="<?php echo $asker; ?>">
                <label>問題:</label>
                <input type="text" name="context"  disabled="disabled" value="<?php echo $context; ?>">
                <label>日期時間:</label>
                <input type="date" name="time"  disabled="disabled" value="<?php echo $time; ?>">
                <input class="btn btn-primary" type="submit" name="action1" value="回答"/>
                <input type="hidden" name="id" value="<?php echo $id; ?>"/> 
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

<!--<li style="list-style-type:none; display:none; " class="member5"><button onclick="location.onclick="location.href='ask_class.php'" type="button" class="btn btn-warning">類別</button></li>--> 


