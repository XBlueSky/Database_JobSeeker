<?php
session_start();
if(!isset($_SESSION['account']))
{
		header('Location:HomePage.php');
		exit;
}
unset($_SESSION['account']);
echo '登出中......';
echo '<meta http-equiv=REFRESH CONTENT=1;url=HomePage.php>';
session_destroy();
exit;
?>