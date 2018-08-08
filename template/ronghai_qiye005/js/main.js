// JavaScript Document
//获取站点名称
jQuery.noConflict();
var sCity_cm = jQuery("b[data-city-name]").attr('data-city-name');
jQuery(function() {
	quickNav(); //侧边浮动导航
	navChange();//首页导航事件

	replaceLink(); //周边游替换链接
	tripHotUp(); //驴游宝滚动


	//搜索右侧tab切换更换主type
	jQuery('.lv_s_all').on('click','.lv_s_ipt_tab li',function(){
		var jQueryself = jQuery(this);
		if ( jQueryself.attr('data-type') ) {
			jQuery('.lv_s_tab li.active').attr( 'data-type', jQueryself.attr('data-type') );
		}
	});

	/*
	* Fn navChange 导航事件
	* 功能：首屏导航切换事件
	*
	*/
	function navChange() {
		var lvSiderNav = jQuery(".lv-sidernav"),
			hover = false,
			attrX = [],
			timer1 = null,
			timer2 = null,
			timer3 = null;
		
		lvSiderNav.hover(function () {
			timer1 = setTimeout( function(){
				hover = true;
			},300);
		}, function () {
			jQuery(this).find(".lv-sidernav-list").removeClass("active");
			hover = false;
			clearTimeout(timer1);
		});

		jQuery(".lv-sidernav-list").hover(function (e) {
			var me = jQuery(this),
				X = e.pageX,
				l = attrX.length,
				oldX = attrX[l - 5];
			if (hover == true && X <= oldX + 5) {
				hoverNav(me);
		        clearTimeout(timer3);
		        attrX = [];
			} else {
				clearTimeout(timer3);
				//var me = jQuery(this);
				timer2 = setTimeout(function (){
					hoverNav(me);
				},500);
			}	
		},function (){
			var me = jQuery(this);
			timer3 = clearTimeout(function () {
				jQuery(this).removeClass("active");
			},300);
			clearTimeout(timer2);
		});

		lvSiderNav.mousemove(function(e) {
		    var X = e.pageX;
		    attrX.push(X);
		});

		function hoverNav(elm) {
			elm.addClass("active").siblings().removeClass("active");
		};
	} //end of Fn navChange()
	
	/* replaceLink
	 * Fn 功能:周边游tab切换替换链接及方案
	*/
	function replaceLink() {
		jQuery(document).on('click','li',function(){
			var me = jQuery(this),
				parLink = me.parent().next();
			if (me.attr('parenttype') == 'picWeek')	{
				if(me.index() == 1) {
					parLink.attr('href','');
				} else {
					parLink.attr('href','');
				}
			}	
		});
	}//end of Fn replaceLink()

	
	/* Fn quickNav()
	* 首页侧边导航	
	*/
	function quickNav() {
		var sideNavBox = jQuery('.nav-left'),
			sideNav,subScroll,body,doc,docTop,w,lastTop,liner_float_l;
		if (!sideNavBox.length) { return false;}
		sideNav = sideNavBox.find('li');
		subScroll = jQuery('.public');
		body = jQuery('html,body');
		doc = jQuery(document);
		docTop = doc.scrollTop();
		w = jQuery(window).width();
		lastTop = subScroll.eq(subScroll.length-1).offset().top;
		//liner_float_l = jQuery('.liner_float_l'); //邮轮浮动广告

		

		scrollFunc();
		sideNavShow();
		mouseScroll(document);
		jQuery(window).resize(function(){
			w = jQuery(window).width();
			sideNavShow();
		});	


		sideNav.each(function(e) {
			var me = jQuery(this);
			me.click(function() {
				body.stop(true,true).animate({scrollTop: subScroll.eq(e).offset().top - (me.offset().top - jQuery(window).scrollTop()) +'px'}, 300,function(){
					changeNav(e,sideNav);
				});
			});
		});
		
		/*
		* 切换索引	
		*/	
		function changeNav(i,nav) {
			nav.eq(i).addClass('active').siblings().removeClass('active');
		}

		/*
		* 判断显示隐藏侧边nav	
		*/	
		function sideNavShow() {
			//浏览器小于1280 隐藏浮动
			if (w > 1280) {

				//在banner位置不显示
				 if (docTop > 500 /*&& docTop < lastTop*/) {
				 	sideNavBox.show().css({top: '70px'});
				 	//liner_float_l.show();

				 	//当到达底部的时候，浮动导航会和底色重影，到底时往上提升
				 	if (docTop >= lastTop - 100) sideNavBox.css('top',lastTop - docTop - 100);
				 } else if (docTop >= lastTop) {

				 }else {
					sideNavBox.fadeOut("fast");
					//liner_float_l.fadeOut("fast");
				}
			}else {
				sideNavBox.hide();
				//liner_float_l.hide();
			}
		};
		
		/*
		* 绑定鼠标滚动事件
		* 绑定滚动条事件	
		*/
		function mouseScroll(elm){
		    if(elm.addEventListener){ 
		   		elm.addEventListener('DOMMouseScroll',scrollFunc,false); 
		    } 
		    window.onmousewheel = elm.onmousewheel =  window.onscroll = scrollFunc;
		}; 

		/*
		* 监听鼠标滚动 document	scrollTop值
		* 判断当前所在索引
		*/
		function scrollFunc() {
			docTop = doc.scrollTop();
			sideNavShow();
			subScroll.each(function (e) {

				if( docTop  >=  subScroll.eq(e).offset().top + (docTop - sideNav.eq(e).offset().top) ) {
					changeNav(e,sideNav);
				}
				
			});
		};
	} //end of Fn quickNav()
		
	/*
	* 旅游宝动态滚动 定时器	
	*/
	function tripHotUp() {
	    var timer = null,
	    lcHotBox = jQuery('.lvyoubao-info');
	    clearInterval(timer);
	    lyb_autoPlay();
	    lcHotBox.hover(function(){
	        clearInterval(timer);
	    },function(){lyb_autoPlay();});
	   function lyb_autoPlay() {
	     timer = setInterval(function(){
	            getLcHotHeight();
	        },2000);
	   }
	};

	/*
	* 旅游宝动态滚动	
	*/
	function getLcHotHeight() {
	    var lc_hot = jQuery('.lvyoubao-info li');
	    var h = -lc_hot.first().outerHeight();
	    var first_html = lc_hot.first().html();
	    lc_hot.first().animate({"margin-top":h},500,function(){
	        lc_hot.last().after("<li>" + first_html + "</li>");
	        jQuery(this).remove();
	    });
	}

});


