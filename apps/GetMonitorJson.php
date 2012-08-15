<?php
/**
 * return the monitor data
 */
require_once('./appCommon.php');
$type = $_SESSION['MADM_SESSION_KEY']['monitor'][0]['type'];
$num = $_SESSION['MADM_SESSION_KEY']['monitor'][0]['num'];
$memm = new MEMMANAGER();
$curcon = $memm -> GetConFromSession($type, $num);
$memm -> LoadMem();
if (!$memm -> is_login())
	exit("NoLogin");
if (!isset($_SESSION) || !array_key_exists('MADM_SESSION_KEY', $_SESSION) || !array_key_exists('monitor', $_SESSION['MADM_SESSION_KEY']))
	exit("SessionFail");
else {
	if ($_SESSION['MADM_SESSION_KEY']['monitor'][0]['monitor'] == 'stats') {
		if ($type == 'con') {
			if (!$memm -> MemConnect($type, $curcon))
				exit("ConnectFail");
			else {
				$list = $memm -> GetStats($curcon['host'], $curcon['port']);
				if ($list == false)
					exit("GetStatsFail");
				$rlist = array();
				foreach($_SESSION['MADM_SESSION_KEY']['monitor'][1] as $key => $value) {
					if (!array_key_exists($value, $list))
						exit("GetKeyFail");
					$rlist[$value] = $list[$value];
				} 
				$rlist['__aftime__'] = date("H:i:s");
				echo json_encode($rlist);
			} 
		} else if ($type == 'conp') {
			$conid = $_SESSION['MADM_SESSION_KEY']['monitor'][0]['conid'];
			if (!$memm -> MemConnect($type, $curcon))
				exit("ConnectFail");
			else {
				$list = $memm -> ConpGetStats();
				if ($list == false || isset($conid) && $list[$conid] == false)
					exit("GetStatsFail");
				$rlist = array();
				foreach($_SESSION['MADM_SESSION_KEY']['monitor'][1] as $key => $value) {
					if (!array_key_exists($value, $list[$conid]))
						exit("GetKeyFail");
					$rlist[$value] = $list[$conid][$value];
				} 
				$rlist['__aftime__'] = date("H:i:s");
				echo json_encode($rlist);
			} 
		} 
	} else if ($_SESSION['MADM_SESSION_KEY']['monitor'][0]['monitor'] == 'data') {
		if ($type == 'con') {
			$slabid = $_GET['slabid'];
			if (!$memm -> MemConnect($type, $curcon))
				exit("ConnectFail");
			else {
				$list = $memm -> GetStats($curcon['host'], $curcon['port']);
				$list_slab = $memm -> GetSlabs($curcon['host'], $curcon['port']);
				if ($list == false || $list_slab == false)
					exit("GetStatsFail");
				$rlist = array();
				$molist = array();
				foreach($_SESSION['MADM_SESSION_KEY']['monitor'][1] as $key => $value) {
					if (!array_key_exists($value, $list_slab[$slabid]))
						exit("GetKeyFail");
					$molist[$value] = $list_slab[$slabid][$value];
				} 
				$rlist['__aftime__'] = date("H:i:s");
				$rlist['slabid'] = $slabid;
				$rlist['curr_items'] = $list['curr_items'];
				$rlist['bytes'] = $list['bytes'];
				$rlist['active_slabs'] = $list_slab['active_slabs'];
				$rlist['total_malloced'] = $list_slab['total_malloced'];
				$rlist['mo'] = array();
				$rlist['mo'] = $molist;
				$rlist['update_select'] = array();
				foreach($list_slab as $key => $value) {
					if ($key != 'active_slabs' && $key != 'total_malloced') {
						$rlist['update_select'][] = $key;
					} 
				} 
				echo json_encode($rlist);
			} 
		} else if ($type == 'conp') {
			$conid = $_SESSION['MADM_SESSION_KEY']['monitor'][0]['conid'];
			$slabid = $_GET['slabid'];
			if (!$memm -> MemConnect($type, $curcon))
				exit("ConnectFail");
			else {
				$list = $memm -> ConpGetStats();
				$list_slab = $memm -> conpGetSlabs();
				if ($list == false || isset($conid) && $list[$conid] == false || $list_slab == false || isset($conid) && $list_slab[$conid] == false)
					exit("GetStatsFail");
				$rlist = array();
				$molist = array();
				foreach($_SESSION['MADM_SESSION_KEY']['monitor'][1] as $key => $value) {
					if (!array_key_exists($value, $list_slab[$conid][$slabid]))
						exit("GetKeyFail");
					$molist[$value] = $list_slab[$conid][$slabid][$value];
				} 
				$rlist['__aftime__'] = date("H:i:s");
				$rlist['slabid'] = $slabid;
				$rlist['curr_items'] = $list[$conid]['curr_items'];
				$rlist['bytes'] = $list[$conid]['bytes'];
				$rlist['active_slabs'] = $list_slab[$conid]['active_slabs'];
				$rlist['total_malloced'] = $list_slab[$conid]['total_malloced'];
				$rlist['mo'] = array();
				$rlist['mo'] = $molist;
				$rlist['update_select'] = array();
				foreach($list_slab[$conid] as $key => $value) {
					if ($key != 'active_slabs' && $key != 'total_malloced') {
						$rlist['update_select'][] = $key;
					} 
				} 
				echo json_encode($rlist);
			} 
		} 
	} else if ($_SESSION['MADM_SESSION_KEY']['monitor'][0]['monitor'] == 'hit') {
		if ($type == 'con') {
			if (!$memm -> MemConnect($type, $curcon))
				exit("ConnectFail");
			else {
				$list = $memm -> GetStats($curcon['host'], $curcon['port']);
				if ($list == false)
					exit("GetStatsFail");
				$rlist = array();
				if (!$memm -> is_Tykyo($type, $num, $curcon)) {
					foreach($_SESSION['MADM_SESSION_KEY']['monitor'][1] as $key => $value) {
						if ($value == 'get') {
							$rlist['get'] = array();
							$rlist['get']['cmd_get'] = $list['cmd_get'];
							$rlist['get']['get_hits'] = $list['get_hits'];
							$rlist['get']['get_misses'] = $list['get_misses'];
						} 
						if ($value == 'delete') {
							$rlist['_delete'] = array();
							$rlist['_delete']['delete_hits'] = $list['delete_hits'];
							$rlist['_delete']['delete_misses'] = $list['delete_misses'];
						} 
						if ($value == 'incr') {
							$rlist['incr'] = array();
							$rlist['incr']['incr_hits'] = $list['incr_hits'];
							$rlist['incr']['incr_misses'] = $list['incr_misses'];
						} 
						if ($value == 'decr') {
							$rlist['decr'] = array();
							$rlist['decr']['decr_hits'] = $list['decr_hits'];
							$rlist['decr']['decr_misses'] = $list['decr_misses'];
						} 
						if ($value == 'cas') {
							$rlist['cas'] = array();
							$rlist['cas']['cas_hits'] = $list['cas_hits'];
							$rlist['cas']['cas_misses'] = $list['cas_misses'];
						} 
						if ($value == 'touch') {
							$rlist['touch'] = array();
							$rlist['touch']['touch_hits'] = $list['touch_hits'];
							$rlist['touch']['touch_misses'] = $list['touch_misses'];
						}
					} 
					$rlist['__aftime__'] = date("H:i:s");
					$rlist['__rtype__'] = 'memcache';
				} else {
					foreach($_SESSION['MADM_SESSION_KEY']['monitor'][1] as $key => $value) {
						if ($value == 'get') {
							$rlist['get'] = array();
							$rlist['get']['cmd_get'] = $list['cmd_get'];
							$rlist['get']['cmd_get_hits'] = $list['cmd_get_hits'];
							$rlist['get']['cmd_get_misses'] = $list['cmd_get_misses'];
						} 
						if ($value == 'set') {
							$rlist['set'] = array();
							$rlist['set']['cmd_set'] = $list['cmd_set'];
							$rlist['set']['cmd_set_hits'] = $list['cmd_set_hits'];
							$rlist['set']['cmd_set_misses'] = $list['cmd_set_misses'];
						} 
						if ($value == 'delete') {
							$rlist['_delete'] = array();
							$rlist['_delete']['cmd_delete'] = $list['cmd_delete'];
							$rlist['_delete']['cmd_delete_hits'] = $list['cmd_delete_hits'];
							$rlist['_delete']['cmd_delete_misses'] = $list['cmd_delete_misses'];
						} 
					} 
					$rlist['__aftime__'] = date("H:i:s");
					$rlist['__rtype__'] = 'tokyo';
				} 
				echo json_encode($rlist);
			} 
		} else if ($type == 'conp') {
			$conid = $_SESSION['MADM_SESSION_KEY']['monitor'][0]['conid'];
			if (!$memm -> MemConnect($type, $curcon))
				exit("ConnectFail");
			else {
				$list = $memm -> ConpGetStats();
				if ($list == false || isset($conid) && $list[$conid] == false)
					exit("GetStatsFail");
				$rlist = array();
				if (!$memm -> is_Tykyo($type, $conid, $curcon)) {
					foreach($_SESSION['MADM_SESSION_KEY']['monitor'][1] as $key => $value) {
						if ($value == 'get') {
							$rlist['get'] = array();
							$rlist['get']['cmd_get'] = $list[$conid]['cmd_get'];
							$rlist['get']['get_hits'] = $list[$conid]['get_hits'];
							$rlist['get']['get_misses'] = $list[$conid]['get_misses'];
						} 
						if ($value == 'delete') {
							$rlist['_delete'] = array();
							$rlist['_delete']['delete_hits'] = $list[$conid]['delete_hits'];
							$rlist['_delete']['delete_misses'] = $list[$conid]['delete_misses'];
						} 
						if ($value == 'incr') {
							$rlist['incr'] = array();
							$rlist['incr']['incr_hits'] = $list[$conid]['incr_hits'];
							$rlist['incr']['incr_misses'] = $list[$conid]['incr_misses'];
						} 
						if ($value == 'decr') {
							$rlist['decr'] = array();
							$rlist['decr']['decr_hits'] = $list[$conid]['decr_hits'];
							$rlist['decr']['decr_misses'] = $list[$conid]['decr_misses'];
						} 
						if ($value == 'cas') {
							$rlist['cas'] = array();
							$rlist['cas']['cas_hits'] = $list[$conid]['cas_hits'];
							$rlist['cas']['cas_misses'] = $list[$conid]['cas_misses'];
						} 
						if ($value == 'touch') {
							$rlist['touch'] = array();
							$rlist['touch']['touch_hits'] = $list[$conid]['touch_hits'];
							$rlist['touch']['touch_misses'] = $list[$conid]['touch_misses'];
						}
					} 
					$rlist['__aftime__'] = date("H:i:s");
					$rlist['__rtype__'] = 'memcache';
				} else {
					foreach($_SESSION['MADM_SESSION_KEY']['monitor'][1] as $key => $value) {
						if ($value == 'get') {
							$rlist['get'] = array();
							$rlist['get']['cmd_get'] = $list[$conid]['cmd_get'];
							$rlist['get']['cmd_get_hits'] = $list[$conid]['cmd_get_hits'];
							$rlist['get']['cmd_get_misses'] = $list[$conid]['cmd_get_misses'];
						} 
						if ($value == 'set') {
							$rlist['set'] = array();
							$rlist['set']['cmd_set'] = $list[$conid]['cmd_set'];
							$rlist['set']['cmd_set_hits'] = $list[$conid]['cmd_set_hits'];
							$rlist['set']['cmd_set_misses'] = $list[$conid]['cmd_set_misses'];
						} 
						if ($value == 'delete') {
							$rlist['_delete'] = array();
							$rlist['_delete']['cmd_delete'] = $list[$conid]['cmd_delete'];
							$rlist['_delete']['cmd_delete_hits'] = $list[$conid]['cmd_delete_hits'];
							$rlist['_delete']['cmd_delete_misses'] = $list[$conid]['cmd_delete_misses'];
						} 
					} 
					$rlist['__aftime__'] = date("H:i:s");
					$rlist['__rtype__'] = 'tokyo';
				} 
				echo json_encode($rlist);
			} 
		} 
	} 
} 

?>