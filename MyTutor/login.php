<?php
session_start();
require_once 'utils.php';
$username=""; //holds user unique identification entry to the user table
$password=""; //unencrypted password
$usertype=""; //user type

if (isset($_POST['username'])&&isset($_POST['password'])&& isset($_POST['usertype'])) {
	$username=sanitizeString($_POST['username']);
	$password=sanitizeString($_POST['password']);
	$usertype=sanitizeString($_POST['usertype']);

	if ($username==""||$password=="") {
		echo '<span style="color:#ff0000">&nbsp;&#x2718;username and/or password empty:-(</span>';
	}else{
		$password=md5($password);
		$query="SELECT * FROM user WHERE user.user_number='$username' AND user.hashed_password='$password'";
		//echo $query;
		$tryuser=queryMysql($query);
		
		if ($tryuser->num_rows) {
			//user exists login successful
			$_SESSION['username']=$username;
			$_SESSION['usertype']=$usertype;
			if ($usertype=="student") {
    					$myrow=$tryuser->fetch_array(MYSQLI_ASSOC);
						$id=$myrow['id'];
						$myquery=queryMysql("SELECT * FROM student WHERE student.id=$id");
						if ($myquery->num_rows) {
							echo("student_success");
						}
					} 

			else if ($usertype=="tutor") {
								$myrow=$tryuser->fetch_array(MYSQLI_ASSOC);
								$id=$myrow['id'];
								$mcourse=0;
								$myquery1=queryMysql("SELECT * FROM tutor WHERE tutor.id=$id");
								$myrow=$myquery1->fetch_array(MYSQLI_ASSOC);
								$mcourse=$myrow['course'];
								$myquery2=queryMysql("SELECT * FROM course WHERE course.id=$mcourse");
								$myrow=$myquery2->fetch_array(MYSQLI_ASSOC);
								$mcoursecode=$myrow['code'];

								if ($myquery1->num_rows) {
                                      if ($mcourse==0) {
                                      echo "tutor_successful_without_class";
                                      }else{
                                      	$_SESSION['course']=$mcoursecode;
                                      	echo("tutor_successful_with_class");
                                      }
								}
								
				
			}
		} else {
			//username or password incorrect
			echo '<span style="color:#ff0000">&nbsp;&#x2718;username and/or password incorrect:-(</span>';
		}
		
	}
}else{
	echo '<span style="color:#ffff00">&nbsp;&#x2718;username and/or password NOT SET:-(</span>';
}

?>