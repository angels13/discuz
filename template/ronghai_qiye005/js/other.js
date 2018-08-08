/*首页banner*/
$.noConflict();  
jQuery(".banner").slide({
	titCell: ".hd ul",
	mainCell: ".bd ul",
	effect: "fold",
	autoPlay: true,
	autoPage: true,
	trigger: "click"
});

/*艺术家滚动*/
jQuery(".scrollBox").slide({
	titCell: ".list li",
	mainCell: ".piclist",
	effect: "left",
	vis: 4,
	scroll: 1,
	delayTime: 800,
	trigger: "click",
	easing: "easeOutCirc"
});

/*弹框盒子*/
jQuery(function() {
	jQuery(".alertbox").click(function() {
		jQuery("#mask").stop().show();
	})
	jQuery("#mask .close").click(function() {
		jQuery("#mask").stop().hide();
	})
});
jQuery(".check-inline,.check-box").click(function() {
	jQuery(this).siblings().removeClass("check_on");
	if(jQuery(this).hasClass("check_on")) {
		jQuery(this).removeClass("check_on");
	} else {
		jQuery(this).addClass("check_on");
	}
})
/*付款页　订单详情展开*/		
jQuery(".r-suc-info .detail-show").click(function(){
  jQuery(this).siblings().removeClass("show-on");
  if(jQuery(this).hasClass("show-on")){
   jQuery(this).removeClass("show-on");
   jQuery(".order-show").hide();
  }else{
   jQuery(this).addClass("show-on");
   jQuery(".order-show").show();
	  }

})


//产品图片滚动效果
	jQuery(".proscroll").slide({ mainCell:".prolist", effect:"leftLoop",vis:5, autoPlay:true});
//商品详情切换
	jQuery(".pro-detail").slide({ titCell:".tab-hd li",trigger:"click", mainCell:".tab-bd",delayTime:0 });
//专场详情图片切换
	jQuery(".spdetail").slide({ mainCell:".bd ul",effect:"fold",autoPlay:true,delayTime:200 });

