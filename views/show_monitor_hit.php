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
	$type=$monitorlist[0]['type'];
	$num=$monitorlist[0]['num'];
	$conid=$monitorlist[0]['conid'];
	$curcon=$memm->GetConFromSession($monitorlist[0]['type'],$monitorlist[0]['num']);
	$memm->LoadMem();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Show_Hit</title>
<script type="text/javascript" src="../include/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../include/js/jquery.anyDrag.min.js"></script>
<script type="text/javascript" src="../include/js/jquery.timers-1.2.js"></script>
<script type="text/javascript" src="../include/js/jquery.sparkline.js"></script>
<script type="text/javascript" src="../include/js/show_monitor_hit.js"></script>
<link rel="stylesheet" href="../include/css/show_monitor_hit.css" />
<style type="text/css">
body{<?php set_font('body');?>}
</style>
<script language="javascript">
var afsempty="<?php echo $langs['afsempty'];?>";
var afsfail="<?php echo $langs['afsfail'];?>";
var afstart="<?php echo $langs['showmo_afstart'];?>";
var afstop="<?php echo $langs['showmo_afstop'];?>";
var afsjsonfail="<?php echo $langs['afsjsonfail'];?>";
var charthit="<?php echo $langs['hitmo_hit'];?>";
var chartmiss="<?php echo $langs['hitmo_miss'];?>";
var nochart="<?php echo $langs['hitmo_nochart'];?>";
var type="<?php echo $type;?>";
var num="<?php echo $num;?>";
var autof=0;
</script>
</head>
<body>
<div id="top">
<?php
	echo $langs['hitmo_tit'];
?>
</div>
<?php 
	if($type=='con')
		echo "<div id=\"statustit\"><span>".$curcon['name']."</span><span>".$curcon['host']." : ".$curcon['port']."</span></div>";
	else
		echo "<div id=\"statustit\"><span>[ ".$curcon['name']." ]</span><span>".$langs['showmo_stats_conptit']." : </span><span>".$conid."</span></div>";
