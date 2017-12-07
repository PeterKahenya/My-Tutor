<?php
  session_start();
 include_once 'utils.php';
 if (isset($_SESSION['username'])) {
     destroySession();
     header("Location:/mytutor/");
 } else {
     echo('You are not logged in') ;
     header("Location:../mytutor/");
 }


?>