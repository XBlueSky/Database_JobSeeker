<?php 
session_start(); 
    if(!isset($_SESSION['jobseeker']))
	{
		header('Location:HomePage.php');
		exit;
	}
?>
<html>
<head>
<title>favorite list</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<?php echo "<h2>Hello ".$_SESSION['jobseeker']."!!</h2>";?>
<form action="jobseeker_logout.php" method="post">
<button class="btn btn-success btn-lg btn-defult" type="submit">Log out</button>
</form>
<h1><center>Favorite List</center></h1>
<table class="table table-bordered">
   <thead>
     <tr class="success">
       <td>ID</td>
       <td>Occupation</td>
	   <td>Location</td>
	   <td>Work Time</td>
	   <td>Education Required</td>
	   <td>Minimum of Working Experience</td>
	   <td>Salary Per Month</td>
	   <td>Operation</td>
      </tr>
	  </thead>
   <tbody>
   <?php
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
$sql2="SELECT * FROM `favorite`"."WHERE `user_id`=?";
$sth2=$db->prepare($sql2);
$sth2->execute(array($user_id));
while($result2=$sth2->fetchObject())
{
$sql="SELECT  recruit.id,occupation.occupation ,location.location,recruit.working_time,recruit.education,recruit.experience,recruit.salary
	FROM  recruit INNER JOIN occupation INNER JOIN location WHERE recruit.occupation_id=occupation.id AND recruit.location_id=location.id and recruit.id=? ORDER BY recruit.id";
$sth= $db->prepare($sql);
$sth->execute(array($result2->recruit_id));
while($result= $sth->fetchObject()) {
	   $exper=$result->experience;
	if($exper==0)
		$exp="NO experience required";
	else if($exper==1)
		$exp="1 year";
	else if($exper==2)
		$exp="2 years";
	else if($exper==3)
		$exp="3 years";
	else if($exper==5)
		$exp="5 years";
	else if($exper==10)
		$exp="10 years";
	echo '<tr>'.
	'<td>'.$result->id.'</td>'.
	'<td>'.$result->occupation.'</td>'.
	'<td>'.$result->location.'</td>'.
	'<td>'.$result->working_time.'</td>'.
	'<td>'.$result->education.'</td>'.
	'<td>'.$exp.'</td>'.
	'<td>'.$result->salary.'</td>'.
	'<td><form action="jobseeker_favorite_delete.php" method="POST"><button class="btn btn-warning" type="submit" value='.$result->id.' name="delete_id">Delete</button></form>'.
	'</td></tr>';
	
} 
}
?>
</tbody> 
</table>
<div class="col-xs-6 col-md-4">
<form action="jobseeker_login.php" method="post">
<button class="btn btn-info" type="submit">Back to job vacancy</button>
</form>
</body>