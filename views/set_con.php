<?php
if(!defined('IN_MADM')) exit();
require_once("./langs/".$_SESSION["MADM_SESSION_KEY"]['lang'].".php");	
require_once('./config.php');
global $config;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
	if(strpos($_SERVER['HTTP_USER_AGENT'], "MSIE 8.0"))
		echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=EmulateIE7\" />";
?>
<title><?php echo $langs['set_con_title']." - ".$langs['title']." - ".$config['version'];?></title>
<script type="text/javascript" src="include/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="include/js/jquery.md5.js"></script>
<script type="text/javascript" src="include/js/jquery.treeview.js"></script>
<script type="text/javascript" src="include/js/set_con.js"></script>
<link rel="stylesheet" href="include/css/jquery.treeview.css" />
<link rel="stylesheet" href="include/css/set_con.css" />
<style type="text/css">
body {<?php set_font('body');?>}
#sc_l_tit {<?php set_font('h1');?>}
#addtype {<?php set_font('h1');?>}
#listm {float:right;margin-right:10px;color:#0066cc;_margin-top:-28px;_margin-right:5px;<?php set_font('body');?>}
#logout {float:right;font-weight:normal;margin-right:30px;_margin-top:-15px;<?php set_font('body');?>}
<?php
if($_SESSION["MADM_SESSION_KEY"]['lang']=='en-us') {
	echo "#showconmenu{margin-left:10px;*margin-left:-74px;}";
	echo ".del_conc,.del_concp{margin-left:290px;}";
}
?>
</style>
<script language="javascript">
/*  some words in js file for different languages  */
var con_exist="<?php echo $langs['con_exist'];?>";
var no_conname="<?php echo $langs['no_conname'];?>";
var no_host="<?php echo $langs['no_host'];?>";
var no_port="<?php echo $langs['no_port'];?>";
var conp_consltit="<?php echo $langs['conp_consltit'];?>";
var con_host="><?php echo $langs['con_host'];?>";
var del="<?php echo $langs['con_del'];?>";
var con_port="<?php echo $langs['con_port'];?>";
var con_more="<?php echo $langs['con_more'];?>";
var conp_pcon="<?php echo $langs['conp_pcon'];?>";
var conp_status="<?php echo $langs['conp_status'];?>";
var conp_statusfalse="<?php echo $langs['conp_statusfail'];?>";
var con_weight="<?php echo $langs['con_weight'];?>";
var con_timeout="<?php echo $langs['con_timeout'];?>";
var con_se="<?php echo $langs['con_se'];?>";
var con_retry="<?php echo $langs['con_retry'];?>";
var con_se="<?php echo $langs['con_se'];?>";
var con_arg="<?php echo $langs['con_arg'];?>";
var con_host="<?php echo $langs['con_host'];?>";
var con_port="<?php echo $langs['con_port'];?>";
var con_arg_pcon="<?php echo $langs['con_arg_pcon'];?>";
var con_arg_no="<?php echo $langs['con_arg_no'];?>";
var con_arg_yes="<?php echo $langs['con_arg_yes'];?>";
var con_arg_timeout="<?php echo $langs['con_arg_timeout'];?>";
var con_arg_se="<?php echo $langs['con_arg_se'];?>";
var con_arg_default="<?php echo $langs['con_arg_default'];?>";
var con_no_list="<?php echo $langs['no_cons'];?>";
var con_failhost="<?php echo $langs['con_failhost'];?>";
var con_failport="<?php echo $langs['con_failport'];?>";
var con_failtimeout="<?php echo $langs['con_failtimeout'];?>";
var con_havecon="<?php echo $langs['con_havecon'];?>";
var con_confirm="<?php echo $langs['con_confirm'];?>";
var con_confirm_clear="<?php echo $langs['con_confirm_clear'];?>";
var con_conpname="<?php echo $langs['no_conpname'];?>";
var con_haveconp="<?php echo $langs['con_haveconp'];?>";
var conp_consltit="<?php echo $langs['conp_consltit'];?>";
var con_failweight="<?php echo $langs['con_failweight'];?>";
var con_failretry="<?php echo $langs['con_failretry'];?>";
var con_failnoconp="<?php echo $langs['con_failnoconp'];?>";
var con_exist_conp="<?php echo $langs['con_exist_conp'];?>";
var conp_statusfail="<?php echo $langs['conp_statusfail'];?>";
var conp_noweight="<?php echo $langs['conp_noweight'];?>";
var con_nolist="<?php echo $langs['con_nolist'];?>";
var con_saveok="<?php echo $langs['con_saveok'];?>";
var con_clearok="<?php echo $langs['con_clearok'];?>";
var con_listsavetime="<?php echo $langs['con_listsavetime'];?>";
var con_loadnotice="<?php echo $langs['con_loadnotice'];?>";
</script>
</head>

