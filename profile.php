<?php
include('./classes/db.php');
include('./Log_in.php');
$username="";
 $isFollowing = False;
	if(isset($_GET['username']))
	{
		if(db::query('SELECT username FROM users WHERE username=:username',array(':username'=>$_GET['username'])))
		{
			$username=db::query('SELECT username FROM users WHERE username=:username',array(':username'=>$_GET['username']))[0]['username'];
		

					$userid=db::query('SELECT id FROM users WHERE username=:username ',array(':username'=>$_GET['username']))[0]['id'];

			$followerid=Login::isLoggedIn();

			
			

		if(isset($_POST['follow']))
		{
				
			if($userid != $followerid){	
			
			if(!db::query('SELECT follower_id FROM followers WHERE user_id=:userid',array('userid'=>$userid)))
			{
				db::query('INSERT INTO followers VALUES(\'\', :userid, :followerid)',array(':userid'=>$userid, ':followerid'=>$followerid));
			}
			else
			{
				echo 'Already following';
			}
			$isFollowing=True;
		}
		}
		if(isset($_POST['unfollow']))
		{
				if($userid != $followerid){	
			if(db::query('SELECT follower_id FROM followers WHERE user_id=:userid',array('userid'=>$userid)))
			{
				db::query('DELETE FROM followers WHERE user_id=:userid AND follower_id=:followerid',array(':userid'=>$userid, ':followerid'=>$followerid));
			}
			
			$isFollowing=False;}
		}
		
		
		if(db::query('SELECT follower_id FROM followers WHERE user_id=:userid',array('userid'=>$userid)))
			{
				$isFollowing=True;	
				//echo 'Already following';
			}
			

	}

		else
		{
			die('User not found');
		}
	}

?>
<h1><?php echo $username; ?> 's Profile</h1>
<form action="profile.php?username=<?php echo $username; ?>"  method ="post">
<?php
if($userid != $followerid){	
if($isFollowing == True)
{
	echo'<input type="submit" name="unfollow" value="unfollow">';
}
else
{
	echo'<input type="submit" name="follow" value="follow">';
}}
?>
</form>