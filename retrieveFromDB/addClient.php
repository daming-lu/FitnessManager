<?php
//echo "haha";
file_put_contents("logAddClient","Here\n",LOCK_EX|FILE_APPEND);
//http://peirongli.dreamhosters.com/WiX/FitnessManager2/index2.html?p1=1#

file_put_contents("logAddClient","POST\n".print_r($_POST,true)."\n",LOCK_EX|FILE_APPEND);

// add trainee
$host="mysql.peirongli.dreamhosters.com"; // Host name 
$usernameDB="daming"; // Mysql username 
$password="FitnessManager"; // Mysql password 
$db_name="damingdb"; // Database name 

mysql_connect("$host", "$usernameDB", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");


$firstName = $_POST['Firstname'];
$lastName = $_POST['Lastname'];
$username = $_POST['Username'];
$Age = $_POST['Age'];
$ImgURL = $_POST['ImgURL'];
$Weight = $_POST['Weight1'];
$Height = $_POST['Height1'];
$Calories = $Weight+$Height;

$con = mysqli_connect($host, $usernameDB, $password,$db_name);

$sql="INSERT INTO Trainees(
username, FirstName, LastName, Age, ImgURL, D1,D2,D3,D4,D5,D6,D7, Calories_Burned, Weight, Height) 
VALUES (
'$username','$firstName', '$lastName',  $Age, '$ImgURL', 4,7,2,2,13,0,4, $Calories, $Weight, $Height );
";

$result = mysqli_query($con,$sql);


header("location:http://peirongli.dreamhosters.com/WiX/FitnessManager2/index2.html?p1=1"); 
?>
