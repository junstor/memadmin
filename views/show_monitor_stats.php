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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Show_Monitor</title>
<script type="text/javascript" src="../include/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../include/js/jquery.anyDrag.min.js"></script>
<script type="text/javascript" src="../include/js/jquery.timers-1.2.js"></script>
<script type="text/javascript" src="../include/js/show_monitor_stats.js"></script>
<link rel="stylesheet" href="../include/css/show_monitor_stats.css" />
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
	echo $langs['showmo_stats_tit'];
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
			$list=$memm->GetStats($curcon['host'],$curcon['port']);
			if($list==false)
				echo "<div id=\"nostats\">".$langs['showmo_nostats']."</div>";
			else {	
				$i=1;
				foreach($monitorlist[1] as $key => $value) {
					$outstr="<div id=\"drag_{$i}\" class=\"monitordiv\"><div class=\"moarg\">{$value}</div><div class=\"modes\">";
					$lang_index="cs_".$value;
					if(array_key_exists($lang_index,$langs))
						$outstr.=$langs[$lang_index];
					$outstr.="</div><div class=\"movalue\"><span id=\"mo_{$value}\" class=\"movaluespan\">{$list[$value]}</span></div></div>";
					echo $outstr;
					++$i;
				}
			}
		}
		else if($monitorlist[0]['type']=='conp') {
			$list=$memm->ConpGetStats();
			if($list==false||isset($monitorlist[0]['conid'])&&$list[$monitorlist[0]['conid']]==false)
				echo "<div id=\"confail\">".$langs['showmo_nostats']."</div>";
			else {
				$i=1;	
				foreach($monitorlist[1] as $key => $value) {
					$outstr="<div id=\"drag_{$i}\" class=\"monitordiv\"><div class=\"moarg\">{$value}</div><div class=\"modes\">";
					$lang_index="cs_".$value;
					if(array_key_exists($lang_index,$langs))
						$outstr.=$langs[$lang_index];
					$outstr.="</div><div class=\"movalue\"><span id=\"mo_{$value}\" class=\"movaluespan\">{$list[$monitorlist[0]['conid']][$value]}</span></div></div>";
					echo $outstr;
					++$i;
				}
			}	
		}
	}
?>
<div id="footer"></div>
</body>
</html>