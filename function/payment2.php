<?php
	include('db/dbconn.php');
	include('login.php');

	if (isset($_POST['nametd']))
{
	$nametd=$_POST['nametd'];
	$uploadfile=$_POST['uploadfile'];
	$detail=$_POST['detail'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];	
	$query = $conn->query("SELECT * FROM `nametd` WHERE `email` = '$email'");
	$check = $query->num_rows;
		if($check == 1)
			{
				echo "<script>alert('EMAIL ALREADY EXIST')</script>";	 
			}
			
			else                            
				{
					$conn->query ("INSERT INTO nametd (nametd, uploadfile, detail, name, email, mobile)
					VALUES ('$nametd', '$uploadfile', '$detail', '$name', '$email', '$mobile')") 
					or die(mysqli_error());	
				}				
					
}
?>