<?php include("include.php");

$variable = $_GET['name'];
$location = $_GET['PostData2'];
$money = $_GET['PostData3'];
$info = $_GET['PostData4'];
//$job = mysql_real_escape_string($_GET['job']);
//$jobLocation = mysql_real_escape_string($_GET['jobLocation']);
//$jobMoney = mysql_real_escape_string($_GET['jobMoney']);
//$jobInfo = mysql_real_escape_string($_GET['jobInfo']);

$query = "INSERT INTO PostJob(job,location,money,info)VALUES ('$variable','$location','$money','$info')";   
$result = mysqli_query($connection,$query);
header('Location: map.php');    
?>