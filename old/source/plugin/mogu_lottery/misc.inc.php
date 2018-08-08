<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

require_once ("function/function_core.php");

/*ajax获取用户名*/
if ($_GET['act'] == 'introduce') {
	$actid = intval($_GET['actid']);
	$activity = _activity($actid);
	if (!$activity) {
		showmessage('Activity does not exist or has been deleted!', dreferer() , 'succeed');
	}
	$html = '<pre style="font-size: 16px; line-height: 24px; word-wrap: break-word; white-space: pre-wrap; white-space: -moz-pre-wrap" >'.$activity['introduce'].'</pre>';
	include template('mogu_lottery:'._detect('default','ajax'));
}

if ($_GET['act'] == 'Preview') {
	$style = '<style>.msger p {padding: 0px 20px;text-align: center;}.msger img {margin: 10px auto 10px auto;display: inline;}</style>';
	$html = '<dl style=""><div class="msger"><p>'.lang('plugin/mogu_lottery','Preview_desc',array('url'=>$_G['siteurl'].'plugin.php?id=mogu_lottery:home&actid='.$_GET['actid'])).'</p><p style="padding:10px;text-align: center;"><img width="200" height="200" src="http://pan.baidu.com/share/qrcode?w=200&h=200&url='.urlencode($_G['siteurl'].'plugin.php?id=mogu_lottery:home&actid='.$_GET['actid']).'"/></p></div></dl>';
	include template('common/header_ajax');
	echo '<h3 class="flb" style="margin-bottom: 0px;"> <em id="return_'.$_GET['handlekey'].'">'.lang('plugin/mogu_lottery','Preview').'</em> <span> <a href="javascript:;" class="flbc" onclick="hideWindow(\''.$_GET['handlekey'].'\');">'.lang('close').'</a> </span> </h3>
<div class="showWindow" style="overflow:auto;overflow-x:hidden; padding:10px;"><dl>'.$html.'</dl></div>';
	include template('common/footer_ajax');
}

?>