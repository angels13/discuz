<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>">
<?php if(!$post['message'] && (($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && ($post['authorid'] == $_G['uid'] && $_G['forum_thread']['closed'] == 0)))) { ?><div class="ptw pbm cl"><a href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if(!empty($_GET['modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_GET['modthreadkey'];?><?php } ?>&amp;page=<?php echo $page;?>" class="z pn"><span class="z">添加柜台介绍</span></a></div><div class="pbw xs1">您可以在本帖中继续<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;firstpid=<?php echo $post['pid'];?>&amp;addtrade=yes<?php if(!empty($_GET['from'])) { ?>&amp;from=<?php echo $_GET['from'];?><?php } ?>"">添加多个商品</a>,并可以针对帖内所有商品添加统一的 "<strong>柜台介绍</strong>"</div><?php } else { ?><?php echo $post['message'];?><?php } ?>
</td></tr></table>

<?php if(count($trades) > 1 || ($_G['uid'] == $_G['forum_thread']['authorid'] || $_G['group']['allowedittrade'])) { ?>
<div class="trdc xs1">
<em>商品数: <?php echo $tradenum;?></em>
<?php if(!$_G['forum_thread']['is_archived'] && ($_G['uid'] == $_G['forum_thread']['authorid'] || $_G['group']['allowedittrade'])) { ?>
<a href="forum.php?mod=misc&amp;action=tradeorder&amp;tid=<?php echo $_G['tid'];?><?php if(!empty($_GET['from'])) { ?>&amp;from=<?php echo $_GET['from'];?><?php } ?>" onclick="showWindow('tradeorder', this.href)">柜台商品管理</a>
<?php if($_G['uid'] == $_G['forum_thread']['authorid']) { if($_G['group']['allowposttrade']) { ?>
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;firstpid=<?php echo $post['pid'];?>&amp;addtrade=yes<?php if(!empty($_GET['from'])) { ?>&amp;from=<?php echo $_GET['from'];?><?php } ?>">+ 添加商品</a>
<?php } ?>
<span class="pipe">|</span>
<a href="javascript:;" onclick="window.open('home.php?mod=space&uid=<?php echo $_G['uid'];?>&do=trade&view=tradelog','','');return false;">交易记录</a>
<?php } } ?>
</div>
<?php } if($tradenum) { if($trades) { ?>
<div class="xs1 cl"><?php if(is_array($trades)) foreach($trades as $key => $trade) { if($tradepostlist[$trade['pid']]['invisible'] != 0) { ?>
<div class="trdb">此商品已被删除</div>
<?php } else { ?>
<div class="trdb">
<div id="trade<?php echo $trade['pid'];?>" class="trdl cl">
<div class="tt" onclick="display('trade<?php echo $trade['pid'];?>');ajaxget('forum.php?mod=viewthread&do=tradeinfo&tid=<?php echo $_G['tid'];?>&pid=<?php echo $trade['pid'];?><?php if(!empty($_GET['modthreadkey'])) { ?>&modthreadkey=<?php echo $_GET['modthreadkey'];?><?php } ?>','tradeinfo<?php echo $trade['pid'];?>','tradeinfo<?php echo $trade['pid'];?>')">
<?php if($trade['displayorder'] > 0) { ?><em class="hot">推荐商品</em><?php } if($trade['thumb']) { ?>
<img src="<?php echo $trade['thumb'];?>" onclick="zoom(this, '<?php echo $trade['attachurl'];?>')" width="<?php if($trade['width'] > 90) { ?>90<?php } else { ?><?php echo $trade['width'];?><?php } ?>" _width="90" _height="90" alt="<?php echo $trade['subject'];?>" />
<?php } else { ?>
<img src="<?php echo IMGDIR;?>/nophotosmall.gif" width="90" height="90" alt="<?php echo $trade['subject'];?>" />
<?php } ?>
</div>
<div class="ta spi">
<span class="y"><a href="javascript:;" onclick="display('trade<?php echo $trade['pid'];?>');ajaxget('forum.php?mod=viewthread&do=tradeinfo&tid=<?php echo $_G['tid'];?>&pid=<?php echo $trade['pid'];?><?php if(!empty($_GET['modthreadkey'])) { ?>&modthreadkey=<?php echo $_GET['modthreadkey'];?><?php } ?>','tradeinfo<?php echo $trade['pid'];?>','tradeinfo<?php echo $trade['pid'];?>')" title="展开"><img src="<?php echo STATICURL;?>image/common/collapsed_yes.gif" alt="" class="vm" /> 展开</a></span>
<h4><a href="forum.php?mod=viewthread&amp;do=tradeinfo&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $trade['pid'];?><?php if(!empty($_GET['modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_GET['modthreadkey'];?><?php } ?>" target="_blank"><?php echo $trade['subject'];?></a></h4>

<dl class="z">
<dt>商品类型:</dt>
<dd>
<?php if($trade['quality'] == 1) { ?>全新<?php } if($trade['quality'] == 2) { ?>二手<?php } ?>
商品
</dd>
<dt>剩余时间:</dt>
<dd>
<?php if($trade['closed']) { ?>
<em>成交结束</em>
<?php } elseif($trade['expiration'] > 0) { ?>
<?php echo $trade['expiration'];?>天<?php echo $trade['expirationhour'];?>小时
<?php } elseif($trade['expiration'] == -1) { ?>
<em>成交结束</em>
<?php } else { ?>
&nbsp;
<?php } ?>
</dd>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_trade_extra'][$key])) echo $_G['setting']['pluginhooks']['viewthread_trade_extra'][$key];?>
</dl>
<div class="z mtn">
<?php if($trade['price'] > 0) { ?>
<strong><?php echo $trade['price'];?></strong>&nbsp;元&nbsp;&nbsp;
<?php } if($_G['setting']['creditstransextra']['5'] != -1 && $trade['credit']) { if($trade['price'] > 0) { ?>附加 <?php } ?><strong><?php echo $trade['credit'];?></strong>&nbsp;<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['5']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['5']]['title'];?>
<?php } ?>
<p class="xg1">
<?php if($trade['costprice'] > 0) { ?>
<del><?php echo $trade['costprice'];?> 元</del>
<?php } if($_G['setting']['creditstransextra']['5'] != -1 && $trade['costcredit'] > 0) { ?>
<del><?php if($trade['costprice'] > 0) { ?>附加 <?php } ?><?php echo $trade['costcredit'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['5']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['5']]['title'];?></del>
<?php } ?>
</p>
</div>
</div>
</div>
<div id="tradeinfo<?php echo $trade['pid'];?>"></div>
</div>
<?php } if(count($trades) == 1) { ?>
<script type="text/javascript" onload="1">display('trade<?php echo $trade['pid'];?>');ajaxget('forum.php?mod=viewthread&do=tradeinfo&tid=<?php echo $_G['tid'];?>&pid=<?php echo $trade['pid'];?><?php if(!empty($_GET['modthreadkey'])) { ?>&modthreadkey=<?php echo $_GET['modthreadkey'];?><?php } ?>','tradeinfo<?php echo $trade['pid'];?>','tradeinfo<?php echo $trade['pid'];?>')</script>
<?php } } ?>
</div>
<?php } ?>

<div id="postmessage_<?php echo $post['pid'];?>"><?php echo $post['counterdesc'];?></div>
<?php } else { ?>
<div class="locked">本柜台无商品</div>
<?php } ?>
