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
<title>Mem_Set</title>
<script type="text/javascript" src="../include/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../include/js/mem_set.js"></script>
<link rel="stylesheet" href="../include/css/mem_set.css" />
<style type="text/css">
body{<?php set_font('body');?>}
</style>
<script language="javascript">
var noempty="<?php echo $langs['mems_noempty'];?>";
var setsuss="<?php echo $langs['mems_setsuss'];?>";
var consavefail="<?php echo $langs['mems_consavefail'];?>";
var conpsavefail="<?php echo $langs['mems_conpsavefail'];?>";
var type="<?php echo $type;?>";
var num="<?php echo $num;?>";
</script>
</head>
<body>
<div id="top">
<?php
	echo $langs['mems_tit'];
?>
</div>

<div id="inputkey">
<div id="settit"><?php echo $langs['mems_settit'];?></div>
<div id="thekey"><div id="keytit">KEY:</div><input id="keyin" name="keyin" type="text" /></div>
<div id="thevalue"><div id="valuetit">VALUE:</div><input id="valuein" name="valuein" type="text" /></div>
<input id="addbut" class="but" name="addbut" type="button" value="SET"/>

</div>
</body>
</html>