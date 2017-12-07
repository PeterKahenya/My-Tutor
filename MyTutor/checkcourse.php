<?php
    	require_once 'utils.php';
if (isset($_POST['code'])) {
	$code=$_POST['code'];
	$result=queryMysql("SELECT * FROM course WHERE course.code='$code'");
    	if ($result->num_rows && $code!="")
         echo "<span class='taken'>&nbsp;&#x2718;This course is alredy Exists</span>";
     else
echo "<span class='available'>&nbsp;&#x2714; Accepted</span>";
}

    	
  ?>