<?php
	if(!ini_get('session.auto_start'))
		session_start();
	error_reporting(0);
	define('IN_MADM', TRUE);
	require_once("../langs/".$_SESSION["MADM_SESSION_KEY"]['lang'].".php");	
	require_once('../config.php');
	global $config;	
	require_once('../include/class/memmanager.class.php');
	require_once("../include/func/memadmin.func.php");	
	$memm=new MEMMANAGER();
	if(!$memm->is_login())
		exit("NoLogin");
	$monitorlist=getSessionMonitor();
	$curcon=$memm->GetConFromSession($monitorlist[0]['type'],$monitorlist[0]['num']);
	$memm->LoadMem();
	$init_slabid=NULL;
	$md5_op=NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Show_Monitor</title>
<script type="text/javascript" src="../include/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../include/js/jquery.anyDrag.min.js"></script>
<script type="text/javascript" src="../include/js/jquery.timers-1.2.js"></script>
<script type="text/javascript" src="../include/js/show_monitor_data.js"></script>
<link rel="stylesheet" href="../include/css/show_monitor_data.css" />
<style type="text/css">
body{<?php set_font('body');?>}
</style>
<script language="javascript">
var afsempty="<?php echo $langs['afsempty'];?>";
var afsfail="<?php echo $langs['afsfail'];?>";
var afstart="<?php echo $langs['showmo_afstart'];?>";
var afstop="<?php echo $langs['showmo_afstop'];?>";
var afsjsonfail="<?php echo $langs['afsjsonfail'];?>";
</script>
</head>
<body>
<div id="top">
<?php
	echo $langs['showmo_data_tit'];
?>
</div>
<?php 
	if($monitorlist[0]['type']=='con')
		echo "<div id=\"statustit\"><span>".$curcon['name']."</span><span>".$curcon['host']." : ".$curcon['port']."</span></div>";
	else
		echo "<div id=\"statustit\"><span>[ ".$curcon['name']." ]</span><span>".$langs['showmo_stats_conptit']." : </span><span>".$monitorlist[0]['conid']."</span></div>";
