<?php
     require_once 'header.php';			
if (isset($_POST['assignment'])) {
      $assignment=sanitizeString($_POST['assignment']);
      $created=time();
      $result=queryMysql("INSERT INTO assignment(course,question,created) VALUES($courseid,'$assignment',$created)");
      if ($result) {
      	echo("assignment_success");
      }else{
      	echo "assignment_failed";
      }
}




?>