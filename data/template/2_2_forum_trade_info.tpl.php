<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('trade_info');?><?php include template('common/header'); if($postlist[$post['pid']]['invisible'] != 0) { ?>
<div class="trdb">����Ʒ�ѱ�ɾ��</div><?php include template('common/footer'); exit;?><?php } if(!$_G['inajax']) { ?>

<script src="<?php echo $_G['setting']['jspath'];?>forum_viewthread.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="��ҳ"><?php echo $_G['setting']['bbname'];?></a><?php echo $navigation;?> <em>&rsaquo;</em> <?php if($_GET['from']=='home') { ?><a href="home.php?mod=space&amp;do=trade">��Ʒ</a> <em>&rsaquo;</em><?php } ?> <a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>">�鿴����</a>
</div>
</div>

<?php if($_G['forum']['ismoderator']) { ?>
<script type="text/javascript">var fid = parseInt('<?php echo $_G['fid'];?>'), tid = parseInt('<?php echo $_G['tid'];?>');</script>
<script src="<?php echo $_G['setting']['jspath'];?>forum_moderate.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<form method="post" autocomplete="off" name="modactions" id="modactions">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="optgroup" />
<input type="hidden" name="operation" />
<input type="hidden" name="listextra" value="" />
</form>
<?php } ?>

<div id="ct" class="wp ct2 cl">
<div class="mn">
<div class="bm bw0">

<div class="ih cl bbda">
<div class="icn avt"><a href="home.php?mod=space&amp;uid=<?php echo $trade['sellerid'];?>"><?php echo avatar($trade[sellerid],small);?></a></div>
<dl>
<dt class="ptn">
<span class="y">
<a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?php echo $post['authorid'];?>&amp;touid=<?php echo $post['authorid'];?>&amp;pmid=0&amp;daterange=2" onclick="showWindow('sendpm', this.href)" style="font-weight: 200"><img src="<?php echo IMGDIR;?>/pmto.gif" style="vertical-align:middle" />������Ϣ</a>&nbsp;
<?php if($post['qq']) { ?>&nbsp;<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $post['qq'];?>&amp;site=<?php echo $_G['setting']['bbname'];?>&amp;menu=yes&amp;from=discuz" target="_blank" title="QQ"><img src="<?php echo IMGDIR;?>/qq.gif" alt="QQ" style="vertical-align:middle" /></a><?php } if($post['icq']) { ?>&nbsp;<a href="http://wwp.icq.com/scripts/search.dll?to=<?php echo $post['icq'];?>" target="_blank" title="ICQ"><img src="<?php echo IMGDIR;?>/icq.gif" alt="ICQ" style="vertical-align:middle" /></a><?php } if($post['yahoo']) { ?>&nbsp;<a href="http://edit.yahoo.com/config/send_webmesg?.target=<?php echo $post['yahoo'];?>&amp;.src=pg" target="_blank" title="Yahoo"><img src="<?php echo IMGDIR;?>/yahoo.gif" alt="Yahoo!" style="vertical-align:middle" /></a><?php } if($post['taobao']) { ?>&nbsp;<a href="javascript:;" onclick="window.open('http://amos.im.alisoft.com/msg.aw?v=2&uid='+encodeURIComponent('<?php echo $post['taobaoas'];?>')+'&site=cntaobao&s=2&charset=utf-8')" title="��������"><img src="<?php echo IMGDIR;?>/taobao.gif" alt="��������" style="vertical-align:middle" /></a><?php } ?>
</span>
<?php echo $trade['seller'];?>
<?php if($_G['setting']['verify']['enabled']) { if(is_array($_G['setting']['verify'])) foreach($_G['setting']['verify'] as $vid => $verify) { if($verify['available'] && $post['verify'.$vid] == 1) { ?>
<a href="home.php?mod=spacecp&amp;ac=profile&amp;op=verify&amp;vid=<?php echo $vid;?>" target="_blank"><?php if($verify['icon']) { ?><img src="<?php echo $verify['icon'];?>" class="vm" alt="<?php echo $verify['title'];?>" title="<?php echo $verify['title'];?>" /><?php } else { ?><?php echo $verify['title'];?><?php } ?></a>&nbsp;
<?php } } } if($online) { ?> <img class="vm" title="����" alt="online" src="<?php echo IMGDIR;?>/ol.gif"><?php } ?>
</dt>
<dd class="mtn"><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?><?php if($_GET['from']) { ?>&amp;from=<?php echo $_GET['from'];?><?php } ?>"><?php echo $_G['forum_thread']['subject'];?></a> <em>&rsaquo;</em> �鿴��Ʒ</dd>
</dl>
</div>
<?php if($_G['inajax']) { ?><span class="y"><a href="javascript:;" onclick="$('tradeinfo<?php echo $trade['pid'];?>').style.display = 'none';display('trade<?php echo $trade['pid'];?>');" title="����"><img src="<?php echo STATICURL;?>image/common/collapsed_no.gif" alt="" class="vm" /> ����</a></span><?php } ?>
<h1 class="ph mtm"><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;do=tradeinfo&amp;pid=<?php echo $post['pid'];?><?php if(!empty($_GET['modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_GET['modthreadkey'];?><?php } ?>" target="_blank"><?php echo $trade['subject'];?></a></h1>
<?php } ?>


<div class="bbda ptm act cl"<?php if($_G['inajax']) { ?> style="border:0"<?php } ?>>
<div class="cl">
<div class="spvimg">
<?php if($trade['displayorder'] > 0) { ?><em class="hot">�Ƽ���Ʒ</em><?php } if($trade['thumb']) { ?>
<a href="javascript:;"><img src="<?php echo $trade['thumb'];?>" onclick="zoom(this, '<?php echo $trade['attachurl'];?>')" width="<?php if($trade['width'] > 300) { ?>300<?php } else { ?><?php echo $trade['width'];?><?php } ?>" _width="300" _height="300" alt="<?php echo $trade['subject'];?>" /></a>
<?php } else { ?>
<img src="<?php echo IMGDIR;?>/nophoto.gif" alt="<?php echo $trade['subject'];?>" />
<?php } if(!$_G['forum_thread']['is_archived']) { if((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] < $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && $post['authorid'] == $_G['uid'])) && !$post['first'] || $_G['forum']['ismoderator'] && $_G['group']['allowdelpost']) { ?>
<p class="ptm pbm">
<?php if($_G['forum']['ismoderator'] && $_G['group']['allowdelpost']) { ?><span class="y"><a href="javascript:;" onclick="modaction('delpost', <?php echo $_GET['pid'];?>)">ɾ��</a>&nbsp;&nbsp;<?php } if($_G['forum']['picstyle'] && ($_G['forum']['ismoderator'] || ($_G['uid'] == $_G['thread']['authorid'] && $_G['forum_thread']['closed'] == 0))) { ?><a onclick="showWindow('setcover_<?php echo $trade['aid'];?>',this.href)" href="forum.php?mod=ajax&amp;action=setthreadcover&amp;aid=<?php echo $trade['aid'];?>&amp;fid=<?php echo $_G['fid'];?>">��Ϊ����</a>&nbsp;&nbsp;<?php } ?></span>
<a class="editp xi1 xw1" style="padding-left: 20px; " href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if(!empty($_GET['modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_GET['modthreadkey'];?><?php } ?>&amp;page=<?php echo $page;?>">�༭��Ʒ</a>
</p>
<?php } } ?>
</div>

<div class="spi cl">
<?php if($_G['inajax']) { ?>
<span class="y"><a href="javascript:;" onclick="$('tradeinfo<?php echo $trade['pid'];?>').style.display = 'none';display('trade<?php echo $trade['pid'];?>');" title="����"><img src="<?php echo STATICURL;?>image/common/collapsed_no.gif" alt="" class="vm" /> ����</a></span>
<h4 class="wx mbm bbda"><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;do=tradeinfo&amp;pid=<?php echo $post['pid'];?><?php if(!empty($_GET['modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_GET['modthreadkey'];?><?php } ?>" target="_blank"><?php echo $trade['subject'];?></a></h4>
<?php } ?>
<dl>
<dt>��Ʒ����:</dt>
<dd>
<?php if($trade['quality'] == 1) { ?>ȫ��<?php } if($trade['quality'] == 2) { ?>����<?php } ?>
��Ʒ
</dd>
<dt>�˷�:</dt>
<dd>
<?php if($trade['transport'] == 0) { ?>���½���<?php } if($trade['transport'] == 1) { ?>���ҳе��˷�<?php } if($trade['transport'] == 2 || $trade['transport'] == 4) { if($trade['transport'] == 4) { ?>����յ������ֱ��֧����������˾<?php } if(!empty($trade['ordinaryfee']) || !empty($trade['expressfee']) || !empty($trade['emsfee'])) { if(!empty($trade['ordinaryfee'])) { ?>ƽ�� <?php echo $trade['ordinaryfee'];?> Ԫ<?php } if(!empty($trade['expressfee'])) { ?> ��� <?php echo $trade['expressfee'];?> Ԫ<?php } if(!empty($trade['emsfee'])) { ?> EMS <?php echo $trade['emsfee'];?> Ԫ<?php } } elseif($trade['transport'] == 2) { ?>
���˷�
<?php } } if($trade['transport'] == 3) { ?>������Ʒ<?php } ?>
</dd>
<dt>ʣ��ʱ��:</dt>
<dd>
<?php if($trade['closed']) { ?>
<em>�ɽ�����</em>
<?php } elseif($trade['expiration'] > 0) { ?>
<?php echo $trade['expiration'];?> �� <?php echo $trade['expirationhour'];?> Сʱ
<?php } elseif($trade['expiration'] == 0) { ?>
<?php echo $trade['expirationhour'];?> Сʱ
<?php } elseif($trade['expiration'] == -1) { ?>
<em>�ɽ�����</em>
<?php } else { ?>
&nbsp;
<?php } ?>
</dd>
<dt>��Ʒ����:</dt><dd><?php echo $trade['amount'];?></dd>
<?php if($trade['locus']) { ?><dt>�ص�:</dt><dd><?php echo $trade['locus'];?></dd><?php } ?>
<dt>�ۼ��۳�:</dt><dd><?php echo $trade['totalitems'];?></dd>
</dl>
<dl class="nums">
<dt>�ּ�:</dt>
<dd>
<?php if($trade['price'] > 0) { ?>
<p><em><?php echo $trade['price'];?></em>&nbsp;Ԫ</p>
<?php } if($_G['setting']['creditstransextra']['5'] != -1 && $trade['credit']) { ?>
<p><?php if($trade['price'] > 0) { ?>���� <?php } ?><em><?php echo $trade['credit'];?></em>&nbsp;<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['5']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['5']]['title'];?></p>
<?php } ?>
</dd>
</dl>
<dl>
<?php if($trade['price'] && $trade['costprice'] > 0 || $_G['setting']['creditstransextra']['5'] != -1 && $trade['credit'] && $trade['costcredit'] > 0) { ?>
<dt>ԭ��:</dt>
<dd class="xg1">
<?php if($trade['costprice'] > 0) { ?>
<del><?php echo $trade['costprice'];?> Ԫ</del><br />
<?php } if($_G['setting']['creditstransextra']['5'] != -1 && $trade['costcredit'] > 0) { ?>
<del><?php if($trade['costprice'] > 0) { ?>���� <?php } ?><?php echo $trade['costcredit'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['5']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['5']]['title'];?></del>
<?php } ?>
</dd>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_tradeinfo_extra'])) echo $_G['setting']['pluginhooks']['viewthread_tradeinfo_extra'];?>
</dl>

<?php if($post['authorid'] != $_G['uid'] && empty($thread['closed']) && $trade['expiration'] > -1) { ?>
<p class="pns mbm">
<?php if($trade['amount']) { ?>
<button onclick="<?php if($_G['uid']) { ?>window.open('forum.php?mod=trade&tid=<?php echo $post['tid'];?>&pid=<?php echo $post['pid'];?>','','');<?php } else { ?>showWindow('login', 'member.php?mod=logging&action=login&guestmessage=yes');<?php } ?>" class="pn"><span>����</span></button> &nbsp;
<?php } else { ?>
<button disabled="yes" class="pn"><span>������</span></button> &nbsp;
<?php } if($_G['uid']) { ?><button onclick="showWindow('sendpm', 'home.php?mod=spacecp&ac=pm&op=showmsg&handlekey=showmsg_<?php echo $post['authorid'];?>&touid=<?php echo $post['authorid'];?>&pmid=0&daterange=2&tradeid=<?php echo $post['pid'];?>')" class="pn"><span><?php if($online) { ?>����<?php } ?>����</span></button><?php } ?>
</p>
<?php } if($trade['tenpayaccount']) { ?>
<p><em>(����Ʒ֧�ֲƸ�ͨ��������������󸶿�)</em></p>
<?php } ?>
</div>
</div>
<div class="cl mtw">
<div class="c pbm">
<?php echo $post['message'];?>
</div>
<?php if($post['attachment']) { ?>
<div class="notice postattach">����: <em>�����ڵ��û����޷����ػ�鿴����</em></div>
<?php } elseif($post['imagelist'] || $post['attachlist']) { ?>
<div class="pattl">
<?php if($post['imagelist']) { ?>
 <?php echo showattach($post, 1); } if($post['attachlist']) { ?>
 <?php echo showattach($post); } ?>
</div>
<?php } if(!$_G['inajax']) { ?><div id="comment_<?php echo $post['pid'];?>" class="cl tpst cm"></div><?php } ?>
</div>
<?php if(!$_G['inajax'] && $allowpostreply && $post['allowcomment'] && $_G['setting']['commentnumber']) { ?><div class="pob"><em><a class="fastre" href="javascript:;" onclick="showWindow('comment', 'forum.php?mod=misc&action=comment&pid=<?php echo $post['pid'];?>', 'get', 0)">����</a></em></div><?php } ?>
</td></tr>
</td></tr></table></div>

<?php if(!empty($aimgs[$post['pid']])) { ?>
<script type="text/javascript" reload="1">
var aimgcount = new Array();
aimgcount[<?php echo $post['pid'];?>] = [<?php echo dimplode($aimgs[$post['pid']]);; ?>];
attachimggroup(<?php echo $post['pid'];?>);
<?php if(empty($_G['setting']['lazyload'])) { ?>
attachimgshow(<?php echo $post['pid'];?>);
<?php } ?>
</script>
<?php } if(!$_G['inajax'] && $post['comment']) { ?>
<script type="text/javascript" reload="1">ajaxget('forum.php?mod=misc&action=commentmore&tid=<?php echo $post['tid'];?>&pid=<?php echo $post['pid'];?>', 'comment_<?php echo $post['pid'];?>');</script>
<?php } if(!$_G['inajax']) { ?>
</div></div>
<div class="sd">
<div class="bm">
<div class="bm_h">
<h2>��������</h2>
</div>
<div class="bm_c">
<table cellpadding="4" cellspacing="4" border="0" width="100%">
<tr><th width="60">����ʵ��</th><td><?php if($post['realname']) { ?><?php echo $post['realname'];?><?php } ?></td></tr>
<tr><th width="60">��������</th><td><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>&amp;do=trade&amp;view=eccredit#sellcredit" target="_blank"><?php echo $post['buyercredit'];?>&nbsp;<img src="<?php echo STATICURL;?>image/traderank/buyer/<?php echo $post['buyerrank'];?>.gif" border="0" style="vertical-align: middle"></a></td></tr>
<tr><th>�������</th><td><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>&amp;do=trade&amp;view=eccredit#buyercredit" target="_blank"><?php echo $post['sellercredit'];?>&nbsp;<img src="<?php echo STATICURL;?>image/traderank/seller/<?php echo $post['sellerrank'];?>.gif" border="0" style="vertical-align: middle"></td></tr>
</table>
</div>
</div>
<?php if($usertrades) { ?>
<div class="bm">
<div class="bm_h">
<h2>��̨������Ʒ</h2>
</div>
<div class="bm_c">
<div class="xld cl"><?php if(is_array($usertrades)) foreach($usertrades as $usertrade) { ?><dl class="cl">
<dd class="m">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $usertrade['tid'];?>&amp;do=tradeinfo&amp;pid=<?php echo $usertrade['pid'];?><?php if(!empty($_GET['modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_GET['modthreadkey'];?><?php } ?>" class="tn">
<?php if($usertrade['displayorder'] > 0) { ?><em class="hot">�Ƽ���Ʒ</em><?php } if($usertrade['aid']) { ?><img src="<?php echo getforumimg($usertrade['aid']); ?>" width="60" alt="<?php echo $usertrade['subject'];?>" /><?php } else { ?><img src="<?php echo IMGDIR;?>/nophoto.gif" width="130" alt="<?php echo $usertrade['subject'];?>" /><?php } ?>
</a>
</dd>
<dt><a href="forum.php?mod=viewthread&amp;tid=<?php echo $usertrade['tid'];?>&amp;do=tradeinfo&amp;pid=<?php echo $usertrade['pid'];?><?php if(!empty($_GET['modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_GET['modthreadkey'];?><?php } ?>"><?php echo $usertrade['subject'];?></a></dt>
<dd>
<?php if($usertrade['price'] > 0) { ?>
<p class="p">&yen; <em class="xi1"><?php echo $usertrade['price'];?></em></p>
<?php } if($_G['setting']['creditstransextra']['5'] != -1 && $usertrade['credit']) { ?>
<p class="<?php if($usertrade['price'] > 0) { ?>xg1<?php } else { ?>p<?php } ?>"><?php if($usertrade['price'] > 0) { ?>���� <?php } ?><em class="xi1"><?php echo $usertrade['credit'];?></em>&nbsp;<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['5']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['5']]['title'];?></p>
<?php } ?>
</dd>
</dl>
<?php } ?>
</div>
</div>
</div>
<?php } if($userthreads) { ?>
<div class="bm">
<div class="bm_h">
<h2><?php echo $trade['seller'];?> ��������Ʒ</h2>
</div>
<div class="bm_c cl xl">
<ul><?php if(is_array($userthreads)) foreach($userthreads as $userthread) { ?><li><span class="z xg1">[<?php echo dgmdate($userthread[dateline], 'n-j');?>]</span>&nbsp;<a href="forum.php?mod=viewthread&amp;tid=<?php echo $userthread['tid'];?>"><?php echo $userthread['subject'];?></a></li>
<?php } ?>
</ul>
</div>
</div>
<?php } ?>
</div>
</div>

<?php if(!IS_ROBOT && !empty($_G['setting']['lazyload'])) { ?>
<script type="text/javascript">
new lazyload();
</script>
<?php } } include template('common/footer'); ?>