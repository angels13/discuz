<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

if(!submitcheck('submit')) {
	showformheader($formurl);
	showtableheader();
	showsubtitle(array(lang('plugin/mogu_lottery','ActivityTitle'), lang('plugin/mogu_lottery','ParticipateQuantity'), lang('plugin/mogu_lottery','status'), cplang('founder_patch_dateline'), cplang('operation')));
	$filterarr = array();
	$limit = 15;
	$count = C::t('#mogu_lottery#mogu_lottery_activity')->count_by_search($filterarr);
	$total_page = ceil($count / $limit);
	$_G['page'] = $limit && $_G['page'] > $total_page ? 1 : $_G['page'];
	$start = ($_G['page'] - 1) * $limit;
	$multipage = multi($count, $limit, $_G['page'], "" . ADMINSCRIPT.'?action='.$basicurl);   
	foreach (C::t('#mogu_lottery#mogu_lottery_activity')->fetch_all_by_search($filterarr, $start, $limit, 'displayorder', 'DESC') as $value) {
		$operate = '<a href="'.ADMINSCRIPT.'?action='.$basicurl.'&mods=edit&actid='.$value['actid'].'&formhash='.FORMHASH.'">'.cplang('edit').'</a> | 
				<a href="'.ADMINSCRIPT.'?action='.$basicurl.'&mods=prize&actid='.$value['actid'].'&formhash='.FORMHASH.'">'.lang('plugin/mogu_lottery','prize_setting').'</a> |
				<a href="'.ADMINSCRIPT.'?action='.$basicurl.'&mods=statistical&do=apply&actid='.$value['actid'].'">'.lang('plugin/mogu_lottery','Statistical').'</a> | 
				<a href="'.ADMINSCRIPT.'?action='.$basicurl.'&mods=delete&actid='.$value['actid'].'&formhash='.FORMHASH.'">'.cplang('delete').'</a>';
		
		showtablerow('', array('class="td28"'), array(
		$value['title'].' [<a href="javascript:;" onclick="showWindow(\'generic\',\'plugin.php?id=mogu_lottery:misc&act=Preview&actid='.$value['actid'].'\', \'get\', 0);">'.lang('plugin/mogu_lottery','Preview').'</a>]',
		0,
		!empty($value['status']) ? '<span style="color:#06f">'.lang('plugin/mogu_lottery','processing').'</span>' : '<span style="color:#FFCC00">'.lang('plugin/mogu_lottery','Stop').'</span>',
		dgmdate($value['dateline'],'d'),
		$operate
		));
	}
	showsubmit('', '','<a href="'.ADMINSCRIPT.'?action='.$basicurl.'&mods=edit" class="btn h">'.lang('plugin/mogu_lottery','NewActivity').'</a>',$multipage);
	showtablefooter();
	showformfooter();
}else{
	
	cpmsg('setting_update_succeed', dreferer(), 'succeed');
}
?>