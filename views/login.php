<?php
if(!defined('IN_MADM')) exit();
require_once('./config.php');
global $config;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login - MemAdmin -<?php echo $config['version'];?></title>
<script type="text/javascript" src="include/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="include/js/login.js"></script>
<link type="text/css" href="include/css/login.css" rel="stylesheet" />
</head>
<body>
<div id="l_main">
	<div id="nojs">
		To Login you need JavaScript 
	</div>
  <div id="l_login">
    <div id="l_logo"> MemAdmin - <?php echo $config['version'];?> </div>
    <div id="l_in">
      <p class="l_in_p"><span>Username：</span>
        <input id="l_in_user" name="user" type="text">
      </p>
      <p class="l_in_p"><span>Password：</span>
        <input id="l_in_pass" name="passwd" type="password">
      </p>
      <p class="l_in_p"><span>Language：</span>
        <select id="selectLang">
          <option value="zh-cn">简体中文</option>
          <option value="en-us">English</option>
        </select>
      </p>
      <p>
        <input id="l_but" name="but" type="button" value="Login">
      </p>
      <div id="l_show_callbak"></div>
    </div>
    <div id="l_info">
      <ul>
        <li>Your default username and password is 'admin'</li>
        <li>You can change your username and password in config.php</li>
      </ul>
    </div>
  </div>
</div>
</body>
</html>