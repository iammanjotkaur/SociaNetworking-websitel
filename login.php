<?php
include('classes/db.php');
if(isset($_POST['login']))
{
	$username= $_POST['username'];
	$password= $_POST['password'];

	if(db::query('SELECT username FROM users WHERE username=:username',array(':username'=>$username)))
	{
		if(password_verify($password,db::query('SELECT password FROM users WHERE username=:username',array(':username'=>$username))[0]['password']))
		{
			echo 'Logged in';
			$cstrong=TRUE;
			$token = bin2hex(openssl_random_pseudo_bytes(64,$cstrong));
			$user_id=db::query('SELECT id FROM users WHERE username=:username',array(':username'=>$username))[0]['id'];
			db::query('INSERT INTO login_tokens VALUES(\'\',:token, :user_id)',array(':token'=>sha1($token),':user_id'=>$user_id));

			setcookie("SNID",$token,time()+60*60*24*7,'/',NULL,NULL,TRUE);	
				setcookie("SNID_",'1',time()+60*60*24*3,'/',NULL,NULL,TRUE);
		}
		else
		echo 'Incorrect Passowrd';
	}
	else
	{
		echo 'User not Registered';
	}
}
?>
<h1>Log in Account</h1>
<form action="login.php" method="POST">
<input type="text" name="username" value="" placeholder="Username..."><p />
<input type="password" name="password" value="" placeholder="Password..."><p />
<input type="submit" name="login" value="Login"><p />
</form>