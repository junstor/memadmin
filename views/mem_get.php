<?php
	if(!defined('IN_MADM')) exit();
	require_once("../langs/".$_SESSION["MADM_SESSION_KEY"]['lang'].".php");	
	require_once('../config.php');
	global $config;
	$curcon=$memm->GetConFromSession($type,$num);
	$memm->LoadMem();
	if(isset($getkey))
		$inputkey=$getkey;
	else
		$inputkey="";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
	if(strpos($_SERVER['HTTP_USER_AGENT'], "MSIE 8.0"))
		echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=EmulateIE7\" />";
?>
<title>Mem_Get</title>
<script type="text/javascript" src="../include/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../include/js/jquery.md5.js"></script>
<script type="text/javascript" src="../include/js/mem_get.js"></script>
<link rel="stylesheet" href="../include/css/mem_get.css" />
<style type="text/css">
body{<?php set_font('body');?>}
</style>
<script language="javascript">
var nokey="<?php echo $langs['memg_nokey'];?>";
var delconfirm="<?php echo $langs['memg_delconfirm'];?>";
var unserfail="<?php echo $langs['memg_unserfail'];?>";
var notget="<?php echo $langs['memg_notget'];?>";
var getres="<?php echo $langs['memg_getres'];?>";
var resnot="<?php echo $langs['memg_resnot'];?>";
var sert="<?php echo $langs['memg_ser'];?>";
var unsert="<?php echo $langs['memg_unser'];?>";
var del="<?php echo $langs['con_del'];?>";
var valuefail="<?php echo $langs['memg_geterror'];?>";
var loading="<?php echo $langs['itemt_loading'];?>";
var updatetit="<?php echo $langs['memg_updateres'];?>";
var type="<?php echo $type;?>";
var num="<?php echo $num;?>";
var valuetypetit="<?php echo $langs['itemt_valuetype'];?>";
var charset="<?php echo $langs['itemt_charsettit'];?>";
</script>
</head>
<body>
<div id="top">
<?php
	echo $langs['memg_tit'];
?>
</div>
<?php 
if(!$memm->MemConnect($type,$curcon)) {
	echo "<div id=\"confail\">".$langs['confail']."</div>";
} else {
?>
<div id="inputkey">
<div class="layoutfixed">
<div id="inputkeytit">KEY:</div>
<div id="form_inputkey"><input id="keyquery" name="keyquery" type="text" value="<?php echo $inputkey;?>"/></div>
<div id="getchar">
<span id="charsettit"><?php echo $langs['itemt_charsettit'];?>：</span>
<select name='selcharset' id="selcharset">
<option id="UTF-8" value="UTF-8">UTF-8</option>
<option id="GBK" value="GBK">GBK</option>
<option id="GB2312" value="GB2312">GB2312</option>
<option id="GB18030" value="GB18030">GB18030</option>
<option id="Latin-1" value="Latin-1">Latin-1</option>
</select>
</div>
<div id="inputbut"><input id="keybut" class="but" name="keybut" type="button" value="GET"/></div>
<div id="inputnot">
<?php echo $langs['memg_inputnot'];?>
</div>
</div>
</div>
<div id="showres">
</div>
<?php
}
?>
</body>
</html>