<?php
require_once'utils.php';
$action=$_GET['action'];

switch ($action) {
	case 'delete_user':
	    $id=$_GET['uid'];
		$res=queryMysql("DELETE FROM user WHERE user.id=$id");
		if ($res) {
			header("Location:dashboard.php");
		} else {
			echo "<h1>Error deleting User</h1>";
		}
		
		break;
	case 'delete_message':
		$id=$_GET['pid'];
		$res=queryMysql("DELETE FROM post WHERE post.id=$id");
		if ($res) {
			header("Location:dashboard.php");
		} else {
			echo "<h1>Error deleting User</h1>";
		}
		
		break;
     case 'delete_discussion':
        $id=$_GET['did'];
		$res=queryMysql("DELETE FROM discussion WHERE discussion.id=$id");
		if ($res) {
			header("Location:dashboard.php");
		} else {
			echo "<h1>Error deleting User</h1>";
		}
		
		break;
		case 'delete_notes':
		$id=$_GET['nid'];
		$res=queryMysql("DELETE FROM note WHERE note.id=$id");
		if ($res) {
			header("Location:dashboard.php");
		} else {
			echo "<h1>Error deleting User</h1>";
		}
		
		break;
		case 'delete_assignment':
		$id=$_GET['aid'];
		$res=queryMysql("DELETE  FROM assignment WHERE assignment.id=$id");
		if ($res) {
			header("Location:dashboard.php");
		} else {
			echo "<h1>Error deleting assignment</h1>";
		}
		
		break;
	default:

			break;
}





?>