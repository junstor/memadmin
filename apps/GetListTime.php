<?php
/**
 * get list save time
 */
header("Cache-Control: no-cache, must-revalidate");
date_default_timezone_set('Asia/Shanghai');
if (isset($_COOKIE['memadmin_cookie_conlist_time'])) {
	$time = ($_COOKIE['memadmin_cookie_conlist_time']);
	echo date('Y-m-d H:i:s', $time);
} else {
	echo "notime";
} 

?>