/* 首页产品倒计时 开始 */
var countdown = {
	timer: jQuery(".js_countdown"),
	init: function(time_distance) {
		var self = this;
		if ( this.timer.size() < 0 || !this.isArray(time_distance)) {
	        return;
	    };

	    this.timer.each(function(e) {
	        var time_arry = time_distance[e];
	        var me = jQuery(this);
	           self.run(time_arry,me); 
	    });
	},
	isArray:function (obj) {  
        return Object.prototype.toString.call(obj) === '[object Array]';   
    },
	run: function(time_arry,elem) {
		var self = this;
		var jQuerybuyBtn = elem.next('.buyBtn');
		if (time_arry >= 0) {
            var int_day, int_hour, int_minute, int_second;
            var timeDown = time_arry,timerID;
            int_hour = Math.floor(timeDown / 3600000);
            timeDown -= int_hour * 3600000;
            int_minute = Math.floor(timeDown / 60000);
            timeDown -= int_minute * 60000;
            int_second = Math.floor(timeDown / 1000);

            int_hour = int_hour < 10 ? "0" + int_hour : int_hour;
            int_minute = int_minute < 10 ? "0" + int_minute : int_minute;
            int_second = int_second < 10 ? "0" + int_second : int_second;


            elem.find(".hour").text(int_hour);
            elem.find(".min").text(int_minute);
            elem.find(".sec").text(int_second);

            //倒计时结束 重置计时器
            if (parseInt(int_hour) == 0 && parseInt(int_minute) == 0 && parseInt(int_second) == 0) {
                clearTimeout(timerID);
                if ( jQuerybuyBtn.hasClass('disabled') ) {
                	jQuerybuyBtn.removeClass('disabled').html("立即抢购");
                	// elem.html(elem.html().replace('开抢','结束'));
                }

                return;
            }
            time_arry -= 1000;
            timerID = setTimeout(function() {
                self.run(time_arry,elem);
            }, 1000);
        } else {
            clearTimeout(timerID);
        }
	}
};
// var timers = [8175, 79887815, 58878175, 18878175];
//countdown1.init(timers);

