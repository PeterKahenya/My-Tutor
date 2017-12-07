<?php
require_once 'utils.php';
$courses=queryMysql("SELECT * FROM course");

while ($courserow=$courses->fetch_array(MYSQLI_ASSOC)) {
	$coursecode=$courserow['code'];
	$cname=$courserow['name'];
	echo("<h4>$coursecode - $cname</h4>");
}

?>