<?php
include('./classes/db.php');
include('./Log_in.php');
if(!Login::isLoggedIn())
{
	die("Not Logged in");
}
if(isset($_POST['confirm']))
{
	if(isset($_POST['alldevices']))
	{
		db::query('DELETE FROM login_tokens WHERE user_id=:userid',array(':userid'=>Login::isloggedin()));
	}
	else
	{
		if(isset($_COOKIE['SNID'])){
		db::query('DELETE FROM login_tokens WHERE token=:token',array(':token'=>sha1($_COOKIE['SNID'])));
	}
	setcookie('SNID','1',time()-3600);
	setcookie('SNID_','1',time()-3600);
	}
}
?>
<h1>Logout of your Account</h1>
<p>Are you sure you'd like to logout?</p>
<form action="logout.php" method ="post">
<input type="checkbox" name="alldevices" value="alldevices">Logout of all devices<br />
<input type="submit" name="confirm" value="Confirm">
</form>