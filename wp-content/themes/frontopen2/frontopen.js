function ResumeError() { return true; } window.onerror = ResumeError;

$(function() {
	$('.toggletitle').click(function(){
		$(this).next('.togglecon').slideToggle();
	})

	doNow = 0  //初始化全局变量
	doNow2 = 0;
	
	$('#article-index').hover(function(){
			if(doNow2 == 1){$(this).clearQueue();$(this).fadeTo(300,1);}
		},function(){
			if(doNow2 == 1){$(this).clearQueue();$(this).fadeTo(300,0.2)};
		})

	if(mod_txt != ''){	
		mod = $(mod_txt);
		nav = mod.position();
	}

	var $search = $('#s'); //设置search框的ID
    $search.focus(function() {
        $(this).css({
            'background': '#FD7B2F',
            'color': '#fff'
        });
        f = setInterval(flash, 1)
    });
    $search.blur(function() {
        $(this).css({
            'background': '#fff',
            'color': '#999'
        });
        clearTimeout(f)
    });
    function flash() {
        $search.fadeTo(1000, 0.7);
        $search.fadeTo(1000, 1)
    };
    $('.nav_button').hover(function() {
		$(this).clearQueue()
        $(this).fadeTo(100, 1)
		$(this).parents('dl').animate({"top":"-5px"},100)
    },
    function() {
        $(this).fadeTo(100, 0.7)
		$(this).parents('dl').animate({"top":"0px"},100)
    });
	
	var moreLink = $('.more-link');
    $('.main .post_box').hover(function() {
        $(this).find(moreLink).animate({
            'width': '25%'
        },
        100);
    },
    function() {
        $(this).find(moreLink).animate({
            'width': '15%'
        },
        100)
    });
    $('#content .post_box').hover(function() {
        $(this).find(moreLink).animate({
            'width': '25%'
        },
        100)
    },
    function() {
        $(this).find(moreLink).animate({
            'width': '15%'
        },
        100)
    });
	
	
    $('.menu li').hover(function() {
        $(this).children('ul').children('li').show()
    },
    function() {
        $(this).children('ul').children('li').hide()
    });
	
	
    $('ul li','.menu').hover(function() {
        var width = $(this).parent().width();
        $(this).children('.sub-menu').css('left', width)
    })
			
	$('.tit .h1 a').each(function(){
		$(this).click(function(){
			$(this).text('页面正在加载，请稍候...')	
		})	
	});
	
	$('#index-ul a').click(function(){
		var getId = $(this).attr('href');
		var getIdPos = $(getId).position();
		goRoll(getIdPos.top,300);
		duanFlash(getId)
		return false;
	})
	
	
	
//	var explorer = window.navigator.userAgent ;
//	if (explorer.indexOf("MSIE") >= 0) {
//		ieWindow()
//	}
	
});

function goRoll(n,time){
	var speed = time || 1000;
	var n  = n || 0;
	$('html,body').animate({scrollTop:n-50},speed);
}

function duanFlash(sect){
	$(sect).css({'background':'#00BCF2','color':'#fff'})
	setTimeout(function(){$(sect).css({'background':'none','color':'#454545'})},1000)
}

//function ieWindow(){
//	var windowWidth = $(window).width();
//	if(windowWidth >= 1366)
//	{
//		$('.post_box').width('44.9%');
//		$('.post_box').css('float','left');
//		$('.post_box .c-con').css('height','140px');
//	}else if(windowWidth < 1366){
//		$('.post_box').width('100%');
//		$('.post_box').css('float','none');
//		$('.post_box .c-con').css('height','auto');
//	}
//
//}

$(window).scroll(function(){
		if(mod_txt != ''){	
			rollCheck()
			rollSoy()
		}
});

$(window).resize(function(){
	if(mod_txt != ''){	
		rollResize()
	}
	
/*	var explorer = window.navigator.userAgent ;
	if (explorer.indexOf("MSIE") >= 0) {
		ieWindow()
	}
*/
});

function rollSoy(){
	var father = $('#content');
	var bod = $('#article-index');
	var fat = $('.entry-content');
	if(father && bod && fat){
		var bodPos = bod.position()
		var fatPos = fat.position()
		var fatherPos = father.position();
		var fatTop = fatPos.top;
		var fatHeight = fat.height();
		var bodLeft = fatherPos.left + father.width() - bod.width() - 10;
			if(navTop >= fatTop-50  && doNow2 == 0)
			{
				bod.css('position','fixed')
				bod.css('top','50px')
				bod.css('z-index','99')
				bod.css('left',bodLeft)
				bod.fadeTo(500,0.2)
				doNow2 = 1;
			}else if(navTop <= fatTop-50  && doNow2 == 1){
				bod.css('position','static')
				bod.fadeTo(500,1)
				doNow2 = 0;
			}else if(navTop >= fatHeight){
				bod.slideUp(300);
			}else if(navTop <= fatHeight){
				bod.slideDown(300);
			}
	}
}

