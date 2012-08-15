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
<title>Mem_Count</title>
<script type="text/javascript" src="../include/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../include/js/mem_count.js"></script>
<link rel="stylesheet" href="../include/css/mem_count.css" />
<style type="text/css">
body{<?php set_font('body');?>}
</style>
<script language="javascript">
var valuenonum="<?php echo $langs['mems_valuenonum'];?>";
var countsuss="<?php echo $langs['mems_countsuss']?>";
var countfail="<?php echo $langs['mems_countfail'];?>";
var noempty="<?php echo $langs['mems_noempty'];?>";
var type="<?php echo $type;?>";
var num="<?php echo $num;?>";
</script>
</head>
<body>
<div id="top">
<?php
	echo $langs['mems_counttit'];
?>
</div>
<div id="keycount">
<div id="counttit"><?php echo $langs['mems_counttit'];?></div>
<div id="incr">
<div id="incrtit">INCREMENT:</div>
<div id="incrkeytit">KEY:</div>
<div id="incrkeyinput"><input id="incrkeyin" class="countinput" name="incrkeyin" type="text" /></div>
<div id="incrvaluetit">VALUE:</div>
<div id="incrvalueinput"><input id="incrvaluein" class="countinput" name="incrvaluein" type="text" /></div>
<input id="incrbut" class="but" name="incrbut" type="button" value="<?php echo $langs['mems_countsave'];?>"/>
</div>

<div id="decr">
<div id="decrtit">DECREMENT:</div>
<div id="decrkeytit">KEY:</div>
<div id="decrkeyinput"><input id="decrkeyin" class="countinput" name="decrkeyin" type="text" /></div>
<div id="decrvaluetit">VALUE:</div>
<div id="decrvalueinput"><input id="decrvaluein" class="countinput" name="decrvaluein" type="text" /></div>
<input id="decrbut" class="but" name="decrbut" type="button" value="<?php echo $langs['mems_countsave'];?>"/>
</div>

</div>
</body>
</html>