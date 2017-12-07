<!DOCTYPE html>
<html>
<head>
  <title>MyTutor</title>
</head>
<body>

<div class="login">
  <?php
   $fh = fopen("adminpass.txt", 'r') or
die("File does not exist or you lack permission to open it");
$line = fgets($fh);
fclose($fh);
if ($line=="") {
  echo<<<_END
<a href="adminsignup.php"><button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="left:25%;">Install System
</button>
</a>
_END;
}else{
  //admin Login
echo<<<_END
<form action="#">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="password" id="sample3">
    <label class="mdl-textfield__label" for="sample3">admin password...</label>
  </div>
</form>
_END;

}
  ?>
</div>
</body>
</html>