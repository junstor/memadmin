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
<script type="text/javascript" src="../include/js/con_slabs.js"></script>
<link rel="stylesheet" href="../include/css/con_slabs.css" />
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
	echo $langs['slabs_tit'];
?>
</div>
<?php
if($type=='con')
{
	if(!$memm->MemConnect($type,$curcon))
		echo "<div id=\"confail\">".$langs['confail']."</div>";
	else
	{
		$list=$memm->GetSlabs($curcon['host'],$curcon['port']);
		$list_check=$memm->GetStats($curcon['host'],$curcon['port']);
		if(md5(serialize($list))==md5(serialize($list_check))) {
			echo "<div id=\"confail\">".$langs['confail_tokyo_cabinet']."</div>";
		} else {
			if($list==false)
			{
				echo "<div id=\"noslabs\">".$langs['noslabs']."</div>";
			}
			else
			{
?>
<div id="conslabs">
<div id="titandsel">
  <div id="slabstit"><span><?php echo $curcon['name'];?></span><span><?php echo $curcon['host']." : ".$curcon['port'];?></span></div>
  <div id="topslabs">
  	<table id="itemstable"  cellpadding="2" cellspacing="1" >
	<tr>
		<th colspan="1"><?php echo $langs['cs_arg'];?></th>
    	<th colspan="1"><?php echo $langs['cs_value'];?></th>
    	<th colspan="1"><?php echo $langs['cs_desc'];?></th>
	</tr>
<?php
		$tableout="<tr><td>active_slabs</td><td>".$list['active_slabs']."</td><td>";
		if(array_key_exists('slabs_active_slabs',$langs))
			$tableout.=$langs['slabs_active_slabs'];
		$tableout.="</td></tr>";
		$tableout.="<tr><td>total_malloced</td><td>".$list['total_malloced']."</td><td>";
		if(array_key_exists('slabs_total_malloced',$langs))
			$tableout.=$langs['slabs_total_malloced'];
		$tableout.="</td></tr>";
		echo $tableout;
?>
	</table>
  </div>
  <div id="slabselect">
  <?php echo $langs['slabs_sslab'];?>： 
  <select name='slabs' id="slabs">
  <?php
  	foreach($list as $key => $value) {
		if($key!='active_slabs'&&$key!='total_malloced') {
			if(isset($slabid)&&$slabid==$key)
				echo "<option id=\"slab_{$key}\" value=\"{$key}\" selected=\"selected\">SLAB : {$key}</option>";
			else
				echo "<option id=\"slab_{$key}\" value=\"{$key}\">SLAB : {$key}</option>";
			if($li_init==NULL)
				$li_init=$key;
		}
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
if(!array_key_exists($li,$list)) {
	echo "<div id=\"noslabs\">".$langs['noslabs_noitems']."</div>";
} else {
?>
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
		$lang_index="slabs_".$key;
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
}
else if($type=='conp') {
	if(!$memm->MemConnect($type,$curcon))
		echo "<div id=\"confail\">".$langs['confail']."</div>";
	else
	{
		$list=$memm->conpGetSlabs();
		$list_check=$memm->ConpGetStats();	
			
		$outopt="";
		foreach($list as $key => $value) {
			if(isset($conid)&&$conid==$key)
				$outopt.="<option id=\"con_{$key}\" value=\"{$key}\" selected=\"selected\"> {$key}</option>";
			else {
				$outopt.="<option id=\"con_{$key}\" value=\"{$key}\">{$key}</option>";
				if($conid==NULL)
					$conid=$key;
			}
			if($li_init_conid==NULL)
				$li_init_conid=$key;
		}
?>	
<div id="conpitems">
<div id="titandsel">
  <div id="conpitemstit"><span><?php echo $curcon['name'];?></span></div>
  <div id="conpconselect">
  <?php echo $langs['cs_scon'];?>：
  <select name='conitemselect' id="conitemselect">
  <?php
  	echo $outopt;
	if(isset($conid))
		$li_conid=$conid;
	else
		$li_conid=$li_init_conid;
  ?>
  </select> 
  </div>
  <?php
  	if($list[$li_conid]==false)
		echo "<div id=\"confail\">".$langs['confail']."</div>";
	else {
		if(md5(serialize($list[$li_conid]))==md5(serialize($list_check[$li_conid]))) {
				echo "<div id=\"confail\">".$langs['confail_tokyo_cabinet']."</div>";
		} else {
  ?>
  <div id="topslabs">
  	<table id="itemstable"  cellpadding="2" cellspacing="1" >
	<tr>
		<th colspan="1"><?php echo $langs['cs_arg'];?></th>
    	<th colspan="1"><?php echo $langs['cs_value'];?></th>
    	<th colspan="1"><?php echo $langs['cs_desc'];?></th>
	</tr>
<?php
		$tableout="<tr><td>active_slabs</td><td>".$list[$li_conid]['active_slabs']."</td><td>";
		if(array_key_exists('slabs_active_slabs',$langs))
			$tableout.=$langs['slabs_active_slabs'];
		$tableout.="</td></tr>";
		$tableout.="<tr><td>total_malloced</td><td>".$list[$li_conid]['total_malloced']."</td><td>";
		if(array_key_exists('slabs_total_malloced',$langs))
			$tableout.=$langs['slabs_total_malloced'];
		$tableout.="</td></tr>";
		echo $tableout;
?>
	</table>
  </div>
  <div id="conpslabselect">
  <?php echo $langs['items_sslab'];?>： 
  <select name='conpslabs' id="conpslabs">
  <?php
  	foreach($list[$conid] as $key => $value) {
		if($key!='active_slabs'&&$key!='total_malloced') {
			if(isset($slabid)&&$slabid==$key)
				echo "<option id=\"slab_{$key}\" value=\"{$key}\" selected=\"selected\">SLAB : {$key}</option>";
			else
				echo "<option id=\"slab_{$key}\" value=\"{$key}\">SLAB : {$key}</option>";
			if($li_init==NULL)
				$li_init=$key;
		}
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
		echo "<div id=\"confail\">".$langs['confail']."</div>";
	}
	else {
		if(!array_key_exists($li,$list[$li_conid])) {
			echo "<div id=\"noslabs\">".$langs['noslabs_noitems']."</div>";
		} else {
?>
<table id="itemstable"  cellpadding="2" cellspacing="1" >
<tr id="slabidtit"><td colspan="3"><?php echo "<span>".$langs['conp_consltit']." : ".$li_conid."</span><span>SLAB : ".$li."</span>";?></td></tr>
<tr>
	<th colspan="1"><?php echo $langs['cs_arg'];?></th>
    <th colspan="1"><?php echo $langs['cs_value'];?></th>
    <th colspan="1"><?php echo $langs['cs_desc'];?></th>
</tr>
<?php
		foreach($list[$li_conid][$li] as $key => $value)
		{	
			$lang_index="slabs_".$key;
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
	}
}
?>
<div id="debug">
<?php debug('end');?>
</div>
</body>
</html>