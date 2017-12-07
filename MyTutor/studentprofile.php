<?php
require_once 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>MyStudent|Profile</title>
	<link rel="stylesheet" type="text/css" href="css/messagingmodal.css">
		<link rel="stylesheet" type="text/css" href="css/studentprofile.css">
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
    .mytutor-list-three {
  width: 650px;
}

</style>
<body style="background-color: #ccc;">
<!-- Simple header with fixed tabs. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--fixed-tabs">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">MyTutor<?php echo "-".$cname;?></span>
    </div>
    <!-- Tabs -->
    <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
      <a href="#classmates" class="mdl-layout__tab is-active">classmates<i class="material-icons">group</i></a>
      <a href="#fixed-tab-2" class="mdl-layout__tab">notifications<i class="material-icons">notifications_active</i></a>
      <a href="#fixed-tab-3" class="mdl-layout__tab">discussions<i class="material-icons">forum</i></a>
      <a href="#fixed-tab-4" class="mdl-layout__tab">notes<i class="material-icons">description</i></a>
      <a href="#fixed-tab-5" class="mdl-layout__tab">tutor</a>
    </div>
  </header>
  <div class="mdl-layout__drawer" style="background-color: #ccc; color: #009688;">
    <span class="mdl-layout-title profile"><?php showProfile($userid,"student",""); ?></span>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="#" onclick="showAssignments()" style=" color: #009688;"><li class="mdl-list__item" style="padding: 2px;">
    <span class="mdl-list__item-primary-content">
    <i class="material-icons mdl-list__item-icon">assignment</i>
    Assignments
</span>
  </li></a>
    <a class="mdl-navigation__link" href="student.php?action=newclass" style="color: #009688;"><li class="mdl-list__item" style="padding: 2px;">
    <span class="mdl-list__item-primary-content">
    <i class="material-icons mdl-list__item-icon">more</i>
    Classes
</span>
  </li>
  </a>
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


  <!-- Th classmates tab-->
    <section class="mdl-layout__tab-panel is-active"  style="background-color: #ccc;height: 100%;" 
    id="classmates">
      <div class="page-content" style="width: 50%; margin-left: 25%; background-color: #fff;">
