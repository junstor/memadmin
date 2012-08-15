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
<title>Mem_Flush</title>
<script type="text/javascript" src="../include/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../include/js/mem_flush.js"></script>
<link rel="stylesheet" href="../include/css/mem_flush.css" />
<style type="text/css">
body{<?php set_font('body');?>}
</style>
<script language="javascript">
var flushconfirm="<?php echo $langs['flush_delnot'];?>";
var flushok="<?php echo $langs['flush_delok'];?>";
var type="<?php echo $type;?>";
var num="<?php echo $num;?>";
</script>
</head>
<body>
<div id="top">
<?php
	echo $langs['flush_tit'];
?>
</div>

<div id="flushall">
	<div id="flushnot"><?php echo $langs['flush_not'];?></div>
	<input id="flushbut" class="but" name="flushbut" type="button" value="<?php echo $langs['flush_but'];?>"/>
</div>
</body>
</html>