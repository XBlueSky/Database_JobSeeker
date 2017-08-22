<?
session_start();
    if(!isset($_SESSION['account']))
{
		header('Location:HomePage.php');
		exit;
}
?>
<?php
$h_id=$_POST['hire_id'];
$db_host="dbhome.cs.nctu.edu.tw";
$db_name="chyli84220_cs";
$db_user="chyli84220_cs";
$db_password="db2015";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);
$account=$_SESSION['account'];
  
$sql3="SELECT * FROM `employer`"
. " WHERE `account` = ?";
$sth3=$db->prepare($sql3);
$sth3->execute(array($account));
while($result3= $sth3->fetchObject()) {
$emp_id=$result3->id;
}	

$sqql="DELETE FROM `recruit` WHERE id=? AND employer_id=?";
$stth=$db->prepare($sqql);
$stth->execute(array($h_id,$emp_id));

header('Location:employer_jobapply.php');
exit;
?>