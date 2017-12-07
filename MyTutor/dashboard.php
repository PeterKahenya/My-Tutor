<?php
   require_once 'utils.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin|Dashboard</title>
	     <link rel="stylesheet" type="text/css" href="css/material.min.css">
     <link rel="stylesheet" type="text/css" href="css/MaterialIcons-Regular.woff">
   <script type="text/javascript" src="js/material.js"></script>
   <style type="text/css">
  @font-face{
    font-family: 'Material Icons';
    font-style: normal;
    font-weight: 400;
    src:url('css/MaterialIcons-Regular.woff');
  }

</style>
</head>
<body>
<!-- Simple header with scrollable tabs. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">MyTutor|Admin-Panel</span>
    </div>
    <!-- Tabs -->
    <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
      <a href="#scroll-tab-1" class="mdl-layout__tab is-active">Students</a>
      <a href="#scroll-tab-2" class="mdl-layout__tab">Tutors</a>
      <a href="#scroll-tab-3" class="mdl-layout__tab">Messages</a>
      <a href="#scroll-tab-4" class="mdl-layout__tab">Notes</a>
      <a href="#scroll-tab-5" class="mdl-layout__tab">Discussions</a>
      <a href="#scroll-tab-6" class="mdl-layout__tab">Assignments</a>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Dashboard</span>
    <nav class="mdl-navigation">
    <a class="mdl-navigation__link" href="courses.php">courses</a>
    </nav>
  </div>
  <main class="mdl-layout__content" style="background-color: #ccc;">
    <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1" style="left: 25%;background-color: #ccc;">
      <div class="page-content" style="margin-left: 25%;">
      <div class="demo-list-action mdl-list" style="width: 50%;background-color: #fff;">

      <?php
 $classmates=queryMysql("SELECT * FROM student INNER JOIN user ON student.id=user.id");
if ($classmates->num_rows) {
  while ($classrow=$classmates->fetch_array(MYSQLI_ASSOC)) {
    $classmid=$classrow['id'];
    $first_name=$classrow['first_name'];
    $last_name=$classrow['last_name'];
    $user_number=$classrow['user_number'];
    $picpath="profilepics/".$classmid.".jpg";
echo <<<_END
  <div class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
      <img src="$picpath" style="width: 50px;height: 50px;border-radius: 50%;"/>
      <span>$first_name $last_name</span>
      <span>$user_number</span>
    </span>
    <a class="mdl-list__item-secondary-action" href="adminbackend.php?action=delete_user&uid=$classmid"><i class="material-icons">delete</i></a>

  </div>
_END;
  }
} else {
 echo('<h1 class="error">Sorry:( No classmates have joined this class Yet!!:)</h1>');
}
?>
  </div>
      </div>
    </section>
    <section class="mdl-layout__tab-panel" id="scroll-tab-2">
      <div class="page-content">
      <!-- Your content goes here -->
            <div class="demo-list-action mdl-list" style="width: 50%;background-color: #fff;">

      <?php
 $classmates=queryMysql("SELECT * FROM tutor INNER JOIN user ON tutor.id=user.id");
if ($classmates->num_rows) {
  while ($classrow=$classmates->fetch_array(MYSQLI_ASSOC)) {
    $classmid=$classrow['id'];
    $first_name=$classrow['first_name'];
    $last_name=$classrow['last_name'];
    $user_number=$classrow['user_number'];
    $picpath="profilepics/".$classmid.".jpg";
echo <<<_END
  <div class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
      <img src="$picpath" style="width: 50px;height: 50px;border-radius: 50%;"/>
      <span>$first_name $last_name</span>
      <span>$user_number</span>
    </span>
<a class="mdl-list__item-secondary-action" href="adminbackend.php?action=delete_user&uid=$classmid"><i class="material-icons">delete</i></a>
  </div>
_END;
  }
} else {
 echo('<h1 class="error">Sorry:( No classmates have joined this class Yet!!:)</h1>');
}
?></div>  
      </div>
    </section>
    <section class="mdl-layout__tab-panel" id="scroll-tab-3">
      <div class="page-content"><!-- Your content goes here -->
        
                    <div class="demo-list-action mdl-list" style="width: 50%;background-color: #fff;">

      <?php
 $assignment=queryMysql("SELECT * FROM post ");
