<?php
// Initialize the session
session_start();
header("Cache-control: private");

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "../login_sample2/config.php";
 
// Define variables and initialize with empty values
$class = $editer = $uptime = $title = $filename = $pre_filename = $filepath =  $class_id = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        $sql = "INSERT INTO file (class,title,editer ,uptime,filename,pre_filename,filepath) VALUES (?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $class,$title,$editer,$uptime,$filename,$pre_filename,$filepath);     
            $class = $_POST["class"];
            $editer = $_POST["editer"];
            $uptime = $_POST["uptime"];
            $title = $_POST["title"];
            $filename = $_POST["filename"];
            $pre_filename = $_POST["pre_filename"];
            $target_dir = "uploads/".$class_id;
            $filepath = $target_dir.$pre_filename;
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepath)){
                echo 'yes';
            }
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo "<script>alert('上傳成功'); location.href = 'fileroom_list.php';</script>";
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
<body>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: left; }
        .wrapper{ width: 75%; padding: 20px; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1 style="text-align: center;"> 歡迎, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>這裡是檔案室新增</h1>
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
            <li style="list-style-type:none; display:none; " class="member7"><button onclick="location.href='page_list.php'" class="btn btn-warning">列表</button></li>
            <li style="list-style-type:none; display:none; " class="member7"><button onclick="location.href='page_add.php'" class="btn btn-warning">新增</button></li>
            <li style="list-style-type:none; display:none; " class="member7"><button onclick="location.href='page_class.php'" class="btn btn-warning">類別</button></li>
        </ul>

</div>
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
                $sql = "SELECT * FROM file_class ";
                $result = $link->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                    $class=$row["class"];
                    $class_id=$row["class_id"];
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
                <label>標題</label>
                <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
            </div>

            <div class="form-group ">
                <label>檔案名</label>
                <input type="text" name="filename" class="form-control" value="<?php echo $filename; ?>">
            </div>

            <div class="form-group ">
                <label>檔案</label>
                <input type="file" name="pre_filename" class="form-control" >
            </div>


    <div class="form-group">
                <input type="hidden" name="editer" class="form-control" value="<?php echo htmlspecialchars($_SESSION["username"]); ?>">
                <input type="hidden" name="class_id" class="form-control" value="<?php echo $class_id; ?>">                
                <input type="hidden" name="uptime" class="form-control" value="<?php if($uptime==null){echo  date("Y-m-d");}else{echo $uptime;} ?>">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>

            <!--<p>Already have an account? <button href="login.php">Login here</button>.</p>!-->
        </form>
    </div>    
</div>
</body>
</html>



