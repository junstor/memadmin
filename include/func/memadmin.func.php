<?php
if (!defined('IN_MADM')) exit();

/**
 * get connection list from session
 * 
 * @return array 
 */
function getConsList() {
	$list = $_SESSION["MADM_SESSION_KEY"];
	return $list['list'][0]['con'][0];
} 
/**
 * get connection pool list from session
 * 
 * @return array 
 */
function getConpsList() {
	$list = $_SESSION["MADM_SESSION_KEY"];
	return $list['list'][1]['conp'][0];
} 
/**
 * get monitor data
 * 
 * @return array 
 */
function getSessionMonitor() {
	$list = $_SESSION["MADM_SESSION_KEY"]['monitor'];
	return $list;
} 

?>