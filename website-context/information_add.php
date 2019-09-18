<?php
// Initialize the session
session_start();
header("Cache-control: private");

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "../login_sample2/config.php";
 
// Define variables and initialize with empty values
$class = $start_date = $end_date = $title = $second_title = $website = $person = $context = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        $sql = "INSERT INTO imformation (class, start_date ,end_date,title,second_title,website,person,context) VALUES (?,?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss", $class, $start_date,$end_date,$title,$second_title,$website,$person,$context);     
            $class = $_POST["class"];
            $start_date = $_POST["start_date"];
            $end_date = $_POST["end_date"];
            $title = $_POST["title"];
            $second_title = $_POST["second_title"];
            $website = $_POST["website"];
            $person = $_POST["person"];
            $context = $_POST["context"];
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo "<script>alert('新增成功'); location.href = 'information_add.php';</script>";
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    // Close connection

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
    <script src="//cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
<body>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: left; }
        .wrapper{ width: 75%; padding: 20px; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1 style="text-align: center;"> 歡迎, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>這裡是網站功能-公告新增</h1>
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
            <li style="list-style-type:none;" class="member6"><button href="#" class="btn btn-warning">頁面</button></li>
            <li style="list-style-type:none; display:none; " class="member7"><button onclick="location.href='page_list.php'" class="btn btn-warning">列表</button></li>
            <li style="list-style-type:none; display:none; " class="member7"><button onclick="location.href='page_add.php'" class="btn btn-warning">新增</button></li>
            <li style="list-style-type:none; display:none; " class="member7"><button onclick="location.href='page_class.php'" class="btn btn-warning">類別</button></li>
        </ul>
</div>
 <!--<?php //echo date("Y-m-d"); ?>-->
    <div align="center">
    <div class="wrapper">       
        <h2>新增公告</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <!--<div class="form-group ">
                <label>類別</label>
                <input type="text" name="class" class="form-control" value="<?php //echo $class; ?>">
            </div>-->

            <div class="form-group ">
            <label>類別</label>
            <select name="class" class="form-control">
                <?php
                require_once "../login_sample2/config.php";
                $sql = "SELECT * FROM imformation_class ";
                $result = $link->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                    $class=$row["class"];
                    ?>
                    <option name="class" value="<?php echo  $class;?>"><?php echo $class; ?></option> 
                <?php
                    }
                }
                mysqli_close($link);
                ?>
            </select>
            </div>
            
            <div class="form-group ">
                <label>開始時間</label>
                <input type="date" name="start_date" class="form-control" value="<?php if($start_date==null){echo  date("Y-m-d");}else{echo $start_date;} ?>">
            </div>

            <div class="form-group ">
                <label>結束時間</label>
                <input type="date" name="end_date" class="form-control" value="<?php if($end_date==null){echo  date("Y-m-d",strtotime('+1 years'));}else{echo $end_date;} ?>">
            </div>

            <div class="form-group ">
                <label>標題</label>
                <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
            </div>

            <div class="form-group ">
                <label>副標題</label>
                <input type="text" name="second_title" class="form-control" value="<?php echo $second_title; ?>">
            </div>

            <div class="form-group ">
                <label>網站</label>
                <input type="text" name="website" class="form-control" value="<?php echo $website; ?>">
            </div>

            <div class="form-group ">
                <label>內文</label>
                <!--<input type="text" name="context" class="form-control" value="<?php //echo $context; ?>">-->
                      <textarea id="editor1"  name="context"><?php echo $context; ?></textarea>
            </div>
            <script>
            CKEDITOR.replace( "editor1" );
            </script>            
    <div class="form-group">
                <input type="hidden" name="person" class="form-control" value="<?php echo htmlspecialchars($_SESSION["username"]); ?>">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>

            <!--<p>Already have an account? <button href="login.php">Login here</button>.</p>!-->
        </form>
    </div>    
</div>
</body>
</html>



