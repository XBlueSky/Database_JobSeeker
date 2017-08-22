<?php
session_start();
    if(!isset($_SESSION['account']))
{
		header('Location:HomePage.php');
		exit;
}
echo "<h2>Hello ".$_SESSION['account']."!</h2>";
?>
<html>
<head>
<title>employer_login.php</title>
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
$sql="SELECT  recruit.id,employer.account,occupation.occupation ,location.location,recruit.working_time,recruit.education,recruit.experience,recruit.salary
	FROM  recruit INNER JOIN employer INNER JOIN occupation INNER JOIN location WHERE recruit.employer_id=employer.id AND recruit.occupation_id=occupation.id AND recruit.location_id=location.id ORDER BY recruit.id";
$sth= $db->prepare($sql);
$sth->execute();
$e_id=$_POST['edit_id'];	

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
		
	if($e_id==$result->id)
	{     
	echo '<form action="employer_login_update.php" method="POST">'.
         '<tr>'.
	     '<td>'.$result->id.'</td>'.
	     '<td><select name="occupation" class="form-control">';
            $sql3= "SELECT occupation from occupation";
		    $sth3 = $db->prepare($sql3);
		    $sth3->execute();
				while($result3=$sth3->fetchObject()){
				echo '<option>'.$result3->occupation.'</option>';
			}	
    echo   '</select></td>'.
         '<td><select name="location" class="form-control">';
		    $sql2= "SELECT location from location";
		    $sth2 = $db->prepare($sql2);
		    $sth2->execute();
				while($result2=$sth2->fetchObject()){
				echo '<option>'.$result2->location.'</option>';
			}	
	echo '</select></td>'.
	     '<td><select name="worktime" class="form-control">'.
         '<option>Morning</option>'.
		 '<option>Afternoon</option>'.
		 '<option>Night</option>'.
         '</select></td>'.
	     '<td><select name="education" class="form-control">
         <option>Graduate School</option>
		 <option>Undergraduate School</option>
		 <option>Senior High School</option>
		 <option>Junior High School</option>
		 <option>Elementary School</option>
         </select></td>'.
	     '<td><select name="experience" class="form-control">
         <option>NO experience required</option>
		 <option>1 year</option>
		 <option>2 years</option>
		 <option>3 years</option>
		 <option>5 years</option>
		 <option>10 years</option>
         </select></td>'.
	     '<td><input type="number" class="form-control" step="1000" value="28000" name="salary"></td>'.
	     '<td><button class="btn btn-success" type="submit" value='.$result->id.' name="update_id">Update</button></form><form action="employer_login.php">
	     <button class="btn btn-warning" type="submit2" >Cancel</button></td></form></tr>';	
	}
	else{
	echo '<tr>'.
	'<td>'.$result->id.'</td>'.
	'<td>'.$result->occupation.'</td>'.
	'<td>'.$result->location.'</td>'.
	'<td>'.$result->working_time.'</td>'.
	'<td>'.$result->education.'</td>'.
	'<td>'.$exp.'</td>'.
	'<td>'.$result->salary.'</td>';
	echo '</tr>';
	}
}
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
</div>
</body>