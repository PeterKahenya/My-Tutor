<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/messagingmodal.css">
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
<body style="background-color: #fff;">


<?php
$fh = fopen("status.txt", 'r') or
die("File does not exist or you lack permission to open it");
$line = fgets($fh);
fclose($fh);
if ($line=="NOT_INSTALLED") {
  echo<<<_END
<a href="setup.php"><button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="left:25%;">Install System
</button>
</a>
_END;
} else {
   echo<<<_END
<a href="dashboard.php"><button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">View Dashboard
</button>
</a>
_END;
}

?>





</body>
</html>