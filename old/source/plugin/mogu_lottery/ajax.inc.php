<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

require (DISCUZ_ROOT . './source/plugin/mogu_lottery/function/function_core.php');

if($_GET['formhash'] != FORMHASH) {
	exit(json_encode(array('result'=>0, 'msg'=>_iconv(lang('plugin/mogu_lottery','NoActivityInof'),'utf-8'))));
}

$actid = intval($_GET['actid']);
$activity = _activity($actid);
if(!$activity){
	exit(json_encode(array('result'=>0, 'msg'=>_iconv(lang('plugin/mogu_lottery','NoActivityInof'),'utf-8'))));
}
if($_GET['lottery']){
	$lasttime = authcode(preg_replace('/\s/', '+', $_G['cookie'][$_GET['lottery']]), 'DECODE', $_G['config']['security']['authkey']);
	if($lasttime){
		$lottery = 1;
		//dsetcookie($_GET['lottery'], NULL);
	}else{
		exit(json_encode(array('result'=>0,'msg'=>_iconv(lang('plugin/mogu_lottery','QualifyAgain'),'utf-8'))));
	}
}
if($activity['subscribe'] && !$lottery){
	$wechat = _getopenid();
	$openid = $wechat[0];
	if(!$openid){
		exit(json_encode(array('result'=>-1,'url'=>$_G['cache']['plugin']['mogu_lottery']['wechat_qrcode'])));
	}
}
$mark = daddslashes(getcookie('marks'));
if(!$_G['uid'] && !$mark && !$openid){
	exit(json_encode(array('result'=>0, 'msg'=>_iconv(lang('plugin/mogu_lottery','PleaseLogin'),'utf-8'))));
}
if(!$activity['status']){
	exit(json_encode(array('result'=>0,'msg'=>_iconv(lang('plugin/mogu_lottery','htisActOff'),'utf-8'))));
}
if($activity['time'][0] && (strtotime($activity['time'][0]) > $_G['timestamp'])){
	exit(json_encode(array('result'=>0,'msg'=>_iconv(lang('plugin/mogu_lottery','ActNoStart',array('x1'=>$activity['time'][0],'x2'=>$activity['time'][1])),'utf-8'))));
}
if($activity['time'][1] && (strtotime ("+1 day", strtotime($activity['time'][1])) < $_G['timestamp'])){
	exit(json_encode(array('result'=>0,'msg'=>_iconv(lang('plugin/mogu_lottery','ActNoEnd',array('x'=>$activity['time'][1])),'utf-8'))));
}
if (($activity['period'][0] && $activity['period'][1]) && (date('H') < $activity['period'][0] || date('H') >= $activity['period'][1])) { //时段
	exit(json_encode(array('result'=>0,'msg'=>_iconv(lang('plugin/mogu_lottery', 'PeriodError', array('x0' => $activity['period'][0],'x1' => $activity['period'][1])),'utf-8'))));
}
if (!empty($activity['group']) && !in_array($_G['groupid'], $activity['group']) && !$lottery) {
    if (!$_G['uid']) {
        exit(json_encode(array('result'=>0,'msg'=>_iconv(lang('plugin/mogu_lottery','PleaseLogin'),'utf-8'))));
    }
	exit(json_encode(array('result'=>0,'msg'=>_iconv(lang('plugin/mogu_lottery','GroupNotAllowed'),'utf-8'))));
}
if($activity['credit'][0] && $activity['credit'][1] && !$lottery){
	if (!$_G['uid']) {
        exit(json_encode(array('result'=>0,'msg'=>_iconv(lang('plugin/mogu_lottery','PleaseLogin'),'utf-8'))));
    }
	$credit['d'] = substr($activity['credit'][0], 0, 1);
	if($credit['d'] == '-' && is_numeric($activity['credit'][1])){
		$space = getuserbyuid($_G['uid']);
		space_merge($space, 'count');
		$credit['title'] = $_G['setting']['extcredits'][$activity['credit'][1]]['title'];
		$space['credits'] = $space['extcredits' . $activity['credit'][1]]; 
		$credit['c'] = ($credit['d'] == '+' || $credit['d'] == '-') ? abs($activity['credit'][0]) : 0;
		if($space['credits'] < $credit['c']) {
			exit(json_encode(array('result'=>0,'msg'=>_iconv(lang('plugin/mogu_lottery','CreditNotenough',array('x'=>$credit['title'],'n'=>$credit['c'] - $space['credits'])),'utf-8'))));
		}
	}
}

$fromarr[] = DB::table('mogu_lottery_user');
$wherearr = array();
$condition = array('uid' => $_G['uid'], 'mark' => $mark, 'openid' => $openid);
foreach($condition as $k => $val){
	$val && $wherearr[] = DB::field($k, $val);
}
$user = C::t('#mogu_lottery#mogu_lottery_user')->fetch_or_search($wherearr, $fromarr);
if(!$user){
	$user = array('uid'=>$_G['uid'],'mark'=>$mark,'openid'=>$openid,'ip'=>$_G['clientip'],'nickname'=>'');
	$user['yid'] = C::t('#mogu_lottery#mogu_lottery_user')->insert($user,true);
}

