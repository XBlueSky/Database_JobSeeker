<?php
session_start();
    
?>
<?php
$Occupation=$_POST['Occupation'];
$Location=$_POST['Location'];
$Work_Time=$_POST['Work_Time'];
$Education_Required=$_POST['Education_Required'];
$Working_Experience=$_POST['Working_Experience'];
$Salary=$_POST['salary'];
$_SESSION['flag'] = $_POST['search'];
$db_host="dbhome.cs.nctu.edu.tw";
$db_name="chyli84220_cs";
$db_user="chyli84220_cs";
$db_password="db2015";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);


$sql= "SELECT  recruit.id,employer.account,occupation.occupation ,location.location,recruit.working_time,recruit.education,recruit.experience,recruit.salary
	FROM  recruit INNER JOIN employer INNER JOIN occupation INNER JOIN location WHERE recruit.employer_id=employer.id AND recruit.occupation_id=occupation.id AND recruit.location_id=location.id ";

if($Occupation!='')  $sql=$sql."AND occupation LIKE '%". $Occupation."%' ";
if($Location!='')  $sql=$sql."AND location LIKE '%". $Location."%' ";
if($Work_Time!='')  $sql=$sql."AND working_time LIKE '%". $Work_Time."%' ";
if($Education_Required!='')  $sql=$sql."AND education LIKE '%". $Education_Required."%' ";
if($Working_Experience!='')  $sql=$sql."AND experience LIKE '%". $Working_Experience."%' ";
$sql=$sql."AND salary BETWEEN 0 AND ".$Salary;

$_SESSION['search']=$sql;
header('Location:employer_login.php');
exit;



?>