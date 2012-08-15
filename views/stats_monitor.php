<?php
	if(!defined('IN_MADM')) exit();
	require_once("../langs/".$_SESSION["MADM_SESSION_KEY"]['lang'].".php");	
	require_once('../config.php');
	global $config;
	require_once('../include/func/debug.php');
	debug();
	$curcon=$memm->GetConFromSession($type,$num);
	$memm->LoadMem();
	$li_init=NULL;
	$monitorarr=array('rusage_user','rusage_system','curr_connections','total_connections','cmd_get','cmd_set','cmd_flush','cmd_touch','bytes_read','bytes_written','accepting_conns','listen_disabled_num','conn_yields','bytes','curr_items','total_items','evictions','reclaimed','hash_bytes','expired_unfetched','evicted_unfetched');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Con_Status</title>
<script type="text/javascript" src="../include/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../include/js/stats_monitor.js"></script>
<link rel="stylesheet" href="../include/css/stats_monitor.css" />
<style type="text/css">
body{<?php set_font('body');?>}
#checktit{<?php set_font('h1');?>}
</style>
<script language="javascript">
var nocheck="<?php echo $langs['nocheck'];?>";
var type="<?php echo $type;?>";
var num="<?php echo $num;?>";
</script>
</head>
<body>
<div id="top">
<?php
	echo $langs['statsmo_tit'];
?>
</div>
<?php
if($type=='con') {
	if(!$memm->MemConnect($type,$curcon))
		echo "<div id=\"confail\">".$langs['confail']."</div>";
	else {
		$list=$memm->GetStats($curcon['host'],$curcon['port']);
		if($list==false)
		{
			echo "<div id=\"nostats\">".$langs['nostats']."</div>";
		}
		else
		{
?>
<div id="statustit"><span><?php echo $curcon['name'];?></span><span><?php echo $curcon['host']." : ".$curcon['port'];?></span></div>
<div id="statscheck">
<div id="checktit"><?php echo $langs['statsmo_arg'];?></div>
<div id="checktableframe1">
<table id="checktable1" class="checktable"  cellpadding="2" cellspacing="1" >
<tr>
	<th colspan="1"><?php echo $langs['statsmo_check'];?></th>
	<th colspan="1"><?php echo $langs['cs_arg'];?></th>
    <th colspan="1"><?php echo $langs['cs_desc'];?></th>
</tr>
<?php
	foreach($monitorarr as $key => $value) {
		$lang_index="cs_".$value;
		if(array_key_exists($value,$list)) {
			$tempstr="<tr><label for=\"checkbox_{$value}\"><td class=\"checktd\"><input type=\"checkbox\" class=\"checkmo\" name=\"checkbox_monitor[]\" id=\"checkbox_{$value}\" value=\"{$value}\"/></td><td>{$value}</td><td>";
			if(array_key_exists($lang_index,$langs))
				$tempstr.=$langs[$lang_index];
			$tempstr.="</td></label></tr>";
			echo $tempstr;
		}
	}
?>
</table>
</div>
</div>
<div id="checkctrl">
<a id="seall" href="javascript:;"><?php echo $langs['statsmo_sall'];?></a><a id="ceall" href="javascript:;"><?php echo $langs['statsmo_call'];?></a><a id="opall" href="javascript:;"><?php echo $langs['statsmo_oall'];?></a>
</div>
<div id="gomonitor">
<input id="gomonitorbut" class="but" name="gomonitorbut" type="button" value="<?php echo $langs['statsmo_start'];?>"/>
</div>
<?php
		}
	}
}
else if($type=='conp') {
	if(!$memm->MemConnect($type,$curcon))
		echo "<div id=\"confail\">".$langs['confail']."</div>";
	else {
		$list=$memm->ConpGetStats();
		if($list==false)
		{
			echo "<div id=\"nostats\">".$langs['nostats']."</div>";
		}
		else
		{
?>
<div id="conptitandsel">
  <div id="conpstatustit"><span><?php echo $curcon['name'];?></span></div>
  <div id="conpstatconselect">
  <?php echo $langs['statsmo_scon'];?>： 
  <select name='scons' id="scons">
  <?php
  	foreach($list as $key => $value) {
		if(isset($conid)&&$conid==$key)
			echo "<option id=\"con_{$key}\" value=\"{$key}\" selected=\"selected\"> {$key}</option>";
		else
			echo "<option id=\"con_{$key}\" value=\"{$key}\">{$key}</option>";
		if($li_init==NULL)
			$li_init=$key;
	}
	if(isset($conid))
		$li=$conid;
	else
		$li=$li_init;
  ?>
  </select> 
  </div>	
  </div>		
<?php
		if($list==false||isset($li)&&$list[$li]==false)
		{
			echo "<div id=\"confail\">".$langs['confail']."</div>";
		}
		else
		{
?>	
<div id="statscheck" class="conpsc">
<div id="checktit"><?php echo $langs['statsmo_arg'];?></div>
<div id="checktableframe1">
<table id="checktable1" class="checktable"  cellpadding="2" cellspacing="1" >
<tr>
	<th colspan="1"><?php echo $langs['statsmo_check'];?></th>
	<th colspan="1"><?php echo $langs['cs_arg'];?></th>
    <th colspan="1"><?php echo $langs['cs_desc'];?></th>
</tr>
<?php
	foreach($monitorarr as $key => $value) {
		$lang_index="cs_".$value;
		if(array_key_exists($value,$list[$li])) {
			$tempstr="<tr><label for=\"checkbox_{$value}\"><td class=\"checktd\"><input type=\"checkbox\" class=\"checkmo\" name=\"checkbox_monitor\" id=\"checkbox_{$value}\" value=\"{$value}\"/></td><td>{$value}</td><td>";
			if(array_key_exists($lang_index,$langs))
				$tempstr.=$langs[$lang_index];
			$tempstr.="</td></label></tr>";
			echo $tempstr;
		}
	}
?>
</table>
</div>
</div>
<div id="checkctrl" class="conpchectrl">
<a id="seall" href="javascript:;"><?php echo $langs['statsmo_sall'];?></a><a id="ceall" href="javascript:;"><?php echo $langs['statsmo_call'];?></a><a id="opall" href="javascript:;"><?php echo $langs['statsmo_oall'];?></a>
</div>
<div id="gomonitor" class="conpgomonitor">
<input id="gomonitorbut" class="but" name="gomonitorbut" type="button" value="<?php echo $langs['statsmo_start'];?>"/>
</div>	
<?php	
		}
		}
	}
}
?>
<div id="footer"></div>
</body>
</html>