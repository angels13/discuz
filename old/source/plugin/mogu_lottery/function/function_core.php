<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/*选择模板*/
function _detect($template = 'default', $file='', $actid='') {
	global $_G;
	$m = checkmobile() && $_GET['mobile']!='no' ? '/touch' : '';
    $templatepath = DISCUZ_ROOT.'./source/plugin/mogu_lottery/template';                      //模板文件目录
	$templatedir = file_exists($templatepath.'/'.$template.$m.'/'.$file.'.htm') ? $template.$m : 'default'.$m;
	$dir = !empty($actid) ? $templatedir.'/'.$file.':'.$actid : $templatedir.'/'.$file ;
	return $dir;
}

/*自适应编码*/
function _iconv($text, $out_charset = CHARSET, $iconv='') {
	$iconv = $iconv ? strtolower($iconv) : strtolower(CHARSET) ;
    return strtolower($out_charset) != $iconv ? eval('return ' . iconv($iconv, strtolower($out_charset), var_export($text, true) . ';')) : $text;
}

/*活动信息*/
function _activity($actid){
	global $_G;

	$activity = C::t('#mogu_lottery#mogu_lottery_activity')->fetch($actid);
	$unserialize_arr = array('time','group','giving','credit','period','winning');  //需要反序列化的字段
	foreach($unserialize_arr as $item){
		$activity[$item] = unserialize($activity[$item]);
	}
	/*导航*/
	$navitem = explode("\n",trim($activity['navitem']));
	$activity['navitem'] = array();
	foreach ($navitem as $k => $nav) {
		$nav = preg_replace("/{actid}/e", $actid, $nav, -1);
		$url = explode("|",trim($nav));
		parse_str($url[1],$item);
		list($identifier, $mods) = explode(':', $item['plugin_php?id']);
		if($url[0]){
			$activity['navitem'][] =  array_merge($item,array('name'=>$url[0],'url'=>$url[1],'img'=>$url[2],'module'=>$mods));
		}
	}
	return $activity;
}

/*获取OPENID*/
function _getopenid() {
	global $_G;
	$wechatinfo = array();
    $setting = $_G['cache']['plugin']['mogu_lottery'];
	if($_GET['key']){
		$wechat = authcode(base64_decode($_GET['key']), 'DECODE', $_G['config']['security']['authkey']);
		if($wechat){
			dsetcookie('wechatinfo', authcode($wechat, 'ENCODE', $_G['config']['security']['authkey']));
			unset($_GET['key']);
			dheader('location: '.$_G['siteurl'].'plugin.php?'.urldecode(http_build_query($_GET)));
		}
	}
	if(!empty($_G['cookie']['wechatinfo'])) {
		$wechatinfo = explode('|',authcode($_G['cookie']['wechatinfo'], 'DECODE', $_G['config']['security']['authkey']));
	}
	if(!$wechatinfo && $setting['wechat_appId'] && $setting['wechat_appsecret'] && strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
		require_once DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php';
		$wechat_client = new WeChatClient($setting['wechat_appId'], $setting['wechat_appsecret']);
		if(empty($_GET['oauth'])) {
			$redirect_uri = $wechat_client->getOauthConnectUri($_G['siteurl'].'plugin.php?'.http_build_query($_GET).'&oauth=yes');
			dheader('location: '.$redirect_uri);
		} else {
			$tocken = $wechat_client->getAccessTokenByCode($_GET['code']);
			$wxinfo = $wechat_client->getUserInfoById($tocken['openid'],'zh_CN');
			$wechatinfo = array($tocken['openid'], $wxinfo['subscribe']);
			dsetcookie('wechatinfo', authcode($tocken['openid'].'|'.$wxinfo['subscribe'], 'ENCODE', $_G['config']['security']['authkey']), 86400);
		}
	}
	return $wechatinfo;
}

?>