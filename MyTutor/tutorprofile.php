<?php
require_once 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tutor|Profile</title>
  <link rel="stylesheet" type="text/css" href="css/tutorprofile.css">
	<link rel="stylesheet" type="text/css" href="css/messagingmodal.css">
	   <link rel="stylesheet" type="text/css" href="css/material.min.css">
	   <link rel="stylesheet" type="text/css" href="css/MaterialIcons-Regular.woff">
   <script type="text/javascript" src="js/material.js"></script>
</head>
<style type="text/css">
	@font-face{
		font-family: 'Material Icons';
		font-style: normal;
		font-weight: 400;
		src:url('css/MaterialIcons-Regular.woff');
	}
	.mytutor-chip .mdl-chip__contact {
        background-image: url("./profilepics/3.jpg");
        background-size: cover;
    }
    .mytutor-list-three {
  width: 650px;
}

</style>
<body style="background-color: #ccc;">
<!-- Simple header with fixed tabs. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--fixed-tabs" style="background-color: #ccc;">
  <header class="mdl-layout__header" style="background-color: #399c5c;">
    <div class="mdl-layout__header-row" style="background-color: #399c5c;">
      <!-- Title -->
      <span class="mdl-layout-title">MyTutor<?php echo "-".$cname;?></span>
    </div>
    <!-- Tabs -->
    <div class="mdl-layout__tab-bar mdl-js-ripple-effect" style="background-color: #399c5c;">
      <a href="#classmates" class="mdl-layout__tab is-active">Class</a>
      <a href="#fixed-tab-2" class="mdl-layout__tab"><span class="mdl-badge" data-badge="4">notifications</span></a>
      <a href="#fixed-tab-3" class="mdl-layout__tab">discussions</a>
      <a href="#fixed-tab-4" class="mdl-layout__tab">notes</a>
    </div>
  </header>
  <div class="mdl-layout__drawer" style="background-color: #ccc; color: #009688;">
    <span class="mdl-layout-title profile"><?php showProfile($userid,"tutor",""); ?></span>
     <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="#" onclick="newAssignment()" style=" color: #009688;"><li class="mdl-list__item" style="padding: 2px;">
    <span class="mdl-list__item-primary-content">
    <i class="material-icons mdl-list__item-icon">create</i>
    New Assignment
</span>
  </li></a>
  <a class="mdl-navigation__link" href="#" onclick="showAssignments()" style=" color: #009688;" ><li class="mdl-list__item" style="padding: 2px;cursor: pointer;">
    <span class="mdl-list__item-primary-content">
    <i class="material-icons mdl-list__item-icon">subject</i>
    Other Assignments
</span>
  </li></a>
      <a class="mdl-navigation__link" href="#" style="color: #009688;"><li class="mdl-list__item" style="padding: 2px;" onclick="startDiscussion()">
    <span class="mdl-list__item-primary-content">
    <i class="material-icons mdl-list__item-icon">create</i>
    New Discussion
</span>
  </li></a>
      <a class="mdl-navigation__link" href="#" onclick="showAllDiscussions()" style=" color: #009688;" ><li class="mdl-list__item" style="padding: 2px;cursor: pointer;">
    <span class="mdl-list__item-primary-content">
    <i class="material-icons mdl-list__item-icon">subject</i>
    Other Discussions
</span>
  </li></a>
      <a class="mdl-navigation__link logout" href="logout.php" style=" color: #009688;"><li 
      class="mdl-list__item" style="padding: 2px;">
    <span class="mdl-list__item-primary-content">
    <i class="material-icons mdl-list__item-icon">exit_to_app</i>
    Log out
</span>
  </li></a>
  <a class="mdl-navigation__link logout" href="help-privacy.php#help" style=" color: #009688;"><li 
  class="mdl-list__item" style="padding: 2px;">
    <span class="mdl-list__item-primary-content">
    <i class="material-icons mdl-list__item-icon">help</i>
    Help
</span>
  </li></a>
    </nav>
  </div>
  <main class="mdl-layout__content">
    <section class="mdl-layout__tab-panel is-active"  style="background-color: #ccc;height: 100%;" id="classmates">
      <div class="page-content" style="width: 50%; margin-left: 25%; background-color: #fff;">
      <!-- Your content goes here -->
 <?php
 $cid=$_SESSION['courseid'];
 $classmates=queryMysql("SELECT student,first_name,last_name,user_number FROM student_course JOIN user ON user.id=student_course.student JOIN student ON student.id=user.id WHERE student_course.course=$courseid");
