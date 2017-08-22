<?php 
session_start(); ?>
<?php
    if(!isset($_SESSION['jobseeker']))
{
		header('Location:HomePage.php');
		exit;
}
unset($_SESSION['jobseeker']);
echo '登出中......';
echo '<meta http-equiv=REFRESH CONTENT=1;url=HomePage.php>';
session_destroy();
?>