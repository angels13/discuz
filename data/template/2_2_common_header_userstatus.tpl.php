<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if($_G['uid']) { ?>
<div class="mb_1">
<strong class="<?php if($_G['setting']['connect']['allow'] && $_G['member']['conisbind']) { ?>vwmy qq<?php } ?>" style="padding-bottom:1px"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" target="_blank" title="访问我的空间" id="yeei_xx" onMouseOver="showMenu({'ctrlid':'yeei_xx','pos':'34!','ctrlclass':'a','duration':2});"><?php echo $_G['member']['username'];?></a></strong>
<?php if($_G['group']['allowinvisible']) { ?>
<span id="loginstatus">
<a id="loginstatusid" href="member.php?mod=switchstatus" title="切换在线状态" onClick="ajaxget(this.href, 'loginstatus');return false;" class="xi2"></a>
</span>
<?php } ?>
                             <?php if($_G['setting']['taskon'] && !empty($_G['cookie']['taskdoing_'.$_G['uid']])) { ?><span class="pipe">|</span><a href="home.php?mod=task&amp;item=doing" id="task_ntc" class="new">任务</a><?php } ?>

                          
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1'];?>
                            <?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra2'])) echo $_G['setting']['pluginhooks']['global_usernav_extra2'];?>
                            <?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra3'])) echo $_G['setting']['pluginhooks']['global_usernav_extra3'];?>
                            <span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
                            
               
</div>                       
<div class="mb_2">							
<a href="home.php?mod=spacecp" class="fc1" id="yeei_sz" onMouseOver="showMenu({'ctrlid':'yeei_sz','pos':'34!','ctrlclass':'a','duration':2});" title="设置"> </a>
<?php if($_G['uid'] && !empty($_G['style']['extstyle'])) { ?>
<a href="javascript:;" class="fc4" onClick="showid('smallLay');" title="切换风格"></a>
<script type="text/javascript">
function showid(idname){
var isIE = (document.all) ? true : false;
var isIE6 = isIE && ([/MSIE (\d)\.0/i.exec(navigator.userAgent)][0][1] == 6);
var newbox=document.getElementById(idname);
newbox.style.zIndex="9999";
newbox.style.display="block"
newbox.style.position = !isIE6 ? "fixed" : "absolute";
newbox.style.top =newbox.style.left = "50%";
newbox.style.marginTop = - newbox.offsetHeight / 2 + "px";
newbox.style.marginLeft = - newbox.offsetWidth / 2 + "px";  
var layer=document.createElement("div");
layer.id="layer";
layer.style.width=layer.style.height="100%";
layer.style.position= !isIE6 ? "fixed" : "absolute";
layer.style.top=layer.style.left=0;
layer.style.backgroundColor="#111";
layer.style.zIndex="9998";
layer.style.opacity="0.6";
document.body.appendChild(layer);
var sel=document.getElementsByTagName("select");
for(var i=0;i<sel.length;i++){        
sel[i].style.visibility="hidden";
}
function layer_iestyle(){      
layer.style.width=Math.max(document.documentElement.scrollWidth, document.documentElement.clientWidth)
+ "px";
layer.style.height= Math.max(document.documentElement.scrollHeight, document.documentElement.clientHeight) +
"px";
}
function newbox_iestyle(){      
newbox.style.marginTop = document.documentElement.scrollTop - newbox.offsetHeight / 2 + "px";
newbox.style.marginLeft = document.documentElement.scrollLeft - newbox.offsetWidth / 2 + "px";
}
if(isIE){layer.style.filter ="alpha(opacity=60)";}
if(isIE6){  
layer_iestyle()
newbox_iestyle();
window.attachEvent("onscroll",function(){                              
newbox_iestyle();
})
window.attachEvent("onresize",layer_iestyle)          
}  
var cbtn= document.getElementById('cbtn');
cbtn.onclick=function(){newbox.style.display="none";layer.style.display="none";for(var i=0;i<sel.length;i++){
sel[i].style.visibility="visible";
}}
layer.onclick=function(){newbox.style.display="none";layer.style.display="none";for(var i=0;i<sel.length;i++){
sel[i].style.visibility="visible";
}}
}
</script>
<?php } ?>
<a href="home.php?mod=space&amp;do=pm" id="pm_ntc" class="fc2 <?php if($_G['member']['newpm']) { ?>fc2_n<?php } ?>" title="<?php if($_G['member']['newpm']) { ?>新<?php } ?>消息"></a>
<a href="home.php?mod=space&amp;do=notice" id="myprompt" class="fc3 <?php if($_G['member']['newprompt']) { ?>fc3_n<?php } ?>" title="<?php if($_G['member']['newprompt']) { ?>新提醒: <?php echo $_G['member']['newprompt'];?><?php } ?>提醒" onmouseover="showMenu({'ctrlid':'myprompt'});"></a><span id="myprompt_check"></span>
<?php if(empty($_G['cookie']['ignore_notice']) && ($_G['member']['newpm'] || $_G['member']['newprompt_num']['follower'] || $_G['member']['newprompt_num']['follow'] || $_G['member']['newprompt'])) { ?><script language="javascript">delayShow($('myprompt'), function() {showMenu({'ctrlid':'myprompt','duration':3})});</script><?php } ?>

</div> 
<?php } elseif(!empty($_G['cookie']['loginuser'])) { ?>
<div class="mb_1">
<strong><a id="loginuser" class="noborder"><?php echo htmlspecialchars($_G['cookie']['loginuser']); ?></a></strong>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href)">激活</a>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
</div>    
<?php } elseif(!$_G['connectguest']) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>logging.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<div class="mb_1 mb_11" id="lsform" onsubmit="return lsSubmit();" style="padding-left:15px">
<span></span>
<a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href);hideWindow('register');" style="background:none">登录</a>
<span class="pipe">|</span> 
<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>"><?php echo $_G['setting']['reglinkname'];?></a>
</div> 
<div class="mb_3">
<?php if(!empty($_G['setting']['pluginhooks']['global_login_extra'])) echo $_G['setting']['pluginhooks']['global_login_extra'];?>
</div>
<div style="display: none;"><?php include template('member/login_simple'); ?></div> 
<?php } else { ?>
<div class="mb_1">
<strong class="vwmy qq" style="padding-bottom:1px"><?php echo $_G['member']['username'];?></strong>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1'];?>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>

</div>
<?php } ?>