<ul class="mdl-list" style="margin: 0;">
 <?php
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
$query="SELECT * FROM post JOIN student ON post.sender=student.id WHERE post.receiver=$userid AND post.course=$courseid GROUP BY sender ORDER BY created DESC ";
$notifications=queryMysql($query);
if ($notifications->num_rows) {
	while ($classrow=$notifications->fetch_array(MYSQLI_ASSOC)) {
		$senderid=$classrow['sender'];
		$first_name=$classrow['first_name'];
		$last_name=$classrow['last_name'];
    $sendt=date("d/m/y h:i:s",time());
    $message=$classrow['mtext'];
        $picpath="profilepics/".$senderid.".jpg";
echo 
<<<_END
 <li class="mdl-list__item mdl-list__item--three-line" style="border-bottom:2px solid #ccc;"> 
    <span class="mdl-list__item-primary-content">
      <img src=$picpath class="classmateprofile"/>
      <span>$first_name $last_name       <span>$sendt</span></span>
      <span class="mdl-list__item-text-body">
       $message
      </span>
    </span>
    <span class="mdl-list__item-secondary-content">

      <a class="mdl-list__item-secondary-action" onclick="vidchat('$first_name  $last_name')" href="#"><i class="material-icons" style="color:#009688;">videocam</i></a>
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
$query="SELECT * FROM discussion_post JOIN discussion JOIN discussion_member JOIN student WHERE discussion_member.member=$userid AND discussion.course=$courseid GROUP BY discussion.id ";
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
      <img src="profilepics/$senderid.jpg" class="classmateprofile">
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
                 <a href="../../notes/Lecturers contacts.pdf">Notes</a>
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
  echo "<h1> Your Class Material Will be posted here";
}
?>     	
      </div>
    </section>








        <section class="mdl-layout__tab-panel" id="fixed-tab-5" style="background-color: #ccc; height: 100%;">
      <div class="page-content" style="width: 60%;margin-left: 20%;background-color: #fff; "><ul class="mdl-list" style="margin: 0;">
      <!-- Your content goes here -->
      	<?php
  $query="SELECT * FROM post JOIN tutor ON post.sender=tutor.id WHERE post.receiver=$userid AND post.course=$courseid AND post.isTutor='1' ORDER BY created DESC";
$discussionsquery=queryMysql($query);
$number=$discussionsquery->num_rows;
if ($discussionsquery->num_rows) {
	while ($classrow=$discussionsquery->fetch_array(MYSQLI_ASSOC)) {
		$senderid=$classrow['sender'];
		$first_name=$classrow['first_name'];
		$last_name=$classrow['last_name'];	
		$message=$classrow['mtext'];	
    $sendt=$classrow['created'];
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

      <a class="mdl-list__item-secondary-action" onclick="vidchat('$first_name  $last_name')" href="#"><i class="material-icons" style="color:#009688;">videocam</i></a>
      <a class="mdl-list__item-secondary-action" href="#"><i class="material-icons" style="color:#009688;" onclick="x($senderid,$userid)">textsms</i></a>
    </span>
  </li>

_END;
	}

} else {
 echo('<h1 class="error">Sorry:-( No Messages Yet from your Tutor in this class!!:)</h1>');
}
?>     	</ul>
      </div>
    </section>

  </main>
</div>









<!-- The DiscussionPosts Modal -->
<div id="assignmentsModal" class="modal" style="display: none;">

  <!-- Modal content -->
    <div class="chatbox" style="padding: 5px;width: 600px;height: 550px;">
    <div><span id="receivername"></span><a href="#" onclick="document.getElementById('assignmentsModal').style.display='none';" style="float: right;top: 0;"><i class="material-icons">close</i></a>
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








<!-- The startDiscussionModal Modal -->
<div id="startDiscussionModal" class="modal">

  <!-- Modal content -->
    <div class="chatbox">
    <div><span id="receivername"></span><a href="#" onclick="document.getElementById('startDiscussionModal').style.display='none';" style="float: right;top: 0;"><i class="material-icons">close</i></a>
    <div class="mdl-textfield mdl-js-textfield">
    <textarea class="mdl-textfield__input" type="text" id="subject" rows= "3" id="sample5" ></textarea>
    <label class="mdl-textfield__label" for="sample5">Text lines...</label>
  </div>
      <button id="startDiscussionButton" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="">Start
      </button>
    </div>
</div>
</div>





<!-- The allDiscussionsModal Modal -->
<div id="allDiscussionsModal" class="modal">

  <!-- Modal content -->
    <div class="chat-modal-content">
    <div class="chatbox">
    <div><span id="receivername"></span><a href="#" onclick="document.getElementById('allDiscussionsModal').style.display='none';" style="float: right;top: 0;"><i class="material-icons">close</i></a>
    <ul id="allassignments"  style="width:95%;padding: 10px;height: 350px;border:none;overflow-x: hidden;overflow-y: scroll;">
    <?php
    $res=queryMysql("SELECT * FROM discussion");
   if ($res->num_rows) {
   while ($row=$res->fetch_array(MYSQLI_ASSOC)) {
            $id=$row['id'];
            $quiz=$row['subject'];
            $created=$row['created'];
                                                                                                                                                                
echo<<<_END
 <li class="mdl-list__item mdl-list__item--three-line">
    <span class="mdl-list__item-text-body">$quiz</span>
    <button class="mdl-button mdl-button--raised mdl-button--colored mdl-js-button" onclick="joinDiscussion($id)" id="joinDiscussion">JOIN</button>
    </li>
_END;
     }
   } else {
    echo '<h5 style="color:#008080;">'.
    'No discussions currently<i class="material-icons">mood_bad</i></h5>';
   }
    ?>
    </ul>
    </div>
</div>
</div>
</div>




<!-- The DiscussionPosts Modal -->
<div id="allPostsModal" class="modal" style="display: none;">

  <!-- Modal content -->
    <div class="chatbox" style="padding: 5px;width: 600px;height: 550px;">
    <div><span id="receivername"></span><a href="#" onclick="document.getElementById('allPostsModal').style.display='none';" style="float: right;top: 0;"><i class="material-icons">close</i></a>
   </div>
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
   <div><span id="vidreceiver">MyTutor|Video</span><a href="#" onclick="document.getElementById('videochatmodal').style.display='none';" style="float: right;top: 0;"><i class="material-icons">close</i></a>
   </div>

  <video id="localVideo" autoplay></video>
  <video id="remoteVideo" autoplay></video>

  <div>

    <button id="startButton" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" onclick="start()">Start</button>
    <button id="callButton" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Call</button>
    <button id="hangupButton" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Hang Up</button>
  </div>
</div>
</div>

<!-- The Chat Modal -->
<div id="chatmodal" class="modal">
  <!-- Modal content -->
    <div class="chatbox">
    <div><span id="receivername">MyTutor|Video</span><a href="#" onclick="document.getElementById('chatmodal').style.display='none';" style="float: right;top: 0;"><i class="material-icons">close</i></a>
   </div>
    <div id="chatlogs" class="chatlogs">
    </div>
    <div class="chatform">
  <div class="mdl-textfield mdl-js-textfield" style="top: 5px;">
    <textarea class="mdl-textfield__input" type="text" rows= "3" id="chattext" ></textarea>
    <label class="mdl-textfield__label" for="chattext">Type Message Here...</label>
  </div>
      <button id="sendbtn" onclick="sendMessage(this)" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" style="left: 10px;float: left; top: 10px;">Send</button>
    </div>
    
</div>
</div>


<script type="text/javascript" src="js/studentprofile.js"></script>
<script type="text/javascript" src="js/lib/adapter.js"></script>
<script type="text/javascript" src="js/videochat.js"></script>
</body>
</html>