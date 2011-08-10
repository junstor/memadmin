<?php
/**
 * return the traverse data
 */
session_start();
header("Cache-Control: no-cache, must-revalidate");
date_default_timezone_set('Asia/Shanghai');
error_reporting(0);
define('IN_MADM', true);
require_once('../include/class/memmanager.class.php');
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
	$lid = $curcon['host'] . ":" . $curcon['port'];
	$list = $list[$lid];
	$relist = array();
	$relist['res'] = array();
	foreach($list as $key => $value) {
		$relist['res'][] = array($key, $value);
	} 
	$relist['rnum'] = count($relist['res']);
	echo json_encode($relist);
} else if ($type == 'conp') {
	$list = $memm -> conpMemCacheDump($conid, $slabid, $shownum);
	$relist = array();
	$relist['res'] = array();
	foreach($list as $key => $value) {
		$relist['res'][] = array($key, $value);
	} 
	$relist['rnum'] = count($relist['res']);
	echo json_encode($relist);
} 

?>