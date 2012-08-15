<?php
	if(!defined('IN_MADM')) exit();
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
<?php 
	if(strpos($_SERVER['HTTP_USER_AGENT'], "MSIE 8.0"))
		echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=EmulateIE7\" />";
?>
<title>Item_Trav</title>
<script type="text/javascript" src="../include/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../include/js/jquery.md5.js"></script>
<script type="text/javascript" src="../include/js/item_trav.js"></script>
<link rel="stylesheet" href="../include/css/item_trav.css" />
<style type="text/css">
body{<?php set_font('body');?>}
</style>
<script language="javascript">
var nonum="<?php echo $langs['itemt_nonum'];?>";
var delconfirm="<?php echo $langs['memg_delconfirm'];?>";
var unserfail="<?php echo $langs['memg_unserfail'];?>";
var numonly="<?php echo $langs['itemt_numonly'];?>";
var numwrong="<?php echo $langs['itemt_numwrong'];?>";
var getres="<?php echo $langs['itemt_getres'];?>";
var resnot="<?php echo $langs['memg_resnot'];?>";
var noexist="<?php echo $langs['itemt_notexist'];?>";
var sert="<?php echo $langs['memg_ser'];?>";
var unsert="<?php echo $langs['memg_unser'];?>";
var del="<?php echo $langs['con_del'];?>";
var valuefail="<?php echo $langs['memg_geterror'];?>";
var conpnoexist="<?php echo $langs['itemt_conpgeterror'];?>";
var novaluetime="<?php echo $langs['itemt_novaluetime'];?>";
var valuetypetit="<?php echo $langs['itemt_valuetype'];?>";
var loading="<?php echo $langs['itemt_loading'];?>";
var prepage="<?php echo $langs['itemt_prepage'];?>";
var nexpage="<?php echo $langs['itemt_nexpage'];?>";
var pagenumno="<?php echo $langs['itemt_pagenumno'];?>";
var thetnum="<?php echo $langs['memg_tnum'];?>";
var pagingerr="<?php echo $langs['itemt_pagingerr'];?>";
var updatetit="<?php echo $langs['memg_updateres'];?>";
var type="<?php echo $type;?>";
var num="<?php echo $num;?>";
var getconid="<?php echo $conid;?>";
var moreinfo="<?php echo $langs['itemt_moreinfo'];?>";
var moreclose="<?php echo $langs['itemt_closemore'];?>";
var itemsize="<?php echo $langs['itemt_size'];?>";
var noexpire="<?php echo $langs['itemt_expiretime'];?>";
var charset="<?php echo $langs['itemt_charsettit'];?>";
var recharnot="<?php echo $langs['memg_reget'];?>";
</script>
</head>

<body>
<div id="top">
<?php
	echo $langs['itemt_tit'];
