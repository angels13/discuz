<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_darwbcomment_forum {

	function viewthread_bottom_output() {
		global $_G, $page;
		if($page!=1) return;
		$config = $_G['cache']['plugin']['darwbcomment'];
		$this->forums = (array)unserialize($config['forums']);
		$this->language = $config['language'];
		$this->appkey = trim($config['appkey']);
		$this->fontsize = $config['fontsize'];
		$this->brandline = $config['brandline'];
		$this->border = $config['border'];
		$this->width = intval($config['width']);
		$this->skin = $config['skin'];
		$this->delayload = $config['delayload'];
		$this->fposition = $config['fposition'];

		if(!in_array($_G['fid'], $this->forums)) return;
		$this->apiurl = "http://widget.weibo.com/distribution/comments.php?width={$this->width}&fontsize={$this->fontsize}&skin={$this->skin}&iframskin={$this->skin}&language={$this->language}&dpc=1";
		if($this->border) $this->apiurl .= "&border=1";
		if($this->brandline) $this->apiurl .= "&brandline=y";
		if(!empty($this->appkey)) $this->apiurl .= "&appkey={$this->appkey}";

		include template('darwbcomment:forum');
		return($return);
	}

	function viewthread_postbottom() {
		$result[] = "<span id='darwbcomment_postbottom' style='visibility:hidden'></span>";
		return($result);
	}

	function viewthread_useraction() {
		$result = "<span id='darwbcomment_useraction' style='visibility:hidden'></span>";
		return($result);
	}

	function index_bottom_output() {
		global $_G;
		$config = $_G['cache']['plugin']['darwbcomment'];
		$this->language = $config['language'];
		$this->appkey = trim($config['appkey']);
		$this->fontsize = $config['fontsize'];
		$this->brandline = $config['brandline'];
		$this->border = $config['border'];
		$this->width = intval($config['width']);
		$this->skin = $config['skin'];
		$this->delayload = $config['delayload'];
		$this->fiposition = $config['fiposition'];

		if(empty($this->fiposition)) return;
		$this->apiurl = "http://widget.weibo.com/distribution/comments.php?width={$this->width}&fontsize={$this->fontsize}&skin={$this->skin}&iframskin={$this->skin}&language={$this->language}&dpc=1";
		if($this->border) $this->apiurl .= "&border=1";
		if($this->brandline) $this->apiurl .= "&brandline=y";
		if(!empty($this->appkey)) $this->apiurl .= "&appkey={$this->appkey}";

		include template('darwbcomment:findex');
		return($return);
	}
	
}


class plugin_darwbcomment_portal {

	function view_article_side_top_output() {
		global $_G, $article;
		$config = $_G['cache']['plugin']['darwbcomment'];
		$this->language = $config['language'];
		$this->appkey = trim($config['appkey']);
		$this->fontsize = $config['fontsize'];
		$this->brandline = $config['brandline'];
		$this->border = $config['border'];
		$this->width = intval($config['width']);
		$this->skin = $config['skin'];
		$this->delayload = $config['delayload'];
		$this->aposition = $config['aposition'];
		$this->url = $_G['siteurl'].'portal.php?mod=view&aid='.$article['aid'];

		if(empty($this->aposition)) return;
		$this->apiurl = "http://widget.weibo.com/distribution/comments.php?width={$this->width}&fontsize={$this->fontsize}&skin={$this->skin}&iframskin={$this->skin}&language={$this->language}&dpc=1";
		if($this->border) $this->apiurl .= "&border=1";
		if($this->brandline) $this->apiurl .= "&brandline=y";
		if(!empty($this->appkey)) $this->apiurl .= "&appkey={$this->appkey}";

		include template('darwbcomment:portal');
		return($return);
	}
	
}

?>
