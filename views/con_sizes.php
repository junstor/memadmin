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
<script type="text/javascript" src="../include/js/con_sizes.js"></script>
<link rel="stylesheet" href="../include/css/con_sizes.css" />
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
	echo $langs['size_tit'];
?>
</div>
<?php
if($type=='con') {
	if(!$memm->MemConnect($type,$curcon))
		echo "<div id=\"confail\">".$langs['confail']."</div>";
	else
	{
		$list=$memm->GetSizes($curcon['host'],$curcon['port']);
		$list_check=$memm->GetStats($curcon['host'],$curcon['port']);
		if(md5(serialize($list))==md5(serialize($list_check))) {
			echo "<div id=\"confail\">".$langs['confail_tokyo_cabinet']."</div>";
		} else {
		if($list==false)
		{
			echo "<div id=\"nosizes\">".$langs['nosizes']."</div>";
		}
		else
		{
?>
<div id="consizes">
  <div id="sizestit"><span><?php echo $curcon['name'];?></span><span><?php echo $curcon['host']." : ".$curcon['port'];?></span></div>
<table id="sizestable"  cellpadding="2" cellspacing="1" >
<tr>
	<th colspan="1">SIZE</th>
    <th colspan="1">COUNT</th>
</tr>
<?php
	foreach($list as $key => $value)
	{
		echo "<tr><td>STAT&nbsp;&nbsp;&nbsp;{$key}</td><td>{$value}</td></tr>";
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
		$list=$memm->conpGetSizes();
		$list_check=$memm->ConpGetStats();
?>			
<div id="conpstat">
  <div id="conptitandsel">
  <div id="conpsizestit"><span><?php echo $curcon['name'];?></span></div>
  <div id="conpstatconselect">
  <?php echo $langs['cs_scon'];?>： 
  <select name='conpscons' id="conpscons">
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
			echo "<div id=\"nosizes\">".$langs['nosizes']."</div>";
		}
		else
		{
			if(md5(serialize($list[$li]))==md5(serialize($list_check[$li]))) {
				echo "<div id=\"confail\">".$langs['confail_tokyo_cabinet']."</div>";
			} else {
?>
<table id="conpsizestable"  cellpadding="2" cellspacing="1" >
<tr id="conidtit"><td colspan="2"><?php echo $langs['conp_consltit']." : ".$li;?></td></tr>
<tr>
	<th colspan="1">SIZE</th>
    <th colspan="1">COUNT</th>
</tr>
<?php
	foreach($list[$li] as $key => $value)
	{
		echo "<tr><td>STAT&nbsp;&nbsp;&nbsp;{$key}</td><td>{$value}</td></tr>";
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