<?php
/**
 * get command
 */
session_start();
header("Cache-Control: no-cache, must-revalidate");
date_default_timezone_set('Asia/Shanghai');
error_reporting(0);
define('IN_MADM', true);
require_once('../include/class/memmanager.class.php');
if (!isset($_GET['type']) || !isset($_GET['num']) || !isset($_POST['data']))
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
$thekey = str_replace("_ _rd", "'", $data[0]['key']);
$thekey = str_replace("_ _rx", "\\", $thekey);
$keylist = explode(" ", $thekey);
$list = $memm -> MemGet($keylist);
echo json_encode($list);

?>