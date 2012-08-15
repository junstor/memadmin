<?php
/**
 * set monitor information into session
 */
if(!ini_get('session.auto_start'))
    session_start();
try {
	if (isset($_SESSION) && array_key_exists("MADM_SESSION_KEY", $_SESSION)) {
		$list = $_POST['data'];
		$_SESSION["MADM_SESSION_KEY"]['monitor'] = $list;
		echo "OK";
	} else
		echo "NoLogin";
} 
catch (Exception $e) {
	echo $e -> getMessage();
	exit;
} 

?>