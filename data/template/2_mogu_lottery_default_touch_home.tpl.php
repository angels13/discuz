<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('home');?><?php include template('mogu_lottery:default/touch/header'); ?><div class="main" >
  <a class="float return" onclick="history.go(-1);"><i data-id="&#x34;"></i></a>
  <a class="float user" href="plugin.php?id=mogu_lottery:my&amp;actid=<?php echo $actid;?>"><i data-id="&#x56;"></i></a>
  <div class="turntable">
    <div style="height:50px;"></div>
    <div class="TurnBox">
      <div id="Turn">
        <section class="gb-wheel-container" id="gbWheel">
          <div class="gb-wheel-content gb-wheel-run">
            <ul class="gb-wheel-line"></ul>
            <div class="gb-wheel-list"></div>
          </div>
          <a href="javascript:;" class="gb-wheel-btn" id="gbLottery"><b>¿ªÊ¼</b></a>
        </section>
      </div>
      <a class="float prize dialog" href="plugin.php?id=mogu_lottery:misc&amp;act=introduce&amp;actid=<?php echo $actid;?>"><i data-id="&#xe008;"></i></a>
    </div>
    <div style="position: relative; z-index: 2; color: #F5F5F5;">
      <div class="chancenum"><?php echo $chancetxt;?><?php echo $credittxt;?></div>
      
      <div id="Scroll" class="announcement" style="height: 80px; overflow: hidden;">
        <ul>
          <?php if(is_array($announcement)) foreach($announcement as $item) { ?>          <li><?php echo $item;?></li>
          <?php } ?>
        </ul>
      </div>
      
      <p class="copyright">&copy; <?php echo $_G['setting']['sitename'];?></p>
      
    </div>
    <div class="superimposed"></div>
    <div class="TurnBg"><img src="source/plugin/mogu_lottery/template/default/touch/images/beam.png" /></div>
  </div>
</div>

<audio id="MyAudio" preload="auto" src="source/plugin/mogu_lottery/static/voice/audio.mp3"></audio>
<script src="source/plugin/mogu_lottery/static/js/fingerprint2.min.js" type="text/javascript"></script> 
<script>
/*æ»šåŠ¨å¼€å§‹*/
function AutoScroll(obj) {
var height = $(obj).find("li:first").height();
$(obj).find("ul:first").animate({
marginTop: "-"+height+"px"
}, 500, function() {
$(this).css({ marginTop: "0px" }).find("li:first").appendTo(this);
});
}
var myar = setInterval('AutoScroll("#Scroll")', 5000);