if(!empty($activity['giving'][1]) && !$lottery){
	$hasuse = C::t('#mogu_lottery#mogu_lottery_hasuse')->fetch_by_yid($user['yid'], $actid);
    !$hasuse && $hasuse = array('yid' => $user['yid'], 'actid' => $actid, 'hasuse' => 0, 'lasttime' => $_G['timestamp']);
	switch ($activity['giving'][0]) {
		case 'hours':$strto = strtotime(date('Y-m-d H:0:0', $_G['timestamp']));$tip = date('H:i', $strto+3600);break;
		case 'day':$strto = strtotime(date('Y-m-d', $_G['timestamp']));$tip = lang('plugin/mogu_lottery','next_day');break;
		case 'week':$strto = strtotime('last monday');$tip = lang('plugin/mogu_lottery','next_week');break;
		case 'month':$strto = strtotime(date('Y-m-1', $_G['timestamp']));$tip = lang('plugin/mogu_lottery','next_month');break;
		default:$strto = 0;$tip = lang('plugin/mogu_lottery','after');break;
	}
	if($hasuse['lasttime'] >= $strto && $hasuse['hasuse'] >= $activity['giving'][1]){
		exit(json_encode(array('result'=>0,'msg'=>_iconv(lang('plugin/mogu_lottery','ChanceOut',array('x'=>$tip)),'utf-8'))));
	}elseif($hasuse['lasttime'] < $strto){
		$hasuse['hasuse'] = 0;
	}
}

$winning = $activity['winning'];
foreach($winning as $k => $val){
	if(!empty($val['prize'])){
		$prizeid[] = $val['prize'];
	}
	$randarr[$k] = $val['chance'];
}
$prizeall = C::t('#mogu_lottery#mogu_lottery_goods')->fetch_all($prizeid);

if($_GET['act'] == 'set'){
	$n = intval($_GET['result']);
	if($lottery){
		dsetcookie($_GET['lottery'], NULL);
	}else{
		$hasuse['hasuse'] += 1;
	    $hasuse['lasttime'] = $_G['timestamp'];
		if($hasuse['hid']){
			C::t('#mogu_lottery#mogu_lottery_hasuse')->update($hasuse['hid'], $hasuse);
		}else{
			C::t('#mogu_lottery#mogu_lottery_hasuse')->insert($hasuse);
		}
		if($credit['d'] && !empty($activity['credit'][1])){
			updatecreditbyaction($credit['d'], $_G['uid'], array('extcredits' . $activity['credit'][1] => $activity['credit'][0]));
		}
	}
	
	if(!empty($winning[$n-1]['prize'])){
		$push = $winning[$n-1]['push'] ? 1 : 0;
		$pid = $winning[$n-1]['prize'];
		if($prizeall[$pid]['type'] == 'credit' && $_G['uid']){
			$prizeall[$pid]['conditions'] = unserialize($prizeall[$pid]['conditions']);
		    updatecreditbyaction('+', $_G['uid'],array('extcredits' . $prizeall[$pid]['conditions']['credit'][0] => +$prizeall[$pid]['conditions']['credit'][1]));
		    $status = 1;
	    }
		C::t('#mogu_lottery#mogu_lottery_stats')->insert(array('actid'=>$actid,'yid'=>$user['yid'],'pid'=>$pid,'push'=>$push,'dateline'=>$_G['timestamp'],'statu'=>$status));
		C::t('#mogu_lottery#mogu_lottery_goods')->update($pid,array('inventory' => $prizeall[$pid]['inventory']-1));
		notification_add($_G['uid'], 'system',lang('plugin/mogu_lottery', 'gm_audit_content',array('x'=>$prizeall[$pid]['name'])), array(),1);	
	}
	exit(json_encode(array('result'=>1,'msg'=>'')));
}

foreach($winning as $k => $val){
	if(!empty($val['prize'])){
	    if($prizeall[$val['prize']]['inventory'] < 1 && $prizeall[$val['prize']]['inventory']!='-1'){
	        unset($randarr[$k]);
	    }
	}
}
$uni = array_sum($randarr);
$res = rand(1,$uni);
$as = $n = $status = 0;
foreach($randarr as $k => $val){            
    if($res <= $val+$as){
        $n = $k+1; break;
	}
	$as += $val;
}
	
if(!empty($n)){
	$tip = $winning[$n-1]['prompt'];
    exit(json_encode(array('result'=>$n,'jackpot'=>$pid,'msg'=>_iconv($tip,'utf-8'))));
}else{
	exit(json_encode(array('result'=>0,'msg'=>_iconv(lang('plugin/mogu_lottery','StockNot'),'utf-8'))));
}
?>