<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

function _showsubmenu($title, $menus = array(), $right = '', $replace = array()) {
	if(empty($menus)) {
		$s = '<div class="itemtitle">'.$right.'<h4>'.cplang($title, $replace).'</h4></div>';
	} elseif(is_array($menus)) {
		$s = '<div class="itemtitle">'.$right.'<h4>'.cplang($title, $replace).'</h4><ul class="tab1">';
		foreach($menus as $k => $menu) {
			if(is_array($menu[0])) {
				$s .= '<li id="addjs'.$k.'" class="'.($menu[1] ? 'current' : 'hasdropmenu').'" onmouseover="dropmenu(this);"><a href="#"><span>'.cplang($menu[0]['menu']).'<em>&nbsp;&nbsp;</em></span></a><div id="addjs'.$k.'child" class="dropmenu" style="display:none;">';
				if(is_array($menu[0]['submenu'])) {
					foreach($menu[0]['submenu'] as $submenu) {
						$s .= $submenu[1] ? '<a href="'.ADMINSCRIPT.'?action='.$submenu[1].'" class="'.($submenu[2] ? 'current' : '').'" onclick="'.$submenu[3].'">'.cplang($submenu[0]).'</a>' : '<a><b>'.cplang($submenu[0]).'</b></a>';
					}
				}
				$s .= '</div></li>';
			} else {
				$s .= '<li'.($menu[2] ? ' class="current"' : '').'><a href="'.(!$menu[4] ? ADMINSCRIPT.'?action='.$menu[1] : $menu[1]).'"'.(!empty($menu[3]) ? ' target="_blank"' : '').'><span>'.cplang($menu[0]).'</span></a></li>';
			}
		}
		$s .= '</ul></div>';
	}
	echo $s;
}
	
function showsubmenuloca($title, $menus = array()) {
		$s = '<ul class="stepstat itemtitle" style="margin-bottom:5px !important;">'.($title ? '<li>'.cplang($title).': </li>' : '');
		
		if(is_array($menus)) {
				$i = 0;
			foreach($menus as $menu) {
				$i++;
				if($menu[1]){
					$s .= '<li>-> <a href="'.$menu[1].'" style="color: #CCC;">'.cplang($menu[0]).'</a></li>';
				}else{
					$s .= '<li class="current"><span style="color: #CCC;">-> </span>'.cplang($menu[0]).'</li>';
				}
			}
		}
		$s .= '</ul>';
		echo $s;
	
}

function _GetTemplate($dir, $m='') {
	$template = array();
    $dirs = opendir($dir);
	require_once libfile('class/xml');
    while (($file = readdir($dirs)) !== false) {
        if ($file != '.' && $file != '..') {
            $cur_path = $dir . DIRECTORY_SEPARATOR . $file;
			$importfile = $dir.'/'.$file.'/config.xml';
            if (is_dir($cur_path) && file_exists($importfile)) {
			    $importtxt = implode('', file($importfile));
	            $stylearray = xml2array($importtxt);
				$stylearray = $stylearray['Data'];
                if ($stylearray['name']) {
					if ($m){
						if (is_dir($cur_path.'/touch')) {
						    $template[$file] = $stylearray;
                            $template[$file]['directory'] = $file;
							if(is_file($cur_path.'/touch/index.htm')){
								$template[$file]['index'] = 1;
							}
						}
					}elseif(is_file($cur_path.'/home.htm')){
                        $template[$file] = $stylearray;
                        $template[$file]['directory'] = $file;
						if(is_file($cur_path.'/index.htm')){
							$template[$file]['index'] = 1;
						}
					}
                }
            }
        }
    }
    closedir($dirs);
    return $template ? _iconv($template, CHARSET, 'gbk') : false;
}

function upload($file, $type='', $act='', $extid='') {
	$upload = new discuz_upload();
	if(!$upload->init($file, $type, $act, $extid) || !$upload->save()) {
		if(!defined('IN_ADMINCP')) {
			    showmessage($upload->errormessage());
		    } else {
			    cpmsg($upload->errormessage(), '', 'error');
		    }
	}
	return $upload->attach;
}

function showscript($actid='',$grid=''){
	$item = '<option value="0">'.lang('plugin/mogu_lottery','NoPrize').'</option>';
	foreach(C::t('#mogu_lottery#mogu_lottery_goods')->fetch_all_by_search() as $val){
		$item .= '<option value="'.$val['pid'].'">'.$val['name'].'</option>';
	}
	$prize = '<select name="prize[]">'.$item.'</select>';
	echo '
	<script type="text/JavaScript">
	    var grid = '.$grid.';
		var forumselect = \'\';
		var rowtypedata = [
			[[1, \'New\'], [1, \''.$prize.'\'],[1, \'<input name="chance[]" type="text" style="width:50px;" /> %\'],[1, \'\'],[1, \'<input name="prompt[]" type="text" />\'], [5, \'<div><a href="javascript:;" onClick="deleterow(this)">'.cplang('delete').'</a></div>\']],
		];
	</script>
	';

}

function _editor(){
    echo '<script type="text/javascript" src="static/image/editor/editor_function.js"></script>
	<script type="text/JavaScript">
	function validate(obj) {  
		edit_save();
		window.onbeforeunload = null;  
		obj.form.submit();  
		return false;  
	}
	</script>';
}
?>