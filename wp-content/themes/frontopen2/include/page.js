

//近期热门的横向滚动-开始
tolWidth = 0;
$(function(){
	mbileNav()
})
$(window).resize(function(){
	mbileNav()
});



function mbileNav(){
	$(".mIco li").each(function(){
		tolWidth += $(this).width();
	});	
	
	$('#remen_ul').width(tolWidth);
	var remen_ul = document.getElementById("remen_ul");
	
	oRecommended = slip('px',remen_ul,{
		direction: "x",
		bar_no_hide: true,
		bar_css: "bottom:-1px;border-radius: 10px;"
	});
}
//近期热门的横向滚动-结束