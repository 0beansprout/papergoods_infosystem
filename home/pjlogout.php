<html>
    <body>
    <style>
    
</style>
<?php

session_start();
unset($_SESSION['ValidUser']);
unset($_SESSION['UserFirstName']);


require_once("index.html");

?>

<!--You have logged out.  Click <a href="pjlogin.php">here</a> to login again.-->
</html>