if ($assignment->num_rows) {
  while ($assignmentrow=$assignment->fetch_array(MYSQLI_ASSOC)) {
    $mid=$assignmentrow['id'];
    $mtext=$assignmentrow['mtext'];
    $created=$assignmentrow['created'];
echo <<<_END
  <div class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
      $mtext
    </span>
<a class="mdl-list__item-secondary-action" href="adminbackend.php?action=delete_message&pid=$mid">
<i class="material-icons">delete</i></a>
  </div>
_END;
  }
} else {
 echo('<h1 class="error">Sorry:( No classmates have joined this class Yet!!:)</h1>');
}
?></div>
      </div>
    </section>
    <section class="mdl-layout__tab-panel" id="scroll-tab-4">
      <div class="page-content"><!-- Your content goes here -->
                            <div class="demo-list-action mdl-list" style="width: 50%;background-color: #fff;">

      <?php
 $assignment=queryMysql("SELECT * FROM note");
if ($assignment->num_rows) {
  while ($assignmentrow=$assignment->fetch_array(MYSQLI_ASSOC)) {
    $assignmentid=$assignmentrow['id'];
    $quiz=$assignmentrow['notes'];
    $created=$assignmentrow['uploaded'];
echo <<<_END
  <div class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
      $quiz
    </span>
    <span>$created</span>
<a class="mdl-list__item-secondary-action" href="adminbackend.php?action=delete_notes&nid=$assignmentid"><i class="material-icons">delete</i></a>
  </div>
_END;
  }
} else {
 echo('<h1 class="error">Sorry:( No classmates have joined this class Yet!!:)</h1>');
}
?></div>
      </div>
    </section>
    <section class="mdl-layout__tab-panel" id="scroll-tab-5">
      <div class="page-content"><!-- Your content goes here -->
                            <div class="demo-list-action mdl-list" style="width: 50%;background-color: #fff;">

      <?php
 $assignment=queryMysql("SELECT * FROM discussion ");
if ($assignment->num_rows) {
  while ($assignmentrow=$assignment->fetch_array(MYSQLI_ASSOC)) {
    $assignmentid=$assignmentrow['id'];
    $quiz=$assignmentrow['subject'];
    $created=$assignmentrow['created'];
echo <<<_END
  <div class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
      $quiz
    </span>
<a class="mdl-list__item-secondary-action" href="adminbackend.php?action=delete_assignment&aid=$assignmentid"><i class="material-icons">delete</i></a>

  </div>
_END;
  }
} else {
 echo('<h1 class="error">Sorry:( No classmates have joined this class Yet!!:)</h1>');
}
?></div>
      </div>
    </section>
    <section class="mdl-layout__tab-panel" id="scroll-tab-6">
      <div class="page-content"><!-- Your content goes here -->
                            <div class="demo-list-action mdl-list" style="width: 50%;background-color: #fff;">

      <?php
 $assignment=queryMysql("SELECT * FROM assignment INNER JOIN user ON tutor.id=user.id");
if ($assignment->num_rows) {
  while ($assignmentrow=$assignment->fetch_array(MYSQLI_ASSOC)) {
    $assignmentid=$assignmentrow['id'];
    $quiz=$assignmentrow['question'];
    $created=$assignmentrow['created'];
echo <<<_END
  <div class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
      $quiz
    </span>
<a class="mdl-list__item-secondary-action" href="adminbackend.php?action=delete_assignment&aid=$assignmentid"><i class="material-icons">delete</i></a>
  </div>
_END;
  }
} else {
 echo('<h1 class="error">Sorry:( No classmates have joined this class Yet!!:)</h1>');
}
?></div>
      </div>
    </section>
  </main>
</div>

</body>
</html>