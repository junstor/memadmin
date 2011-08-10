<?php
/**
 * count command
 */
session_start();
header("Cache-Control: no-cache, must-revalidate");
date_default_timezone_set('Asia/Shanghai');
error_reporting(0);
define('IN_MADM', true);
require_once('../include/class/memmanager.class.php');
if (!isset($_GET['type']) || !isset($_GET['num']) || !isset($_GET['action']) || !isset($_POST['data']))
	exit('Fail');
$type = $_GET['type'];
$num = $_GET['num'];
$data = $_POST['data'];
$memm = new MEMMANAGER();
$curcon = $memm -> GetConFromSession($type, $num);
$memm -> LoadMem();
if (!$memm -> is_login())
	exit("NoLogin");
if (!$memm -> MemConnect($type, $curcon))
	exit("ConnectFail");
if ($_GET['action'] == 'incr') {
	$ret = @$memm -> MemIncr($data[0]['key'], $data[0]['value']);
	if (gettype($ret) == 'boolean' && $ret == false)
		echo "IncrFail";
	else
		echo $ret;
} else if ($_GET['action'] == 'decr') {
	$ret = @$memm -> MemDecr($data[0]['key'], $data[0]['value']);
	if (gettype($ret) == 'boolean' && $ret == false)
		echo "DecrFail";
	else
		echo $ret;
} 

?>