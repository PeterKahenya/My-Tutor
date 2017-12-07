<!DOCTYPE html>
<html>
<head>
<title>Setting up database</title>
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
<h3>Setting up...</h3>
<?php
require_once 'utils.php';
if (isset($_POST['pass'])) {
	$pass=md5($_POST['pass']);
	$fh = fopen("adminpass.txt", 'w') or die("Failed to create file");
fwrite($fh, $pass) or die("Could not write to file");
fclose($fh);
echo "File 'testfile.txt' written successfully";
} else {
	# code...
}

//create users table 
createTable('user',
'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 user_number VARCHAR(16),
 hashed_password VARCHAR(32),
 INDEX(user_number(6))');

//create course table
createTable('course',
'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
code VARCHAR(6),
name VARCHAR(256)');

//create student table a student is a user
createTable('student',
'myid INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 id  INT UNSIGNED,
 first_name VARCHAR(25),
 last_name VARCHAR(25),
 FOREIGN KEY(id) REFERENCES user(id) ON DELETE CASCADE');

//create tutor table a tutor is a user
createTable('tutor',
'myid INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
id INT UNSIGNED,
first_name VARCHAR(25),
last_name VARCHAR(25),
course INT UNSIGNED,
FOREIGN KEY(course) REFERENCES course(id)ON DELETE CASCADE,
FOREIGN KEY(id) REFERENCES user(id) ON DELETE CASCADE');

//create note table to hold the notes----------The field notes contains the filename of the notes
createTable('note',
'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 course INT UNSIGNED,
 notes VARCHAR(1000),
 uploaded INT UNSIGNED,
 FOREIGN KEY(course) REFERENCES course(id) ON DELETE CASCADE');

createTable('student_course',
'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 student INT UNSIGNED,
 course INT  UNSIGNED,
 FOREIGN KEY(student) REFERENCES student(id),
 FOREIGN KEY(course) REFERENCES course(id) ON DELETE CASCADE');

//create discussion table
createTable('discussion',
'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 subject VARCHAR(100),
 created INT UNSIGNED,
 course INT UNSIGNED,
 moderator INT UNSIGNED,
 FOREIGN KEY(course) REFERENCES course(id) ON DELETE CASCADE,
 FOREIGN KEY(moderator) REFERENCES user(id) ON DELETE CASCADE');

//post is the actual table with the messages
createTable('post',
'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 mtext VARCHAR(4096),
 created INT UNSIGNED,
 sender INT UNSIGNED,
 receiver INT UNSIGNED,
 course INT UNSIGNED,
 isTutor CHAR(1) NOT NULL,
 isRead CHAR(1) NOT NULL,
 FOREIGN KEY(course) REFERENCES course(id),
 FOREIGN KEY(sender) REFERENCES user(id) ON DELETE CASCADE,
 FOREIGN KEY(receiver) REFERENCES user(id) ON DELETE CASCADE');

createTable('discussion_post',
	'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	 mtext VARCHAR(4096),
     created INT UNSIGNED,
     discussion INT UNSIGNED,
     sender INT UNSIGNED,
     isTutor CHAR(1) NOT NULL,
     FOREIGN KEY(discussion) REFERENCES discussion(id),
 	 FOREIGN KEY(sender) REFERENCES user(id)');

createTable('discussion_member',
	'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	 discussion INT UNSIGNED,
	 member INT UNSIGNED,
	 FOREIGN KEY(discussion) REFERENCES discussion(id) ON DELETE CASCADE,
	 FOREIGN KEY(member) REFERENCES user(id) ON DELETE CASCADE');

createTable('assignment',
	'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	 course INT UNSIGNED,
	 question VARCHAR(8192),
	 created INT UNSIGNED,
	 FOREIGN KEY(course) REFERENCES course(id) ON DELETE CASCADE');

if (!unlink('status.txt')) echo "Could not delete file";
else echo "File 'status.txt' successfully deleted";
$fh = fopen("status.txt", 'w') or die("Failed to create file");
$text = <<<_END
INSTALLED
_END;
fwrite($fh, $text) or die("Could not write to file");
fclose($fh);
echo "File 'status.txt' written successfully";
?>
<br>...done.
<!-- Colored raised button -->
<a href="admin.php">
<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
  Continue
</button>
</a>
</body>
