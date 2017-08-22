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
<title>favorite list</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<?php echo "<h2>Hello ".$_SESSION['account']."!!</h2>";?>
<form action="employer_logout.php" method="post">
<button class="btn btn-success btn-lg btn-defult" type="submit">Log out</button>
</form>
<h1><center>Favorite List</center></h1>
   <?php
$db_host="dbhome.cs.nctu.edu.tw";
$db_name="chyli84220_cs";
$db_user="chyli84220_cs";
$db_password="db2015";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);
$account=$_SESSION['account'];


$sql="SELECT  recruit.id,employer.account,occupation.occupation ,location.location,recruit.working_time,recruit.education,recruit.experience,recruit.salary
	FROM  recruit INNER JOIN employer INNER JOIN occupation INNER JOIN location WHERE recruit.employer_id=employer.id AND recruit.occupation_id=occupation.id AND recruit.location_id=location.id 
	AND employer.account=?  ORDER BY recruit.id";
$sth= $db->prepare($sql);
$sth->execute(array($account));
while($result=$sth->fetchObject()){
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
    echo '<table class="table table-striped"><thead>'.
		'<tr class="Info">'.
		'<td width="10%">'.$result->occupation.'</td>'.
	    '<td width="10%">'.$result->location.'</td>'.
		'<td width="10%">'.$result->working_time.'</td>'.
	    '<td width="10%">'.$result->education.'</td>'.
	    '<td width="15%">'.$exp.'</td>'.
	    '<td width="10%">'.$result->salary.'</td><td width="13%"></td><td width="13%"></td><td width="9%"></td></tr></thead>';
	$sql2 = "SELECT * FROM application "."WHERE recruit_id=?";
    $sth2 = $db->prepare($sql2);
    $sth2->execute(array($result->id));
	while($result2=$sth2->fetchObject())
	{
		$user_id=$result2->user_id;
		$sql3="SELECT * FROM user "."WHERE id=?";
		$sth3=$db->prepare($sql3);
		$sth3->execute(array($user_id));
		while($result3=$sth3->fetchObject())
		{
			echo '<tbody><tr>
				<td>'.$result3->account.'</td>
				<td>'.$result3->gender.'</td>
				<td>'.$result3->age.'</td>
				<td>'.$result3->education.'</td>
				<td>'.$result3->expected_salary.'</td>
				<td>'.$result3->phone.'</td>
				<td>'.$result3->email.'</td>';
				
				$sql4= "SELECT user.id , specialty.specialty FROM user INNER JOIN user_specialty ON user.id=user_specialty.user_id 
				        INNER JOIN specialty ON user_specialty.specialty_id=specialty.id 
						WHERE user.id ='".$user_id."' ORDER BY specialty.id";
				$sth4 = $db->prepare($sql4);
				$sth4->execute();
				echo '<td>';
				echo '<select name="experience" class="form-control">';
				while($result4=$sth4->fetchObject()){
				echo '<option>'.$result4->specialty.'</option>';
				}	
				echo '</select></td>';
				echo '<td><form action="employer_jobhire.php" method="POST">'.
	                 '<button class="btn btn-success " type="submit" value='.$result->id.' name="hire_id">Hire</button></form>'.
	                 '</td></tr></tbody>';
		}
	}
echo '</table>';
}	
?>
<div class="col-xs-6 col-md-4">
<form action="employer_login.php" method="post">
<button class="btn btn-info" type="submit">Back to job vacancy</button>
</form>
</body>