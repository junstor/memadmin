<?php
/**
 * load the list from cookie
 */
header("Cache-Control: no-cache, must-revalidate");
if (isset($_COOKIE['memadmin_cookie_conlist'])) {
	$_COOKIE['memadmin_cookie_conlist'] = stripslashes($_COOKIE['memadmin_cookie_conlist']); 
	$res = unserialize($_COOKIE['memadmin_cookie_conlist']);
	echo json_encode($res);
} else {
	echo "nolist";
} 

?>