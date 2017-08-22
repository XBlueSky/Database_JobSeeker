<?php 
	session_start(); 
    if(isset($_SESSION['jobseeker']))
	{
		header('Location:jobseeker_login.php');
		exit;
	}
	else if(isset($_SESSION['account']))
	{
		header('Location:employer_login.php');
		exit;
	}
$db_host="dbhome.cs.nctu.edu.tw";
$db_name="chyli84220_cs";
$db_user="chyli84220_cs";
$db_password="db2015";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);

?>
<html>
<head>
<title>Jobseeker_signup</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<h2>Fill in your resume</h2>
<br>
      
<form action="jobseeker_signup.php" method="POST">
  <div class="row">
  <div class="col-xs-12 col-md-3">
    <label for="account">Account</label>
    <input type="text" class="form-control" name="account">
  </div>
  <div class="col-xs-12 col-md-3">
	<label for="password">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  <div class="col-xs-12 col-md-3">
	<label for="phone">Phone</label>
    <input type="text" class="form-control" name="phone">
  </div>
  <div class="col-xs-12 col-md-3">
	 <label for="gender">Gender</label>
      <select name="gender" class="form-control">
        <option>Male</option>
		<option>Female</option>
      </select>
  </div>
  <br><br>
  <div class="col-xs-12 col-md-3">
	<label for="age">Age</label>
    <input type="number" class="form-control" max="100" min="1" step="1" value="22" name="age">
  </div>
  <div class="col-xs-12 col-md-3">	
	<label for="email">Email</label>
    <input type="text" class="form-control" name="email">
  </div>
  <div class="col-xs-12 col-md-3">	
	<label for="expected_salary">Expected Salary</label>
    <input type="number" class="form-control" step="1000" value="28000" name="expected_salary">
  </div>
  <div class="col-xs-12 col-md-3">	 
	 <label for="education">Major Education</label>
      <select name="education" class="form-control">
        <option>Graduate School</option>
		<option>Undergraduate School</option>
		<option>Senior High School</option>
		<option>Junior High School</option>
		<option>Elementary School</option>
      </select>
  </div>
  </div>
  <h3>What is your specialty?</h3>
<?	$sql2= "SELECT * from specialty";
	$sth2= $db->prepare($sql2);
	$sth2->execute();
	while($result2=$sth2->fetchObject()){
	echo  '<label class="checkbox-inline">'.
          '<input type="checkbox" name="special_id[]" value="'.$result2->id.'">'.$result2->specialty.'';
    echo  '</label>';
				}	
?>
 
<br><br>

<div class="col-xs-12 col-md-3"> 
<button class="btn btn-success btn-lg btn-block" type="submit" >submit</button>
</form>
</div>
</body>
</html> 










