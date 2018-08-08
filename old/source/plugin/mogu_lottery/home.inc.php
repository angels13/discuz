<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

require (DISCUZ_ROOT . './source/plugin/mogu_lottery/function/function_core.php');
require_once libfile('function/home');
$actid = intval($_GET['actid']);

$activity = _activity($actid);
if (!$activity) {
    showmessage('Activity does not exist or has been deleted!', dreferer() , 'succeed');
}
$navtitle = strip_tags($activity['title']);

if($activity['subscribe']){
	$wechat = _getopenid();
	$openid = $wechat[0];
}

foreach($activity['winning'] as $k => $val){
	if(!empty($val['prize'])){
		$prizeid[] = $val['prize'];
	}
}
	
$prizeall = C::t('#mogu_lottery#mogu_lottery_goods')->fetch_all($prizeid);
foreach($activity['winning'] as $k => $val){
	$prizelist[$k]['id'] = $k;
	if(!empty($val['prize'])){
		$prizelist[$k]['name'] = $prizeall[$val['prize']]['name'];
	    $prizelist[$k]['pic'] = $prizeall[$val['prize']]['pic'] = pic_get($prizeall[$val['prize']]['pic'], 'common', 0, 0);
		//$prizeall[$val['prize']] = $prizeall[$val['prize']];   //备用奖品列表
	}else{
		$prizelist[$k]['name'] = lang('plugin/mogu_lottery','NoPrizes');
		//$prizelist[$k]['pic'] = 'source/plugin/mogu_lottery/static/images/none.gif';
	}	
}
$prizejson = json_encode(_iconv($prizelist,'utf-8'));

if($activity['credit'][0] && $activity['credit'][1]){
	$credit['d'] = substr($activity['credit'][0], 0, 1);
	$credit['title'] = $_G['setting']['extcredits'][$activity['credit'][1]]['title']; 
	$credit['c'] = abs($activity['credit'][0]);
	if($credit['d'] && $credit['c']) {
		$creditd = $credit['d'] == '-' ? lang('plugin/mogu_lottery','deduction') : lang('plugin/mogu_lottery','reward');
		$credittxt = ', '.lang('plugin/mogu_lottery','credittxt', array('d'=>$creditd,'n'=>$credit['c'],'t'=>$credit['title']));
	}
}

if(!empty($activity['giving'][1])){
	$fromarr[] = DB::table('mogu_lottery_user');
	$mark = daddslashes(getcookie('marks'));
	$condition = array();
	if($_G['uid']){
		$condition[] = DB::field('uid', $_G['uid']);
	}
	if($mark){
		$condition[] = DB::field('mark', $mark);
	}
	if($openid){
		$condition[] = DB::field('openid', $openid);
	}
	if(!empty($condition)){
		$user = C::t('#mogu_lottery#mogu_lottery_user')->fetch_or_search($condition, $fromarr);
		$user && $hasuse = C::t('#mogu_lottery#mogu_lottery_hasuse')->fetch_by_yid($user['yid'], $actid);
	}
	
	switch ($activity['giving'][0]) {
		case 'hours': $strto = strtotime(date('Y-m-d H:0:0', time())); break;
		case 'day': $strto = strtotime(date('Y-m-d', time())); break;
		case 'week': $strto = strtotime('last monday'); break;
		case 'month': $strto = strtotime(date('Y-m-1', time())); break;
		default: $strto = 0; break;
	}
	$hasuse['hasuse'] = !$hasuse || $hasuse['lasttime'] < $strto ? 0 : $hasuse['hasuse'];
	$chance = intval($activity['giving'][1]) - $hasuse['hasuse'];
	$chance<0 && $chance = 0;
	$chancetxt = lang('plugin/mogu_lottery','Chance_'.$activity['giving'][0], array('n'=>$chance));
}

if($_GET['lottery']){
	$lasttime = authcode(preg_replace('/\s/', '+', $_G['cookie'][$_GET['lottery']]), 'DECODE', $_G['config']['security']['authkey']);
	if($lasttime){
		$chance = $chance + 1;
		$chancetxt = lang('plugin/mogu_lottery','Chance_'.$activity['giving'][0], array('n'=>$chance));
	}
}

$filterarr['actid'] = array($actid);
$filterarr['push'] = array(1);
foreach(C::t('#mogu_lottery#mogu_lottery_stats')->fetch_all_by_search($filterarr,0,10,'dateline') as $val){
	$nickname = array_values(array_filter(array($val['username'],$val['nickname'],$val['ip'])));
	$len = strlen($nickname[0])/3;
	$len = $len < 2 ? 2 : $len;
	//$val['username'] = substr_replace($nickname[0],str_repeat('*',$len),ceil(($len)/1),$len);
	$val['username'] = $nickname[0];
	$announcement[] = lang('plugin/mogu_lottery','WinnersAnnounced_'.rand(0,3), array('u'=>'','name'=>$val['username'], 'goods'=>$val['name']));	
}


include template('mogu_lottery:'._detect($activity['template'],$module), NULL, './source/plugin/mogu_lottery/template');
?>