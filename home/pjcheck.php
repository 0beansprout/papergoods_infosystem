<?php 
// put this code block at the top of all secure pages in the site
// to make sure the current browser is logged in 
if($_SESSION['ValidUser'] == true) {
    // echo "Welcome back " . $_SESSION['CustomerName'] . "<BR>";
 } else {
 echo "You must <a href='pjlogin.php'>login</a> in order to access this site.";
 exit;
 }
 /*
if($_SESSION['UserPosition']=="CEO"){
    //
}else{
    echo "You don't have a permssion to access this page. Please return to the <a href='pjlogin.php'>login</a> page and Contact Administrator.";
    exit;
}
*/
?>


