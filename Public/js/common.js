//插入固定在右边的悬浮按钮
$(function () {
    var html = '<div class="fixed_box">'
            + '<a class="add-fixed applyBtn"><label></label><p>发布</p></a>'
           // + '<a href="/index/download/" class="load-fixed"><label></label><p>下载</p></a>'
            + '<a class="official"><label></label><p>官方微信</p><div class="official_pop"><p></p><span>扫一扫关注我们</span></div></a>'
            //+ '<a class="look_telephone"><label></label><p>手机访问</p><div class="telephone_pop"><p></p><span>扫一扫体验小程序</span></div></a>'
            + '<a class="to_top"><label></label></a>'
            + '</div>';
    $(".body-container").append(html);
    var wWidth = $(window).width();
    var wHeight = $(window).height();
    var imgLeft = 0;
    var scrollTop = 0;
    if ($(this).scrollTop() > 200) {
        $(".fixed_box .to_top").show()
    } else {
        $(".fixed_box .to_top").hide()
    }
    $(window).scroll(function () {
        scrollTop = $(this).scrollTop()
        if ($(this).scrollTop() > 200) {
            $(".fixed_box .to_top").fadeIn()
        } else {
            $(".fixed_box .to_top").fadeOut()
        }
    })

    $(".fixed_box").css("bottom", "100px")
    if (wWidth < 980) {
        imgLeft = (wWidth - 980) - 140;
    } else {
        imgLeft = (wWidth - 980) / 2 - 140
    }
    $(".fixed_box").css("right", '1px');
    $(window).resize(function () {
        wWidth = $(window).width();
        wHeight = $(window).height();
        if (wWidth < 980) {
            imgLeft = (wWidth - 980) - 140;
        } else {
            imgLeft = (wWidth - 980) / 2 - 140;
        }
        $(".fixed_box").css("bottom", "100px")
        $(".fixed_box").css("right", '1px');
    })
    //二维码显示
    $(".look_telephone").hover(function () {
        $(".telephone_pop").stop(true, true).fadeIn();
    }, function () {
        $(".telephone_pop").stop(true, true).fadeOut();
    })
    $(".official").hover(function () {
        $(".official_pop").stop(true, true).fadeIn();
    }, function () {
        $(".official_pop").stop(true, true).fadeOut();
    })
    //	回到顶部
    $(".to_top").click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 200);
    })
})

$(function () {
    $('.applyBtn').click(function(){
        window.open('/user/index/apply/','_blank');
    });
    $('.uploadBtns').click(function(){
        window.open('/user/index/apply/','_blank');
    });
});

//处理图片的宽高
function setImgWH(obj) {
    if (obj.width > obj.height) {
        $(obj).css('height', '100%');
    } else {
        $(obj).css('width', '100%');
    }
}

$(function () {
    //弹窗
    var H_ture = $(".switchbox .content").height();
    var flag = true;
    if (H_ture > 36) {
        $(".switchbox .content").css("height", "36px")
        $(".slideBtn a").click(function () {
            if (flag) {
                $(".switchbox .content").animate({
                    "height": H_ture
                })
                $(this).addClass("active")
            } else {
                $(".switchbox .content").animate({
                    "height": "36px"
                })
                $(this).removeClass("active")
            }
            flag = !flag;
        })
    }
    // 点击标签的效果
    $(".switchbox .content a").click(function () {
        $(".switchbox .content a").removeClass("active")
        $(this).addClass("active")
    })
})

$(function () {
    //图片变大变小
    $(".imgScale").on('mouseenter', '.content', function () {
        $(this).find("img").addClass("scale").removeClass("scale_return")
    });
    $(".imgScale").on('mouseleave', '.content', function () {
        $(this).find("img").addClass("scale_return").removeClass("scale")
    });
})