(function() {
var status = false;
if(!getcookie('marks')){
status = true;
popup.open('<div class="tip"><dt>ÕıÔÚ»ñÈ¡Éè±¸ĞÅÏ¢...</dt></div>');
new Fingerprint2().get(function(result){
if(result){
setcookie('marks', result);
popup.close();
status = false;
}else{
status = false;
}
});
}
// å¥–å“é…ç½®
var awards = <?php echo $prizejson;?>;

var len = awards.length, turnNum = 1 / len;

var gbWheel = document.getElementById('gbWheel'),
lineList = gbWheel.querySelector('ul.gb-wheel-line'),
itemList = gbWheel.querySelector('.gb-wheel-list'),
lineListHtml = [],
itemListHtml = [];
// transformå…¼å®¹
function preTransform() {
var cssPrefix,
vendors = {
  '': '',
  Webkit: 'webkit',
  Moz: '',
  O: 'o',
  ms: 'ms'
},
testEle = document.createElement('p'),
cssSupport = {};
//å—…æ¢ç‰¹æ€§
Object.keys(vendors).some(function(vendor) {
if (testEle.style[vendor + (vendor ? 'T' : 't') + 'ransform'] !== undefined) {
    cssPrefix = vendor ? '-' + vendor.toLowerCase() + '-' : '';
    return true;
}
});
//å…¼å®¹CSSå‰ç¼€
function normalizeCss(name) {
name = name.toLowerCase();
return cssPrefix ? cssPrefix + name : name;
}
cssSupport = {
transform: normalizeCss('Transform'),
}
return cssSupport.transform;
}

var transform = preTransform();

awards.forEach(function(v, i, a) {
// åˆ†éš”çº¿
lineListHtml.push('<li class="gb-wheel-litem" style="' + transform + ': rotate('+ (i * turnNum + turnNum / 2) +'turn)"></li>');
v.pic = v.pic ? v.pic : 'source/plugin/mogu_lottery/static/images/none.gif';
// å¥–é¡¹
itemListHtml.push('<div class="gb-wheel-item" style="' + transform + ': rotate('+ (i * turnNum) +'turn)">');
itemListHtml.push('<div class="gb-wheel-icontent" >');
itemListHtml.push('<p class="gb-wheel-itext">');
itemListHtml.push(v.name);
itemListHtml.push('</p>');
itemListHtml.push('<p class="gb-wheel-iicon">');
itemListHtml.push('<img src="'+v.pic+'">');
itemListHtml.push('</p>');
itemListHtml.push('</div>');
itemListHtml.push('</div>');
});           
lineList.innerHTML = lineListHtml.join('');
itemList.innerHTML = itemListHtml.join('');

// æ—‹è½¬
var i = 0;
var chance = parseInt(<?php echo $chance;?>);

document.getElementById('gbLottery').onclick = function() {
if (status != false) {
return false;
}

$('#gbLottery b').html('Æô¶¯ÖĞ');
$('#gbLottery').css({'font-size':'20px'});
$(this).addClass('btnk');
player(0,0.1);

status = true;
jQuery.ajax({
type: "POST",
dataType: "json",
timeout: 7000,
url: 'plugin.php?id=mogu_lottery:result',
data: {actid: '<?php echo $_GET['actid'];?>', lottery:'<?php echo $_GET['lottery'];?>', formhash: '<?php echo FORMHASH;?>'},
error: function(data) {
Reset();
popup.open('ÍøÂçÁ¬½Ó´íÎó£¡', 'alert');
},
success: function(data) {
if(data.result > 0){
i++;
player(0.6,6.2);
$('#gbLottery').removeClass('btnk');  //å¼¹æ€§è¿˜åŸ
w = (360/len)-5;                      //åç§»é‡
offset = (w/2)-(Math.random()*w);     //æ¨¡æ‹Ÿé‡åŠ›æƒ¯æ€§
angle = ((data.result - 1) * ((360 / len).toFixed(3))) + offset;
gbWheel.querySelector('.gb-wheel-content').style['-webkit-transform'] = 'rotate('+ ((i * 3600) - angle) +'deg)';
<?php if(!empty($activity['giving']['1'])) { ?>
jQuery("#chance").css({'font-size':'2px'});
chance--;
jQuery("#chance").html(chance);
jQuery("#chance").animate({'font-size':'36px'});
jQuery("#chance").animate({'font-size':'24px'});
<?php } ?>
setTimeout(function (){
if(data.jackpot){
player(6.4,10);
}
Reset();
popup.open('<p class="p10" style="padding-top: 70px;"><img src="'+awards[data.result-1]['pic']+'"></p><p style="padding-top: 30px;padding-bottom: 40px;">'+data.msg+'</p>', 'alert');
}, 6000);
}else if(data.result == -1){
Reset();
popup.open('<div class="tip"><dt><p><img src="'+data.url+'" width="100%"></p><p>Ê¹ÓÃÎ¢ĞÅÉ¨Ãè¡¢»ò³¤°´¶şÎ¬ÂëÊ¶±ğ¹«ÖÚºÅ£¬ÔÚ¹«ÖÚºÅÄÚ»Ø¸´»î¶¯Ãû³Æ</p></dt></div>');
}else{
Reset();
popup.open(data.msg, 'alert');
}
}
});
}

function player(start,stop){
var audio = document.getElementById('MyAudio');
if(audio){
audio.currentTime = start;
audio.play();
var time = (stop - start) * 1000;
setTimeout(function () {
audio.pause();
}, time);
}
}

function Reset(){
status = false;
$('#gbLottery').removeClass('btnk');
$('#gbLottery b').html('¿ªÊ¼');
$('#gbLottery').css({'font-size':'30px'});
}
}());

</script><?php include template('mogu_lottery:default/touch/footer'); ?>