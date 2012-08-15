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
	$li_init_conid=NULL;
	if(!isset($conid))
		$conid=NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Con_Items</title>
<script type="text/javascript" src="../include/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../include/js/con_items.js"></script>
<link rel="stylesheet" href="../include/css/con_items.css" />
<style type="text/css">
body{<?php set_font('body');?>}
</style>
<script language="javascript">
var type="<?php echo $type;?>";
var num="<?php echo $num;?>";
var getconid="<?php echo $conid;?>";
</script>
</head>
<body>
<div id="top">
<?php
	echo $langs['items_tit'];
?>
</div>
<?php
if($type=='con')
{
	if(!$memm->MemConnect($type,$curcon))
		echo "<div id=\"confail\">".$langs['confail']."</div>";
	else
	{
		$list=$memm->GetItems($curcon['host'],$curcon['port']);
		$list_check1=$memm->GetStats($curcon['host'],$curcon['port']);
		$list_check2=$memm->GetSettings($curcon['host'],$curcon['port']);
		if(md5(serialize($list_check1))==md5(serialize($list_check2))) {
			echo "<div id=\"confail\">".$langs['confail_tokyo_cabinet']."</div>";
		} else {
		if($list==false)
		{
			echo "<div id=\"noitems\">".$langs['noitems']."</div>";
		}
		else
		{
?>
<div id="conitems">
<div id="titandsel">
  <div id="itemstit"><span><?php echo $curcon['name'];?></span><span><?php echo $curcon['host']." : ".$curcon['port'];?></span></div>
  <div id="slabselect">
  <?php echo $langs['items_sslab'];?>： 
  <select name='slabs' id="slabs">
  <?php
  	foreach($list as $key => $value) {
		if(isset($slabid)&&$slabid==$key)
			echo "<option id=\"slab_{$key}\" value=\"{$key}\" selected=\"selected\">SLAB : {$key}</option>";
		else
			echo "<option id=\"slab_{$key}\" value=\"{$key}\">SLAB : {$key}</option>";
		if($li_init==NULL)
			$li_init=$key;
	}
	if(isset($slabid))
		$li=$slabid;
	else
		$li=$li_init;
  ?>
  </select> 
  </div>
</div>
<table id="itemstable"  cellpadding="2" cellspacing="1" >
<tr id="slabidtit"><td colspan="3">SLAB : <?php echo $li;?></td></tr>
<tr>
	<th colspan="1"><?php echo $langs['cs_arg'];?></th>
    <th colspan="1"><?php echo $langs['cs_value'];?></th>
    <th colspan="1"><?php echo $langs['cs_desc'];?></th>
</tr>
<?php
	foreach($list[$li] as $key => $value)
	{
		$lang_index="items_".$key;
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
}
else if($type=='conp') {
	if(!$memm->MemConnect($type,$curcon))
		echo "<div id=\"confail\">".$langs['confail']."</div>";
	else
	{
		$list=$memm->conpGetItems();
		$list_check=$memm->ConpGetStats();
?>	
<div id="conpitems">
<div id="titandsel">
  <div id="conpitemstit"><span><?php echo $curcon['name'];?></span></div>
  <div id="conpconselect">
  <?php echo $langs['cs_scon'];?>：
  <select name='conitemsle' id="conitemsle">
  <?php
  	foreach($list as $key => $value) {
		if(isset($conid)&&$conid==$key)
			echo "<option id=\"con_{$key}\" value=\"{$key}\" selected=\"selected\"> {$key}</option>";
		else {
			echo "<option id=\"con_{$key}\" value=\"{$key}\">{$key}</option>";
			if($conid==NULL)
				$conid=$key;
		}
		if($li_init_conid==NULL)
			$li_init_conid=$key;
	}
	if(isset($conid))
		$li_conid=$conid;
	else
		$li_conid=$li_init_conid;
  ?>
  </select> 
  </div>
  <div id="conpslabselect">
  <?php echo $langs['items_sslab'];?>： 
  <select name='conpslabs' id="conpslabs">
  <?php
  	foreach($list[$conid]['items'] as $key => $value) {
		if(isset($slabid)&&$slabid==$key)
			echo "<option id=\"slab_{$key}\" value=\"{$key}\" selected=\"selected\">SLAB : {$key}</option>";
		else
			echo "<option id=\"slab_{$key}\" value=\"{$key}\">SLAB : {$key}</option>";
		if($li_init==NULL)
			$li_init=$key;
	}
	if(isset($slabid))
		$li=$slabid;
	else
		$li=$li_init;
  ?>
  </select> 
  </div>
  </div>
<?php
	if($list[$li_conid]==false) {
		echo "<div id=\"noitems\">".$langs['noitems_conp']."</div>";
	}
	else {
		if(md5(serialize($list[$li_conid]))==md5(serialize($list_check[$li_conid]))) {
				echo "<div id=\"confail\">".$langs['confail_tokyo_cabinet']."</div>";
		} else {
?>
<table id="conpitemstable"  cellpadding="2" cellspacing="1" >
<tr id="slabidtit"><td colspan="3"><?php echo "<span>".$langs['conp_consltit']." : ".$li_conid."</span><span>SLAB : ".$li."</span>";?></td></tr>
<tr>
	<th colspan="1"><?php echo $langs['cs_arg'];?></th>
    <th colspan="1"><?php echo $langs['cs_value'];?></th>
    <th colspan="1"><?php echo $langs['cs_desc'];?></th>
</tr>
<?php
		foreach($list[$li_conid]['items'][$li] as $key => $value)
		{	
			$lang_index="items_".$key;
			$tableout="<tr><td>{$key}</td><td>{$value}</td><td>";
			if(array_key_exists($lang_index,$langs))
				$tableout.=$langs[$lang_index];
			$tableout.="</td></tr>";
			echo $tableout;
		}
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