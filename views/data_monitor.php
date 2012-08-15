<?php
	if(!defined('IN_MADM')) exit();
	require_once("../langs/".$_SESSION["MADM_SESSION_KEY"]['lang'].".php");	
	require_once('../config.php');
	global $config;
	require_once('../include/func/debug.php');
	debug();
	$curcon=$memm->GetConFromSession($type,$num);
	$memm->LoadMem();
	$monitorarr=array('chunk_size','chunks_per_page','total_pages','total_chunks','used_chunks','free_chunks','free_chunks_end','mem_requested');
	$li_init=NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Con_Status</title>
<script type="text/javascript" src="../include/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../include/js/data_monitor.js"></script>
<link rel="stylesheet" href="../include/css/data_monitor.css" />
<style type="text/css">
body{<?php set_font('body');?>}
#checktit,#conpchecktit{<?php set_font('h1');?>}
</style>
<script language="javascript">
var type="<?php echo $type;?>";
var num="<?php echo $num;?>";
</script>
</head>
<body>
<div id="top">
<?php
	echo $langs['datamo_tit'];
?>
</div>
<?php
if($type=='con') {
	if(!$memm->MemConnect($type,$curcon))
		echo "<div id=\"confail\">".$langs['confail']."</div>";
	else {
		$list=$memm->GetSlabs($curcon['host'],$curcon['port']);
		$list_check=$memm->GetStats($curcon['host'],$curcon['port']);
		if(md5(serialize($list))==md5(serialize($list_check))) {
			echo "<div id=\"confail\">".$langs['confail_tokyo_cabinet']."</div>";
		}
		else if($list['active_slabs']==0)
		{
			echo "<div id=\"noitems\">".$langs['datamo_noitems']."</div>";
		}
		else
		{
?>
<div id="statustit"><span><?php echo $curcon['name'];?></span><span><?php echo $curcon['host']." : ".$curcon['port'];?></span></div>
<div id="statscheck">
<div id="checktit"><?php echo $langs['datamo_arg_tit'];?></div>
<div id="checktableframe1">
<table id="checktable1" class="checktable"  cellpadding="2" cellspacing="1" >
<tr>
	<th colspan="1"><?php echo $langs['statsmo_check'];?></th>
	<th colspan="1"><?php echo $langs['cs_arg'];?></th>
    <th colspan="1"><?php echo $langs['cs_desc'];?></th>
</tr>
<tr class="check_span"><td colspan="3"><?php echo $langs['datamo_gloarg'];?></td></tr>
<tr><td class="checktd"><input type="checkbox" class="checkmo_glo" name="checkbox_monitor[]" id="checkbox_c" checked="checked" disabled="disabled" /></td><td>curr_items</td><td><?php echo $langs['cs_curr_items'];?></td></tr>
<tr><td class="checktd"><input type="checkbox" class="checkmo_glo" name="checkbox_monitor[]" id="checkbox_c" checked="checked" disabled="disabled" /></td><td>bytes</td><td><?php echo $langs['cs_bytes'];?></td></tr>
<tr><td class="checktd"><input type="checkbox" class="checkmo_glo" name="checkbox_monitor[]" id="checkbox_c" checked="checked" disabled="disabled" /></td><td>active_slabs</td><td><?php echo $langs['slabs_active_slabs'];?></td></tr>
<tr><td class="checktd"><input type="checkbox" class="checkmo_glo" name="checkbox_monitor[]" id="checkbox_c" checked="checked" disabled="disabled" /></td><td>total_malloced</td><td><?php echo $langs['slabs_total_malloced'];?></td></tr>
<tr class="check_span"><td colspan="3"><?php echo $langs['datamo_slabarg'];?></td></tr>
<?php
	foreach($monitorarr as $key => $value) {
		$lang_index="slabs_".$value;
		if(array_key_exists($lang_index,$langs))
			$des=$langs[$lang_index];
		else
			$des="";
		echo "<tr><td class=\"checktd\"><input type=\"checkbox\" class=\"checkmo\" name=\"checkbox_monitor[]\" id=\"checkbox_c\" checked=\"checked\" disabled=\"disabled\"  value=\"".$value."\"/></td><td>".$value."</td><td>".$des."</td></tr>";
	}
?>
<tr><td class="checktd"><input type="checkbox" class="checkmo_glo" name="checkbox_monitor[]" id="checkbox_c" checked="checked" disabled="disabled" /></td><td colspan="2"><?php echo $langs['showmo_data_lostmem'];?> （ total_chunks * chunk_size - mem_requested ）</td></tr>
</table>
</div>
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
		$list=$memm->conpGetSlabs();
		$list_check=$memm->ConpGetStats();
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
		if($list==false||isset($conid)&&$list[$conid]==false)
		{
			echo "<div id=\"confail\">".$langs['confail']."</div>";
		}
		else
		{
			if(md5(serialize($list[$li]))==md5(serialize($list_check[$li]))) {
				echo "<div id=\"confail\">".$langs['confail_tokyo_cabinet']."<a href=\"#\">".$langs['help']."</a></div>";
			} else if($list[$li]['active_slabs']==0) {
				echo "<div id=\"noitems\">".$langs['datamo_noitems']."</div>";
			} else {
?>	

<div id="statscheck">
<div id="conpchecktit"><?php echo $langs['datamo_arg_tit'];?></div>
<div id="checktableframe1">
<table id="checktable1" class="checktable"  cellpadding="2" cellspacing="1" >
<tr id="setidtit"><td colspan="3"><?php echo $langs['scon_conser']." : ".$li;?></td></tr>
<tr>
	<th colspan="1"><?php echo $langs['statsmo_check'];?></th>
	<th colspan="1"><?php echo $langs['cs_arg'];?></th>
    <th colspan="1"><?php echo $langs['cs_desc'];?></th>
</tr>
<tr class="check_span"><td colspan="3"><?php echo $langs['datamo_gloarg'];?></td></tr>
<tr><td class="checktd"><input type="checkbox" class="checkmo_glo" name="checkbox_monitor[]" id="checkbox_c" checked="checked" disabled="disabled" /></td><td>curr_items</td><td><?php echo $langs['cs_curr_items'];?></td></tr>
<tr><td class="checktd"><input type="checkbox" class="checkmo_glo" name="checkbox_monitor[]" id="checkbox_c" checked="checked" disabled="disabled" /></td><td>bytes</td><td><?php echo $langs['cs_bytes'];?></td></tr>
<tr><td class="checktd"><input type="checkbox" class="checkmo_glo" name="checkbox_monitor[]" id="checkbox_c" checked="checked" disabled="disabled" /></td><td>active_slabs</td><td><?php echo $langs['slabs_active_slabs'];?></td></tr>
<tr><td class="checktd"><input type="checkbox" class="checkmo_glo" name="checkbox_monitor[]" id="checkbox_c" checked="checked" disabled="disabled" /></td><td>total_malloced</td><td><?php echo $langs['slabs_total_malloced'];?></td></tr>
<tr class="check_span"><td colspan="3"><?php echo $langs['datamo_slabarg'];?></td></tr>
<?php
	foreach($monitorarr as $key => $value) {
		$lang_index="slabs_".$value;
		if(array_key_exists($lang_index,$langs))
			$des=$langs[$lang_index];
		else
			$des="";
		echo "<tr><td class=\"checktd\"><input type=\"checkbox\" class=\"checkmo\" name=\"checkbox_monitor[]\" id=\"checkbox_c\" checked=\"checked\" disabled=\"disabled\" value=\"".$value."\"/></td><td>".$value."</td><td>".$des."</td></tr>";
	}
?>
<tr><td class="checktd"><input type="checkbox" class="checkmo_glo" name="checkbox_monitor[]" id="checkbox_c" checked="checked" disabled="disabled" /></td><td colspan="2"><?php echo $langs['showmo_data_lostmem'];?> （ total_chunks * chunk_size - mem_requested ）</td></tr>
</table>
</div>
</div>

<div id="gomonitor">
<input id="gomonitorbut" class="but" name="gomonitorbut" type="button" value="<?php echo $langs['statsmo_start'];?>"/>
</div>
<?php	
			}
		}
		}
	}
}
?>
<div id="footer"></div>
</body>
</html>