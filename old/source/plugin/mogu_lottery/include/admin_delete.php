<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

if(!$_GET['confirmed']) {
	cpmsg(lang('plugin/mogu_lottery','ActivityDeleteConfirm'), 'action='.$basicurl."&mods=delete&actid=$actid&formhash=".FORMHASH, 'form');
} else {
	@unlink($_G['setting']['attachdir'].'common/'.$activity['activitypic']);
	C::t('#mogu_lottery#mogu_lottery_stats')->delete_by_actid($actid);
	C::t('#mogu_lottery#mogu_lottery_hasuse')->delete_by_actid($actid);
	C::t('#mogu_lottery#mogu_lottery_activity')->delete($actid);
	cpmsg('setting_update_succeed', 'action='.$basicurl, 'succeed');
}


?>