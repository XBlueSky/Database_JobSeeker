<?
    session_start();
    if(!isset($_SESSION['jobseeker']))
{
		header('Location:HomePage.php');
		exit;
}
?>
<?
$db_host="dbhome.cs.nctu.edu.tw";
$db_name="chyli84220_cs";
$db_user="chyli84220_cs";
$db_password="db2015";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);

$account=$_SESSION['jobseeker'];
$recruit_id=$_POST[favorite_id];

$sql="SELECT * FROM `user`"."WHERE `account`=?";
$sth=$db->prepare($sql);
$sth->execute(array($account));
while($result= $sth->fetchObject()) {
$user_id=$result->id;
}	

$sql2="INSERT INTO `favorite`(user_id,recruit_id)".
	 "VALUES(?,?)";
$sth2=$db->prepare($sql2);
$sth2->execute(array($user_id,$recruit_id));

header('Location:jobseeker_login.php');
exit;
?>