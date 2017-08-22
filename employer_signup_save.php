<?
session_start();
    if(!isset($_SESSION['account']))
{
		header('Location:HomePage.php');
		exit;
}
?>
<?php
$occupation=$_POST['occupation'];
$location=$_POST['location'];
$worktime=$_POST['worktime'];
$education=$_POST['education'];
$experience=$_POST['experience'];
$salary=$_POST['salary'];
$account=$_SESSION['account'];
$id=NULL;

if($experience=="NO experience required")
$exper_time=0;
else if($experience=="1 year")
$exper_time=1;	
else if($experience=="2 years")
$exper_time=2;
else if($experience=="3 years")
$exper_time=3;
else if($experience=="5 years")
$exper_time=5;
else if($experience=="10 years")
$exper_time=10;


$db_host="dbhome.cs.nctu.edu.tw";
$db_name="chyli84220_cs";
$db_user="chyli84220_cs";
$db_password="db2015";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);

$sql="SELECT * FROM location";
$str= $db->prepare($sql);
$str->execute();
$flag=0;
$num =1;
while($result = $str->fetchObject()){
    if($result->location==$location){
		$location_id=$result->id;
		$flag=1;
	}
	$num++;
}
if($flag==0){
	$location_id=$num;
	$sqll="INSERT INTO `location`(id,location)"
	."VALUES(?,?)";
	$sth =$db->prepare($sqll);
	$sth ->execute(array($id,$location));	
}
$sqo="SELECT * FROM occupation";
$sto= $db->prepare($sqo);
$sto->execute();
while($result = $sto->fetchObject()){
    if($result->occupation==$occupation){
		$occupation_id=$result->id;
	}
}
$sqe="SELECT * FROM employer";
$ste= $db->prepare($sqe);
$ste->execute();
while($result = $ste->fetchObject()){
    if($result->account==$account){
		$employer_id=$result->id;
	}
}

$sqql="INSERT INTO `recruit`(id,employer_id,occupation_id,location_id,working_time,education,experience,salary)"
."VALUES(?,?,?,?,?,?,?,?)";
$stth=$db->prepare($sqql);
$stth->execute(array($id,$employer_id,$occupation_id,$location_id,$worktime,$education,$exper_time,$salary));

header('Location:employer_login.php');
exit;
?>