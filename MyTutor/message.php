<?php
require_once 'header.php';
$action="";
$sender=$userid;
$receiver="";
$message="";
$courseid=$_SESSION['courseid'];

if (isset($_POST['receiver']) && isset($_POST['action'])) {
	$receiver=sanitizeString($_POST['receiver']);
	$action=sanitizeString($_POST['action']);
	if ($action=="send") {
		$message=sanitizeString($_POST['message']);
		if ($message!="") {
			$created=time();

			$sendresult=queryMySql("INSERT INTO post(mtext,created,sender,receiver,course,isTutor) VALUES('$message',$created,$sender,$receiver,$courseid,$isTutor)");
			if ($sendresult) {
				echo $userid;
		}
		else{
			echo("failed");
		}
	}
	} else {
		$courseid=$_SESSION['courseid'];
		$query="SELECT * FROM post WHERE post.sender=$receiver AND post.receiver=$userid OR post.sender=$userid AND 
		        post.receiver=$receiver  AND post.course=$courseid ORDER BY created DESC";
		$result=queryMySql($query);
		$output=array();
		$output=$result->fetch_all(MYSQLI_ASSOC);
		echo json_encode($output);

	}
	
	
}
if ($_FILES)
{
	
	foreach ($_FILES['files']['error'] as $key => $error) {
		if ($error==UPLOAD_ERR_OK) {
			$name=$_FILES['files']['name'][$key];
			move_uploaded_file($_FILES['files']['tmp_name'][$key], "notes/".$name);
			$uploaded=time();
            $insres=queryMySql("INSERT INTO note(course,notes,uploaded) VALUES($courseid,'$name',$uploaded)");
            if($insres){
            	echo($name." successfully uploaded");
            }
		}
	}
	echo("done...");
	
}



?>