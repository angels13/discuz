<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

require_once (DISCUZ_ROOT."/source/plugin/mogu_lottery/function/function_core.php");


_showsubmenu('',array(
	array(lang('plugin/mogu_lottery','basis_setting'), $basicurl.'&mods=edit&actid='.$actid, $_GET['mods'] == 'edit'),
	array(lang('plugin/mogu_lottery','prize_setting'), $basicurl.'&mods=prize&actid='.$actid, $_GET['mods'] == 'prize'),
	array(lang('plugin/mogu_lottery','Statistical'), $basicurl.'&mods=statistical&actid='.$actid, $_GET['mods'] == 'statistical')
));

if(!submitcheck('submit')) {
	showformheader($formurl.'&mod='.$_GET['mod'].'&actid='.$actid,'enctype');
	showtableheader('');
	
	$selected['prize'][$_GET['prize']] = 'selected';
	$selected['status'][$_GET['status']] = 'selected';
	$selected['perpage'][$_GET['perpage']] = 'selected';
	
	$prizeall = C::t('#mogu_lottery#mogu_lottery_goods')->fetch_all_by_search();
	$item = '<option value="" selected>'.lang('plugin/mogu_lottery','GoodsName').'</option>';
	foreach($prizeall as $v){
		$item .= '<option value="'.$v['pid'].'" '.$selected['prize'][$v['pid']].'>'.$v['name'].'</option>';
	}
	echo cplang('resultsort').': <select name="prize">'.$item.'</select>&nbsp;
				  <select name="status">
					<option value="all" selected>'.lang('plugin/mogu_lottery','status').'</option>
					<option value="0" '.$selected['status']['0'].'>'.lang('plugin/mogu_lottery','Wlingqu').'</option>
					<option value="1" '.$selected['status']['1'].'>'.lang('plugin/mogu_lottery','ylingqu').'</option>
				  </select>&nbsp;
				  <select name="perpage">
					<option value="10" '.$selected['perpage']['10'].'>'.cplang('perpage_10').'</option>
					<option value="20" '.$selected['perpage']['20'].'>'.cplang('perpage_20').'</option>
					<option value="50" '.$selected['perpage']['50'].'>'.cplang('perpage_50').'</option>
					<option value="100" '.$selected['perpage']['100'].'>'.cplang('perpage_100').'</option>
				  </select>&nbsp;
				  <input type="submit" name="searchsubmit" value="'.cplang('search').'" class="btn">';
	showsubtitle(array('',lang('plugin/mogu_lottery','username'),lang('plugin/mogu_lottery','GoodsName'),lang('plugin/mogu_lottery','GoodsType'),lang('plugin/mogu_lottery','WinningTime'),lang('plugin/mogu_lottery','status')));
	
	$_GET['prize'] = isset($_GET['prize']) ? intval($_GET['prize']) : '';
	$_GET['status'] = isset($_GET['status']) ? daddslashes($_GET['status']) : 'all';
	$limit = !empty($_GET['perpage']) ? intval($_GET['perpage']) : 10;

	$filterarr['actid'] = array($actid);
	if(!empty($_GET['prize'])){
		$filterarr['pid'] = array($_GET['prize']);
	}
	if($_GET['status']!='all'){
		$filterarr['statu'] = array($_GET['status']);
	}
	isset($_GET['prize']) ? $get['prize']=$_GET['prize'] : '';
	isset($_GET['status']) ? $get['status']=$_GET['status'] : '';
	$url = http_build_query($get);
	$page = max(1, $_GET['page']);
	$start = ($page - 1) * $limit;
	$count = C::t('#mogu_lottery#mogu_lottery_stats')->count_by_search($filterarr);
	$multipage = multi($count, $limit, $page, "" . ADMINSCRIPT . '?action='.$formurl.'&mod='.$_GET['mods'].'&actid='.$actid.'&'.$url);   
	foreach (C::t('#mogu_lottery#mogu_lottery_stats')->fetch_all_by_search($filterarr, $start, $limit) as $val) {
		$arr[] = $val;
		$yids[] = $val['yid'];
	}
	$userdata = C::t('#mogu_lottery#mogu_lottery_userdata')->fetch_all($yids);
	//print_r($userdata);
	foreach ($arr as $val){
		!$val['username'] && $val['username'] = $val['ip'];
		showtagheader('tbody', 't_'.$val['sid'], true, 'xt');
		showtablerow('', array('','','','','','class="fu"'), array(
		'<input name="sid[]" type="checkbox" value="'.$val['sid'].'" />',
		$val['username'],
		$val['name'],
		lang('plugin/mogu_lottery',$val['type']),
		dgmdate($val['dateline']),
		!empty($val['statu']) ? lang('plugin/mogu_lottery','ylingqu') : lang('plugin/mogu_lottery','Wlingqu').'<div class="trs"><b>&#25910;&#20214;&#20154;: '.$userdata[$val['yid']]['addressee'].'</b><b>&#32852;&#31995;&#30005;&#35805;: '.$userdata[$val['yid']]['telephone'].'</b><b>&#37038;&#32534;: '.$userdata[$val['yid']]['zipcode'].'</b><b>&#35814;&#32454;&#22320;&#22336;: '.$userdata[$val['yid']]['address'].'</b></div>'
		));
		showtagfooter('tbody');
	}

	$optypehtml = '&nbsp;&nbsp;<input type="radio" name="optype" id="optype_lq" value="lq" class="radio" /><label for="optype_lq">'.lang('plugin/mogu_lottery','BJYJLQ').'</label>&nbsp;&nbsp;';
	showsubmit('submit', 'submit', '<input type="checkbox" name="chkall" value="ths" onclick="checkAll(\'prefix\', this.form, \'sid\')">'.lang('plugin/mogu_lottery','Allselect').$optypehtml, '',$multipage);
	showtablefooter();
	showformfooter();
	echo '<style>
	.fu {position: relative;}
	.trs {display: none; position: absolute; right: 0px; top: 0px;height: 36px;line-height: 36px;background: #F2F9FD;text-align: right; width: 1000px;}
	.trs b {padding-left: 15px;  padding-right: 15px;}
	.hover:hover .trs {display: block;}
	</style>';
}else{
	$aids = !empty($_GET['sid']) && is_array($_GET['sid']) ? daddslashes($_GET['sid']) : array();
	if($_POST['optype'] == 'lq') {
		foreach($aids as $sid){
			C::t('#mogu_lottery#mogu_lottery_stats')->update($sid,array('statu' => 1));
		}  
	}
	cpmsg('setting_update_succeed' , dreferer(), 'succeed');
}		

?>