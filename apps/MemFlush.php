<?php
/**
 * flush all
 */
require_once('./appCommon.php');
if (!isset($_GET['type']) || !isset($_GET['num']))
	exit('Fail');
$type = $_GET['type'];
$num = $_GET['num'];
$memm = new MEMMANAGER();
$curcon = $memm -> GetConFromSession($type, $num);
$memm -> LoadMem();
if (!$memm -> is_login())
	exit("NoLogin");
if (!$memm -> MemConnect($type, $curcon))
	exit("ConnectFail");
$re = $memm -> flushAll();
if ($re == true)
	exit("FlushOK");
else
	exit("Fail");

?>