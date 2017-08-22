<?
session_start();
    if(!isset($_SESSION['account']))
{
		header('Location:HomePage.php');
		exit;
}
?>
<?php
$d_id=$_POST['delete_id'];
$db_host="dbhome.cs.nctu.edu.tw";
$db_name="chyli84220_cs";
$db_user="chyli84220_cs";
$db_password="db2015";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);


$sqql="DELETE FROM `recruit` WHERE id=?";
$stth=$db->prepare($sqql);
$stth->execute(array($d_id));

header('Location:employer_login.php');
exit;
?>