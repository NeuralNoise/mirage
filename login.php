<?php
session_start();
{
	include("database.php");
if(isset($_POST['user_email']) && isset($_POST['user_password'])) {
$user_email=mysql_real_escape_string($_POST['user_email']);
$user_password=mysql_real_escape_string($_POST['user_password']);
											   
$errmsg_arr = array();
$errflag = false;

if($user_email == '') {
		$errmsg_arr[] = 'Email Id missing';
		$errflag = true;
	}
	if($user_password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php?error=1;");
		exit();
	}
	$pass=$_POST['user_password'];
	$qry="SELECT * FROM user WHERE email='$user_email' AND password='$pass' ";
	$result=mysql_query($qry);
	
	
	if($result) {
		if(mysql_num_rows($result) >0) {
			$member = mysql_fetch_array($result);
			$_SESSION['SESS_MEMBER_ID'] = $member['first_name']."  ".$member['last_name'];
			$_SESSION['SESS_MEMBER_PASS']=$member['password'];
			$_SESSION['SESS_MEMBER_EMAIL']=$member['email'];
			$qry="update user set status='1' WHERE email='$user_email' AND password='$pass' ";
			mysql_query($qry);
		
			header("location:index.php");
			
}
		else
			
			header("location: index.php?error=1");	
		
		}
		
		else {
			
			
			
			header("location: index.php?error=1");
			
		}
	}else {
		die("Query failed");
	}
	

}
 
?>
