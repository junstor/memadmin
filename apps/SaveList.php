<?php
/**
 * save list
 */
date_default_timezone_set('Asia/Shanghai');
try {
	$list = $_POST['data'];
	$serlist = serialize($list);
	setcookie('memadmin_cookie_conlist', $serlist, time() + 315360000);
	setcookie('memadmin_cookie_conlist_time', time(), time() + 315360000);
	echo "OK";
} 
catch (Exception $e) {
	echo $e -> getMessage();
	exit;
} 

?>