if ($classmates->num_rows) {
	while ($classrow=$classmates->fetch_array(MYSQLI_ASSOC)) {
		$classmid=$classrow['student'];
		$first_name=$classrow['first_name'];
		$last_name=$classrow['last_name'];
		$user_number=$classrow['user_number'];
    $picpath="profilepics/".$classmid.".jpg";
		if ($classmid!=$userid) {	
echo <<<_END
<li class="mdl-list__item mdl-list__item--two-line" style="border-bottom:5px solid #ccc;">
    <span class="mdl-list__item-primary-content">
      <img src=$picpath class="classmateprofile"/>
      <span>$first_name $last_name</span>
    </span>
    <span class="mdl-list__item-secondary-content">
      <a class="mdl-list__item-secondary-action" href="#" onclick="x($classmid,$userid)"><i class="material-icons">textsms</i></a>
      <a class="mdl-list__item-secondary-action" href="#" onclick="vidchat('$first_name  $last_name')"><i class="material-icons">videocam</i></a>
    </span>
  </li>
_END;
	}
	}
} else {
 echo('<h1 class="error">Sorry:( No classmates have joined this class Yet!!:)</h1>');
}
?>
      </div>
    </section>












<!--The notifications tab-->

    <section class="mdl-layout__tab-panel" id="fixed-tab-2" style="background-color: #ccc; height: 100%;">
      <div class="page-content" style="width: 60%;margin-left: 20%;background-color: #fff; "><ul class="mdl-list" style="margin: 0;">
      <!-- Your content goes here -->
      	<?php
$query="SELECT * FROM post JOIN student ON post.sender=student.id WHERE post.receiver=$userid AND post.course=$courseid GROUP BY sender ORDER BY created DESC";
$notifications=queryMysql($query);
if ($notifications->num_rows) {
	while ($classrow=$notifications->fetch_array(MYSQLI_ASSOC)) {
		$senderid=$classrow['sender'];
		$first_name=$classrow['first_name'];
		$last_name=$classrow['last_name'];		
    $sendt=$classrow['created'];
    $message=$classrow['mtext'];
        $picpath="profilepics/".$senderid.".jpg";
echo 
<<<_END
 <li class="mdl-list__item mdl-list__item--three-line" style="border-bottom:2px solid #ccc;"> 
    <span class="mdl-list__item-primary-content">
      <i class="material-icons  mdl-list__item-avatar" style="color:#009688;background-color:#fff;" >face</i>
      <span>$first_name $last_name       <span>$sendt</span></span>
      <span class="mdl-list__item-text-body">
       $message
      </span>
    </span>
    <span class="mdl-list__item-secondary-content">

      <a class="mdl-list__item-secondary-action" onclick="vidchat()" href="#"><i class="material-icons" style="color:#009688;">videocam</i></a>
      <a class="mdl-list__item-secondary-action" href="#"><i class="material-icons" style="color:#009688;" onclick="x($senderid,$userid)">textsms</i></a>
    </span>
  </li>
_END;

	}
} else {
 echo("notifications empty");
}
?></ul>
      </div>
    </section>
    





<!--Discussions tab-->
    <section class="mdl-layout__tab-panel" id="fixed-tab-3" style="background-color: #ccc; height: 100%;">
      <div class="page-content" style="width: 60%;margin-left: 20%;background-color: #fff; ">
      <ul class="mdl-list" style="margin: 0;">
      <!-- Your content goes here -->
      	<?php
$query="SELECT * FROM discussion_post JOIN user ON user.id=discussion_post.sender JOIN student ON student.id=user.id JOIN discussion GROUP BY discussion_post.discussion ORDER BY discussion_post.created DESC";
$discussionsquery=queryMysql($query);
$number=$discussionsquery->num_rows;
if ($discussionsquery->num_rows) {
	while ($classrow=$discussionsquery->fetch_array(MYSQLI_ASSOC)) {
		$senderid=$classrow['sender'];
    $discussion=$classrow['discussion'];
		$first_name=$classrow['first_name'];
		$last_name=$classrow['last_name'];	
    $sendt=$classrow['created'];
    $message=$classrow['mtext'];	
        $picpath="profilepics/".$senderid.".jpg";
         echo <<<_END
         <li class="mdl-list__item mdl-list__item--three-line" style="border-bottom:2px solid #ccc;"> 
    <span class="mdl-list__item-primary-content">
      <i class="material-icons  mdl-list__item-avatar" style="color:#009688;background-color:#fff;" >face</i>
      <span>$first_name $last_name       <span>$sendt</span></span>
      <span class="mdl-list__item-text-body">
       $message
      </span>
    </span>
    <span class="mdl-list__item-secondary-content">
      <a class="mdl-list__item-secondary-action" href="#"><i class="material-icons" style="color:#009688;" onclick="showAllPosts($discussion)">textsms</i></a>
    </span>
  </li>
_END;
	}
} else {
 echo('<h1 class="error">Sorry:-( No Messages Yet have joined this class Yet!!:)</h1>');
}
?>     	</ul>
      </div>
    </section>


     <section class="mdl-layout__tab-panel" id="fixed-tab-4" style=" background-color: #ccc;">
      <div class="page-content" style="width: 50%; margin-left: 25%; background-color: #fff;">
      <!-- Your content goes here -->
      	<?php
        echo
