<?php
/**
 * return the traverse data after filtered
 */
require_once('./appCommon.php');
if (!isset($_GET['type']) || !isset($_GET['num']) || !isset($_GET['shownum']) || !isset($_POST['data']))
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
$filters = $_POST['data'];
if ($filters[0]['kt'] == 1)
	$keyfilter = str_replace("_ _rd", "'", $filters[0]['kf']);
if ($filters[0]['vt'] == 1)
	$valuefilter = str_replace("_ _rd", "'", $filters[0]['vf']);
$test_str = "test";
if ($filters[0]['kt'] == 1) {
	$r = @preg_match($keyfilter, $test_str);
	if (gettype($r) == 'boolean' && $r == false)
		exit("KeyFilterFail");
} 
if ($filters[0]['vt'] == 1) {
	$r = @preg_match($valuefilter, $test_str);
	if (gettype($r) == 'boolean' && $r == false)
		exit("ValueFilterFail");
} 
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
		$keyallow = 0;
		$valueallow = 0;
		if ($filters[0]['kt'] == 1) {
			$rkey = @preg_match($keyfilter, $key);
			if (gettype($rkey) == 'integer' && $rkey == 1)
				$keyallow = 1;
			else
				$keyallow = 0;
		} else {
			$keyallow = 1;
		} 
		if ($filters[0]['vt'] == 1) {
			$getvalue = $memm -> MemGet(array($key));
			if(is_string($getvalue[0][$key])) {
				$rvalue = @preg_match($valuefilter, $getvalue[0][$key]);
				if (gettype($rvalue) == 'integer' && $rvalue == 1)
					$valueallow = 1;
				else
					$valueallow = 0;
			} elseif (is_array($getvalue[0][$key]) || is_object($getvalue[0][$key])) {
				$rvalue = @preg_match($valuefilter, serialize($getvalue[0][$key]));
				if (gettype($rvalue) == 'integer' && $rvalue == 1)
					$valueallow = 1;
				else
					$valueallow = 0;
			} else {
				$valueallow = 1;
			}
		} else {
			$valueallow = 1;
		} 
		if ($keyallow == 1 && $valueallow == 1) {
			$t=$value[1];
			if($t==$stime)
				$value[1] = "noexpire";
			else
				$value[1] = date('Y-m-d H:i:s',$t);
			$relist['res'][] = array(urlencode($key), $value);
		} 
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
		$keyallow = 0;
		$valueallow = 0;
		if ($filters[0]['kt'] == 1) {
			$rkey = @preg_match($keyfilter, $key);
			if (gettype($rkey) == 'integer' && $rkey == 1)
				$keyallow = 1;
			else
				$keyallow = 0;
		} else {
			$keyallow = 1;
		} 
		if ($filters[0]['vt'] == 1) {
			$getvalue = $memm -> MemGet(array($key));
			if(is_string($getvalue[0][$key])) {
				$rvalue = @preg_match($valuefilter, $getvalue[0][$key]);
				if (gettype($rvalue) == 'integer' && $rvalue == 1)
					$valueallow = 1;
				else if ($getvalue[0][$key] == 'undefined' || $getvalue[0][$key] == false)
					$valueallow = 1;
				else
					$valueallow = 0;
			} elseif (is_array($getvalue[0][$key]) || is_object($getvalue[0][$key])) {
				$rvalue = @preg_match($valuefilter, serialize($getvalue[0][$key]));
				if (gettype($rvalue) == 'integer' && $rvalue == 1)
					$valueallow = 1;
				else if ($getvalue[0][$key] == 'undefined' || $getvalue[0][$key] == false)
					$valueallow = 1;
				else
					$valueallow = 0;
			} else {
				$valueallow = 1;
			}
		} else {
			$valueallow = 1;
		} 
		if ($keyallow == 1 && $valueallow == 1) {
			$t=$value[1];
			if($t==$stime)
				$value[1] = "noexpire";
			else
				$value[1] = date('Y-m-d H:i:s',$t);
			$relist['res'][] = array(urlencode($key), $value);
		} 
	} 
	$relist['rnum'] = count($relist['res']);
	echo json_encode($relist);
} 

?>