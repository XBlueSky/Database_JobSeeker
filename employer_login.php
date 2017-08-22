<?php
session_start();
    if(!isset($_SESSION['account']))
{
		header('Location:HomePage.php');
		exit;
}
$db_host="dbhome.cs.nctu.edu.tw";
$db_name="chyli84220_cs";
$db_user="chyli84220_cs";
$db_password="db2015";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);
echo "<h2>Hello ".$_SESSION['account']."!</h2>";
?>
<html>
<head>
<title>employer_login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<form action="employer_logout.php">
 <button type="submit" class="btn btn-success btn-lg btn-default">Logout</button>
 </form>
<h1><center>Job Vacancy</center></h1>
<table class="table table-bordered">
   <thead>
     <tr>
	<form action="employer_search.php" method="POST"><center>
      <td><input type="text" name="Occupation" placeholder=Occupation></td>
	   <td><input type="text" name="Location" placeholder=Location></td>
	   <td><input type="text" name="Work_Time" placeholder='Work Time'></td>
	   <td><input type="text" name="Education_Required" placeholder='Education Required'></td>
	   <td><input type="text" name="Working_Experience" placeholder='Working Experience'></td>
	   <td><p>Less <input type="number" step="1000" value="60000" name="salary"></p></td> 
     <td><div class="col-md-4 col-md-offset-4">
     <button type="submit" name="search" value="0">Search</button><br /></td>
    </form>
	</tr>
     <tr class="success">
       <td>ID</td>
       <td>Occupation</td>
	   <td>Location</td>
	   <td>Work Time</td>
	   <td>Education Required</td>
	   <td>Minimum of Working Experience</td>
	   <td>
       Salary Per Month
        <a href="Homepage_asc.php">
	   <img src="up.png" border="0" width="25" height="25">
       <a href="Homepage_des.php">
       <img src="down.png" border="0" width="25" height="25"></td>
	   <td>Operation</td>
      </tr>  
   </thead>
   <tbody>
   <?php
  if($_SESSION['flag']=="0"){
	if( $_SESSION['sort']=="1"){
	$sql= $_SESSION['search']." ORDER BY salary DESC";
	$sth= $db->prepare($sql);
	$sth->execute();
}else if( $_SESSION['sort']=="0"){
	$sql= $_SESSION['search']." ORDER BY salary ASC";
	$sth= $db->prepare($sql);
	$sth->execute();
}else{
	$sql= $_SESSION['search']." ORDER BY id ASC";
	$sth= $db->prepare($sql);
	$sth->execute();
}
}
else{
 if( $_SESSION['sort']=="1"){
	$sql= "SELECT  recruit.id,employer.account,occupation.occupation ,location.location,recruit.working_time,recruit.education,recruit.experience,recruit.salary
	FROM  recruit INNER JOIN employer INNER JOIN occupation INNER JOIN location WHERE recruit.employer_id=employer.id AND recruit.occupation_id=occupation.id AND recruit.location_id=location.id ORDER BY salary DESC";
	$sth= $db->prepare($sql);
	$sth->execute();
}else if( $_SESSION['sort']=="0"){
	$sql= "SELECT  recruit.id,employer.account,occupation.occupation ,location.location,recruit.working_time,recruit.education,recruit.experience,recruit.salary
	FROM  recruit INNER JOIN employer INNER JOIN occupation INNER JOIN location WHERE recruit.employer_id=employer.id AND recruit.occupation_id=occupation.id AND recruit.location_id=location.id ORDER BY salary ASC";
	$sth= $db->prepare($sql);
	$sth->execute();
}else{
	$sql= "SELECT  recruit.id,employer.account,occupation.occupation ,location.location,recruit.working_time,recruit.education,recruit.experience,recruit.salary
	FROM  recruit INNER JOIN employer INNER JOIN occupation INNER JOIN location WHERE recruit.employer_id=employer.id AND recruit.occupation_id=occupation.id AND recruit.location_id=location.id ORDER BY id ASC";
	$sth= $db->prepare($sql);
	$sth->execute();
}
}

	
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
if($result->account==$_SESSION['account']){	
	echo '<tr><form action="employer_login_edit.php" method="POST">'.
	'<td>'.$result->id.'</td>'.
	'<td>'.$result->occupation.'</td>'.
	'<td>'.$result->location.'</td>'.
	'<td>'.$result->working_time.'</td>'.
	'<td>'.$result->education.'</td>'.
	'<td>'.$exp.'</td>'.
	'<td>'.$result->salary.'</td>'.
    '<td>'.'<button class="btn btn-success" type="submit" value='.$result->id.' name="edit_id">Edit</button></form>'.
	'<form action="employer_login_delete.php" method="POST"><button class="btn btn-warning" type="submit" value='.$result->id.' name="delete_id">Delete</button></form>'.
	'</td></tr>';
}
else{
	echo '<tr>'.
	'<td>'.$result->id.'</td>'.
	'<td>'.$result->occupation.'</td>'.
	'<td>'.$result->location.'</td>'.
	'<td>'.$result->working_time.'</td>'.
	'<td>'.$result->education.'</td>'.
	'<td>'.$exp.'</td>'.
	'<td>'.$result->salary.'</td>'.'</tr>';
}
}
unset($_SESSION['sort']);

?>	 
</tbody> 
 </table>
  <div class="col-xs-6 col-md-4">
 <form action="employer_signup_add.php" method="post">
<button class="btn btn-primary" type="submit">Add a New job</button>
</form>
 <form action="jobseeker_list.php" method="post">
<button class="btn btn-info" type="submit">Job Seeker List</button>
</form>
  <form action="employer_jobapply.php" method="post">
<button class="btn btn-danger" type="submit">Who Apply Your Job</button>
</form>
</div>
</body>