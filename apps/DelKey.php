<?php
/**
 * delete an item
 */
session_start();
header("Cache-Control: no-cache, must-revalidate");
date_default_timezone_set('Asia/Shanghai');
error_reporting(0);
define('IN_MADM', true);
require_once('../include/class/memmanager.class.php');
if (!isset($_GET['type']) || !isset($_GET['num']))
	exit('Fail');
$type = $_GET['type'];
$num = $_GET['num'];
$key = $_POST['data'];
$memm = new MEMMANAGER();
$curcon = $memm -> GetConFromSession($type, $num);
$memm -> LoadMem();
if (!$memm -> is_login())
	exit("NoLogin");
if (!$memm -> MemConnect($type, $curcon))
	exit("ConnectFail");
$thekey = str_replace("_ _rd", "'", $key[0]['key']);
$thekey = str_replace("_ _rx", "\\", $thekey);
if (@$memm -> MemDel($thekey))
	echo "DelOK";
else
	echo "DelFail";

?>