<<<_END

<!-- Accent-colored raised button with ripple -->
<form method="POST" id="uploadform" enctype="multipart/form-data">
<input type="file" id="myFile" name="notes" multiple/>
<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" onclick="uploadFiles(this)" id="upload" >
  Upload
</button>
</form>

_END;

?>
       <?php
        $result=queryMysql("SELECT * FROM note WHERE note.course=$courseid ORDER BY uploaded DESC");
        if ($result->num_rows) {
        while ($notes=$result->fetch_array(MYSQLI_ASSOC)) {
                $basename=$notes['notes'];
                $ext="";
                $p = preg_match("/.pdf/i", $basename);
                if ($p!=0) {
                   $ext="pdf"; 
                }
                $pp=preg_match("/.pptx/i", $basename);
                if ($pp!=0) {
                    $ext="pptx";
                }
                $docs=preg_match("/.doc/i", $basename);
                if ($docs!=0) {
                    $ext="doc";
                }
                $docx=preg_match("/.docx/i", $basename);
                if ($docx!=0) {
                    $ext="docx";
                }
                $value="/notes/".$basename;
            switch ($ext) {
              case 'pdf':
                 echo <<<_END
                 <div class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
      <a class="mdl-list__item-secondary-action"  style="color:#ff0000;" href="#"><i class="material-icons">picture_as_pdf</i></a>
      <span>$basename</span>
    </span>
    <a class="mdl-list__item-secondary-action" href="#"><i class="material-icons">hdr_strong</i></a>
    <a class="mdl-list__item-secondary-action" href="$value" target="#"><i class="material-icons">get_app</i></a>
  </div>
_END;
              
                break;
              case 'doc':case 'docx':

                 echo <<<_END
                 <div class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
      <a class="mdl-list__item-secondary-action"  style="color:#0011f0;" href="#"><i class="material-icons">insert_drive_file</i></a>
      <span>$basename</span>
    </span>
    <a class="mdl-list__item-secondary-action" href="#"><i class="material-icons">hdr_strong</i></a>
    <a class="mdl-list__item-secondary-action" href="$value" target="#"><i class="material-icons">get_app</i></a>
  </div>
_END;
              break;
          case 'pptx':
                 echo <<<_END
                 <div class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
      <a class="mdl-list__item-secondary-action"  style="color:#ffc000;" href="#"><i class="material-icons">slideshow</i></a>
      <span>$basename</span>
    </span>
    <a class="mdl-list__item-secondary-action" href="#"><i class="material-icons">hdr_strong</i></a>
    <a class="mdl-list__item-secondary-action" href="$value" target="#"><i class="material-icons">get_app</i></a>
  </div>
_END;
break;


              default:
                echo($ext);
                break;
            }
          }
        }else{
          echo "<h1>No Courses uploaded just yet";
        }

?>     	
      </div>
    </section>

  </main>
</div>


<!-- The startDiscussionModal Modal -->
<div id="startDiscussionModal" class="modal">
    <div class="chatbox">
<form>
  <div class="mdl-textfield mdl-js-textfield">
    <textarea class="mdl-textfield__input" type="text" rows= "5" id="subject" ></textarea>
    <label class="mdl-textfield__label" for="subject">Enter First Post for the new Discussion...</label>
  </div>
</form>
<button id="startDiscussionButton"  class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
  Post
</button>
</div>
</div>

<!-- The Assignments Modal -->
<div id="assignmentsmodal" class="modal">
    <div class="chatbox">
