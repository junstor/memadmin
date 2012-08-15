<?php
/**
 * serialize and unserialize
 */
require_once('./appCommon.php');
if (!isset($_GET['type']) || !isset($_GET['num']) || !isset($_GET['action']))
	exit('Fail');
if(!isset($_GET['charset']))
	$cs='UTF-8';
else
	$cs=$_GET['charset'];
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
		arrayRecursive($list[0][$thekey], 'htmlspecialchars', true,$cs);
		echo serialize($list[0][$thekey]);
	} else if(gettype($list[0][$thekey])=='object') { 
		echo serialize(toutf8($list[0][$thekey],$cs));
	} else {
		echo htmlspecialchars(toutf8($list[0][$thekey],$cs));
	} 
} 
if ($_GET['action'] == 'unser') {
	$list = $memm -> MemGet(array($thekey));
	if (is_array($list[0][$thekey])||gettype($list[0][$thekey])=='object') {
		arrayRecursive($list[0][$thekey], 'htmlspecialchars', true,$cs);
		echo "<pre>";
		print_r($list[0][$thekey]);
		echo "</pre>";
	} else {
		$unser = @unserialize($list[0][$thekey]);
		if (is_array($unser)) {
			arrayRecursive($unser, 'htmlspecialchars', true,$cs);
			echo "<pre>";
			print_r($unser);
			echo "</pre>";
		} else if ($unser == false) {
			$jsonstr = json_decode($list[0][$thekey], true);
			if ($jsonstr == null)
				echo "FormatFail";
			else if (is_array($jsonstr)) {
				arrayRecursive($jsonstr, 'htmlspecialchars', true,$cs);
				echo "<pre>";
				print_r($jsonstr);
				echo "</pre>";
			} else
				echo "FormatFail";
		} 
	} 
} 

?>