<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
require_once (DISCUZ_ROOT."/source/plugin/mogu_lottery/function/function_core.php");

if(!submitcheck('submit')) {
	if(!empty($actid)){
		_showsubmenu('',array(
			array(lang('plugin/mogu_lottery','basis_setting'), $basicurl.'&mods=edit&actid='.$actid, $_GET['mods'] == 'edit'),
			array(lang('plugin/mogu_lottery','prize_setting'), $basicurl.'&mods=prize&actid='.$actid, $_GET['mods'] == 'prize'),
			array(lang('plugin/mogu_lottery','Statistical'), $basicurl.'&mods=statistical&actid='.$actid, $_GET['mods'] == 'statistical')
		));
	}else{
		showsubmenuloca(lang('plugin/mogu_lottery','CurrLoca'),array(
			array(lang('plugin/mogu_lottery','ActivityList'), ADMINSCRIPT.'?action='.$basicurl.'&mods=list'),
			array(lang('plugin/mogu_lottery','NewActivity'))
		));
	}
	
	foreach (C::t('common_usergroup')->fetch_all_by_type() as $g) {
		$usergrouplist[] = array($g['groupid'],$g['grouptitle']);
	}
	
	showformheader($formurl.'&mods='.$_GET['mods'].'&actid='.$actid,'enctype');
	showtableheader('');
	showtagheader('tbody', 'tab1', true, 'tbody');
	showsetting(lang('plugin/mogu_lottery','ActivityTitle'), 'title', $activity['title'], 'text','','','','required="required"');
	showsetting(lang('plugin/mogu_lottery','status'), array('status',array(array(1,lang('plugin/mogu_lottery','Open')),array(0,lang('plugin/mogu_lottery','Stop')))), $activity['status'], 'mradio');
	$template = _GetTemplate(DISCUZ_ROOT . '/source/plugin/mogu_lottery/template');
	foreach ($template as $t) {
		$templatelist[] = array($t['directory'],$t['name'].' ('.$t['directory'].')');
	}
	showsetting(lang('plugin/mogu_lottery','TemplateStyle'), array('template', $templatelist), $activity['template'], 'select','','','<a href="javascript:;" onclick="showWindow(\'generic\',\'plugin.php?id=winners:misc&act=PreviewTemplate\', \'get\', 0);" style="color:#2366A8;">'.lang('plugin/mogu_lottery','PreviewTemplate').'</a>');
	showsetting(lang('plugin/mogu_lottery','CoverImage'), 'activitypic', $activity['activitypic'], 'filetext');
	//showsetting(lang('plugin/mogu_lottery','prizebackpic'), 'prizebackpic', $activity['prizebackpic'], 'filetext','','',lang('plugin/mogu_lottery','prizebackpic_desc'));
	//showsetting(lang('plugin/mogu_lottery','pianyiliang'), 'angle', $activity['angle'], 'text','','',lang('plugin/mogu_lottery','angle_desc'));
	$activity['time'] = unserialize($activity['time']);
	showsetting(lang('plugin/mogu_lottery','ActivityTime'), array('time[]','time[]'), $activity['time'], 'daterange');
	showsetting(lang('plugin/mogu_lottery','MustConcernsWeiXin'), 'subscribe', $activity['subscribe'], 'radio','','',lang('plugin/mogu_lottery','MustConcernsWeiXin_desc'));
	$activity['group'] = unserialize($activity['group']);
	showsetting(lang('plugin/mogu_lottery','AllowUserGroup'), array('group[]', $usergrouplist), $activity['group'], 'mselect','','',lang('plugin/mogu_lottery','AllowUserGroup_desc'));
	
	$EveryArr = array(
		'once' => lang('plugin/mogu_lottery','Once'),
		'hours' => lang('plugin/mogu_lottery','EveryHours'),
		'day' => lang('plugin/mogu_lottery','EveryDay'),
		'week' => lang('plugin/mogu_lottery','EveryWeek'),
		'month' => lang('plugin/mogu_lottery','EveryMonth')
	);
	$activity['giving'] = unserialize($activity['giving']);
	foreach($EveryArr as $k => $val){
		$option .= '<option value="'.$k.'" '.($activity['giving'][0] == $k ? 'selected':'').'>'.$val.'</option>';
	}
	$givinghtml = '<select name="giving[]" style="width:70px;">'.$option.'</select>,'.lang('plugin/mogu_lottery','SysGiv').' <input name="giving[]" type="text" style="width:50px;" value="'.$activity['giving'][1].'"/> '.lang('plugin/mogu_lottery','ci');
	showsetting(lang('plugin/mogu_lottery','GivChance'), '', '', $givinghtml,'','',lang('plugin/mogu_lottery','NotGift'));
	
	$option = '';
	$activity['credit'] = unserialize($activity['credit']);
	foreach ($_G['setting']['extcredits'] as $k => $c) {
		if($c['title']){
		   $option .= '<option value="'.$k.'" '.($activity['credit'][1] == $k ? 'selected':'').'>'.$c['title'].'</option>';
		}
	}
	$credithtml = '<input name="credit[]" type="text" style="width:65px;" value="'.$activity['credit'][0].'"/> - <select name="credit[]" style="width:100px;">'.$option.'</select>';
	showsetting(lang('plugin/mogu_lottery','LootteryIntegral'), '', '', $credithtml,'','',lang('plugin/mogu_lottery','IntegralAction_desc'));
	$activity['period'] = unserialize($activity['period']);
	showsetting(lang('plugin/mogu_lottery','PeriodTime'), array('period[]','period[]'), $activity['period'], 'range','','',lang('plugin/mogu_lottery','PeriodTime_desc'));
	!$activity['navitem'] && $activity['navitem'] = '&#25105;&#35201;&#25277;&#22870;|plugin.php?id=mogu_lottery:home&actid={actid}
&#25105;&#30340;&#22870;&#21697;|plugin.php?id=mogu_lottery:my&actid={actid}
&#20013;&#22870;&#21517;&#21333;|plugin.php?id=mogu_lottery:award&actid={actid}';
	showsetting(lang('plugin/mogu_lottery','NavigationItem'), 'navitem', $activity['navitem'], 'textarea','','',lang('plugin/mogu_lottery','NavigationItem_desc'));
	showsetting(lang('plugin/mogu_lottery','ActivityIntroduce'), 'introduce', $activity['introduce'], 'textarea','','','','required="required"');
	showtagfooter('tbody');
	showsubmit('submit', 'submit');
	showtablefooter();
	showformfooter();
}else{
	if($_FILES['activitypic']['tmp_name']){
		$up = upload($_FILES['activitypic'],  'common', random(3, 1), random(8));	
	}
	if($_FILES['prizebackpic']['tmp_name']){
		$backpic = upload($_FILES['prizebackpic'],  'common', random(3, 1), random(8));	
	}
	$data = array(
		'status' => intval($_GET['status']),
		'title' => daddslashes($_GET['title']),
		'template' => daddslashes($_GET['template']), 
		'activitypic' => $up['attachment'] ? $up['attachment'] : $_GET['activitypic'],
		'prizebackpic' => $backpic['attachment'] ? $backpic['attachment'] : $_GET['prizebackpic'],
		'angle' => intval($_GET['angle']),
		'time' => serialize($_GET['time']),
		'subscribe' => intval($_GET['subscribe']),
		'group' => serialize($_GET['group']),
		'giving' => serialize($_GET['giving']),
		'credit' => serialize($_GET['credit']),
		'period' => serialize($_GET['period']),
		'navitem' => daddslashes($_GET['navitem']),
		'introduce' => dhtmlspecialchars($_GET['introduce'])
	);
	if(!empty($actid)){
		C::t('#mogu_lottery#mogu_lottery_activity')->update($actid, $data);
		cpmsg('setting_update_succeed', dreferer(), 'succeed');
	}else{
		$data['uid'] = $_G['uid'];
		$data['username'] = $_G['username'];
		$data['dateline'] = time();
		$actid = C::t('#mogu_lottery#mogu_lottery_activity')->insert($data,true);
		cpmsg('setting_update_succeed','action='.$basicurl,'succeed');
	} 
}
?>