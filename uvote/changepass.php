<?php
session_start();
require('connection.php');


if(empty($_SESSION['member_id'])){
 header("location:access-denied.php");
} 

$result=mysqli_query($con, "SELECT * FROM tbMembers WHERE member_id = '$_SESSION[member_id]'");
if (mysqli_num_rows($result)<1){
    $result = null;
}
$row = mysqli_fetch_array($result);
if($row)
 {

 $stdId = $row['member_id']; 
  $encpass= $row['password'];
}
?>
<?php

if (isset($_POST['changepass'])){
$myId =  $_REQUEST['id'];
$oldpass = md5($_POST['oldpass']);
$newpass = $_POST['newpass'];
$conpass = $_POST['conpass'];
if($encpass == $oldpass)
{
  if($newpass == $conpass)
  {
    $newpassword = md5($newpass);
    $sql = mysqli_query($con,"UPDATE tbmembers SET password='$newpassword' WHERE member_id = '$myId'" );
    echo "<script>alert('Password Change')</script>";
  }
  else
  {
    echo "<script>alert('New and Confirm Password Not Match')</script>";
  }

}
else
{
    echo "<script>alert('Old password not match')</script>";
}



}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Student Profile Management</title>
<link href="css/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/user.js">
</script>
</head>
<body bgcolor="tan">
     
<center><b><font color = "brown" size="6">Faculty Voting System</font></b></center><br><br>
<div id="page">
<div id="header">
  <h1>MANAGE MY PROFILE</h1>
  <a href="student.php">Home</a> | <a href="vote.php">Current Polls</a> | <a href="manage-profile.php">Manage My Profile</a> | <a href="changepass.php">Change Password</a>| <a href="logout.php">Logout</a>
</div>
<div id="container">
<table border="0" width="620" align="center">
<CAPTION><h3>CHANGE PASSWORD</h3></CAPTION>
<form action="changepass.php?id=<?php echo $_SESSION['member_id']; ?>" method="post">
<table align="center">
<tr><td>Old Password:</td><td><input type="password" style="background-color:#999999; font-weight:bold;" name="oldpass" maxlength="5" value=""></td></tr>
<tr><td>New Password:</td><td><input type="password" style="background-color:#999999; font-weight:bold;" name="newpass" maxlength="5" value=""></td></tr>
<tr><td>Confirm New Password:</td><td><input type="password" style="background-color:#999999; font-weight:bold;" name="conpass" maxlength="15" value=""></td></tr>
<tr><td>&nbsp;</td></td><td><input type="submit" name="changepass" value="Update Profile"></td></tr>
</table>
</form>
<hr>
</div>
<div id="footer"> 
  <div class="bottom_addr">&copy; Designed by group 7</div>
</div>
</div>
</body>
</html>