<?php
// code to include at the top of every secure page in your site
// to force all users who visit that page to have previously 
// logged in during the current browsing session

session_start();

if(!isset($_SESSION['ValidUser'])) {

	// make them login
	// send 'em back to the login form
	header('Location: http://www.pgsalesmgmt.com/pjlogin.php');
	die();
	
} // end  if not session $validuser

