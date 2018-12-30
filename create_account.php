<?php

include('classes/db.php');
if (isset($_POST['createaccount']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	if(!db::query('SELECT username FROM users WHERE	 username=:username',array(':username'=>$username)))
		if(strlen($username)==3 && strlen($username)<= 32)
			if(preg_match('/[a-zA-Z0-9_]+/',$username))
				if(strlen($password)>=6 && strlen($password) <=60)
					if(filter_var($email, FILTER_VALIDATE_EMAIL)){
						if(!db::query('SELECT email FROM users WHERE email=:email',array(':email'=>$email)))

									{db::query('INSERT INTO users VALUES (\'\',:username,:password,:email)',array(':username'=>$username,':password'=>password_hash($password,PASSWORD_BCRYPT),':email'=>$email));
									echo "SUCCESS";}
								else
								echo 'Email already in use';
						}
						else
							echo "INVALID email";
			

						else
{
	echo "Invalid password";
}
		else{
			echo "Invalid Username";
		}

	else {
		echo "Ivalid username";
	}


	else
	{
		echo "User Exists";
	}
}
?>
<h1>Register</h1>
<form action="create_account.php" method="post">
<input type="text" name="username" value="" placeholder="Username ..."><br><br>
<input type="password" name="password" value="" placeholder="Password ..."><br><br>
<input type="email" name="email" value="" placeholder="someone@somesite.com"><br><br>
<input type="submit" name="createaccount" value="Create Account" >

</form>