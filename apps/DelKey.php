<?php
/**
 * delete an item
 */
require_once('./appCommon.php');
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