<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$mark = daddslashes(getcookie('marks'));
if(!$mark){
	header("Location: ".$_G['siteurl']."plugin.php?id=winners:home&actid=".$actid);
	exit;
}

if (!$_G['uid']) {
	showmessage('not_loggedin', NULL, array() , array('login' => 1));
}

require_once ("function/function_core.php");
require_once libfile('function/home');

$_GET['do'] = !$_GET['do'] ? 'list' : $_GET['do'];
$actid = intval($_GET['actid']);

$wechat = _getopenid();
$openid = $wechat[0];
$fromarr[] = DB::table('mogu_lottery_user');
$wherearr = array();
$condition = array('uid' => $_G['uid'], 'mark' => $mark, 'openid' => $openid);
foreach($condition as $k => $val){
	$val && $wherearr[] = DB::field($k, $val);
}

$user = C::t('#mogu_lottery#mogu_lottery_user')->fetch_or_search($wherearr, $fromarr);
if($user && !$user['uid']){
	C::t('#mogu_lottery#mogu_lottery_user')->update($user['yid'], array('uid'=>$_G['uid']));
}

if($_GET['do'] == 'list'){
	$navtitle = strip_tags(lang('plugin/mogu_lottery','WinningRecord'));
	$filterarr = array();
	$filterarr['yid'] = array($user['yid']);
	$limit = 10;
	$page = max(1, $_GET['page']);
	$start = ($page - 1) * $limit;
	$count = C::t('#mogu_lottery#mogu_lottery_stats')->count_by_search($filterarr);
	$multipage = multi($count, $limit, $page,'plugin.php?id=mogu_lottery:my&actid='.$actid);
	foreach (C::t('#mogu_lottery#mogu_lottery_stats')->fetch_all_by_search($filterarr, $start, $limit, 'statu,dateline' ,'DESC') as $val) {
		$val['type'] = lang('plugin/mogu_lottery',$val['type']);
		$val['status'] = !empty($val['statu']) ? '<span style="color:#09f;">'.lang('plugin/mogu_lottery','ylingqu').'</span>' : lang('plugin/mogu_lottery','Wlingqu');
		$val['pic'] = pic_get($val['pic'], 'common', 0, 0);
		$list[] = $val;
		$actarr[] = $val['actid'];
	}
	foreach (C::t('#mogu_lottery#mogu_lottery_activity')->fetch_all($actarr) as $val) {
		$activitylist[$val['actid']] = $val;
	}
	
}elseif($_GET['do'] == 'address'){
	$navtitle = strip_tags(lang('plugin/mogu_lottery','MailingAddress'));
	$data = C::t('#mogu_lottery#mogu_lottery_userdata')->fetch($user['yid']);
	if(submitcheck('submit')) {
		$dataup = array(
		'yid' => $user['yid'],
		'addressee' =>daddslashes($_GET['addressee']),
		'telephone' => daddslashes($_GET['telephone']),
		'zipcode' => daddslashes($_GET['zipcode']),
		'address' => daddslashes($_GET['address'])
		);
		if(!$data['yid']){
			C::t('#mogu_lottery#mogu_lottery_userdata')->insert($dataup);
		}else{
			C::t('#mogu_lottery#mogu_lottery_userdata')->update($user['yid'], $dataup);
		}
		showmessage('mogu_lottery:info_has_submit', dreferer(), 'succeed');
	}
}

include template('mogu_lottery:'._detect($activity['template'],$module), NULL, './source/plugin/mogu_lottery/template');
?>