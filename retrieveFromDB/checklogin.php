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

// for trainee
$dataFileAbsPath = "/home/damlu/peirongli.dreamhosters.com/WiX/FitnessManager2/data_Miles7days.tsv";

$con = mysqli_connect("$host", "$username", "$password","$db_name");
$result = mysqli_query($con,"SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'");

$rowId = 1;

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
	
	} else {
		$id = $row['id'];
		$This_Trainer = "/home/damlu/peirongli.dreamhosters.com/WiX/FitnessManager2/data_ThisTrainer.tsv";
		$His_Trainees = "/home/damlu/peirongli.dreamhosters.com/WiX/FitnessManager2/data_HisTrainees.tsv";
		
		// get Trainer's profile
		
		file_put_contents($This_Trainer,"ID\tusername\tFirstName\tLastName\tAge\tImgURL\tYearsOfExp\tProfLevel\tRatingStarts\n",LOCK_EX);		
		
		$resultTrainer = mysqli_query($con,"SELECT * FROM Trainers WHERE ID=$id");
		while($rowTrainer = mysqli_fetch_array($resultTrainer)){
			//echo "heeeee";
			file_put_contents("log2", "log trainer: ".print_r($rowTrainer,true)."\n",LOCK_EX | FILE_APPEND);
			for($i=0; $i<count($rowTrainer); $i++){
				file_put_contents("log2", print_r($rowTrainer[$i],true)."\n",LOCK_EX | FILE_APPEND);
				file_put_contents($This_Trainer, $rowTrainer[$i],LOCK_EX | FILE_APPEND);
				if($i == count($rowTrainer)-1){
					file_put_contents($This_Trainer,"\n",LOCK_EX | FILE_APPEND);
				} else {
					file_put_contents($This_Trainer,"\t",LOCK_EX | FILE_APPEND);
				}
			}		
		}	
		
		// get this Trainer's Trainee List
		file_put_contents($His_Trainees,"ID\tusername\tFirstName\tLastName\tAge\tD1\tD2\tD3\tD4\tD5\tD6\tD7\tCalories_Burned\tWeight\tHeight\n",LOCK_EX);		
		
		$resultTrainees = mysqli_query($con,"SELECT * from Trainees WHERE Trainees.ID in (SELECT Trainee_ID from Xref WHERE Trainer_ID = 1)");
		while($rowTrainee = mysqli_fetch_array($resultTrainees)){
			//echo "heeeee";
			//file_put_contents($His_Trainees, "log trainee: ".print_r($rowTrainee,true)."\n",LOCK_EX | FILE_APPEND);
			file_put_contents("log4", "log trainee: ".print_r($rowTrainee,true)."\n",LOCK_EX | FILE_APPEND);
			for($i=0; $i<count($rowTrainee); $i++){
				//file_put_contents($His_Trainees, print_r($rowTrainee[$i],true)."\n",LOCK_EX | FILE_APPEND);
				file_put_contents($His_Trainees, $rowTrainee[$i],LOCK_EX | FILE_APPEND);
				if($i == count($rowTrainee)-1){
					file_put_contents($His_Trainees,"\n",LOCK_EX | FILE_APPEND);
				} else {
					file_put_contents($His_Trainees,"\t",LOCK_EX | FILE_APPEND);
				}
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
//header("location: http://peirongli.dreamhosters.com/WiX/FitnessManager2/D3_hist.html?p1=$rowId");
//header("location: http://peirongli.dreamhosters.com/WiX/FitnessManager2/index.html?p1=$rowId");

if($rowId==1){
	header("location: http://peirongli.dreamhosters.com/WiX/FitnessManager2/index2.html?p1=$rowId");
} else {
	header("location: http://peirongli.dreamhosters.com/WiX/FitnessManager2/widget.html");
}
				//http://peirongli.dreamhosters.com/learnD3/
//echo "success\n";

}
else {
//echo "Wrong Username or Password";
}
?>

