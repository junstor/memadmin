<?php
	if(!defined('IN_MADM')) exit();
	require_once('../include/func/debug.php');
	debug();
	require_once("../langs/".$_SESSION["MADM_SESSION_KEY"]['lang'].".php");	
	require_once('../config.php');
	global $config;
	$curcon=$memm->GetConFromSession($type,$num);
	$memm->LoadMem();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Con_Settings</title>
<script type="text/javascript" src="../include/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../include/js/con_settings.js"></script>
<link rel="stylesheet" href="../include/css/con_settings.css" />
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
	echo $langs['sett_tit'];
?>
</div>
<?php
if($type=='con') {
	if(!$memm->MemConnect($type,$curcon))
		echo "<div id=\"confail\">".$langs['confail']."</div>";
	else
	{
		$list=$memm->GetSettings($curcon['host'],$curcon['port']);
		$list_check=$memm->GetStats($curcon['host'],$curcon['port']);
		if(md5(serialize($list))==md5(serialize($list_check))) {
			echo "<div id=\"confail\">".$langs['confail_tokyo_cabinet']."</div>";
		} else {
			if($list==false)
			{
				echo "<div id=\"nosettings\">".$langs['nosettings']."</div>";
			}
			else
			{
?>
<div id="consettings">
  <div id="settingstit"><span><?php echo $curcon['name'];?></span><span><?php echo $curcon['host']." : ".$curcon['port'];?></span></div>
<table id="settingstable"  cellpadding="2" cellspacing="1" >
<tr>
	<th colspan="1"><?php echo $langs['cs_arg'];?></th>
    <th colspan="1"><?php echo $langs['cs_value'];?></th>
    <th colspan="1"><?php echo $langs['cs_desc'];?></th>
</tr>
<?php
				foreach($list as $key => $value)
				{
					$lang_index="sett_".$key;
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
		$list=$memm->conpGetSettings();
		$list_check=$memm->ConpGetStats();
?>
<div id="conpsettings">
  <div id="conptitandsel">
  <div id="conpsettingstit"><span><?php echo $curcon['name'];?></span></div>
  <div id="conpsettingsselect">
 <?php echo $langs['cs_scon'];?>： 
  <select name='ssets' id="ssets">
  <?php
  	foreach($list as $key => $value) {
		if(isset($consetid)&&$consetid==$key)
			echo "<option id=\"con_{$key}\" value=\"{$key}\" selected=\"selected\"> {$key}</option>";
		else
			echo "<option id=\"con_{$key}\" value=\"{$key}\">{$key}</option>";
		if($li_init==NULL)
			$li_init=$key;
	}
	if(isset($consetid))
		$li=$consetid;
	else
		$li=$li_init;
  ?>
  </select> 
  </div>
</div>
<?php
		if($list==false||isset($li)&&$list[$li]==false)
		{
			echo "<div id=\"nosettings\">".$langs['nosettings']."</div>";
		}
		else
		{
			if(md5(serialize($list[$li]))==md5(serialize($list_check[$li]))) {
				echo "<div id=\"confail\">".$langs['confail_tokyo_cabinet']."</div>";
			} else {
?>
<table id="conpsettingstable"  cellpadding="2" cellspacing="1" >
<tr id="setidtit"><td colspan="3"><?php echo $langs['scon_conser']." : ".$li;?></td></tr>
<tr>
	<th colspan="1"><?php echo $langs['cs_arg'];?></th>
    <th colspan="1"><?php echo $langs['cs_value'];?></th>
    <th colspan="1"><?php echo $langs['cs_desc'];?></th>
</tr>
<?php
			foreach($list[$li] as $key => $value)
			{
				$lang_index="sett_".$key;
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
?>
<div id="debug">
<?php debug('end');?>
</div>
</body>
</html>