<?php
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

$_GET['mods'] != 'delete' && cpheader();
echo '<script type="text/javascript">var disallowfloat = "'.$_G['setting']['disallowfloat'].'",CSSPATH = "'.$_G['setting']['csspath'].'";</script>
      <script type="text/javascript" src="static/js/calendar.js"></script>';
	  
$basicurl = 'plugins&operation=config&do='.$_G['gp_do'].'&identifier=mogu_lottery&pmod='.$_GET['pmod'];
$_GET['mods'] = in_array($_GET['mods'], array('list', 'edit', 'new')) ? $_GET['mods'] : 'list';
$formurl = $basicurl.'&mods='.$_GET['mods'];

require (DISCUZ_ROOT."/source/plugin/mogu_lottery/function/function_admin.php");
require_once libfile('function/home');

if($_GET['mods'] == 'list'){
	if(!submitcheck('submit')) {
		
		showformheader($formurl.'&mod='.$_GET['mod'].'&actid='.$actid.'&act='.$_GET['mods'],'enctype');
		showtableheader('');
		showsubtitle(array(cplang('delete'),lang('plugin/mogu_lottery','GoodsName'),lang('plugin/mogu_lottery','GoodsPic'),lang('plugin/mogu_lottery','Inventory'),lang('plugin/mogu_lottery','GoodsType'),cplang('operation')));
		foreach(C::t('#mogu_lottery#mogu_lottery_goods')->fetch_all_by_search() as $val){
			showtablerow('', array(), array('<input name="delete[]" type="checkbox" value="'.$val['pid'].'" />','<input name="name['.$val['pid'].']" value="'.$val['name'].'" type="text" class="txt"/>','<img src="'.pic_get($val['pic'], 'common', 0, 0).'" height="36"/>','<input name="inventory['.$val['pid'].']" value="'.$val['inventory'].'" type="text" style="width:60px;" />',lang('plugin/mogu_lottery',$val['type']),'<a href="'.ADMINSCRIPT.'?action='.$basicurl.'&mods=edit&pids='.$val['pid'].'&formhash='.FORMHASH.'">'.cplang('edit').'</a>'));
		}
		showsubmit('submit', 'submit', '', '<a href="'.ADMINSCRIPT.'?action='.$formurl.'&mods=edit&formhash='.FORMHASH.'" class="btn h">'.lang('plugin/mogu_lottery','AddGoods').'</a>');
		showtablefooter();
		showformfooter();
	}else{
		$delete = !empty($_GET['delete']) && is_array($_GET['delete']) ? daddslashes($_GET['delete']) : array();
		foreach($delete as $val) {
			$goods = C::t('#mogu_lottery#mogu_lottery_goods')->fetch(intval($val));
			@unlink($_G['setting']['attachdir'].'common/'.$goods['pic']);
			C::t('#mogu_lottery#mogu_lottery_goods')->delete($val);
		}
		foreach($_GET['name'] as $k => $val){
			C::t('#mogu_lottery#mogu_lottery_goods')->update(intval($k), array('name'=>daddslashes($val),'inventory'=>daddslashes($_GET['inventory'][$k])));
		}
		cpmsg('setting_update_succeed', dreferer(), 'succeed');
	}

}elseif($_GET['mods'] == 'new'){
}elseif($_GET['mods'] == 'edit'){
	$pid = intval($_GET['pids']);
	$goods = C::t('#mogu_lottery#mogu_lottery_goods')->fetch($pid);
	if(!submitcheck('submit')) {
		showsubmenuloca(lang('plugin/mogu_lottery','CurrLoca'),array(
			array(lang('plugin/mogu_lottery','GoodsList'), ADMINSCRIPT.'?action='.$basicurl.'&mods=list'),
			array(lang('plugin/mogu_lottery','EditGoods'))
		));
		showformheader($formurl.'&mods='.$_GET['mods'].'&actid='.$actid.'&act='.$_GET['mods'].'&pids='.$pid,'enctype');
		showtableheader('');
		showsetting(lang('plugin/mogu_lottery','GoodsName'), 'name', $goods['name'], 'text','','','','required="required"');
		showsetting(lang('plugin/mogu_lottery','GoodsPic'), 'pic', $goods['pic'], 'filetext','','',lang('plugin/mogu_lottery','GoodsPic_desc'));
		showsetting(lang('plugin/mogu_lottery','Inventory'), 'inventory', $goods['inventory'], 'number');
		$credittypelist = array(
			array('physical',lang('plugin/mogu_lottery','physical'),array('credit'=>'none','custom'=>'none')),
			array('credit',lang('plugin/mogu_lottery','credit'),array('credit'=>'','custom'=>'none')),
			array('custom',lang('plugin/mogu_lottery','custom'),array('credit'=>'none','custom'=>'')));
		showsetting(lang('plugin/mogu_lottery','GoodsType'), array('type', $credittypelist),$goods['type'], 'mradio');
		$goods['conditions'] = unserialize($goods['conditions']);
		
		showtagheader('tbody', 'credit', $goods['type']=='credit', 'sub');
		foreach ($_G['setting']['extcredits'] as $k => $c) {
			if($c['title']){
			   $option .= '<option value="'.$k.'" '.($goods['conditions']['credit'][0] == $k ? 'selected':'').'>'.$c['title'].'</option>';
			}
		}
		$credithtml = '<select name="conditions[credit][]" style="width:100px;">'.$option.'</select> '.lang('plugin/mogu_lottery','RewardNum').' <input name="conditions[credit][]" type="text" style="width:65px;" value="'.$goods['conditions']['credit'][1].'"/>';
		showsetting(lang('plugin/mogu_lottery','IntegralReward'), '', '', $credithtml);
		showtagfooter('tbody');
		
		showtagheader('tbody', 'custom', $goods['type']=='custom', 'sub');
		showsetting(lang('plugin/mogu_lottery','Conditions'), 'conditions[custom]', $goods['conditions']['custom'], 'textarea');
		showtagfooter('tbody');
		
		showsetting(lang('plugin/mogu_lottery','GoodsIntroduce'), 'introduce', $goods['introduce'], 'textarea');
		showsubmit('submit', 'submit');
		showtablefooter();
		showformfooter();
	}else{
		if(!empty($_FILES['pic']['tmp_name'])){
			$ups = upload($_FILES['pic'], 'common', random(3, 1), random(8));
			$_GET['pic'] = $ups['attachment']; 
			$goods['pic'] && unlink($_G['setting']['attachdir'].$goods['pic']);
		}
		$data = array(
			'actid' => $actid,
			'name' => daddslashes($_GET['name']),
			'pic' => daddslashes($_GET['pic']),
			'inventory' => intval($_GET['inventory']),
			'type' => daddslashes($_GET['type']),
			'introduce' => daddslashes($_GET['introduce']),
			'conditions' => serialize($_GET['conditions'])
		);
		if($pid){
			C::t('#mogu_lottery#mogu_lottery_goods')->update($pid,$data);
			cpmsg('setting_update_succeed' , dreferer(), 'succeed');
		}else{
			C::t('#mogu_lottery#mogu_lottery_goods')->insert($data);
			cpmsg('setting_update_succeed' , 'action='.$basicurl.'&mods=list', 'succeed');
		}
	}
}
?>