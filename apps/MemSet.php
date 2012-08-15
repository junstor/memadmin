<?php
/**
 * set command
 */
require_once('./appCommon.php');
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
$thevalue = str_replace("_ _rd", "'", $data[0]['value']);
$thevalue = str_replace("_ _rx", "\\", $thevalue);
if ($memm -> MemSet($thekey, $thevalue))
	echo "SetOK";
else
	echo "SetFail";

?>