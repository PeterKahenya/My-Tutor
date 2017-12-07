<?php
require_once 'header.php';
$action="";
$sender=$userid;
$discussionid=0;
$message="";




if (isset($_POST['discussionid'])) {
	$discussionid=sanitizeString($_POST['discussionid']);
	$_SESSION['discussionid']=$discussionid;
}else{
	if (isset($_SESSION['discussionid'])) {
		$discussionid=$_SESSION['discussionid'];
			}
}

//actions are join,start,post,showposts,showdiscussions
	if (isset($_POST['action'])) {
	$action=$_POST['action'];
	switch ($action) {
		case 'joinDiscussion':
			joinDiscussion();
			break;
		case 'startDiscussion':
			startDiscussion();
			break;
		case 'post':
			post();
			break;
		case 'showposts':
			showposts();
			break;
		case 'showdiscussions':
			showdiscussions();
			break;
		default:
			
			break;
	}
}





function startDiscussion(){
	$courseid=$_SESSION['courseid'];
	global $userid;
	$subject=sanitizeString($_POST['subject']);
	$created=time();
	$quer="INSERT INTO discussion(subject,created,course,moderator) VALUES('$subject',$created,$courseid,$userid)";
	$resp=queryMysql($quer);
	$resp1=queryMysql("SELECT * FROM discussion ORDER BY created DESC LIMIT 1");
	$row=$resp1->fetch_array(MYSQLI_ASSOC);
	$discussionid=$row['id'];
	$_SESSION['discussionid']=$discussionid;
     
	if ($resp && $resp1) {
		echo '1';
	} else {
		echo '0';
			}
	
}

function post()
{    global $discussionid;
	 global $sender;
	 global $isTutor;
	$message=$_POST['message'];
	$created=time();
	$newq="INSERT INTO discussion_post(mtext,created,discussion,sender,isTutor) VALUES('$message',$created,
		$discussionid,$sender,$isTutor)";
	$resp=queryMysql("INSERT INTO discussion_post(mtext,created,discussion,sender) VALUES('$message',$created,
		$discussionid,$sender)");
	if ($resp) {
		echo $sender;
	} else {
		echo '';
	}
	
}

function showposts()
{
	global $discussionid;
	$myquery="SELECT * FROM discussion_post JOIN discussion ON discussion_post.discussion=discussion.id  JOIN user ON user.id=discussion_post.sender JOIN student WHERE discussion.id=$discussionid GROUP BY discussion_post.id ORDER BY discussion_post.created ";
	$posts=queryMysql($myquery);
	$output=array();
	$output=$posts->fetch_all(MYSQLI_ASSOC);
	echo json_encode($output);
}

function showdiscussions()
{
	//get all your discussions where you are a participant
	$result=queryMysql("SELECT * FROM discussion JOIN discussion_member ON discussion.id=discussion_member.discussion WHERE  discussion.course=$courseid");
	$output=array();
	$output=$result->fetch_all(MYSQLI_ASSOC);
	echo json_encode($output);
}

function joinDiscussion()
{
	 $discussionid=$_SESSION['discussionid'];
	global $userid;
	//add your id to discussion member
   $resp=queryMysql("INSERT INTO discussion_member(discussion,member) VALUES ($discussionid,$userid)");
    if ($resp) {
    	echo '1';
    } else {
    	echo '0';
    }
    
}




?>