/*	导航条贴合JS*/
function rollCheck(){
	var modHieght = mod.height()
	navbod = mod;
	navWidth = navbod.width()
	navbod.css('left',nav.left);
	
	navTop = $(document).scrollTop();
		if(navTop >= nav.top-50 && doNow == 0)
		{
			navbod.css('position','fixed')
			navbod.css('top','50px')
			navbod.css('z-index','99')
			navbod.css('background','#F6F6F6')
			navbod.css('width',navWidth)
			navbod.css('border','none')
			navbod.css('overflow','hidden')

			modHieght = mod.height()
			$("<div id='tian'></div>").insertAfter(navbod);
			$('#tian').css('height',modHieght + 20);
			doNow = 1;
			
		}else if(navTop <= nav.top-50 && doNow == 1){
			navbod.css('position','static')
			navbod.css('background','none')
			navbod.attr('style','border-bottom: 20px solid #f6f6f6;')
			$('#tian').remove();
			doNow = 0;
		}
}

function rollResize(){
	var modHieght = mod.height()
	navbod = mod;
	navWidth = navbod.width()
	navbod.css('left',nav.left);
	
	mod.css('position','static')
	var nav2 = mod.position()
	nav2temp = $('#primary');
	navbod2 = mod;
	navWidth2 = nav2temp.width()
	navbod2.css('left',nav2.left);
	navbod2.css('width',navWidth2);
	navWidth = navWidth2;
	navTop2 = $(document).scrollTop();
	
		if(navTop2 >= nav2.top-50)
		{
			navbod2.css('position','fixed')
			navbod2.css('top','50px')
			navbod2.css('z-index','99')
			navbod2.css('background','#F6F6F6')
			navbod2.css('width',navWidth2)
		}else{
			navbod2.css('position','static')
			navbod2.css('background','none')
		}

}

/*加载进度条完成后隐藏*/
$(document).ready(function(){
	$('.loading').fadeOut();
});




/*页面图片拉伸*/
$(function(){
var doBox = $('.entry-content');
doBox.find('img').each(function(){
var picWidth = parseInt($(this).width());
var boxWidth = parseInt(doBox.width());
if(picWidth > boxWidth)
{
var pW = $(this).width();
var pH = $(this).height();
var BL = pH / pW;
var outH = boxWidth * BL;
$(this).width(boxWidth);
$(this).height(outH);
}
})
});


/*设置cookie*/
$(document).ready(function(e) {
    $('#tclose').click(function(){
		$(".m960tips").hide();  //隐藏tips整体窗口
		$('#bakg').hide();
		var date=new Date(); //获取当前时间
		var expiresDays=365;  //将date设置为365天以后的时间
		date.setTime(date.getTime()+expiresDays*24*3600*1000); //将tips的cookie设置为10天后过期 
		document.cookie="tips=1;expires="+date.toGMTString();  //设置cookie
	})
});


$(function(){
	/*获取cookie参数*/
	var getCookie = document.cookie.replace(/[ ]/g,"")  //获取cookie，并且将获得的cookie格式化，去掉空格字符
	var arrCookie = getCookie.split(";")  //将获得的cookie以"分号"为标识 将cookie保存到arrCookie的数组中
	var tips;  //声明变量tips
	for(var i=0;i<arrCookie.length;i++){   //使用for循环查找cookie中的tips变量
		var arr=arrCookie[i].split("=");   //将单条cookie用"等号"为标识，将单条cookie保存为arr数组
		if("tips"==arr[0]){  //匹配变量名称，其中arr[0]是指的cookie名称，如果该条变量为tips则执行判断语句中的赋值操作
			tips=arr[1];   //将cookie的值赋给变量tips
			break;   //终止for循环遍历
		} 
	}

	/*判断cookie是否设置，如果没有设置cookie则显示提示文字*/
	if(tips != 1){  //默认情况下判断，如果没有设置tips则执行下面的脚本，将tips对话框显示出来
		var WHeight = $(window).height();
		var WWidth = parseInt($(window).width());
		if(WWidth < 960){
			$('.m960tips').show();
			$('#bakg').css("height",WHeight);
			$('#bakg').show();
			$('.m960tips').css("z-index","999");
			$('.navcon').css("z-index","999");
		}
	}
})



