<?php 
session_start();
$db_host="dbhome.cs.nctu.edu.tw";
$db_name="chyli84220_cs";
$db_user="chyli84220_cs";
$db_password="db2015";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);

$_SESSION['sort'] = 0;
if(isset($_SESSION['account']))
{
		header('Location:employer_login.php');
		exit;
}
	else if(isset($_SESSION['jobseeker']))
{
		header('Location:jobseeker_login.php');
	
}
else{
	    header('Location:HomePage.php');
}
exit;
?>