<body>
<div id="sc_top"><?php echo $langs['set_con_title'];?><span id="logout"><a href="index.php?action=logout"><?php echo $langs['exit'];?></a></span></div>
<div id="sc_main">
  <div id="sc_hlist">
    <div id="sc_l_tit"> <?php echo $langs['set_con_listtit'];?>
      <div id="listm">
        <div id="sidetreecontrol"><a id="tc1" href="javascript:;"></a><a id="tc2" href="javascript:;"></a></div>
        <a id="showcontrol" href="javascript:;"><?php echo $langs['con_listm'];?>▼</a>
        <div id="showconmenu">
          <div id="conall">
            <ul>
              <li><a id="call" href="javascript:;"><?php echo $langs['con_call'];?></a></li>
              <li><a id="eall" href="javascript:;"><?php echo $langs['con_eall'];?></a></li>
            </ul>
          </div>
          <div id="saveclear">
            <ul>
              <li><a id="clearlist" href="javascript:;"><?php echo $langs['con_clearlist'];?></a></li>
              <li><a id="savelist" href="javascript:;"><?php echo $langs['con_savelist'];?></a></li>
              <li><a id="loadlist" href="javascript:;"><?php echo $langs['con_loadlist'];?></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div id="list_tree">
      <div id="no_tree"></div>
      <ul id="tree" class="filetree">
      </ul>
    </div>
    <div id="gonext">
      <input id="gonextbut" class="but" name="gonextbut" type="button" value="<?php echo $langs['con_go'];?>"/>
      <div id="save_date"> </div>
    </div>
  </div>
  <div id="sc_add">
    <div id="sc_add_main">
      <p id="addtype">
        <input id="addcon" type="radio" name="addcon" value='addcon' checked>
        <label for="addcon">&nbsp;<?php echo $langs['set_con_addcon'];?></label>
        <input id="addcp" type="radio" name="addcon" value='addconnpool'>
        <label for="addcp">&nbsp;<?php echo $langs['set_con_addconpool'];?></label>
      </p>
      <div id="addcon_m">
        <div class="mtitle"> <?php echo $langs['help_addcon'];?></div>
        <div id="addcinput">
          <p id="addcname"><?php echo $langs['con_name'];?>：
            <input id="conname" name="conname" type="text" value="<?php echo $langs['con_name_def'];?>"/>
          </p>
          <p id="addhost"><?php echo $langs['con_host'];?>：
            <input id="conhost" name="conhost" type="text" value="127.0.0.1"/>
            <span id="aport"><?php echo $langs['con_port'];?>：</span>
            <input id="conport" name="conport" type="text" value="11211"/>
          </p>
          <div id="con_more">
            <div id="more_but"><span id="more_icon">▼</span>&nbsp;<a id="showm" href="javascript:;"><?php echo $langs['con_more'];?></a></div>
            <div id="show_more">
              <p id="more_line"></p>
              <p id="con_pcon">
                <input id="addpc" type="checkbox" name="addpc" />
                &nbsp;<?php echo $langs['con_pcon'];?></p>
              <p id="setti"><?php echo $langs['con_timeout'];?>：
                <input id="contimeout" name="contimeout" type="text" value="1"/>
                &nbsp;<?php echo $langs['con_se'];?></p>
            </div>
            <input id="addcon_but" class="but" name="addcon_but" type="button" value="< <?php echo $langs['con_add'];?>"/>
          </div>
        </div>
      </div>
      <div id="addconpool_m">
        <div class="mtitle"> <?php echo $langs['help_addcp'];?></div>
        <div id="addcpinput">
          <p id="addcpname"><?php echo $langs['conp_name'];?>：
            <input id="conpname" name="conpname" type="text" value="<?php echo $langs['conp_name_def'];?>"/>
          </p>
          <div id="cons"></div>
          <div id="add_new"> <a id="add_new_con" href="javascript:;"><?php echo $langs['add_new_con'];?></a> </div>
          <input id="addconp_but" class="but" name="addconp_but" type="button" value="< <?php echo $langs['con_add'];?>"/>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="footer"></div>
</body>
</html>
<?php
if(isset($glo_s)&&$glo_s=='init')
	echo "<script>json2data(\"apps/GetList.php\");savelisttime();</script>";
if(isset($glo_s)&&$glo_s=='session')
	echo "<script>json2data(\"apps/GetListSession.php\");hidelisttime();</script>";
?>