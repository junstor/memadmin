<?php
if(!ini_get('session.auto_start'))
	session_start();
define('IN_MADM', true);
error_reporting(0);
require_once('../include/class/memmanager.class.php');
$memm = new MEMMANAGER();
if (!$memm -> is_login())
	exit("NoLogin");
if (!isset($_GET['type']) || !isset($_GET['num']) || $_GET['type'] != 'con' && $_GET['type'] != 'conp')
	exit;
if (isset($_GET['action']) && $_GET['action'] == 'showcon') {
	$type = $_GET['type'];
	$num = $_GET['num'];
	require_once('show_con.php');
} 
if (isset($_GET['action']) && $_GET['action'] == 'constatus') {
	$type = $_GET['type'];
	$num = $_GET['num'];
	if (isset($_GET['conid']))
		$conid = $_GET['conid'];
	require_once('con_status.php');
} 
if (isset($_GET['action']) && $_GET['action'] == 'consettings') {
	$type = $_GET['type'];
	$num = $_GET['num'];
	if (isset($_GET['consetid']))
		$consetid = $_GET['consetid'];
	require_once('con_settings.php');
} 
if (isset($_GET['action']) && $_GET['action'] == 'conitems') {
	$type = $_GET['type'];
	$num = $_GET['num'];
	if (isset($_GET['slabid']))
		$slabid = $_GET['slabid'];
	if (isset($_GET['conid']))
		$conid = $_GET['conid'];
	require_once('con_items.php');
} 
if (isset($_GET['action']) && $_GET['action'] == 'consizes') {
	$type = $_GET['type'];
	$num = $_GET['num'];
	if (isset($_GET['conid']))
		$conid = $_GET['conid'];
	require_once('con_sizes.php');
} 
if (isset($_GET['action']) && $_GET['action'] == 'conslabs') {
	$type = $_GET['type'];
	$num = $_GET['num'];
	if (isset($_GET['slabid']))
		$slabid = $_GET['slabid'];
	if (isset($_GET['conid']))
		$conid = $_GET['conid'];
	require_once('con_slabs.php');
} 
if (isset($_GET['action']) && $_GET['action'] == 'statsmonitor') {
	$type = $_GET['type'];
	$num = $_GET['num'];
	if (isset($_GET['conid']))
		$conid = $_GET['conid'];
	require_once('stats_monitor.php');
} 
if (isset($_GET['action']) && $_GET['action'] == 'datamonitor') {
	$type = $_GET['type'];
	$num = $_GET['num'];
	if (isset($_GET['conid']))
		$conid = $_GET['conid'];
	require_once('data_monitor.php');
} 
if (isset($_GET['action']) && $_GET['action'] == 'hitmonitor') {
	$type = $_GET['type'];
	$num = $_GET['num'];
	if (isset($_GET['conid']))
		$conid = $_GET['conid'];
	require_once('hit_monitor.php');
} 
if (isset($_GET['action']) && $_GET['action'] == 'memget') {
	$type = $_GET['type'];
	$num = $_GET['num'];
	if (isset($_GET['getkey']))
		$getkey = $_GET['getkey'];
	require_once('mem_get.php');
} 
if (isset($_GET['action']) && $_GET['action'] == 'memset') {
	$type = $_GET['type'];
	$num = $_GET['num'];
	require_once('mem_set.php');
} 
if (isset($_GET['action']) && $_GET['action'] == 'memflush') {
	$type = $_GET['type'];
	$num = $_GET['num'];
	require_once('mem_flush.php');
} 
if (isset($_GET['action']) && $_GET['action'] == 'memcount') {
	$type = $_GET['type'];
	$num = $_GET['num'];
	require_once('mem_count.php');
} 
if (isset($_GET['action']) && $_GET['action'] == 'itemtrav') {
	$type = $_GET['type'];
	$num = $_GET['num'];
	if (isset($_GET['slabid']))
		$slabid = $_GET['slabid'];
	if (isset($_GET['conid']))
		$conid = $_GET['conid'];
	require_once('item_trav.php');
} 
if (isset($_GET['action']) && $_GET['action'] == 'filtertrav') {
	$type = $_GET['type'];
	$num = $_GET['num'];
	if (isset($_GET['slabid']))
		$slabid = $_GET['slabid'];
	if (isset($_GET['conid']))
		$conid = $_GET['conid'];
	require_once('item_filtertrav.php');
} 

?>