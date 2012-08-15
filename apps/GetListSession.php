<?php
/**
 * get list information from session
 */
if(!ini_get('session.auto_start'))
    session_start();
header("Cache-Control: no-cache, must-revalidate");
try {
	echo json_encode($_SESSION["MADM_SESSION_KEY"]['list']);
} 
catch (Exception $e) {
	echo "NoLogin";
	exit;
} 

?>