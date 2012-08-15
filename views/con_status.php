<?php
	if(!defined('IN_MADM')) exit();
	require_once('../include/func/debug.php');
	debug();
	require_once("../langs/".$_SESSION["MADM_SESSION_KEY"]['lang'].".php");	
	require_once('../config.php');
	global $config;
	$curcon=$memm->GetConFromSession($type,$num);
	$memm->LoadMem();
	$li_init=NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Con_Status</title>
<script type="text/javascript" src="../include/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../include/js/con_status.js"></script>
<link rel="stylesheet" href="../include/css/con_status.css" />
<style type="text/css">
body{<?php set_font('body');?>}
</style>
<script language="javascript">
var type="<?php echo $type;?>";
var num="<?php echo $num;?>";
</script>
</head>
<body>
<div id="top">
<?php
	echo $langs['cs_tit'];
?>
</div>
<?php
if($type=='con') {
	if(!$memm->MemConnect($type,$curcon))
		echo "<div id=\"confail\">".$langs['confail']."</div>";
	else
	{
		$list=$memm->GetStats($curcon['host'],$curcon['port']);
		if($list==false)
		{
			echo "<div id=\"nostats\">".$langs['nostats']."</div>";
		}
		else
		{
?>
<div id="constat">
  <div id="statustit"><span><?php echo $curcon['name'];?></span><span><?php echo $curcon['host']." : ".$curcon['port'];?></span></div>
<table id="statustable"  cellpadding="2" cellspacing="1" >
<tr>
	<th colspan="1"><?php echo $langs['cs_arg'];?></th>
    <th colspan="1"><?php echo $langs['cs_value'];?></th>
    <th colspan="1"><?php echo $langs['cs_desc'];?></th>
</tr>
<?php
	foreach($list as $key => $value)
	{
		$lang_index="cs_".$key;
		$tableout="<tr><td>{$key}</td><td>{$value}</td><td>";
		if(array_key_exists($lang_index,$langs))
			$tableout.=$langs[$lang_index];
		$tableout.="</td></tr>";
		echo $tableout;
	}
?>
</table>
</div>
<?php
		}
	}
}
else if($type=='conp') {
	if(!$memm->MemConnect($type,$curcon))
		echo "<div id=\"confail\">".$langs['confail']."</div>";
	else
	{
		$list=$memm->ConpGetStats();
?>			
<div id="conpstat">
  <div id="conptitandsel">
  <div id="conpstatustit"><span><?php echo $curcon['name'];?></span></div>
  <div id="conpstatconselect">
  <?php echo $langs['cs_scon'];?>： 
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
		if($list==false||isset($conid)&&$list[$conid]==false)
		{
			echo "<div id=\"confail\">".$langs['confail']."</div>";
		}
		else
		{
?>
<table id="conpstatustable"  cellpadding="2" cellspacing="1" >
<tr id="conidtit"><td colspan="3"><?php echo $langs['conp_consltit']." : ".$li;?></td></tr>
<tr>
	<th colspan="1"><?php echo $langs['cs_arg'];?></th>
    <th colspan="1"><?php echo $langs['cs_value'];?></th>
    <th colspan="1"><?php echo $langs['cs_desc'];?></th>
</tr>
<?php
	foreach($list[$li] as $key => $value)
	{
		$lang_index="cs_".$key;
		$tableout="<tr><td>{$key}</td><td>{$value}</td><td>";
		if(array_key_exists($lang_index,$langs))
			$tableout.=$langs[$lang_index];
		$tableout.="</td></tr>";
		echo $tableout;
	}
?>
</table>
</div>				
<?php		
		}
	}
}
?>
<div id="debug">
<?php debug('end');?>
</div>
</body>
</html>