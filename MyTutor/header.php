<?php
  session_start();
  require_once 'utils.php';
  
  if (isset($_SESSION['username'])) {
            $loggedin=TRUE;
            //get the userid of the logged user
            $user=$_SESSION['username'];
            $reslt=queryMysql("SELECT * FROM user WHERE user.user_number='$user'");
            $row=$reslt->fetch_array(MYSQLI_ASSOC);
            $userid=$row['id'];
            if ($_SESSION['usertype']=="student") {
   	         $usertype="student";
             $isTutor='0';
                if (isset($_SESSION['course'])) {
                  $courseChosen=TRUE;
                        } else {
                  $courseChosen=FALSE;
                                }
   } else {
            $usertype="tutor";
            $isTutor='1';      
   }
  }
  else{
  	$loggedin=FALSE;
  }



if (isset($_POST['course'])) {
  $_SESSION['course']=$_POST['course'];
  $course=$_POST['course'];
}else if(isset($_SESSION['course'])){
  $course=$_SESSION['course'];
}
//set courseid chosen
                  $reslt=queryMysql("SELECT * FROM course WHERE course.code='$course'");
                  $row=$reslt->fetch_array(MYSQLI_ASSOC);
                  $courseid=$row['id'];
                  $cname=$row['name'];
                  $_SESSION['courseid']=$courseid;
?>