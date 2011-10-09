<?php
/**
 * serialize and unserialize
 */
session_start();
header("Cache-Control: no-cache, must-revalidate");
date_default_timezone_set('Asia/Shanghai');
error_reporting(0);
define('IN_MADM', true);
require_once('../include/class/memmanager.class.php');
if (!isset($_GET['type']) || !isset($_GET['num']) || !isset($_GET['action']))
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
if ($_GET['action'] == 'ser') {
	$list = $memm -> MemGet(array($thekey));
	if (is_array($list[0][$thekey])) {
		$tempa=array();
		foreach($list[0][$thekey] as $k => $v) {
			$k=htmlspecialchars($k);
			$v=htmlspecialchars($v);
			$tempa[$k]=$v;
		}
		echo serialize($tempa);
	} else if(gettype($list[0][$thekey])=='object') { 
		echo serialize($list[0][$thekey]);
	} else {
		echo htmlspecialchars($list[0][$thekey]);
	} 
} 
if ($_GET['action'] == 'unser') {
	$list = $memm -> MemGet(array($thekey));
	if (is_array($list[0][$thekey])||gettype($list[0][$thekey])=='object') {
		echo "<pre>";
		print_r($list[0][$thekey]);
		echo "</pre>";
	} else {
		$unser = @unserialize($list[0][$thekey]);
		if (is_array($unser)) {
			$tempa=array();
			foreach($unser as $k => $v) {
				$k=htmlspecialchars($k);
				$v=htmlspecialchars($v);
				$tempa[$k]=$v;
			}
			echo "<pre>";
			print_r($tempa);
			echo "</pre>";
		} else if ($unser == false) {
			$jsonstr = json_decode($list[0][$thekey], true);
			if ($jsonstr == null)
				echo "FormatFail";
			else if (is_array($jsonstr)) {
				$tempa=array();
				foreach($jsonstr as $k => $v) {
					$k=htmlspecialchars($k);
					$v=htmlspecialchars($v);
					$tempa[$k]=$v;
				}
				echo "<pre>";
				print_r($tempa);
				echo "</pre>";
			} else
				echo "FormatFail";
		} 
	} 
} 

?>