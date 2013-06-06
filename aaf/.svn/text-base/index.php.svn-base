<?php

/* Setup web browing session data from AAF attributes.
 * Three core attributes are requested from AAF: displayName, organizationName, and email 
 */
session_start();
if (isset($_SERVER['email']))
{
	$_SESSION['email'] = $_SERVER['email'];
	$_SESSION['displayName'] = $_SERVER['displayName'];
	$_SESSION['organizationName'] = $_SERVER['organizationName'];
}

header('location: ../index.php?r=site/aaf');
?>
