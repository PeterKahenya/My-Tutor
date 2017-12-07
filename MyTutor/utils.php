<?php
$dbhost = 'localhost'; //Your database server address
$dbname = 'mytutor'; // Your Database Name
$dbuser = 'root'; // ...db username
$dbpass = ''; // ...db password
$appname = "MyTutor"; // ...Password
$loggedin=FALSE; //is a user logged in
$usertype="";    //type of user logged in either 'student' or 'tutor' or 'registrar'
$courseChosen=FALSE;//flag for if the student has chosen a course to join a class
$userid=0;
$courseid=0;
$isTutor='0';
$course="";

//connect to database
$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($connection->connect_error) die($connection->connect_error);
//function to create table
function createTable($name, $query)
{
queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
echo "Table '$name' created or already exists.<br>";
}

function queryMysql($query)
{
global $connection;
$result = $connection->query($query);
if (!$result) die($connection->error);
return $result;
}

//destroying sessions
function destroySession()
{
$_SESSION=array();
if (session_id() != "" || isset($_COOKIE[session_name()]))
setcookie(session_name(), '', time()-2592000, '/');
session_destroy();
}

//remove malicious code from the users input
function sanitizeString($var)
{
global $connection;
$var = strip_tags($var);
$var = htmlentities($var);
$var = stripslashes($var);
return $connection->real_escape_string($var);
}

//display logged in user profile $user is the userid PK to the user table and $table is the user type table 
function showProfile($user,$table,$otherdata)
{
	$picpath="profilepics/".$user.".jpg";
if (file_exists($picpath)){
   echo '<img class="profilepic" onclick="editprofile();" src='."$picpath".'>';
}else{
	echo '<div class="profilepic" onclick="editprofile();">&nbspP</div>';
}
   $result = queryMysql("SELECT * FROM user NATURAL JOIN $table WHERE id=$user");
   if ($result->num_rows)
   {
   $row = $result->fetch_array(MYSQLI_ASSOC);
   $fname=$row['first_name'];
   $lname=$row['last_name'];
   $uno= $row['user_number'];
echo <<<_END
     <p onclick="editprofile()" class="details"><em>$fname $lname<br/>$uno<br/>
    $otherdata</em></p>
_END;
}


}



  ?>