?>
<div id="monitorctrl">
<div id="autofresh"><span id="repaf"><span id="ausrep"></span><?php echo $langs['sautof_des'];?></span></span><span id="lastaftit"><?php echo $langs['showmo_lasttime'];?></span><span id="lasttime"><?php echo $langs['scon_nohave'];?></span><span id="afstit"><?php echo $langs['showmo_aftit'];?></span><span id="sein"><input name="afs" id="afs" type="text" /><?php echo $langs['con_se'];?></span><input id="startaf" class="but" name="startaf" type="button" value="<?php echo $langs['showmo_afstart'];?>"/></div>
<div id="resetlayout"><a id="relayout" href="javascript:;"><?php echo $langs['showmo_relayout'];?></a></div>
</div>
<?php
	if(!$memm->MemConnect($type,$curcon))
		echo "<div id=\"confail\">".$langs['confail']."</div>";
	else
	{
		if($type=='con') {
			$list=$memm->GetStats($curcon['host'],$curcon['port']);
			if($list==false)
				echo "<div id=\"nostats\">".$langs['showmo_nostats']."</div>";
			else {	
				$i=1;
				foreach($monitorlist[1] as $key => $value) {
					if($value=='get') {
						if(!$memm->is_Tykyo($type,$num,$curcon)) {
							$cmdcount=$list['cmd_get'];
							$cmdmiss=$list['get_misses'];
							$cmdhit=$list['get_hits'];
						}
						else {
							$cmdcount=$list['cmd_get'];
							$cmdmiss=$list['cmd_get_misses'];
							$cmdhit=$list['cmd_get_hits'];
						}
					}
					else if($value=='set') {
							$cmdcount=$list['cmd_set'];
							$cmdmiss=$list['cmd_set_misses'];
							$cmdhit=$list['cmd_set_hits'];
					}
					else if($value=='delete') {
						if(!$memm->is_Tykyo($type,$num,$curcon)) {
							$cmdcount=$list['delete_hits']+$list['delete_misses'];
							$cmdmiss=$list['delete_misses'];
							$cmdhit=$list['delete_hits'];
						}
						else {
							$cmdcount=$list['cmd_delete'];
							$cmdmiss=$list['cmd_delete_misses'];
							$cmdhit=$list['cmd_delete_hits'];
						}
					}
					else if($value=='incr') {
						$cmdcount=$list['incr_hits']+$list['incr_misses'];
						$cmdmiss=$list['incr_misses'];
						$cmdhit=$list['incr_hits'];
					}
					else if($value=='decr') {
						$cmdcount=$list['decr_hits']+$list['decr_misses'];
						$cmdmiss=$list['decr_misses'];
						$cmdhit=$list['decr_hits'];
					}
					else if($value=='cas') {
						$cmdcount=$list['cas_hits']+$list['cas_misses'];
						$cmdmiss=$list['cas_misses'];
						$cmdhit=$list['cas_hits'];
					}
					else if($value=='touch') {
						$cmdcount=$list['cmd_touch'];
						$cmdmiss=$list['touch_misses'];
						$cmdhit=$list['touch_hits'];
					}
?>
	<div id="<?php echo $value;?>hit" class="monitordiv drag_<?php echo $i;?>">
    	<div id="<?php echo $value;?>tit" class="movetit"><?php echo strtoupper($value)." ".$langs['hitmo_hittit'];?></div>
    	<div id="<?php echo $value;?>hitdata" class="hitdata">
        	<div class="alltit">
            	<div id="cmd_<?php echo $value;?>_tit" class="thetit"><?php echo $langs['hitmo_cmdcount'];?></div>
                <div id="<?php echo $value;?>_hits_tit" class="thetit"><?php echo $langs['hitmo_hitcount'];?></div>
                <div id="<?php echo $value;?>_misses_tit" class="thetit"><?php echo $langs['hitmo_misscount'];?></div>
                <div id="<?php echo $value;?>_hit_rate_tit" class="thetit"><?php echo $langs['hitmo_hitrate'];?></div>
            </div>
            <div class="allvalue">
            	<div id="cmd_<?php echo $value;?>_value" class="thevalue"><?php echo $cmdcount;?></div>
                <div id="<?php echo $value;?>_hits_value" class="thevalue"><?php echo $cmdhit;?></div>
                <div id="<?php echo $value;?>_misses_value" class="thevalue"><?php echo $cmdmiss;?></div>
                <div id="<?php echo $value;?>_hit_rate" class="thevalue">
			<?php
				if($cmdcount==0||($cmdhit/$cmdcount)*100==0)
					echo "0%";
				else
					echo sprintf("%.2f",(($cmdhit/$cmdcount)*100))."%";
			?>
           	 	</div>
            </div>   
        </div>
		<div id="<?php echo $value;?>hitchart" class="hitchart">
        	<?php
				if($cmdcount==0)
					echo "<div class=\"nochart\">".$langs['hitmo_nochart']."</div>";
				else {
    				echo "<span id=\"".$value."chart\" class=\"chart\">".(int)($cmdhit/$cmdcount*100).",".(int)($cmdmiss/$cmdcount*100)."</span>";
					echo "<div class=\"chartico\"><div class=\"hitico\">".$langs['hitmo_hit']."</div><div class=\"missico\">".$langs['hitmo_miss']."</div></div>";
				}
			?>
    	</div>
    </div>
 <?php
 			++$i;
				}							
			}
		}
		else if($type=='conp') {
			$list=$memm->ConpGetStats();
			if($list==false||isset($conid)&&$list[$conid]==false)
				echo "<div id=\"confail\">".$langs['showmo_nostats']."</div>";
			else {
				$i=1;
				foreach($monitorlist[1] as $key => $value) {
					if($value=='get') {
						if(!$memm->is_Tykyo($type,$conid,$curcon)) {
							$cmdcount=$list[$conid]['cmd_get'];
							$cmdmiss=$list[$conid]['get_misses'];
							$cmdhit=$list[$conid]['get_hits'];
						}
						else {
							$cmdcount=$list[$conid]['cmd_get'];
							$cmdmiss=$list[$conid]['cmd_get_misses'];
							$cmdhit=$list[$conid]['cmd_get_hits'];
						}
					}
					else if($value=='set') {
							$cmdcount=$list[$conid]['cmd_set'];
							$cmdmiss=$list[$conid]['cmd_set_misses'];
							$cmdhit=$list[$conid]['cmd_set_hits'];
					}
					else if($value=='delete') {
						if(!$memm->is_Tykyo($type,$conid,$curcon)) {
							$cmdcount=$list[$conid]['delete_hits']+$list[$conid]['delete_misses'];
							$cmdmiss=$list[$conid]['delete_misses'];
							$cmdhit=$list[$conid]['delete_hits'];
						}
						else {
							$cmdcount=$list[$conid]['cmd_delete'];
							$cmdmiss=$list[$conid]['cmd_delete_misses'];
							$cmdhit=$list[$conid]['cmd_delete_hits'];
						}
					}
					else if($value=='incr') {
						$cmdcount=$list[$conid]['incr_hits']+$list[$conid]['incr_misses'];
						$cmdmiss=$list[$conid]['incr_misses'];
						$cmdhit=$list[$conid]['incr_hits'];
					}
					else if($value=='decr') {
						$cmdcount=$list[$conid]['decr_hits']+$list[$conid]['decr_misses'];
						$cmdmiss=$list[$conid]['decr_misses'];
						$cmdhit=$list[$conid]['decr_hits'];
					}
					else if($value=='cas') {
						$cmdcount=$list[$conid]['cas_hits']+$list[$conid]['cas_misses'];
						$cmdmiss=$list[$conid]['cas_misses'];
						$cmdhit=$list[$conid]['cas_hits'];
					}
					else if($value=='touch') {
						$cmdcount=$list[$conid]['cmd_touch'];
						$cmdmiss=$list[$conid]['touch_misses'];
						$cmdhit=$list[$conid]['touch_hits'];
					}
?>
	<div id="<?php echo $value;?>hit" class="monitordiv drag_<?php echo $i;?>">
    	<div id="<?php echo $value;?>tit" class="movetit"><?php echo strtoupper($value)." ".$langs['hitmo_hittit'];?></div>
    	<div id="<?php echo $value;?>hitdata" class="hitdata">
        	<div class="alltit">
            	<div id="cmd_<?php echo $value;?>_tit" class="thetit"><?php echo $langs['hitmo_cmdcount'];?></div>
                <div id="<?php echo $value;?>_hits_tit" class="thetit"><?php echo $langs['hitmo_hitcount'];?></div>
                <div id="<?php echo $value;?>_misses_tit" class="thetit"><?php echo $langs['hitmo_misscount'];?></div>
                <div id="<?php echo $value;?>_hit_rate_tit" class="thetit"><?php echo $langs['hitmo_hitrate'];?></div>
            </div>
            <div class="allvalue">
            	<div id="cmd_<?php echo $value;?>_value" class="thevalue"><?php echo $cmdcount;?></div>
                <div id="<?php echo $value;?>_hits_value" class="thevalue"><?php echo $cmdhit;?></div>
                <div id="<?php echo $value;?>_misses_value" class="thevalue"><?php echo $cmdmiss;?></div>
                <div id="<?php echo $value;?>_hit_rate" class="thevalue">
			<?php
				if($cmdcount==0)
					echo "0%";
				else
					echo sprintf("%.2f",(($cmdhit/$cmdcount)*100))."%";
			?>
           	 	</div>
            </div>   
        </div>
		<div id="<?php echo $value;?>hitchart" class="hitchart">
        	<?php
				if($cmdcount==0)
					echo "<div class=\"nochart\">".$langs['hitmo_nochart']."</div>";
				else {
    				echo "<span id=\"".$value."chart\" class=\"chart\">".$cmdhit.",".$cmdmiss."</span>";
					echo "<div class=\"chartico\"><div class=\"hitico\">".$langs['hitmo_hit']."</div><div class=\"missico\">".$langs['hitmo_miss']."</div></div>";
				}
			?>
    	</div>
    </div>
 <?php
 					++$i;
				}			
			}	
		}
	}
?>
<div id="footer"></div>
</body>
</html>