<?php
	if(!defined('IN_MADM')) exit();
	require_once("../langs/".$_SESSION["MADM_SESSION_KEY"]['lang'].".php");	
	require_once('../config.php');
	global $config;
	require_once('../include/func/debug.php');
	debug();
	$curcon=$memm->GetConFromSession($type,$num);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Show_Con</title>
<link rel="stylesheet" href="../include/css/show_con.css" />
<style type="text/css">
body{<?php set_font('body');?>}
</style>
</head>

<body>
<div id="top">
<?php
	if($type=='con')
		echo $langs['scon_tit'];
	else
		echo $langs['scon_ptit'];
?>
</div>
<div id="contit">
<?php
	if($type=='con')
	 	echo $curcon['name']."     ".$curcon['host']." : ".$curcon['port'];
	else
		echo $curcon['name'];
?>
</div>
<div id="concode">
<?php
if($type=='con')
{
?>
<table id="codetable"  cellpadding="2" cellspacing="1"  width="600">
<tr>
	<th colspan="2"><?php echo $langs['scon_condemo'];?></th>
</tr>
<tr>
	<td>
    <?php
		if($curcon['ispcon']==0) {
			if($curcon['timeout']==1)
				$con_str="\$memcache->connect('".$curcon['host']."',".$curcon['port'].");";
			else
				$con_str="\$memcache->connect('".$curcon['host']."',".$curcon['port'].",".$curcon['timeout'].");";
		} else {
			if($curcon['timeout']==1)
				$con_str="\$memcache->pconnect('".$curcon['host']."',".$curcon['port'].");";
			else
				$con_str="\$memcache->pconnect('".$curcon['host']."',".$curcon['port'].",".$curcon['timeout'].");";
		}
		echo $con_str;
	?>
    </td>
</tr>
</table>
<?php
}
else if($type=='conp')
{
?>
<table id="codetable"  cellpadding="2" cellspacing="1"  width="600">
<tr>
	<th colspan="2"><?php echo $langs['scon_condemo'];?></th>
</tr>
<tr>
	<td id="serverlist">	
<?php
	$condemo=array();
	for($i=0;$i<$curcon['num'];$i++) {
		$condemo[$i]="\$memcache->addServer(";
		$carg=array();
		if($curcon['conlist'][$i]['status']==1)
			$carg[]="FALSE";
		if($curcon['conlist'][$i]['retry']!=15)
			$carg[]=$curcon['conlist'][$i]['retry'];
		else if($curcon['conlist'][$i]['retry']==15&&count($carg)!=0)
			$carg[]=$curcon['conlist'][$i]['retry'];
		if($curcon['conlist'][$i]['timeout']!=1)
			$carg[]=$curcon['conlist'][$i]['timeout'];
		else if($curcon['conlist'][$i]['timeout']==1&&count($carg)!=0)
			$carg[]=$curcon['conlist'][$i]['timeout'];
		if($curcon['conlist'][$i]['weight']!="")
			$carg[]=$curcon['conlist'][$i]['weight'];
		else if($curcon['conlist'][$i]['weight']==""&&count($carg)!=0)
			$carg[]=1;
		if($curcon['conlist'][$i]['pcon']==0)
			$carg[]="FALSE";
		else if($curcon['conlist'][$i]['pcon']==1&&count($carg)!=0)
			$carg[]=$curcon['conlist'][$i]['pcon'];
		$carg[]=$curcon['conlist'][$i]['port'];
		$carg[]="'".$curcon['conlist'][$i]['host']."'";
		for($j=count($carg)-1;$j>=0;$j--) {
			if($j==count($carg)-1)
				$condemo[$i].=$carg[$j];
			else
				$condemo[$i].=",".$carg[$j];	
		}
		$condemo[$i].=");";
	}
	echo join("<br />",$condemo);
?>
	</td>
</tr>
</table>
<?php
}
?>
</div>
<div id="condata">
<?php
if($type=='con')
{
?>
<table id="datatable"  cellpadding="2" cellspacing="1"  width="600">
<tr>
	<th colspan="2"><?php echo $langs['con_arg'];?></th>
</tr>
<tr>
	<td width="120"><?php echo $langs['scon_type'];?></td>
	<td>
    <?php
		if($curcon['ispcon']==0)
			echo $langs['scon_mcon'];
		else if($curcon['ispcon']==1)
			echo $langs['scon_mpcon'];	
	?>
    </td>
</tr>
<tr>
	<td width="120"><?php echo $langs['scon_confun'];?></td>
	<td>
    <?php
		if($curcon['ispcon']==0)
			echo "Memcache::connect()";
		else if($curcon['ispcon']==1)
			echo "Memcache::pconnect()";
	?>
    </td>
</tr>
<tr>
	<td width="120"><?php echo $langs['con_name'];?></td>
	<td><?php echo $curcon['name'];?></td>
</tr>
<tr>
	<td width="120"><?php echo $langs['con_host'];?></td>
	<td><?php echo $curcon['host'];?></td>
</tr>
<tr>
	<td width="120"><?php echo $langs['con_port'];?></td>
	<td><?php echo $curcon['port'];?></td>
</tr>
<tr>
	<td width="120"><?php echo $langs['scon_ispcon'];?></td>
	<td>
    <?php
		if($curcon['ispcon']==0)
			echo $langs['con_arg_no']."(".$langs['con_arg_default'].")";
		else
			echo $langs['con_arg_yes'];
	?>
    </td>
</tr>
<tr>
	<td width="120"><?php echo $langs['con_arg_timeout'];?></td>
	<td>
	<?php 
		if($curcon['timeout']==1)
			echo $curcon['timeout'].$langs['con_arg_se']."(".$langs['con_arg_default'].")";
		else
			echo $curcon['timeout'].$langs['con_arg_se'];
	?>         
    </td>
</tr>

</table>
<?php
} else if($type=='conp') {
?>
<table id="datatable"  cellpadding="2" cellspacing="1"  width="600">
<tr>
	<th colspan="2"><?php echo $langs['scon_ptit'];?></th>
</tr>
<tr>
	<td width="120"><?php echo $langs['scon_type'];?></td>
	<td>
    <?php
		if($type=='con'&&$curcon['ispcon']==0)
			echo $langs['scon_mcon'];
		else if($type=='con'&&$curcon['ispcon']==1)
			echo $langs['scon_mpcon'];	
		else if($type=='conp')
			echo $langs['scon_mconp'];
	?>
    </td>
</tr>
<tr>
	<td width="120"><?php echo $langs['scon_confun'];?></td>
	<td>
    <?php
		if($type=='conp')
			echo "Memcache::addServer()";
		else if($type=='con'&&$curcon['ispcon']==0)
			echo "Memcache::connect()";
		else if($type=='con'&&$curcon['ispcon']==1)
			echo "Memcache::pconnect()";
	?>
    </td>
</tr>
<tr>
	<td width="120"><?php echo $langs['con_name'];?></td>
	<td><?php echo $curcon['name'];?></td>
</tr>
<tr>
	<td width="120"><?php echo $langs['scon_connum'];?></td>
    <td><?php echo $curcon['num'];?></td>
</tr>
</table>
<?php
}
?>
</div>
<?php
if($type=='conp')
{
?>
<div id="conpcon">
<?php
for($i=0;$i<$curcon['num'];$i++) {
	if($curcon['conlist'][$i]['pcon']==0)
		$ispcon=$langs['con_arg_no'];
	else
		$ispcon=$langs['con_arg_yes']."(".$langs['con_arg_default'].")";
	if($curcon['conlist'][$i]['status']==0)
		$constatus="TRUE (".$langs['con_arg_default'].")";
	else
		$constatus="<span class=\"bigred\">FALSE</span>";
	if($curcon['conlist'][$i]['timeout']==1)
		$contimeout=$curcon['conlist'][$i]['timeout'].$langs['con_arg_se']."(".$langs['con_arg_default'].")";
	else
		$contimeout=$curcon['conlist'][$i]['timeout'].$langs['con_arg_se'];
	if($curcon['conlist'][$i]['retry']==15)
		$conretry=$curcon['conlist'][$i]['retry'].$langs['con_arg_se']."(".$langs['con_arg_default'].")";
	else
		$conretry=$curcon['conlist'][$i]['retry'].$langs['con_arg_se'];
	if($curcon['conlist'][$i]['weight']=="")
		$conweight=$langs['scon_nohave'];
	else
		$conweight=$curcon['conlist'][$i]['weight'];
	echo "<table class=\"conpcontable\"  cellpadding=\"2\" cellspacing=\"1\"  width=\"600\">
<tr><th colspan=\"2\">".$langs['scon_conser']." ".($i+1)."</th></tr><tr><td width=\"120\">".$langs['con_host']."</td><td>".$curcon['conlist'][$i]['host']."</td></tr><tr><td width=\"120\">".$langs['con_port']."</td><td>".$curcon['conlist'][$i]['port']."</td></tr><tr><td width=\"120\">".$langs['scon_ispcon']."</td><td>".$ispcon."</td></tr><tr><td width=\"120\">".$langs['con_weight']."</td><td>".$conweight."</td></tr><tr><td width=\"120\">".$langs['con_arg_timeout']."</td><td>".$contimeout."</td></tr><tr><td width=\"120\">".$langs['con_retry']."</td><td>".$conretry."</td></tr><tr><td width=\"120\">".$langs['conp_status']."</td><td>".$constatus."</td></tr></table>";
}
?>
</div>
<?php
}
?>
<div id="debug">
<?php debug('end');?>
</div>
</body>
</html>