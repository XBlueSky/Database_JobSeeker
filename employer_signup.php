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
<?php
$account=$_POST['account'];
$password=crypt($_POST['password'],'$1$aqweipald');
$phone=$_POST['phone'];
$email=$_POST['email'];
$id=NULL;
$db_host="dbhome.cs.nctu.edu.tw";
$db_name="chyli84220_cs";
$db_user="chyli84220_cs";
$db_password="db2015";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);
$flag= 0;


if($account != null && $_POST['password'] != null)
{
$sql2= "SELECT * FROM `employer`"
. " WHERE `account` = ?"; 
$sth2= $db->prepare($sql2);
$sth2->execute(array($account));	
while($result= $sth2->fetchObject()) {
$flag= 1;
}	
if($flag==0){
$sql="INSERT INTO`employer`(id,account,password,phone,email)"
."VALUES(?,?,?,?,?)";
$sth=$db->prepare($sql);
$sth->execute(array($id,$account,$password,$phone,$email));

$_SESSION['account'] = $account;
echo '<meta http-equiv=REFRESH CONTENT=1;url=employer_login.php>'; 
}
else {
echo '已有相同帳號!'; 
echo '<meta http-equiv=REFRESH CONTENT=1;url=employer_signup.html>';	 
}
}
else echo '<meta http-equiv=REFRESH CONTENT=1;url=employer_signup.html>';

?>

