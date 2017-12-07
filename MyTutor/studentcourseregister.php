<?php
	require_once 'header.php';

//constants
$success="SUCCESSFULL";
$failed="FAILED";
$notall="NOT_ALL_FIELDS_FILLED";
$alreadyReg="ALREADY_REGISTERED";
$user=$_SESSION['username'];

if (isset($_POST['code']))
{
$code = sanitizeString($_POST['code']);

//authentication
if ($code == ""){
echo $notall;
}
else
{
      $course =queryMysql("SELECT id FROM course WHERE code='$code'");
      $myrow=$course->fetch_array(MYSQLI_ASSOC);
      $cid=$myrow['id'];
      $query="SELECT * FROM student_course WHERE student=$userid AND course=$cid";
$result = queryMysql($query);
if ($result->num_rows){
  echo $alreadyReg;
}
else
{
	$myq=queryMysql("SELECT count(course) AS mycount FROM student_course WHERE student=$userid");
	$myrow=$myq->fetch_array(MYSQLI_ASSOC);
      $count=$myrow['mycount'];
      if ($count<=5) {
      queryMysql("INSERT INTO student_course(student,course) VALUES($userid, $cid)");
		echo $success;
		exit();
      } else {
      	echo("Exceeded your maaximum courses");
      	exit();
      }
      

}
}
}
?>