?>
<div id="monitorctrl">
<div id="autofresh"><span id="repaf"><span id="ausrep"></span><?php echo $langs['sautof_des'];?></span></span><span id="lastaftit"><?php echo $langs['showmo_lasttime'];?></span><span id="lasttime"><?php echo $langs['scon_nohave'];?></span><span id="afstit"><?php echo $langs['showmo_aftit'];?></span><span id="sein"><input name="afs" id="afs" type="text" /><?php echo $langs['con_se'];?></span><input id="startaf" class="but" name="startaf" type="button" value="<?php echo $langs['showmo_afstart'];?>"/></div>
<div id="resetlayout"><a id="relayout" href="javascript:;"><?php echo $langs['showmo_relayout'];?></a></div>
</div>
<?php

	if(!$memm->MemConnect($monitorlist[0]['type'],$curcon))
		echo "<div id=\"confail\">".$langs['confail']."</div>";
	else
	{
		if($monitorlist[0]['type']=='con') {
			$slablist=$memm->GetSlabs($curcon['host'],$curcon['port']);
			$statslist=$memm->GetStats($curcon['host'],$curcon['port']);
?>			

<div id="drag_1"  class="monitordiv">	
<div class="moarg"><?php echo $langs['datamo_gloarg'];?></div>
<table class="checktable"  cellpadding="2" cellspacing="1" >
<tr>
	<th colspan="1"><?php echo $langs['cs_arg'];?></th>
    <th colspan="1"><?php echo $langs['cs_desc'];?></th>
    <th colspan="1"><?php echo $langs['cs_value'];?></th>
</tr>
<tr><td class="argname">curr_items</td><td class="argdes"><?php echo $langs['cs_curr_items'];?></td><td class="argvalue"><span id="data_curr_items" class="glospan"><?php echo $statslist['curr_items'];?></span></td></tr>
<tr><td class="argname">bytes</td><td class="argdes"><?php echo $langs['cs_bytes'];?></td><td class="argvalue"><span id="data_bytes" class="glospan"><?php echo $statslist['bytes'];?></span></td></tr>
<tr><td class="argname">active_slabs</td><td class="argdes"><?php echo $langs['slabs_active_slabs'];?></td><td class="argvalue"><span id="data_active_slabs" class="glospan"><?php echo $slablist['active_slabs'];?></span></td></tr>
<tr><td class="argname">total_malloced</td><td class="argdes"><?php echo $langs['slabs_total_malloced'];?></td><td class="argvalue"><span id="data_total_malloced" class="glospan"><?php echo $slablist['total_malloced'];?></span></td></tr>
</table>

</div>
			
<div id="drag_2"  class="monitordiv">	
<div class="moarg"><?php echo $langs['showmo_slab_arg'];?></div> 
<div class="selectslabid">
<span class="seltit"><?php echo $langs['slabs_sslab']." ： ";?></span>
<select name='slabs' id="slabs">
<?php
  	foreach($slablist as $key => $value) {
		if($key!='active_slabs'&&$key!='total_malloced') {
			echo "<option id=\"slab_{$key}\" value=\"{$key}\">SLAB : {$key}</option>";
			$md5_op.="-".$key;
			if($init_slabid==NULL)
				$init_slabid=$key;
		}
	}
?>
 </select> 
</div>
<table class="checktable"  cellpadding="2" cellspacing="1" >
<tr>
	<th colspan="1"><?php echo $langs['cs_arg'];?></th>
    <th colspan="1"><?php echo $langs['cs_desc'];?></th>
    <th colspan="1"><?php echo $langs['cs_value'];?></th>
</tr>
<?php
	foreach($monitorlist[1] as $key => $value) {
		$outstr="<tr><td classs=\"argname\">$value</td><td class=\"argdes\">";
					$lang_index="slabs_".$value;
					if(array_key_exists($lang_index,$langs))
						$outstr.=$langs[$lang_index];
					$outstr.="</td><td class=\"argvalue\"><span id=\"data_$value\" class=\"glospan\">".$slablist[$init_slabid][$value]."</span></td></tr>";
					echo $outstr;		
	}
	$lostmem=$slablist[$init_slabid]['total_chunks']*$slablist[$init_slabid]['chunk_size']-$slablist[$init_slabid]['mem_requested'];
?>
<tr id="lostmem"><td id="lostmemtd" classs="argname" colspan="2"><?php echo $langs['showmo_data_lostmem'];?> ( total_chunks * chunk_size - mem_requested )</td><td class="argvalue"><span id="data_lostmem" class="glospan"><?php echo $lostmem;?></span></td>
</table>
</div>			
<?php
		}
		else if($monitorlist[0]['type']=='conp') {
			$slablist=$memm->conpGetSlabs();
			$statslist=$memm->ConpGetStats();
?>
<div id="drag_1"  class="monitordiv">	
<div class="moarg"><?php echo $langs['datamo_gloarg'];?></div>
<table class="checktable"  cellpadding="2" cellspacing="1" >
<tr>
	<th colspan="1"><?php echo $langs['cs_arg'];?></th>
    <th colspan="1"><?php echo $langs['cs_desc'];?></th>
    <th colspan="1"><?php echo $langs['cs_value'];?></th>
</tr>
<tr><td class="argname">curr_items</td><td class="argdes"><?php echo $langs['cs_curr_items'];?></td><td class="argvalue"><span id="data_curr_items" class="glospan"><?php echo $statslist[$monitorlist[0]['conid']]['curr_items'];?></span></td></tr>
<tr><td class="argname">bytes</td><td class="argdes"><?php echo $langs['cs_bytes'];?></td><td class="argvalue"><span id="data_bytes" class="glospan"><?php echo $statslist[$monitorlist[0]['conid']]['bytes'];?></span></td></tr>
<tr><td class="argname">active_slabs</td><td class="argdes"><?php echo $langs['slabs_active_slabs'];?></td><td class="argvalue"><span id="data_active_slabs" class="glospan"><?php echo $slablist[$monitorlist[0]['conid']]['active_slabs'];?></span></td></tr>
<tr><td class="argname">total_malloced</td><td class="argdes"><?php echo $langs['slabs_total_malloced'];?></td><td class="argvalue"><span id="data_total_malloced" class="glospan"><?php echo $slablist[$monitorlist[0]['conid']]['total_malloced'];?></span></td></tr>
</table>

</div>
			
<div id="drag_2"  class="monitordiv">	
<div class="moarg"><?php echo $langs['showmo_slab_arg'];?></div> 
<div class="selectslabid">
<span class="seltit"><?php echo $langs['slabs_sslab']." ： ";?></span>
<select name='slabs' id="slabs">
<?php
  	foreach($slablist[$monitorlist[0]['conid']] as $key => $value) {
		if($key!='active_slabs'&&$key!='total_malloced') {
			echo "<option id=\"slab_{$key}\" value=\"{$key}\">SLAB : {$key}</option>";
			$md5_op.="-".$key;
			if($init_slabid==NULL)
				$init_slabid=$key;
		}
	}
?>
 </select> 
</div>
<table class="checktable"  cellpadding="2" cellspacing="1" >
<tr>
	<th colspan="1"><?php echo $langs['cs_arg'];?></th>
    <th colspan="1"><?php echo $langs['cs_desc'];?></th>
    <th colspan="1"><?php echo $langs['cs_value'];?></th>
</tr>
<?php
	foreach($monitorlist[1] as $key => $value) {
		$outstr="<tr><td classs=\"argname\">$value</td><td class=\"argdes\">";
					$lang_index="slabs_".$value;
					if(array_key_exists($lang_index,$langs))
						$outstr.=$langs[$lang_index];
					$outstr.="</td><td class=\"argvalue\"><span id=\"data_$value\" class=\"glospan\">".$slablist[$monitorlist[0]['conid']][$init_slabid][$value]."</span></td></tr>";
					echo $outstr;		
	}
	$lostmem=$slablist[$monitorlist[0]['conid']][$init_slabid]['total_chunks']*$slablist[$monitorlist[0]['conid']][$init_slabid]['chunk_size']-$slablist[$monitorlist[0]['conid']][$init_slabid]['mem_requested'];
?>
<tr id="lostmem"><td id="lostmemtd" classs="argname" colspan="2"><?php echo $langs['showmo_data_lostmem'];?> ( total_chunks * chunk_size - mem_requested )</td><td class="argvalue"><span id="data_lostmem" class="glospan"><?php echo $lostmem;?></span></td>
</table>
</div>			

<?php
		}
	}
?>
<div id="footer"></div>
</body>
</html>
<?php
echo "<script>slabid_t=$init_slabid;md5_op=$md5_op;</script>";
?>