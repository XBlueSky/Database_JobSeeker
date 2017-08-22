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

$db_host="dbhome.cs.nctu.edu.tw";
$db_name="chyli84220_cs";
$db_user="chyli84220_cs";
$db_password="db2015";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);
$flag=0;
$sql= "SELECT * FROM `employer`"
. " WHERE `account` = ? AND `password` = ?";
$sth= $db->prepare($sql);
$sth->execute(array($account, $password));
if($account != null && $password != null){	
while($result=$sth->fetchObject()) {
$flag=1;
}	
if($flag==1){
$_SESSION['account'] = $account;	
echo  '登入成功!';
echo '<meta http-equiv=REFRESH CONTENT=1;url=employer_login.php>';
}
else{
echo  '登入失敗!';
echo '<meta http-equiv=REFRESH CONTENT=1;url=HomePage.php>';	
}
}
?>