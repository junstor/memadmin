<?php
/**
 * get command
 */
require_once('./appCommon.php');
if (!isset($_GET['type']) || !isset($_GET['num']) || !isset($_POST['data']))
	exit('Fail');
if(!isset($_GET['charset']))
	$cs='UTF-8';
else
	$cs=$_GET['charset'];
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
$relist = array();
$relist[0] = array();
$relist[1] = array();
foreach($list[0] as $key => $value) {
	$newkey = urlencode($key);
	$relist[0][$newkey]=array();
	if(is_array($value))
		$relist[0][$newkey][0]=serialize($value);
	elseif(gettype($value)=='object') {
		$relist[0][$newkey][0]=serialize($value);
	} else
		$relist[0][$newkey][0]=$value;
	$relist[0][$newkey][1]=gettype($value);
}
foreach($list[1] as $key => $value) {
	$newkey = urlencode($key);
	$relist[1][$newkey] = $value;
}
echo array2json($relist,$cs);
?>