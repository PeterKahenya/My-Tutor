<?php 
require_once 'header.php';
if ($loggedin) {
    if ($usertype=="student") {
          if ($courseChosen) {
              header("Location:../mytutor/student.php");
          }          
      } else {
          header("Location:../mytutor/tutorprofile.php");
      }
        
  } 

 ?>
<!DOCTYPE html>
<html>
<head>
  <title>MyTutor</title>
  <link rel="icon" type="images/gif" href="images/favicon.jpg">
  <link rel="stylesheet" type="text/css" href="css/material.min.css">
  <script src="js/material.js"></script>
</head>
<body>
<!-- Uses a transparent header that draws on top of the layout's background -->
<style>
.mytutor-card-square.mdl-card {
  width: 320px;
  height: 350px;
  top: 16%;
}
.mytutor-card-square > .mdl-card__title {
  color: #008080;
}

.mytutor-layout-transparent {
  background: url('images/welcome.jpg') center / cover;
}
.mytutor-layout-transparent .mdl-layout__header,
.mytutor-layout-transparent .mdl-layout__drawer-button {
  /* This background is dark, so we set text to white. Use 87% black instead if
     your background is light. */
  color: white;
}
</style>

<div class="mytutor-layout-transparent mdl-layout mdl-js-layout">
  <header class="mdl-layout__header mdl-layout__header--transparent">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title" style="border:1px solid #fff;border-left:100px solid #fff;padding-left: 30px;
font-size: 75px;padding-top: 100px;">MyTutor</span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation -->
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="../mytutor/registrar.php" style="background-color:#009688;">Registrar</a>
        <a class="mdl-navigation__link" href="../mytutor/adminhome.php" style="background-color: #ccc;color: #009688;">Administrator</a>
      </nav>
    </div>
  </header>
  <main class="mdl-layout__content">

<div class="mytutor-card-square mdl-card mdl-shadow--2dp" style="float: left;left: 25%; background-color: #ccc;">
  <div class="mdl-card__title mdl-card--expand" style="background: url('images/studentbg.jpg') center right 100% no-repeat #46B6AC;">
    <h2 class="mdl-card__title-text">Student</h2>
  </div>
  <div class="mdl-card__supporting-text">
    Interact with your classmates, your tutor and everyone important to your class
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="../mytutor/student.php">
     student
    </a>
  </div>
</div>

<div class="mytutor-card-square mdl-card mdl-shadow--2dp" style="float: right;right: 15%;">
  <div class="mdl-card__title mdl-card--expand" style="background: url('images/tutor.jpg') center right 100% no-repeat #46B6AC;">
    <h2 class="mdl-card__title-text">Tutor</h2>
  </div>
  <div class="mdl-card__supporting-text">
    Engage your students in assignments,notes and class material. Interact with them and view their discussions
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="../mytutor/tutor.php">
      Tutor
    </a>
  </div>
</div>

  </main>

<footer class="mdl-mini-footer" style="background-color: #ccc;color: #008080;">
  <div class="mdl-mini-footer__left-section">
    <div class="mdl-logo">MyTutor</div>
    <ul class="mdl-mini-footer__link-list">
      <li><a href="help-privacy.php#help">Help</a></li>
      <li><a href="help-privacy.php#terms">Privacy & Terms</a></li>
    </ul>
  </div>
</footer>


</div>

</body>
</html>