// JavaScript Document
//��ȡվ������
jQuery.noConflict();
var sCity_cm = jQuery("b[data-city-name]").attr('data-city-name');
jQuery(function() {
	quickNav(); //��߸�������
	navChange();//��ҳ�����¼�

	replaceLink(); //�ܱ����滻����
	tripHotUp(); //¿�α�����


	//�����Ҳ�tab�л�������type
	jQuery('.lv_s_all').on('click','.lv_s_ipt_tab li',function(){
		var jQueryself = jQuery(this);
		if ( jQueryself.attr('data-type') ) {
			jQuery('.lv_s_tab li.active').attr( 'data-type', jQueryself.attr('data-type') );
		}
	});

	/*
	* Fn navChange �����¼�
	* ���ܣ����������л��¼�
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
	 * Fn ����:�ܱ���tab�л��滻���Ӽ�����
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
	* ��ҳ��ߵ���	
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
		//liner_float_l = jQuery('.liner_float_l'); //���ָ������

		

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
		* �л�����	
		*/	
		function changeNav(i,nav) {
			nav.eq(i).addClass('active').siblings().removeClass('active');
		}

		/*
		* �ж���ʾ���ز��nav	
		*/	
		function sideNavShow() {
			//�����С��1280 ���ظ���
			if (w > 1280) {

				//��bannerλ�ò���ʾ
				 if (docTop > 500 /*&& docTop < lastTop*/) {
				 	sideNavBox.show().css({top: '70px'});
				 	//liner_float_l.show();

				 	//������ײ���ʱ�򣬸���������͵�ɫ��Ӱ������ʱ��������
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
		* ���������¼�
		* �󶨹������¼�	
		*/
		function mouseScroll(elm){
		    if(elm.addEventListener){ 
		   		elm.addEventListener('DOMMouseScroll',scrollFunc,false); 
		    } 
		    window.onmousewheel = elm.onmousewheel =  window.onscroll = scrollFunc;
		}; 

		/*
		* ���������� document	scrollTopֵ
		* �жϵ�ǰ��������
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
	* ���α���̬���� ��ʱ��	
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
	* ���α���̬����	
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


/* ��ҳ��Ʒ����ʱ ��ʼ */
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

            //����ʱ���� ���ü�ʱ��
            if (parseInt(int_hour) == 0 && parseInt(int_minute) == 0 && parseInt(int_second) == 0) {
                clearTimeout(timerID);
                if ( jQuerybuyBtn.hasClass('disabled') ) {
                	jQuerybuyBtn.removeClass('disabled').html("��������");
                	// elem.html(elem.html().replace('����','����'));
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

// �ı���ʹ�� ��˵��ã����µ���ʱָ���� countdown1.run(timers[0],countdown1.timer.eq(0));
/* ��ҳ��Ʒ����ʱ ���� */


jQuery(function(){


	//����ʱ
	var countdownTimers = [];
	jQuery('.js_countdown').each(function(){
		var jQueryself = jQuery(this),
			diffcout = jQueryself.attr('data-diffcout');
		/^\+?[1-9][0-9]*jQuery/.test(diffcout) && countdownTimers.push(diffcout);
	});

	countdownTimers.length && countdown.init(countdownTimers);



	//tab�л�
	var jQuerypublicTab = jQuery('.JS_publicTab');
	var publicTabHover = false;
	var timer = null;

	//cm
	var aPart_cm = ['����','���','����','������','�ܱ���','������Ʊ','�ȼپƵ�','���ι���'];

	jQuerypublicTab.on('hover', 'li', function() {
		var jQueryself = jQuery(this);//hover����tab
		var jQueryp = jQueryself.parents('.public');
		var jQuerypro = jQueryp.find('.js_proList');
		var jQueryindex = jQueryself.index();
		var jQuerymoreLink = jQueryself.parent().next('.public-tit-more').find('a'); //���ܴ��ڶ����������
		var jQuerytoPro = jQuerypro.eq(jQueryindex); //��Ҫ��ʾ����������

		//cm
		var sText_cm,
			nPidx_cm = jQueryself.parents('.public').index();

		publicTabHover = true;
		clearTimeout(timer);

		//�ӳټ���hover
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

			// �Ҳ�������ӱ任
			if ( jQuerymoreLink.length ) {
				jQuerymoreLink.eq(jQueryindex).show().siblings().hide();
			}

			//cm
			sText_cm = '��ҳ-PC-' + sCity_cm + '-P' + dMyIndex(nPidx_cm) + '-' + aPart_cm[nPidx_cm] + '-' + dMyIndex(jQueryindex,1) + '-' + removeHTMLTag(jQueryself.html());
			cmCreateElementTag(sText_cm,"PC��ҳPART" + dMyIndex(nPidx_cm) + aPart_cm[nPidx_cm]);
			
		},100);

	});

	//tab���ߺ��¼�
	jQuerypublicTab.on('mouseout', 'li', function() {
		publicTabHover = false;
		clearTimeout(timer);
	});
});

/*
* ����ȥ��html��ǩ
*/
function removeHTMLTag(str) {  
    str = str.replace(/<\/?[^>]*>/g,''); //ȥ��HTML tag 
    str = str.replace(/(^\s+)|(\s+jQuery)/g,''); //ȥ����β�հ�
    str = str.replace(/ [\s| | ]* /g,' '); //ȥ���������  
    return str;  
}

/*
* ����index 01 10 11
* i ����Ҫת��������
* n ���� ��ѡ��Ϊ��ʱ��ǰ�õ�0
* */

function dMyIndex(i,n) {
	var re = /^[0-9]+jQuery/;
	if ( re.test(i) ) {

		i +=1;
		if (n) i = i < 10 ? '0'+i : i;
		return i;
	}
}
//banner�ֲ�

var t = n =0, count;
jQuery(document).ready(function(){ 
	count=jQuery("#banner_list a").length;	
	jQuery("#banner_list a:not(:first-child)").hide();	
	jQuery("#banner li").click(function() {	
	var i = jQuery(this).index();//��ȡLiԪ���ڵ�ֵ����1��2��3��4
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