<?php
// Initialize the session
// Include config file
require_once "../login_sample2/config.php";
 
$id = $_POST['id'];
$class=$_POST["class"];
$file="";
/*$sql2 = "SELECT * FROM file_class Where id='$id'";
$result = $link->query($sql2);
 if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        	$file='uploads/'.$row["class"];
        	echo("成功");
         }
    }*/

// Processing form data when form is submitted
$sql = "UPDATE file_class SET class = '$class' WHERE id = '$id'; ";
   
if ($link->query($sql) === TRUE) {	
    //echo "New record change successfully .";
    /*$rename = 'uploads/'.$class;
	if(rename($file,$rename)){
		echo '更名成功';
	}else{
		echo '更名失敗';
	}*/
    header("location: fileroom_class.php");
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

mysqli_close($link);
//echo("<script>console.log('".json_encode($data)."');</script>");
?>

