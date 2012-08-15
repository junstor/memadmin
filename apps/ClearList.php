<?php
/**
 * clear up the list information saved in session
 */
try {
	setcookie('memadmin_cookie_conlist', '', time()-100);
	setcookie('memadmin_cookie_conlist_time', '', time()-100);
	echo "OK";
} 
catch (Exception $e) {
	echo $e -> getMessage();
	exit;
} 

?>