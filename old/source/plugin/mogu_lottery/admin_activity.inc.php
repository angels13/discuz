<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

$_GET['mods'] != 'delete' && cpheader();
echo '<script type="text/javascript">var disallowfloat = "'.$_G['setting']['disallowfloat'].'",CSSPATH = "'.$_G['setting']['csspath'].'";</script>
      <script type="text/javascript" src="static/js/calendar.js"></script>
	  <style>
	  .itemtitle {margin-bottom:-5px !important;}
	  .load {background-image: url(source/plugin/mogu_lottery/static/images/load.gif) !important; background-repeat: no-repeat;}
	  .curr, .unselect { background-image: url(/static/image/common/atarget.png); display: block; height: 11px; width: 11px; }
      .curr { background-position: 0px -40px !important; }
	  .rowform .nofloat li {float: left; margin-right: 10px;}
	  .formlist, .upimg, .pns { padding:10px; width:420px;}
	  </style>';
	  
$basicurl = 'plugins&operation=config&do='.$_G['gp_do'].'&identifier=mogu_lottery&pmod='.$_GET['pmod'];
$_GET['mods'] = in_array($_GET['mods'],array('delete','edit','list','statistical','new','prize')) ? $_GET['mods'] : 'list';
$formurl = $basicurl.'&mods='.$_GET['mods'];

require (DISCUZ_ROOT."/source/plugin/mogu_lottery/function/function_admin.php");

if(!empty($_GET['actid'])){
	$actid = intval($_GET['actid']);
    $activity = C::t('#mogu_lottery#mogu_lottery_activity')->fetch($actid);
}

require ('include/admin_'.$_GET['mods'].'.php');

?>