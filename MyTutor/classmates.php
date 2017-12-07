<?php
$classmates=queryMysql("SELECT * FROM student_course JOIN user ON user.id=student_course.student JOIN student ON student.id=user.id WHERE course=$cid");

if ($classmates->num_rows) {
	while ($classrow=$classmates->fetch_array(MYSQLI_ASSOC)) {
	
	}
} else {
 echo('<h1 class="error">Sorry:( No classmates have joined this class Yet!!:)</h1>');
}


?>