<form>
  <div class="mdl-textfield mdl-js-textfield">
    <textarea class="mdl-textfield__input" type="text" rows= "5" cols="10" id="topic" ></textarea>
    <label class="mdl-textfield__label" for="subject">Enter The Assignment Question</label>
  </div>
</form>
<button  onclick="createNewAssignment();"  class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
  Start
</button>
</div>
</div>

<!-- The DiscussionPosts Modal -->
<div id="allassignmentsModal" class="modal" style="display: none;">

  <!-- Modal content -->
    <div class="chatbox" style="padding: 5px;width: 600px;height: 550px;">
    <div><span id="receivername"></span><a href="#" onclick="document.getElementById('allassignmentsModal').style.display='none';" style="float: right;top: 0;"><i class="material-icons">close</i></a>
  <ul id="allassignments"  style="width:95%;padding: 10px;height: 350px;border:none;overflow-x: hidden;overflow-y: scroll;">
    <?php
    $res=queryMysql("SELECT * FROM assignment WHERE assignment.course=$courseid ORDER BY created DESC");
   if ($res->num_rows) {
   while ($row=$res->fetch_array(MYSQLI_ASSOC)) {
            $id=$row['id'];
            $quiz=$row['question'];
            $created=$row['created'];

echo<<<_END
 <li class="mdl-list__item mdl-list__item--three-line">
    <span class="mdl-list__item-text-body">$quiz</span>
    </li>
_END;
     }
   } else {
    echo '<h5>No assignments currently<i class="material-icons">mood_bad</i></h5>';
   }    
    ?>
    </ul>
    </div>
</div>
</div>




<!-- The allDiscussionsModal Modal -->
<div id="allDiscussionsModal" class="modal" style="display: none;">

  <!-- Modal content -->
    <div class="chatbox" style="padding: 5px;width: 600px;height: 550px; overflow-y: scroll;">
    <?php
    $result=queryMysql("SELECT * FROM discussion WHERE  discussion.course=$courseid");

    while ($row=$result->fetch_array(MYSQLI_ASSOC)) {
           $discussionid=$row['id'];
           $subject=$row['subject'];
           $moderator=$row['moderator']; 
           $created=$row['created'];
           echo <<<_END
<div class="demo-list-action mdl-list">
  <div class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
      <i class="material-icons mdl-list__item-avatar" style="background-color:#008080;">forum</i>
      <span>$subject</span>
    </span>
    <a class="mdl-list__item-secondary-action" href="#"><i class="material-icons" onclick="joinDiscussion($discussionid)">card_membership</i></a>
  </div>
</div>



_END;
    }
?>
</div>
</div>

<!-- The DiscussionPosts Modal -->
<div id="allPostsModal" class="modal" style="display: none;">

  <!-- Modal content -->
    <div class="chatbox" style="padding: 5px;width: 600px;height: 550px;">
    <ul id="discusslog"  style="width:95%;padding: 10px;height: 350px;border:none;overflow-x: hidden;overflow-y: scroll;">
    </ul>
    <div  style="margin-bottom: 10px;display: flex;align-items: flex-start; padding-left: 10px;">
    <div class="mdl-textfield mdl-js-textfield">
    <textarea class="mdl-textfield__input" type="text" cols="15" rows="5" id="myText" ></textarea>
    <label class="mdl-textfield__label" for="myText">Text lines...</label>
    </div>
    <button onclick="sendDiscussionPost()" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
      Send
    </button>
    </div>

    </div>
    </div>

<!-- The Video Modal -->
<div class="modal" id="videochatmodal">

  <!-- Modal content -->
<div style="background-color: #009688; color: #fff;" class="videocontent">
  <h4>MyTutor|Video</h4>

  <video id="localVideo" autoplay></video>
  <video id="remoteVideo" autoplay></video>

  <div>
    <button id="startButton" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="start()">Start</button>
    <button id="callButton" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">Call</button>
    <button id="hangupButton" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">Hang Up</button>
  </div>
</div>
</div>

<!-- The Chat Modal -->
<div id="chatmodal" class="modal">

  <!-- Modal content -->
    <div class="chatbox">
    <div id="chatlogs" class="chatlogs">
    </div>
    <div class="chatform">
    	<textarea id="chattext">
    	</textarea>
    	<button id="sendbtn" onclick="sendMessage(this)" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">Send</button>
    </div>
   	
</div>
</div>

<script type="text/javascript" src="js/tutorprofile.js"></script>
<script type="text/javascript" src="js/lib/adapter.js"></script>
<script type="text/javascript" src="js/videochat.js"></script>
</body>
</html>