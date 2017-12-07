<?php
   require_once 'utils.php';
   $code="";
   $name="";
   $error="";
   if (isset($_POST['code'])&&isset($_POST['name'])) {
    $code=sanitizeString($_POST['code']);
    $name=sanitizeString($_POST['name']);
    if ($code==""||$name=="") {
    	$error="All fields must be full";
    	echo($error);
    } else {
    		queryMysql("INSERT INTO course(code,name) VALUES('$code', '$name')");
             $error="<p style='color:#00ff00;'>Success</p>";
             echo($error);
    	}
    	
    }
    
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>MyTutor|Add Course</title>
	<link rel="stylesheet" type="text/css" href="css/addcourse.css">
	<script type="text/javascript">
		function checkcourse(course) {
			params = "code=" + course.value;
			request = new ajaxRequest();
			request.open("POST", "checkcourse.php", true);
			request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			request.setRequestHeader("Content-length", params.length)
			request.setRequestHeader("Connection", "close")
			request.onreadystatechange = function(){
										if (this.readyState == 4)
										if (this.status == 200)
										if (this.responseText != null)
											document.getElementById('info').innerHTML = this.responseText
												}
						request.send(params)
								}
        function ajaxRequest(){
				try {
				 var request = new XMLHttpRequest();
				  }catch(e1) {
					try { 
						request = new ActiveXObject("Msxml2.XMLHTTP"); 
					  }catch(e2){
						try { 
							request = new ActiveXObject("Microsoft.XMLHTTP");
						   }catch(e3) {
								request = false
								     } 
							 } 
						}
							return request;
					}
	</script>
</head>
<body>
   <div class='container'>
 	<form action='addcourse.php' method='POST'>
 		Add Courses:<br/>
 		<input type='text' class='field' name='code' maxlength="6" onblur='checkcourse(this)' placeholder='Enter course code'><span id="info"></span><br/>
 		<input type='text' class='field' name='name' placeholder='Enter course name'><br/>
 		<input type='submit' class='addbtn' value='Add'> 
 	</form>
 </div>
</body>
</html>