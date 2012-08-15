<?php
/**
 * MEMMANAGER class
 */
if (!defined('IN_MADM')) exit();
define('ROOT', str_replace("\\", '/', dirname(__FILE__)));
require_once("../include/func/memadmin.func.php");

class MEMMANAGER {
	/**
	 * memcache connection handle 
	 * 
	 * @var memcache_obj 
	 */
	private $memcache_obj = null;
	/**
	 * check the memcache module is loaded
	 */
	function LoadMem() {
		if (!extension_loaded('memcache')) {
			exit("Fail : no memcache support");
		} 
	} 
	/**
	 * check login
	 * 
	 * @return boolean 
	 */
	function is_login() {
		if (isset($_SESSION) && array_key_exists("MADM_SESSION_KEY", $_SESSION))
			return true;
		else
			return false;
	} 
	/**
	 * get connection information from session
	 * 
	 * @param string $type the connection type
	 * @param int $num the connection index
	 * @return array 
	 */
	function GetConFromSession($type, $num) {
		if ($type == 'con') {
			$list = getConsList();
			return $list['cons'][$num];
		} else {
			$list = getConpsList();
			return $list['conps'][$num];
		} 
	} 
	/**
	 * add connection to the connection pool
	 * 
	 * @param array $conarr connection array
	 */
	function multiaddServer($conarr) {
		switch (count($conarr)) {
			case 2:
				$this -> memcache_obj -> addServer($conarr[0], $conarr[1]);
				break;
			case 3:
				$this -> memcache_obj -> addServer($conarr[0], $conarr[1], $conarr[2]);
				break;
			case 4:
				$this -> memcache_obj -> addServer($conarr[0], $conarr[1], $conarr[2], $conarr[3]);
				break;
			case 5:
				$this -> memcache_obj -> addServer($conarr[0], $conarr[1], $conarr[2], $conarr[3], $conarr[4]);
				break;
			case 6:
				$this -> memcache_obj -> addServer($conarr[0], $conarr[1], $conarr[2], $conarr[3], $conarr[4], $conarr[5]);
				break;
			case 7:
				$this -> memcache_obj -> addServer($conarr[0], $conarr[1], $conarr[2], $conarr[3], $conarr[4], $conarr[5], $conarr[6]);
				break;
		} 
	} 
	/**
	 * create connection
	 * 
	 * @param string $type the connection type
	 * @param array $curcon the connection index
	 * @return boolean 
	 */
	function MemConnect($type, $curcon) {
		$this -> memcache_obj = new Memcache;
		if ($type == 'con') {
			if ($curcon['ispcon'] == 0) {
				if ($curcon['timeout'] == 1) {
					if (!@$this -> memcache_obj -> connect($curcon['host'], $curcon['port']))
						return false;
				} else {
					if (!@$this -> memcache_obj -> connect($curcon['host'], $curcon['port'], $curcon['timeout']))
						return false;
				} 
			} else {
				if ($curcon['timeout'] == 1) {
					if (!@$this -> memcache_obj -> pconnect($curcon['host'], $curcon['port']))
						return false;
				} else {
					if (!@$this -> memcache_obj -> pconnect($curcon['host'], $curcon['port'], $curcon['timeout']))
						return false;
				} 
			} 
		} 
		if ($type == 'conp') {
			$this -> memcache_obj = new Memcache;
			$conarr = array();
			for($i = 0;$i < $curcon['num'];$i++) {
				$conarr[$i] = array();
				$carg = array();
				if ($curcon['conlist'][$i]['status'] == 1)
					$carg[] = "FALSE";
				if ($curcon['conlist'][$i]['retry'] != 15)
					$carg[] = $curcon['conlist'][$i]['retry'];
				else if ($curcon['conlist'][$i]['retry'] == 15 && count($carg) != 0)
					$carg[] = $curcon['conlist'][$i]['retry'];
				if ($curcon['conlist'][$i]['timeout'] != 1)
					$carg[] = $curcon['conlist'][$i]['timeout'];
				else if ($curcon['conlist'][$i]['timeout'] == 1 && count($carg) != 0)
					$carg[] = $curcon['conlist'][$i]['timeout'];
				if ($curcon['conlist'][$i]['weight'] != "")
					$carg[] = $curcon['conlist'][$i]['weight'];
				else if ($curcon['conlist'][$i]['weight'] == "" && count($carg) != 0)
					$carg[] = 1;
				if ($curcon['conlist'][$i]['pcon'] == 0)
					$carg[] = "FALSE";
				else if ($curcon['conlist'][$i]['pcon'] == 1 && count($carg) != 0)
					$carg[] = $curcon['conlist'][$i]['pcon'];
				$carg[] = $curcon['conlist'][$i]['port'];
				$carg[] = $curcon['conlist'][$i]['host'];
				for($k = count($carg)-1;$k >= 0;$k--) {
					$conarr[$i][count($carg) - $k-1] = $carg[$k];
				} 
				$carg = null;
				$this -> multiaddServer($conarr[$i]);
			} 
		} 
		return true;
	} 
	/**
	 * check if the connection is the tokyo tyran
	 * 
	 * @param string $type the connection type
	 * @param int $num the connection index
	 * @param array $curcon the connection information array
	 * @return boolean 
	 */
	function is_Tykyo($type, $num, $curcon) {
		if ($type == 'con') {
			$list = $this -> GetSettings($curcon['host'], $curcon['port']);
			$list_check = $this -> GetStats($curcon['host'], $curcon['port']);
			if (md5(serialize($list)) == md5(serialize($list_check)))
				return true;
			else
				return false;
		} 
		if ($type == 'conp') {
			$list = $this -> conpGetSettings();
			$list_check = $this -> ConpGetStats();
			if (md5(serialize($list[$num])) == md5(serialize($list_check[$num])))
				return true;
			else
				return false;
		} 
	} 
	/**
	 * get the statistics information of the connection pool
	 * 
	 * @return array 
	 */
	function ConpGetStats() {
		$list = @$this -> memcache_obj -> getExtendedStats();
		return $list;
	} 
	/**
	 * get the settings information of the connection pool
	 * 
	 * @return array 
	 */
	function conpGetSettings() {
		$list = @$this -> memcache_obj -> getExtendedStats('settings');
		return $list;
	} 
	/**
	 * get the items information of the connection pool
	 * 
	 * @return array 
	 */
	function conpGetItems() {
		$list = @$this -> memcache_obj -> getExtendedStats('items');
		return $list;
	} 
	/**
	 * get the sizes information of the connection pool
	 * 
	 * @return array 
	 */
	function conpGetSizes() {
		$list = @$this -> memcache_obj -> getExtendedStats('sizes');
		return $list;
	} 
	/**
	 * get the settings information of the connection
	 * 
	 * @param string $host hostname
	 * @param int $port port
	 * @return array 
	 */
	function GetStats($host, $port) {
		$list = $this -> memcache_obj -> getExtendedStats();
		$key = $host . ":" . $port;
		return $list[$key];
	} 
	/**
	 * get the settings information of the connection
	 * 
	 * @param string $host hostname
	 * @param int $port port
	 * @return array 
	 */
	function GetSettings($host, $port) {
		$list = $this -> memcache_obj -> getExtendedStats('settings');
		$key = $host . ":" . $port;
		return $list[$key];
	} 
	/**
	 * get the items information of the connection
	 * 
	 * @param string $host hostname
	 * @param int $port port
	 * @return array 
	 */
	function GetItems($host, $port) {
		$list = $this -> memcache_obj -> getExtendedStats('items');
		$key = $host . ":" . $port;
		if ($list[$key] == false)
			return false;
		else if (array_key_exists('items', $list[$key]))
			return $list[$key]['items'];
		else
			return false;
	} 
	/**
	 * get the sizes information of the connection
	 * 
	 * @param string $host hostname
	 * @param int $port port
	 * @return array 
	 */
	function GetSizes($host, $port) {
		$list = $this -> memcache_obj -> getExtendedStats('sizes');
		$key = $host . ":" . $port;
		return $list[$key];
	} 
	/**
	 * get the slabs information of the connection
	 * 
	 * @param string $host hostname
	 * @param int $port port
	 * @return array 
	 */
	function GetSlabs($host, $port) {
		$list = $this -> memcache_obj -> getExtendedStats('slabs');
		$key = $host . ":" . $port;
		return $list[$key];
	} 
	/**
	 * get the slabs information of the connection pool
	 * 
	 * @return array 
	 */
	function conpGetSlabs() {
		$list = @$this -> memcache_obj -> getExtendedStats('slabs');
		return $list;
	} 
	/**
	 * delete an item
	 * 
	 * @param string $key key
	 * @return boolean 
	 */
	function MemDel($key) {
		return $this -> memcache_obj -> delete($key);
	} 
	/**
	 * get some items
	 * 
	 * @param string $key key
	 * @return array 
	 */
     function MemGet($key) {
        $flags = "";
		$list = @$this -> memcache_obj -> get($key, $flags);
		$rlist = array();
		$rlist[0] = array();
		$rlist[1] = array();
		$rlist[0] = $list;
		$rlist[1] = $flags;
		return $rlist;
	} 
	/**
	 * set command
	 * 
	 * @param string $key key
	 * @param string $value value
	 * @return boolean 
	 */
	function MemSet($key, $value) {
		return $this -> memcache_obj -> set($key, $value);
	} 
	/**
	 * increment command
	 * 
	 * @param string $key key
	 * @param string $value value
	 * @return boolean 
	 */
	function MemIncr($key, $value) {
		return $this -> memcache_obj -> increment($key, (int)$value);
	} 
	/**
	 * decrement command
	 * 
	 * @param string $key key
	 * @param string $value value
	 * @return boolean 
	 */
	function MemDecr($key, $value) {
		return $this -> memcache_obj -> decrement($key, (int)$value);
	} 
	/**
	 * traverse
	 * 
	 * @param int $slabid slabid
	 * @param int $num the connection index
	 * @return array 
	 */
	function MemCacheDump($slabid, $num) {
		return $this -> memcache_obj -> getExtendedStats("cachedump", $slabid, $num);
	} 
	/**
	 * traverse the connection pool
	 * 
	 * @param int $slabid slabid
	 * @param int $num the connection index
	 * @return array 
	 */
	function conpMemCacheDump($conid, $slabid, $num) {
		$list = $this -> memcache_obj -> getExtendedStats("cachedump", $slabid, $num);
		return $list[$conid];
	} 
	/**
	 * flush all
	 * 
	 * @return boolean 
	 */
	function flushAll() {
		return @$this -> memcache_obj -> flush();
	} 
} 

?>
