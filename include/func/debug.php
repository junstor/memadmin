<?php
if (!defined('IN_MADM')) exit();
require_once("../langs/" . $_SESSION["MADM_SESSION_KEY"]['lang'] . ".php");
/**
 * debug
 * 
 * @param string $state state
 * @author qianmoxr.blog.163.com 
 */
function debug($state = '') {
	global $langs;
	list($usec, $sec) = explode(" ", microtime());
	$time = ((float)$usec + (float)$sec);
	if ($state == '') {
		$GLOBALS['memoryStart'] = memory_get_usage();
		$GLOBALS['timeStart'] = $time;
	} else {
		$GLOBALS['timeEnd'] = $time;
		$GLOBALS['memoryEnd'] = memory_get_usage();
		$memory = ($GLOBALS['memoryEnd'] - $GLOBALS['memoryStart']) - 216;
		printf ("<span id=\"webruntime\">{$langs['run_time']} : %.2f ms</span><span id=\"webrunmem\">{$langs['run_memory']} : {$memory} byte</span>", ($GLOBALS['timeEnd'] - $GLOBALS['timeStart']) * 1000);
		unset($GLOBALS['memoryStart'], $GLOBALS['timeStart'], $GLOBALS['timeStart'], $GLOBALS['timeEnd'], $GLOBALS['memoryEnd']);
	} 
} 

?>