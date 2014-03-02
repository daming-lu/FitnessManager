<?php

$host="mysql.peirongli.dreamhosters.com"; // Host name 
$username="daming"; // Mysql username 
$password="FitnessManager"; // Mysql password 
$db_name="damingdb"; // Database name 
$tbl_name="members"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

$test1=$_GET['a'];
file_put_contents("log1", "test1 == $test1\n",LOCK_EX | FILE_APPEND);

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
//session_register("myusername");
//session_register("mypassword"); 

// ###

$dataFileAbsPath = "/home/damlu/peirongli.dreamhosters.com/WiX/FitnessManager2/data_Miles7days.tsv";
$con = mysqli_connect("$host", "$username", "$password","$db_name");
$result = mysqli_query($con,"SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'");
while($row = mysqli_fetch_array($result))
{
	file_put_contents("log1", "log : ".print_r($row,true)."\n",LOCK_EX | FILE_APPEND);
	
	//echo $row['Role']."!";
	
	if($row['Role']==2){
		//echo "Trainee!\n";
		// it's a trainee !
		$rowId = $row['id'];
		//echo "rowId == ".$rowId."\n";
		$result2 = mysqli_query($con,"SELECT * FROM Trainees WHERE ID=$rowId");
		//dataMiles7days.tsv
		file_put_contents($dataFileAbsPath, 
			"letter\tfrequency\n",LOCK_EX );
		
		while($row2 = mysqli_fetch_array($result2)){
			//echo "heeeee";
			file_put_contents("log1", "log trainee: ".print_r($row2,true)."\n",LOCK_EX | FILE_APPEND);
			
			for($i=1; $i<=7; $i++){
				$day = "D".$i;
				//echo $day." - ".$row2[$day]."!\n";
				file_put_contents($dataFileAbsPath, 
				"$day\t$row2[$day]\n",LOCK_EX | FILE_APPEND);
				
			}
			
		}
	
	}
	
	//echo $row['Letter'] . " " . $row['Frequency'];
	//echo "<br>";
	/*
	file_put_contents("/home/damlu/peirongli.dreamhosters.com/learnD3/data.tsv",
		$row['Letter']."\t".$row['Frequency']."\n",
		LOCK_EX | FILE_APPEND
	);
	*/
}

// ### 

file_put_contents("log1","\nSuccess Login\n",FILE_APPEND|LOCK_EX);

//header("location:login_success.php");
//header("location:http://peirongli.dreamhosters.com/WiX/FitnessManager/#");
header("location: http://peirongli.dreamhosters.com/WiX/FitnessManager2/D3_hist.html?p1=$rowId");
				//http://peirongli.dreamhosters.com/learnD3/
//echo "success\n";

}
else {
//echo "Wrong Username or Password";
}
?>

