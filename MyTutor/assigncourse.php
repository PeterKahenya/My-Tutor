<?php 
 require_once 'utils.php';
echo <<<_END
      <!DOCTYPE html>
 <html>
 <head>
 	<title>Assign Tutors</title>
    <link rel="stylesheet" type="text/css" href="css/assigncourse.css">
 </head>
 <body>
 <div class="container">
 <form action="assigncourse.php" method="POST">
 Assign courses to tutors:</br>
_END;
     $availablecourses=queryMysql("SELECT * FROM course");
     if ($availablecourses->num_rows) {
        echo('<select name="course">');
         while ($row=$availablecourses->fetch_array(MYSQLI_ASSOC)) {
            $id=$row['id'];
            $code=$row['code'];
            $name=$row['name'];
           echo "<option value='$id'>$code-$name</option>";
     }
     echo("</select><br/>");
     } else {
        echo('<p>No Courses are available</p><a href="addcourse.php">Add course</a>');
     }
     

     $availableTutors=queryMysql("SELECT * FROM tutor");
     if ($availableTutors->num_rows) {
        echo("</select><br/>Select tutor:<select name='tutor'>");
     while ($mrow=$availableTutors->fetch_array(MYSQLI_ASSOC)) {
            $tid=$mrow['id'];
            $fname=$mrow['first_name'];
            $lname=$mrow['last_name'];
           echo "<option value='$tid'>$fname $lname</option>";
     }
        echo("</select><br/>");
     } else {
          echo('<p style="color:#700070;text-decoration: none;">Sorry :-(  </br>No Tutors Registered!!</br></p><br/>');
     }
     
     

echo <<<_END
<input type="submit" value="Assign"> 
</form>
 </div>
 </body>
 </html>
_END;
   
    if (isset($_POST['course'])) {
    	 $courseid=$tutorid=0;
    	 $courseid=$_POST['course'];
         $tutorid=$_POST['tutor'];
        if ($courseid==0||$tutorid==0) {
	echo("<p>All fields must be input</p>");
                                        } else {
	                                           $query="UPDATE tutor SET course=".$courseid." WHERE id=".$tutorid;
	                                           queryMysql($query);
                                                }

                                        }     
   


 ?>