// 改变后可使用 如此调用，重新倒计时指定项 countdown1.run(timers[0],countdown1.timer.eq(0));
/* 首页产品倒计时 结束 */


jQuery(function(){


	//倒计时
	var countdownTimers = [];
	jQuery('.js_countdown').each(function(){
		var jQueryself = jQuery(this),
			diffcout = jQueryself.attr('data-diffcout');
		/^\+?[1-9][0-9]*jQuery/.test(diffcout) && countdownTimers.push(diffcout);
	});

	countdownTimers.length && countdown.init(countdownTimers);



	//tab切换
	var jQuerypublicTab = jQuery('.JS_publicTab');
	var publicTabHover = false;
	var timer = null;

	//cm
	var aPart_cm = ['特卖','大促','出境','国内游','周边游','景点门票','度假酒店','旅游攻略'];

	jQuerypublicTab.on('hover', 'li', function() {
		var jQueryself = jQuery(this);//hover到的tab
		var jQueryp = jQueryself.parents('.public');
		var jQuerypro = jQueryp.find('.js_proList');
		var jQueryindex = jQueryself.index();
		var jQuerymoreLink = jQueryself.parent().next('.public-tit-more').find('a'); //可能存在多个更多链接
		var jQuerytoPro = jQuerypro.eq(jQueryindex); //将要显示的内容区域

		//cm
		var sText_cm,
			nPidx_cm = jQueryself.parents('.public').index();

		publicTabHover = true;
		clearTimeout(timer);

		//延迟加载hover
		timer = setTimeout(function(){
			if ( !publicTabHover ) {
				clearTimeout(timer);
				return false;
			}

			jQueryself.addClass('active').siblings().removeClass('active');

            jQuerytoPro.find('img').each(function(){
                var jQueryme = jQuery(this),
                    src = jQueryme.attr('to');
                src && jQueryme.attr('src',src).removeAttr('to');
            });

			jQuerytoPro.stop(true).fadeIn(300).siblings().stop(true).fadeOut(300);

			// 右侧更多链接变换
			if ( jQuerymoreLink.length ) {
				jQuerymoreLink.eq(jQueryindex).show().siblings().hide();
			}

			//cm
			sText_cm = '首页-PC-' + sCity_cm + '-P' + dMyIndex(nPidx_cm) + '-' + aPart_cm[nPidx_cm] + '-' + dMyIndex(jQueryindex,1) + '-' + removeHTMLTag(jQueryself.html());
			cmCreateElementTag(sText_cm,"PC首页PART" + dMyIndex(nPidx_cm) + aPart_cm[nPidx_cm]);
			
		},100);

	});

	//tab移走后事件
	jQuerypublicTab.on('mouseout', 'li', function() {
		publicTabHover = false;
		clearTimeout(timer);
	});
});

/*
* 正则去掉html标签
*/
function removeHTMLTag(str) {  
    str = str.replace(/<\/?[^>]*>/g,''); //去除HTML tag 
    str = str.replace(/(^\s+)|(\s+jQuery)/g,''); //去除首尾空白
    str = str.replace(/ [\s| | ]* /g,' '); //去除多余空行  
    return str;  
}

/*
* 处理index 01 10 11
* i 代表要转换的数字
* n 参数 可选，为真时，前置倒0
* */

function dMyIndex(i,n) {
	var re = /^[0-9]+jQuery/;
	if ( re.test(i) ) {

		i +=1;
		if (n) i = i < 10 ? '0'+i : i;
		return i;
	}
}
//banner轮播

var t = n =0, count;
jQuery(document).ready(function(){ 
	count=jQuery("#banner_list a").length;	
	jQuery("#banner_list a:not(:first-child)").hide();	
	jQuery("#banner li").click(function() {	
	var i = jQuery(this).index();//获取Li元素内的值，即1，2，3，4
	n = i;
	
	if (i >= count) return;
	jQuery("#banner_list a").filter(":visible").fadeOut(500).parent().children().eq(i).fadeIn(1000);

	document.getElementById("banner").style.background="";

	jQuery(this).toggleClass("on");

	jQuery(this).siblings().removeAttr("class");

	});
	t = setInterval("showAuto()",5000);
	jQuery("#banner").hover(function(){clearInterval(t)}, function(){t = setInterval("showAuto()",5000)});

})

function showAuto()
{
	n = n >=(count -1) ?0 : ++n;
	jQuery("#banner li").eq(n).trigger('click');
}