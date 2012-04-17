<?php
/**
 * MEMADMIN class
 */
if (!defined('IN_MADM')) exit();
require_once('./config.php');
class MEMADMIN {
	/**
	 * language
	 * 
	 * @var lang_temp 
	 */
	private $lang_temp;

	/**
	 * decide the login is available or not
	 * 
	 * @return boolean 
	 */
	function check() {
		global $config;
		if (isset($_POST['user']) && isset($_POST['passwd']) && isset($_POST['lang'])) {
			$user = $_POST['user'];
			$passwd = $_POST['passwd'];
			$this -> lang_temp = $_POST['lang'];
			if ($user == $config['user'] && $passwd == $config['passwd'])
				return true;
			else
				return false;
		} else
			exit;
	} 
	/**
	 * check the memcache module is loaded
	 */
	function checkmemsuport() {
		if (!extension_loaded('memcache')) {
			require_once('./views/nomemsupport.php');
			exit;
		} 
	} 
	/**
	 * initial the session
	 */
	function set_session() {
		$_SESSION["MADM_SESSION_KEY"] = array('lang' => $this -> lang_temp);
	} 
	/**
	 * check the list is saved or not
	 * 
	 * @return boolean 
	 */
	function session_havelist() {
		if (isset($_SESSION["MADM_SESSION_KEY"]['list']))
			return true;
		else
			return false;
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
	 * show the views
	 */
	function show_views() {
		if(!ini_get('session.auto_start'))
			session_start();
		if (isset($_GET['action']) && $_GET['action'] == 'login') {
			if ($this -> check()) {
				$this -> set_session();
				echo "OK";
			} else
				echo "FAIL";
			exit;
		} 
		if (isset($_GET['action']) && $_GET['action'] == 'logout') {
			unset($_SESSION["MADM_SESSION_KEY"]);
			session_destroy();
			Header("Location: index.php");
		} 
		if (!$this -> is_login()) {
			require_once('./views/login.php');
			exit;
		} 
		if (isset($_GET['action']) && $_GET['action'] == 'set.con') {
			$glo_s = 'init';
			require_once('./views/set_con.php');
			exit;
		} 
		if (isset($_GET['action']) && $_GET['action'] == 'set.con.session' && $this -> session_havelist()) {
			$glo_s = 'session';
			require_once('./views/set_con.php');
			exit;
		} 
		if (isset($_GET['action']) && $_GET['action'] == 'admin') {
			require_once('./views/memadmin.php');
			exit;
		} 
		if ($this -> is_login() && !isset($_GET['action'])) {
			Header("Location: index.php?action=set.con");
			exit;
		} 
		// other get/post method here
		require_once('./views/fail_query.php');
		exit;
	} 
} 

?>