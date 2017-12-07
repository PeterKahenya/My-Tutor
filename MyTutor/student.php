<?php 
require_once 'header.php';
if ($loggedin) {
    if ($usertype=="student") {
          if ($courseChosen) {
            if (!isset($_GET['action'])) {
              header("Location:studentprofile.php");
            }
              
          }
          
      } else {
          header("Location:../tutorprofile.php");
      }
  }

 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <title>MyTutor|Student</title>
   <link rel="icon" type="images/gif" href="images/favicon.jpg">
   <link rel="stylesheet" type="text/css" href="css/student.css">
   <link rel="stylesheet" type="text/css" href="css/material.min.css">
   <script type="text/javascript" src="js/material.js"></script>
 </head>
 <style>
.mytutor-layout-transparent {
  background: url('images/background.jpg') center / cover;
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
        <a class="mdl-navigation__link" id="coursetab" href="help-privacy.php#courses">Courses</a>
        <a class="mdl-navigation__link" href="help-privacy.php#about">About</a>
        <a class="mdl-navigation__link" href="help-privacy.php#help">Help</a>
      </nav>
    </div>
  </header>
  <main class="mdl-layout__content">




<div id="myModal" class="modal" style="display: none;">

  <!-- Modal content -->
    <div class="form" id="loginform">
    <p class="toptext">@Student</p><br/>
    <div id="info"> </div>
    <div class="formcontent">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" id="username">
    <label class="mdl-textfield__label" for="username">Admission No...</label>
  </div>

 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" id="password">
    <label class="mdl-textfield__label" for="password">Password</label>
  </div>
<button onclick="login('student')" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">
  login
</button>
<button style="float: right;" onclick="startsignup()" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
  signup
</button>


   </div>
    
</div>

</div>
</div>


<form id="uploadform" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
    <div class="form"  style="display: none; z-index: 4;padding-bottom: 5px; width: 30%; top: 100px;float: left;left: 40%;" id="signupform">
    <p class="toptext">Signup@student</p><br/>
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
    <label class="mdl-textfield__label" id="adminr" for="susername">Admission no...</label>
  </div>

 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" id="spassword" onblur="testname(this,'passr')" name="password">
    <label class="mdl-textfield__label" id="passr" for="spassword">Password...</label>
  </div>

   <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float: left;">
    <input class="mdl-textfield__input" type="password" oninput="confirm(this,'cpassr')" name="cpassword">
    <label class="mdl-textfield__label" id="cpassr" for="cpassword">Renter password</label>
  </div>
   <input class="browsebtn" type="file" id="myFile" name="profilepic" style="height: 30px; ">
   <span id="filer"></span>

  <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="float: left;left: 45%;" 
  onclick="signup('student')" type="submit">signup</button>

  <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" style="float: right;" 
  onclick="calllogin()">login</button><br/><span style="float: left;" id="error"></span>


  </div>
  </div>

</form>

<div id="courses" class="modal" style="display: none;">
   <div class="content">
    <div class="top">Choose Class to enter</div>
    <div class="registered">
      <form method="POST">
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp" style="background-color: #008080;width: 100%;border-radius: 5px; ">
  <tbody id="myclasses">
  </tbody>
</table>
      </form>
    </div>
    <div class="addform">
    Choose Course to Register:</br>
    <?php
    $availablecourses=queryMysql("SELECT * FROM course");
     if ($availablecourses->num_rows) {
        echo('<select id="code">');
         while ($row=$availablecourses->fetch_array(MYSQLI_ASSOC)) {
            $id=$row['id'];
            $code=$row['code'];
            $name=$row['name'];
           echo "<option value='$code'>$code-$name</option>";
     }
     echo('</select><button onclick="submit()">Register</button><br>');
     } else {
        echo('<p>No Courses are available</p>');
     }
    ?>
    </div>
    <span id="error" style="color: red;"></span>
  </div>
</div>






  
     
  </main>




<script type="text/javascript" src="js/student.js"></script>
<script type="text/javascript">
  //test if logged in
var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText=="1") {

          popcourses();
          document.getElementById('courses').style.display="block";
        } else {
          document.getElementById('myModal').style.display="block";
        }
      }
    }
xhttp.open("POST", "testlogin.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(); 


</script>
 </body>
 </html>