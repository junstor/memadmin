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
/**
 * array to utf8 & urlencode
 *
 */
function arrayRecursive(&$array, $function, $apply_to_keys_also = false, $cs)
{
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            arrayRecursive($array[$key], $function, $apply_to_keys_also, $cs);
        } else {
            $array[$key] = $function(toutf8($value,$cs));
        }
        if ($apply_to_keys_also && is_string($key)) {   	
        }
    }
}
/**
 * return json string
 *
 * @return string
 */
function array2json($array,$cs) {
	arrayRecursive($array,'urlencode',true,$cs);
	return json_encode($array);
}
/**
 * auto charset to utf8
 *
 * @return string
 */
function toutf8($i,$t){
	switch($t) {
		case 'UTF-8':
			$i=@iconv("UTF-8","UTF-8//IGNORE",$i);
			return $i;
			break;
		case 'GBK':
			$i=@iconv("GBK","UTF-8//IGNORE",$i);
			return $i;
			break;
		case 'GB2312':
			$i=@iconv("GB2312","UTF-8//IGNORE",$i);
			return $i;
			break;
		case 'GB18030':
			$i=@iconv("GB18030","UTF-8//IGNORE",$i);
			return $i;
			break;
		case 'Latin-1':
			$i=@iconv("ISO-8859-1","UTF-8//IGNORE",$i);
			return $i;
			break;
		default:
			$i=@iconv("UTF-8","UTF-8//IGNORE",$i);
			return $i;
	}
}
?>