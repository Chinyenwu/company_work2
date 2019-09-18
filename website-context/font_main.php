<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首頁</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<body>
      <h2>這裡是首頁</h2>
      <p>這裡會印出首頁內容</p>  
      <p style="   position:absolute; top:0; left:0;">
        <button onclick="location.href='font_main.php'" class="btn btn-safe">首頁</button>
   	 </p> 
      <p style="   position:absolute; top:0; right:0;">
     <?php
    // Initialize the session
      session_start();
      header("Cache-control: private");
// Check if the user is logged in, if not then redirect him to login page
      if(isset($_SESSION["loggedin"]) ){
          echo "<a href='back_main.php' class='btn btn-safe'>後台管理</a>";
          echo "<a href='../login_sample2/logout.php' class='btn btn-safe'>登出</a>";
      }
      else{
          echo "<a href='../login_sample2/login.php' class='btn btn-safe'>登入</a>";
      }
      ?>        
   	 </p>
 </body>
</html>