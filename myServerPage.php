<?php

echo "<h1> Here </h1>\n";
file_put_contents("log1","here1\n",FILE_APPEND|LOCK_EX);
$decoded = base64_decode($_POST['json']);
file_put_contents("log1","here2\n",FILE_APPEND|LOCK_EX);
//$decoded = "plain\n";
$jsonFile = fopen('myJson.json','a+');
fwrite($jsonFile,$decoded);
fclose($jsonFile);

//$con=mysqli_connect("example.com","peter","abc123","my_db");

$con = mysqli_connect("mysql.peirongli.dreamhosters.com","daming","FitnessManager","damingdb");
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


//$sql="CREATE TABLE Persons(FirstName CHAR(30),LastName CHAR(30),Age INT)";

$sql = 'INSERT INTO Persons VALUES ("Daming", "Lu" , 29)';

// Execute query
if (mysqli_query($con,$sql))
{
  	file_put_contents("log1","success\n",FILE_APPEND|LOCK_EX);

  	echo "Table persons created successfully";
}
else
{
	file_put_contents("log1","failure\n",FILE_APPEND|LOCK_EX);

    echo "Error creating table: " . mysqli_error($con);
}

?>
