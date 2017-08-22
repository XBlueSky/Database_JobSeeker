<?
session_start();
    if(!isset($_SESSION['jobseeker']))
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
$account=$_SESSION['jobseeker'];
  
$sql3="SELECT * FROM `user`"
. " WHERE `account` = ?";
$sth3=$db->prepare($sql3);
$sth3->execute(array($account));
while($result3= $sth3->fetchObject()) {
$user_id=$result3->id;
}	

$sqql="DELETE FROM `favorite` WHERE user_id=? AND recruit_id=?";
$stth=$db->prepare($sqql);
$stth->execute(array($user_id,$d_id));

header('Location:jobseeker_favorite.php');
exit;
?>