<?php
/**
 * return the traverse data
 */
require_once('./appCommon.php');
if (!isset($_GET['type']) || !isset($_GET['num']) || !isset($_GET['shownum']))
	exit('Fail');
if ($_GET['type'] == 'con') {
	if (!isset($_GET['slabid']))
		exit('Fail');
	$slabid = $_GET['slabid'];
} 
if ($_GET['type'] == 'conp') {
	if (!isset($_GET['conid']) || !isset($_GET['slabid']))
		exit('Fail');
	$conid = $_GET['conid'];
	$slabid = $_GET['slabid'];
} 
$type = $_GET['type'];
$num = $_GET['num'];
$shownum = $_GET['shownum'];
$memm = new MEMMANAGER();
$curcon = $memm -> GetConFromSession($type, $num);
$memm -> LoadMem();
if (!$memm -> is_login())
	exit("NoLogin");
if (!$memm -> MemConnect($type, $curcon))
	exit("ConnectFail");
if ($type == 'con') {
	$list = $memm -> MemCacheDump($slabid, $shownum);
	 $slist = $memm->GetStats($curcon['host'],$curcon['port']);
	$lid = $curcon['host'] . ":" . $curcon['port'];
	$list = $list[$lid];
	$relist = array();
	$relist['res'] = array();
	$stime = intval($slist['time']) - intval($slist['uptime']);
	 foreach($list as $key => $value) {
		$t=$value[1];
		if($t==$stime)
			$value[1] = "noexpire";
		else
			$value[1] = date('Y-m-d H:i:s',$t);
		$relist['res'][] = array(urlencode($key), $value);
	}
	$relist['rnum'] = count($relist['res']);
	echo json_encode($relist);
} else if ($type == 'conp') {
	$list = $memm -> conpMemCacheDump($conid, $slabid, $shownum);
	$slist = $memm-> ConpGetStats();
	$relist = array();
	$relist['res'] = array();
	$stime = intval($slist[$conid]['time']) - intval($slist[$conid]['uptime']);
	foreach($list as $key => $value) {
		$t=$value[1];
		if($t==$stime)
			$value[1] = "noexpire";
		else
			$value[1] = date('Y-m-d H:i:s',$t);
		$relist['res'][] = array(urlencode($key), $value);
	} 
	$relist['rnum'] = count($relist['res']);
	echo json_encode($relist);
} 

?>