<?php
if(!defined('IN_MADM')) exit();
require_once("./langs/".$_SESSION["MADM_SESSION_KEY"]['lang'].".php");	
require_once("./include/func/memadmin.func.php");	
require_once('./config.php');
global $config;
$conlist=getConsList();
$conplist=getConpsList();
if($conlist['num']>0)
	$type="con";
else
	$type="conp";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="include/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="include/js/jquery.ui.all.js"></script>
<script type="text/javascript" src="include/js/jquery.layout.min.js"></script>
<script type="text/javascript" src="include/js/memadmin.js"></script>
<link rel="stylesheet" href="include/css/memadmin.css" />
<title><?php echo $langs['title']." - ".$config['version'];?></title>
<script>
var type='<?php echo $type;?>',num=0;
</script>
<style type="text/css">
body{<?php set_font('body');?>}
#leftmenu{<?php set_font('menu');?>}
<?php
if($_SESSION["MADM_SESSION_KEY"]['lang']=='en-us') {
	echo "#listset{margin-right:5px;}";
	echo "#showlist{_margin-top:22px;*margin-left:-251px;}";
	echo "*+html #showlist{margin-left:-251px;}";
	echo "#logout{*margin-top:-2px;}";
}
?>
</style>
</head>
<body>
<div class="ui-layout-center">
<iframe src="views/memmanager.php?type=<?php echo $type;?>&num=0&action=showcon" id="mainframe" name="mainframe" width="100%" height="100%" frameborder="0" marginheight="0" scrolling="auto"></iframe>
</div>
<div class="ui-layout-north">
<div id="logo">
  <img src="images/logo.gif" width="80" height="13" />
</div>
<div id="list">
<p id="listtit"><?php echo $langs['mad_con'];?>: </p>
<p id="curcon">
<?php
	if($conlist['num']>0) {
		echo $conlist['cons'][0]['name']." (".$conlist['cons'][0]['host'].":".$conlist['cons'][0]['port'].")";	
	} else {
		echo $conplist['conps'][0]['name'];
	}
?>
</p>
<div id="dropbut"><a href="javascript:;"></a></div>
<div id="showlist">
<p id="showlisttit"><?php echo $langs['mad_conlist'];?></p>
<ul>
<?php 
	for($i=0;$i<$conlist['num'];$i++) {
		echo "<li><img src=\"images/conc.gif\" width=\"13\" height=\"14\" /><a class=\"econ\" href=\"javascript:;\"><input class=\"hide_num\" name=\"himd\" type=\"text\" value=\"".$i."\"/><span class=\"conname\">".$conlist['cons'][$i]['name']." (".$conlist['cons'][$i]['host'].":".$conlist['cons'][$i]['port'].")</span></a></li>";	
	}
	for($j=0;$j<$conplist['num'];$j++) {
		echo "<li><img src=\"images/folder-closed.gif\" width=\"16\" height=\"14\" /><a class=\"econp\" href=\"javascript:;\"><input class=\"hide_num\" name=\"himd\" type=\"text\" value=\"".$j."\"/><span class=\"conpname\">".$conplist['conps'][$j]['name']."</span></a></li>";		
	}
?>
</ul>
</div>
</div>
<div id="listset">
<a target="_self" href="index.php?action=set.con.session"><?php echo $langs['mad_conset'];?></a>
</div>
<div id="othermenu">
&nbsp;
</div>
<div id="rightmenu">
<div id="about">
<a id="aboutmem" href="javascript:;">MemAdmin v<?php echo $config['version'];?></a>
</div>
<div id="logout">
<a href="index.php?action=logout"><?php echo $langs['exit'];?></a>
</div>
<div id="showuser">
<?php echo $config['user'];?>
</div>
</div>
</div>
<div class="ui-layout-west">

<div id="leftmenu">

<div class="menue">
  <div class="menutit"><?php echo $langs['scon_tit'];?></div>
  <div class="menulist">
    <ul>
       <li><a id="showcon" href="javascript:;" class="but_a inithover"><?php echo $langs['con_arg'];?></a></li>
    </ul>
  </div>	
</div>
<div class="menue">
  <div class="menutit"><?php echo $langs['aboutcon'];?></div>
  <div class="menulist">
    <ul>
       <li><a id="constat" href="javascript:;" class="but_a"><?php echo $langs['statsinfo'];?></a></li>
       <li><a id="consett" href="javascript:;" class="but_a"><?php echo $langs['settinginfo'];?></a></li>
       <li><a id="conslabs" href="javascript:;" class="but_a"><?php echo $langs['slabinfo'];?></a></li>
       <li><a id="conitems" href="javascript:;" class="but_a"><?php echo $langs['iteminfo'];?></a></li>
       <li><a id="consizes" href="javascript:;" class="but_a"><?php echo $langs['sizeinfo'];?></a></li>
    </ul>
  </div>	
</div>
<div class="menue">
  <div class="menutit"><?php echo $langs['monitor'];?></div>
  <div class="menulist">
    <ul>
       <li><a id="statsmonitor" href="javascript:;" class="but_a"><?php echo $langs['statmonitor'];?></a></li>
       <li><a id="datamonitor" href="javascript:;" class="but_a"><?php echo $langs['datamonitor'];?></a></li>
       <li><a id="hitmonitor" href="javascript:;" class="but_a"><?php echo $langs['hitmonitor'];?></a></li>
    </ul>
  </div>	
</div>
<div class="menue">
  <div class="menutit"><?php echo $langs['getset'];?></div>
  <div class="menulist">
    <ul>
       <li><a id="memget" href="javascript:;" class="but_a"><?php echo $langs['getdata'];?></a></li>
       <li><a id="memset" href="javascript:;" class="but_a"><?php echo $langs['setdata'];?></a></li>
       <li><a id="memcount" href="javascript:;" class="but_a"><?php echo $langs['countcom'];?></a></li>
       <li><a id="memflush" href="javascript:;" class="but_a"><?php echo $langs['flushallt'];?></a></li>
    </ul>
  </div>	
</div>
<div class="menue">
  <div class="menutit"><?php echo $langs['exmod'];?></div>
  <div class="menulist">
    <ul>
       <li><a id="itemtrav" href="javascript:;" class="but_a"><?php echo $langs['itemtravt'];?></a></li>
       <li><a id="filtertrav" href="javascript:;" class="but_a"><?php echo $langs['itemfiltravt'];?></a></li>
    </ul>
  </div>	
</div>



</div>

</div>
</body>
</html>