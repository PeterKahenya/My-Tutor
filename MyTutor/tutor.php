<?php 
require_once 'header.php';
if ($loggedin) {
    if ($usertype=="student") {
          if ($courseChosen) {
              header("Location:studentprofile.php");
          } else {
             header("Location:studentcourse.php");
          }
          
      } else {
          header("Location:tutor.php");
      }
        
  }

 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <title>MyTutor|Tutor</title>
<link rel="icon" type="images/gif" href="images/favicon.jpg">
   <link rel="stylesheet" type="text/css" href="css/tutor.css">
   <link rel="stylesheet" type="text/css" href="css/material.min.css">
   <script type="text/javascript" src="js/material.js"></script>
 </head>
 <style>
.mytutor-layout-transparent {
  background: url('images/tutor.jpg') center / cover;
}
</style>

 <body>
 <!-- Uses a transparent header that draws on top of the layout's background -->

<div class="mytutor-layout-transparent mdl-layout mdl-js-layout">
  <header class="mdl-layout__header mdl-layout__header--transparent">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title" style="border:1px solid #fff;border-left:100px solid #fff;padding-left: 30px;
font-size: 75px;padding-top: 150px;">MyTutor</span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation -->
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="/mytutor/">Home</a>
        <a class="mdl-navigation__link" href="" id="usefullidiot"></a>
        <a class="mdl-navigation__link" href="help-privacy.php#about">About</a>
        <a class="mdl-navigation__link" href="help-privacy.php#help">Help</a>
      </nav>
    </div>
  </header>
  <main class="mdl-layout__content">

<div id="myModal" class="modal">

  <!-- Modal content -->
    <div class="form" id="loginform">
    <p class="toptext">@Tutor</p><br/>
    <div id="info"> </div>
    <div class="formcontent">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" >
    <input class="mdl-textfield__input" type="text" id="username">
    <label class="mdl-textfield__label" for="username">Staff No...</label>
  </div>

 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" id="password">
    <label class="mdl-textfield__label" for="password">Password</label>
  </div>
<button onclick="login('tutor')" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored" 
   style="background-color: #009688;">login</button>
<button style="float: right;" onclick="startsignup()" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
  signup
</button>


   </div>
    
</div>

</div>
</div>



    <div class="form"  style="display: none; z-index: 4;padding-bottom: 5px; width: 30%; top: 100px;float: left;left: 40%;" id="signupform">
    <p class="toptext">Signup@Tutor</p><br/>
     <span id="info"></span>
    <div class="formcontent">

  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" id="fname" onblur="testname(this,'fnamer')" name="fname" >
    <label class="mdl-textfield__label" id="fnamer" for="fname">First name...</label>
  </div>


  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" onblur="testname(this,'lnamer')" id="lname" name="lname">
    <label class="mdl-textfield__label" id="lnamer" for="lname">Last Name...</label>
  </div>   

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" id="susername" onblur="testname(this,'adminr')" name="username">
    <label class="mdl-textfield__label" id="adminr" for="susername">Staff No...</label>
  </div>

 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" id="spassword" onblur="testname(this,'passr')" name="password">
    <label class="mdl-textfield__label" id="passr" for="spassword">password...</label>
  </div>

   <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float: left;">
    <input class="mdl-textfield__input" type="password" oninput="confirm(this,'cpassr')" name="cpassword">
    <label class="mdl-textfield__label" id="cpassr" for="cpassword">Renter password</label>
  </div>
   <input class="browsebtn" type="file" id="profilepic" name="profilepic" style="height: 30px; ">
   <span id="filer"></span>

  <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="float: left;left: 45%;
  background-color: #009688;" onclick="signup('tutor')">signup</button>

  <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" style="float: right;" 
  onclick="calllogin()">login</button><br/>

  <span style="float: left;" id="error"></span>
  </div>
  </div>

  
  </main>

<script type="text/javascript" src="js/tutor.js"></script>

 </body>
 </html>