?>
</div>
<?php
if($type=='con') {
	if(!$memm->MemConnect($type,$curcon))
		echo "<div id=\"confail\">".$langs['confail']."</div>";
	else {
		$list_check1=$memm->GetStats($curcon['host'],$curcon['port']);
		$list_check2=$memm->GetSettings($curcon['host'],$curcon['port']);
		if(md5(serialize($list_check1))==md5(serialize($list_check2))) {
			echo "<div id=\"confail\">".$langs['confail_tokyo_cabinet']."</div>";
		} else {
			$list=$memm->GetItems($curcon['host'],$curcon['port']);
			if($list==false)
			{
				echo "<div id=\"noitems\">".$langs['noitems']."</div>";
			}
			else
			{
?>
			<div class="layoutfixed">
			<div id="itemstit"><span><?php echo $curcon['name'];?></span><span><?php echo $curcon['host']." : ".$curcon['port'];?></span></div>
            <div id="totalnum"><?php echo $langs['itemt_totalnum'];?>：<span id="totalnumvalue"><?php echo $list_check1['curr_items'];?></span><span id="numnott"><?php echo $langs['itemt_numnott'];?></span></div></div>
			<div id="travmenu">
            <div class="layoutfixed">
            	<div id="totalmenu">        	
                    <div id="selslab">
                    	<?php echo $langs['itemt_sleslabid'];?>：
                        <select name='selslabid' id="selslabid">
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
                    <div id="slabtotalnum"><?php echo $langs['itemt_slabtotalnum'];?>：<span id="slabtotalnumvalue"><?php echo $list[$li]['number'];?></span></div>
                    <div id="slabtrav"><?php echo $langs['itemt_travtit'];?><input id="travnum" name="travnum" type="text" /><?php echo $langs['itemt_travtitnum'];?>
                    <span id="charsettit"><?php echo $langs['itemt_charsettit'];?>：</span>
                    <select name='selcharset' id="selcharset">
                    	<option id="UTF-8" value="UTF-8">UTF-8</option>
                    	<option id="GBK" value="GBK">GBK</option>
                    	<option id="GB2312" value="GB2312">GB2312</option>
                        <option id="GB18030" value="GB18030">GB18030</option>
                        <option id="Latin-1" value="Latin-1">Latin-1</option>
                    </select>
                    <input id="gotrav" class="but" name="gotrav" type="button" value="<?php echo $langs['itemt_getbut'];?>"/></div>
                </div>
            </div>
            </div>
<?php	
			}
		}
	}
} else if($type=='conp') {
	if(!$memm->MemConnect($type,$curcon))
		echo "<div id=\"confail\">".$langs['confail']."</div>";
	else {
		$list=$memm->conpGetItems();
		$list_check=$memm->ConpGetStats();
?>
<div class="layoutfixed">
<div id="itemstit"><span><?php echo $curcon['name'];?></span></div>	
<div id="selcon">
<select name='conitemsle' id="conitemsle">
  <?php
  	foreach($list_check as $key => $value) {
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
<?php
	if($list[$li_conid]==false) {
		echo "<div id=\"noitems\">".$langs['noitems_conp']."</div>";
	} else {
		if(md5(serialize($list[$li_conid]))==md5(serialize($list_check[$li_conid]))) {
				echo "<div id=\"confail\">".$langs['confail_tokyo_cabinet']."</div>";
		} else {
?>			
<div id="totalnum"><?php echo $langs['itemt_totalnum'];?>：<span id="totalnumvalue"><?php echo $list_check[$li_conid]['curr_items'];?></span></span><span id="numnott"><?php echo $langs['itemt_numnott'];?></span></div></div>
<div id="travmenu">
<div class="layoutfixed">
            	<div id="totalmenu">        	
                    <div id="selslab">
                    	<?php echo $langs['itemt_sleslabid']?>：
                        <select name='conpselslabid' id="conpselslabid">
<?php
  	foreach($list[$li_conid]['items'] as $key => $value) {
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
                    <div id="slabtotalnum"><?php echo $langs['itemt_slabtotalnum'];?>：<span id="slabtotalnumvalue"><?php echo $list[$li_conid]['items'][$li]['number'];?></span></div>
                    <div id="slabtrav"><?php echo $langs['itemt_travtit'];?><input id="travnum" name="travnum" type="text" /><?php echo $langs['itemt_travtitnum'];?>
                    <span id="charsettit"><?php echo $langs['itemt_charsettit'];?>：</span>
                    <select name='selcharset' id="selcharset">
                    	<option id="UTF-8" value="UTF-8">UTF-8</option>
                    	<option id="GBK" value="GBK">GBK</option>
                    	<option id="GB2312" value="GB2312">GB2312</option>
                        <option id="GB18030" value="GB18030">GB18030</option>
                        <option id="Latin-1" value="Latin-1">Latin-1</option>
                    </select>
                    <input id="gotrav" class="but" name="gotrav" type="button" value="<?php echo $langs['itemt_getbut'];?>"/></div>
                </div>
            </div>
            </div>
<?php		
		}
	}
	}
}
?>
<div id="showres"></div>
<div id="pages"></div>
</body>
</html>