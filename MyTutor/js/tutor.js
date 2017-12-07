function login(usertype) {
  alert("login")
var usernumber=document.getElementById("username").value;
var password=document.getElementById("password").value;
params="username="+usernumber+"&password="+password+"&usertype="+usertype;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     if(this.responseText=="tutor_successful_with_class"){
       document.getElementById('usefullidiot').innerHTML="Logout";
       document.getElementById('usefullidiot').href="Logout.php";
       window.location="tutorprofile.php";
     }else{
        document.getElementById('usefullidiot').innerHTML="Logout";
        document.getElementById('usefullidiot').href="Logout.php";
       document.getElementById("info").innerHTML=this.responseText;
     }

    }
  };
  xhttp.open("POST", "login.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(params);
}

function startsignup() {
  var loginform=document.getElementById('loginform');
  var signupform=document.getElementById('signupform');
  loginform.style.display="none";
  signupform.style.display="block";
}

function testname(textbox,err) {
  if(textbox.value==""){
    document.getElementById(err).style.color="#ff0000";
    document.getElementById(err).innerHTML='&nbsp;&#x2718;empty field';
  }else{
    document.getElementById(err).style.color="#009c50";
    document.getElementById(err).innerHTML='&nbsp;&#x2714;';
  }
}

function confirm(textbox,err) {
  var pass=document.getElementById("spassword").value;
  var cpass=textbox.value;
  if (cpass==pass) {
    document.getElementById(err).style.color="#009c50";
    document.getElementById(err).innerHTML='&nbsp;&#x2714;';  
  }else{
    document.getElementById(err).innerHTML='&nbsp;&#x2718;';
    document.getElementById(err).style.color="#FF0000";
  }

}


function signup(usertype) {
    var fname=document.getElementById('fname').value;
    var lname=document.getElementById('lname').value;
    var username=document.getElementById('susername').value;
    var password=document.getElementById('spassword').value;
    var form=document.getElementById('uploadform');

   form.onsubmit=function(event) {
            event.preventDefault();
   var params="fname="+fname+"&lname="+lname+"&admNo="+username+"&pass="+password+"&usertype="+usertype;
  request = new XMLHttpRequest();
  request.onreadystatechange = function()
                      {
                      if (this.readyState == 4)
                      if (this.status == 200)
                      if (this.responseText != null)
                        if (this.responseText=="tutor") {
                          var loginform=document.getElementById('loginform');
                          var signupform=document.getElementById('signupform');
                             
                          uploadFiles();
                                loginform.style.display="block";
                                signupform.style.display="none";
                        } else {
                          if (this.responseText=="student") {
                            document.getElementById('signupform').style.display="";
                          } else {
                            document.getElementById('error').innerHTML=this.responseText;
                          }
                        }
                        }
  request.open("POST", "signup.php", true)
  request.setRequestHeader("Content-type","application/x-www-form-urlencoded")
  request.send(params);
};
}
    function uploadFiles() {
        var inp=document.getElementById('myFile');

        
            var files=inp.files;
             if (window.FormData) {
              var formdata=new FormData();
              for (var i = 0; i < files.length; i++) {
                  var file=files[i];
                  formdata.append('files[]',file);
              }
              var xhttp=new XMLHttpRequest();
                   xhttp.onreadystatechange=function () {
                  if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('filer').innerHTML=this.responseText;
                  }
              }


              xhttp.open('POST','signup.php');
              xhttp.send(formdata);

         }
        }




function calllogin() {
    var loginform=document.getElementById('loginform');
  var signupform=document.getElementById('signupform');
  loginform.style.display="block";
  signupform.style.display="none";
}
