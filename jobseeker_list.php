<?php 
session_start();
if(!isset($_SESSION['account']))
{
		header('Location:HomePage.php');
		exit;
}
?>
<html>
<head>
<title>Jobseeker_list</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<?php echo "<h2>Hello ".$_SESSION['account']."!!</h2>";?>
<form action="employer_logout.php">
 <button type="submit" class="btn btn-success btn-lg btn-default">Logout</button>
 </form>
<h1><center>Job Seeker List</center></h1>
<table class="table table-bordered">
   <thead>
     <tr class="success">
       <td>ID</td>
       <td>Name</td>
	   <td>Gender</td>
	   <td>Age</td>
	   <td>Education</td>
	   <td>Expected Salary</td>
	   <td>Phone Number</td>
	   <td>Email</td>
	   <td>Specialty</td>
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
	
$sql = "SELECT * FROM user ";
$sth = $db->prepare($sql);
$sth->execute();
while($result = $sth->fetchObject()){
				echo '<tr>
				<td>'.$result->id.'</td>
				<td>'.$result->account.'</td>
				<td>'.$result->gender.'</td>
				<td>'.$result->age.'</td>
				<td>'.$result->education.'</td>
				<td>'.$result->expected_salary.'</td>
				<td>'.$result->phone.'</td>
				<td>'.$result->email.'</td>';
				
				$sql= "SELECT user.id , specialty.specialty FROM user INNER JOIN user_specialty ON user.id=user_specialty.user_id 
				        INNER JOIN specialty ON user_specialty.specialty_id=specialty.id 
						WHERE user.id ='".$result->id."' ORDER BY specialty.id";
				$sth1 = $db->prepare($sql);
				$sth1->execute();
				echo '<td>';
				echo '<select name="experience" class="form-control">';
				while($result2=$sth1->fetchObject()){
				echo '<option>'.$result2->specialty.'</option>';
				}	
				echo'</select></td></tr>'; 
			}
?>	 
</tbody> 
 </table>

<form action="employer_login.php">
<button class="btn btn-primary btn-lg btn-default" type="submit">back to job vacancy</button>
</form>
</div>

</body>