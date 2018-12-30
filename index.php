<?php
include('./classes/db.php');
include('./Log_in.php');

 

	if(Login::isLoggedIn())
	{
		echo 'Logged In';
		echo Login::isLoggedIn();
	}
	else
	{
		echo 'Not Logged In';
	}

?>