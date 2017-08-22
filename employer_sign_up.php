<?
session_start();
    if(isset($_SESSION['account']))
{
		header('Location:employer_login.php');
		exit;
}
    else if(isset($_SESSION['jobseeker']))
{
		header('Location:jobseeker_login.php');
		exit;
}
?>
<html>
<head>
<title>employer_signup</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<h2>Registration</h2>
<h2>New Employer to Job_Hunt System?Register Below</h2>
<br>
  <div class="row">
<form action="employer_signup.php" method="POST">
  <div class="col-xs-12 col-md-3">
    <label for="account">Account</label>
    <input type="text"class="form-control"name="account">
  </div>
  <div class="col-xs-12 col-md-3">
	<label for="password">Password</label>
    <input type="password"class="form-control"name="password">
  </div>
 <br>
 <br>
 <br>
  <div class="col-xs-12 col-md-3">
	<label for="phone">Phone</label>
    <input type="text" class="form-control"name="phone">
  </div>
  <div class="col-xs-12 col-md-3">	
	<label for="email">Email</label>
    <input type="text" class="form-control"name="email">
  </div>
<br><br><br>
  <div class="col-xs-12 col-md-3">
  <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
   </div>
  </form>
  </div>
</body>







