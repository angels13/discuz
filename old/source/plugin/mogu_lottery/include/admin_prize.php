<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

require_once (DISCUZ_ROOT."/source/plugin/mogu_lottery/function/function_core.php");

$activity = C::t('#mogu_lottery#mogu_lottery_activity')->fetch($actid);
$activity['winning'] = unserialize($activity['winning']);
if(!submitcheck('submit')) {
	_showsubmenu('',array(
		array(lang('plugin/mogu_lottery','basis_setting'), $basicurl.'&mods=edit&actid='.$actid, $_GET['mods'] == 'edit'),
		array(lang('plugin/mogu_lottery','prize_setting'), $basicurl.'&mods=prize&actid='.$actid, $_GET['mods'] == 'prize'),
		array(lang('plugin/mogu_lottery','Statistical'), $basicurl.'&mods=statistical&actid='.$actid, $_GET['mods'] == 'statistical')
	));
	showscript($actid,count($activity['prize']));
	showformheader($formurl.'&mod='.$_GET['mod'].'&actid='.$actid,'enctype');
	showtableheader('');
	showsubtitle(array(lang('plugin/mogu_lottery','location'),lang('plugin/mogu_lottery','prize_setting'),lang('plugin/mogu_lottery','Chance'),lang('plugin/mogu_lottery','Published'),lang('plugin/mogu_lottery','SmokingTip'),''));
	$prizeall = C::t('#mogu_lottery#mogu_lottery_goods')->fetch_all_by_search();
	foreach($activity['winning'] as $k => $val){
		$item = '<option value="0" '.(empty($val['prize']) ? 'selected' : '').'>--'.lang('plugin/mogu_lottery','NoPrize').'--</option>';
		foreach($prizeall as $v){
			$item .= '<option value="'.$v['pid'].'" '.($v['pid'] == $val['prize'] ? 'selected' : '').'>'.$v['name'].'</option>';
		}
		showtablerow('', array(), array($k+1,'<select name="prize['.$k.']">'.$item.'</select>','<input name="chance['.$k.']" value="'.$val['chance'].'" type="text" style="width:50px;" /> %','<input name="push['.$k.']" type="checkbox" value="1" '.($val['push'] ? 'checked' : '').'/>','<input name="prompt['.$k.']" type="text" value="'.$val['prompt'].'"/>','<div><a href="javascript:;" onClick="deleterow(this)">'.cplang('delete').'</a></div>'));
	}
	showsubmit('submit', 'submit', '', ' <a href="javascript:;" onclick="grid++;addrow(this, 0);" class="addtr">'.lang('plugin/mogu_lottery','AddGrid').'</a>');
	showtablefooter();
	showformfooter();
}else{
	foreach($_GET['prize'] as $k => $val) {
		$dat[] = array(
			'prize' => $val,
			'chance' => $_GET['chance'][$k],
			'push' => $_GET['push'][$k],
			'prompt' => $_GET['prompt'][$k]
		);
	}
	$data['winning'] = serialize($dat);
	C::t('#mogu_lottery#mogu_lottery_activity')->update($actid, $data);
	cpmsg('setting_update_succeed' , dreferer(), 'succeed');
}


?>