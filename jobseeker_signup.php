<?php 
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
<?php
$account=$_POST['account'];
$password=crypt($_POST['password'],'$1$aqweipald');
$phone=$_POST['phone'];
$gender=$_POST['gender'];
$age=$_POST['age'];
$email=$_POST['email'];
$expected_salary=$_POST['expected_salary'];
$education=$_POST['education'];
$id=NULL;
$special=$_POST["special_id"];
$num = 0;
$flag= 0;


$db_host="dbhome.cs.nctu.edu.tw";
$db_name="chyli84220_cs";
$db_user="chyli84220_cs";
$db_password="db2015";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);

if($account != null && $_POST['password']!= null)
{
$sql2= "SELECT * FROM `user`"
. " WHERE `account` = ?"; 
$sth2= $db->prepare($sql2);
$sth2->execute(array($account));	
while($result= $sth2->fetchObject()) {
$flag= 1;
}	
 if($flag==0){
$sql= "INSERT INTO `user`(id,account,password,education,expected_salary,phone,gender,age,email)"
."VALUES(?,?,?,?,?,?,?,?,?)";
$sth= $db->prepare($sql);
$sth->execute(array($id,$account,$password,$education,$expected_salary,$phone,$gender,$age,$email));

$sql3="SELECT * FROM `user`"
. " WHERE `account` = ?";
$sth3=$db->prepare($sql3);
$sth3->execute(array($account));
while($result= $sth3->fetchObject()) {
$user_id=$result->id;
}	
 foreach($special as $value) {
 $num = $num + 1;
 $sql1= "INSERT INTO `user_specialty`(id,user_id,specialty_id)"
 ."VALUES(?,?,?)";
 $sth1= $db->prepare($sql1);
 $sth1->execute(array($id,$user_id,$value));
   }	
$_SESSION['jobseeker'] = $account;	
echo '<meta http-equiv=REFRESH CONTENT=1;url=jobseeker_login.php>'; 
	 
 }
 else {
echo '已有相同帳號!'; 
echo '<meta http-equiv=REFRESH CONTENT=1;url=jobseeker_sign_up.php>';	 
 }
}
else echo '<meta http-equiv=REFRESH CONTENT=1;url=jobseeker_sign_up.php>';
?>