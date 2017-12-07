<?php
session_start();
require_once 'utils.php';
$fname = "";
$lname = "";
$admNo = "";
$pass  = "";
$usertype="";
$userid=0;



//ge the post parameters
if (isset($_POST['admNo'])&&isset($_POST['pass'])&&isset($_POST['fname'])&&isset($_POST['lname']))
{
$fname = sanitizeString($_POST['fname']);
$lname = sanitizeString($_POST['lname']);
$admNo = sanitizeString($_POST['admNo']);
$pass  = sanitizeString($_POST['pass']);
$usertype=sanitizeString($_POST['usertype']);





//authentication
if ($fname == "" ||  $lname == ""||  $admNo == ""||  $pass == ""){
	echo '<span style="color:#ff0000;float:left;left:0px; font-size=8px;">&nbsp;&#x2718;All fields must be filled!!</span>';
}
else{
   $pass=md5($pass);
  $res=queryMysql("SELECT * FROM user WHERE user.user_number='$admNo'");
  if ($res->num_rows) {
  	 echo '<span style="color:#ff0000">&nbsp;&#x2718;Admission number already exists:-(</span>';
  }else{
 queryMysql("INSERT INTO user(user_number,hashed_password) VALUES('$admNo','$pass')");
 $result=queryMysql("SELECT * FROM user WHERE user.user_number='$admNo'");
 $row=$result->fetch_array(MYSQLI_ASSOC);
 $id=$row['id'];
 $userid=$id;
 $_SESSION['userid']=$userid;

 $result1=queryMysql("INSERT INTO $usertype(id,first_name,last_name) VALUES($id,'$fname','$lname')");
 if ($result1) {
 	if ($usertype=="student") {
 		echo('student');
 	} else {
 		echo('tutor');
 	}
 	
 } else {
 	 echo '<span style="color:#ff0000">&nbsp;&#x2718;:-(It Might Be us please try again later</span>';
 }
}
}
}








if ($_FILES)
{
	
	foreach ($_FILES['files']['error'] as $key => $error) {
		if ($error==UPLOAD_ERR_OK) {
			 $userid=$_SESSION['userid'];
			$name=$_FILES['files']['name'][$key];
			move_uploaded_file($_FILES['files']['tmp_name'][$key], "profilepics/".$userid.".jpg");
			$uploaded=time();
		}
	}
	echo("done...");
	
}




?>