<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta id="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	<link rel="shortcut icon" href="/Public/m/images/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon-precomposed" href="<?php echo ($info["thumbnail"]); ?>"/>
    <title><?php if($info['seotitle']): echo ($info['seotitle']); else: echo ($info["title"]); endif; ?> - <?php echo (C("sitename")); ?></title>
    <meta name="keywords" content="<?php echo ($info["keywords"]); ?>" />
    <meta name="description" content="<?php echo ($info["description"]); ?>" />
	<link rel="stylesheet" type="text/css" href="/Public/m/css/reset.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/m/css/layout.css?1.0.47">
	<link rel="stylesheet" type="text/css" href="/Public/m/css/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/page.css">
	<script type="text/javascript" src="/Public/m/js/adaptive-version.js"></script>
	<script type="text/javascript" src="/Public/m/js/jquery.min.js"></script>
</head>
<body>

	<div class="page">
		<div class="m-top white b-bottom-e5">
			<h2><a href="/" class="logo"></a></h2>
			<?php if($user): ?><a href="<?php echo U('app/apply');?>" class="btn left">
				<div class="user">
					<span>
						<i><img src="/Public/m/images/add.png" alt="发布小程序"></i>
					</span>
				</div>
			</a>
			<?php else: ?>
			<a href="<?php echo U('public/login');?>" class="btn left">
				<div class="user">
					<span>
						<i><img src="/Public/m/images/user-icon.png"></i>
					</span>
				</div>
			</a><?php endif; ?>
			<a href="javascript:;" class="btn right headDropMenu"></a>
		</div>
		<div class="m-container top" style="bottom: 1.1rem;">
			<div class="m-sub">
				<div class="objects">
					<div class="list list13 b-bottom-e5">
						<a href="javascript:;" class="btn fr copyBtn" data-clipboard-text="<?php echo ($info["title"]); ?>" onclick="showtip('<?php echo ($info["title"]); ?>','<?php echo ($info["thumbnail"]); ?>','')">进入</a>
						<a href="javascript:;" title="<?php echo ($info["title"]); ?>" class="left">
							<span class="obj-img fl">
								<img src="<?php echo ($info["thumbnail"]); ?>" alt="<?php echo ($info["title"]); ?>">
							</span>
							<div class="mid">
								<div class="title elps"><?php echo ($info["title"]); ?></div>
								<p class="author">分类：<?php echo ($catename); ?></p>
								<p class="author">热度：<?php echo ($info["n"]); ?></p>
								<div class="author"><div class="star"><div class="star-inner" style="width: 84%;"></div></div></div>
							</div>
						</a>
						
					</div>
				</div>

				<div class="tag-title">
					<div class="color fl"></div><?php echo ($info["title"]); ?> 介绍
				</div>
				<div class="tag-content wx-info-content height">
					<?php echo ($info["description"]); ?>
				</div>
	
				<div class="tag-title">
					<div class="color fl"></div><?php echo ($info["title"]); ?> 截图
				</div>
				<div class="cut-wrap">
					<div class="cut-imgs">
						<div class="line c-img"></div>
						<?php $info[screen]=trim($info[screen],'|'); $arr=explode('|',$info[screen]); foreach($arr as $k=>$v){ echo '<span class="c-img"><img src="'.$v.'" alt="'.$info['title'].'截图-'.$k.'" bigimg="'.$v.'"/></span>'; } ?>
											
						
						<div class="line c-img"></div>
					</div>
				</div>
				
				 
				<div class="guide-wrap">
				 
					 
					<div class="guide">
						<p class="text">一键直达小程序！</p>
					</div>
					<div class="guid-ewm">
						<span><img src="<?php echo ((isset($info["qrcode"]) && ($info["qrcode"] !== ""))?($info["qrcode"]):'/Public/images/default_qrcode.png'); ?>" alt="<?php echo (C("sitename")); ?>公众号二维码"></span>
						<p>长按保存二维码</p>
					</div>
                    <div class="guide">
						<p class="text">一键关注我们！</p>
					</div>
					<div class="guid-ewm">
						<span><img src="<?php echo ((isset($info["open_qrcode"]) && ($info["open_qrcode"] !== ""))?($info["open_qrcode"]):'/Public/images/default_gzh_qrcode.png'); ?>" alt="<?php echo (C("sitename")); ?>公众号二维码"></span>
						<p>长按保存二维码</p>
					</div>
					
				</div>
				<div class="tag-title" style="margin-bottom: .2rem;">
					<div class="color fl"></div><?php echo ($info["title"]); ?> 评分
				</div>
				<div class="score-wrap clear">
					<div class="score-left">
						<span class="score"><?php echo ($info["score"]); ?></span>
						<div class="star-wrap">
							<div class="star"><div class="star-inner" style="width: <?php echo ($info["width"]); ?>%;"></div></div>
							<p>共<?php echo ($snum); ?>个评分</p>
						</div>
					</div>
					<div class="score-right">
						<div class="list"><label class="text">5星</label><div class="progress"><div class="inner" style="width: <?php echo ($sinfo[5]['width']); ?>%;"></div></div><label class="count"><?php echo ($sinfo[5]['num']); ?>条</label></div>
						<div class="list"><label class="text">4星</label><div class="progress"><div class="inner" style="width: <?php echo ($sinfo[4]['width']); ?>%;"></div></div><label class="count"><?php echo ($sinfo[4]['num']); ?>条</label></div>
						<div class="list"><label class="text">3星</label><div class="progress"><div class="inner" style="width: <?php echo ($sinfo[3]['width']); ?>%;"></div></div><label class="count"><?php echo ($sinfo[3]['num']); ?>条</label></div>
						<div class="list"><label class="text">2星</label><div class="progress"><div class="inner" style="width: <?php echo ($sinfo[2]['width']); ?>%;"></div></div><label class="count"><?php echo ($sinfo[2]['num']); ?>条</label></div>
						<div class="list"><label class="text">1星</label><div class="progress"><div class="inner" style="width: <?php echo ($sinfo[1]['width']); ?>%;"></div></div><label class="count"><?php echo ($sinfo[1]['num']); ?>条</label></div>
					</div>
				</div>

				<div class="big-score-model clear">
					<h2>请给小程序评分吧</h2>
					<div class="big-star">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>	
				
				<div style="margin: 10px 0px;">
					<!--WAP版-->
					<?php if(C('open_cy') == '1'): ?><div class="tag-title clear discuss-model">
                            <div class="color fl"></div>全部评论
                        </div>
                        <div class="discuss">
                            <div id="thelist">
                            </div>
                        </div>
                        <div class="m-bottom recommend b-top-e5">
                            <div class="input" contenteditable="true"></div>
                            <a href="javascript:;" class="btn"></a>
                        </div><?php endif; ?>
				</div>
				
			</div>
		</div>
		
		
		<div class="cut-preivew">
			<span class="close"></span>
			<div class="bbb">
				<div class="swiper-container imgs-wrap">
					<div class="swiper-wrapper imgs">
						<div class="swiper-slide"><img src="" alt="<?php echo ($info["title"]); ?>截图-原图0"></div><div class="swiper-slide"><img src="" alt="<?php echo ($info["title"]); ?>截图-原图1"></div><div class="swiper-slide"><img src="" alt="<?php echo ($info["title"]); ?>截图-原图2"></div>					</div>
					<div class="pagination"></div>
				</div>
			</div>
		</div>
		
		<div class="headDropMenuLayer">
			<div class="headDropMenuContent clear">
				<a href="/" title="小程序精品推荐"><span class="d_recommend"></span><p>精品推荐</p></a>
				<a href="<?php echo U('/app/category/');?>" title="小程序分类"><span class="d_classify"></span><p>类别</p></a>
				<a href="<?php echo U('app/apply');?>" title="小程序发布"><span class="d_ranking"></span><p>发布</p></a>
				<a href="<?php echo U('/eva/');?>" title="小程序资讯"><span class="d_article"></span><p>测评</p></a>
				<a href="<?php echo U('/special/');?>" title="小程序专题"><span class="d_special"></span><p>专题</p></a>
				<a href="<?php echo U('/search/');?>" title="小程序搜索"><span class="d_search"></span><p>搜索</p></a>
			</div>
		</div>
				<div class="copy-laye"></div>
		<div class="copy-laye-content copy-laye-show-1" style="bottom:0px;">
			<span class="ewm">
				<img src="" alt="">
			</span>
			<p class="name"></p>
			<p class="copy-tip">长按二维码体验小程序</p>
			<div class="tip-img">
				<img src="<?php echo ((isset($info["qrcode"]) && ($info["qrcode"] !== ""))?($info["qrcode"]):'/Public/images/default_qrcode.png'); ?>" alt="<?php echo (C("sitename")); ?>公众号二维码"  style="width:150px">
			</div>
			
		</div>
		<div class="copy-laye-content copy-laye-show-2">
			<span class="ewm">
				<img src="" alt="">
			</span>
			<p class="name"></p>
			<p class="copy-tip">长按二维码体验小程序</p>
			 
			<div class="tip-img">
				<img src="<?php echo ((isset($info["qrcode"]) && ($info["qrcode"] !== ""))?($info["qrcode"]):'/Public/images/default_qrcode.png'); ?>" alt="<?php echo (C("sitename")); ?>公众号二维码" style="width:150px">
			</div>
			
		</div>
	</div>
	
	<script type="text/javascript" src="/Public/m/js/touch-0.2.14.min.js"></script>
	<script type="text/javascript" src="/Public/m/js/clipboard.min.js?1.0.14"></script>
	<script type="text/javascript" src="/Public/m/js/common.min.js?1.0.24"></script>
	<script type="text/javascript" src="/Public/m/js/swiper.min.js"></script>


<link rel="stylesheet" type="text/css" href="/Public/js/layer/skin/default/layer.css">
<script type="text/javascript" src="/Public/js/layer/layer.js"></script>
<script type="text/javascript">
var uid = "<?php echo cookie('uid');?>";
var my_score = '<?php echo ($hasScore); ?>';
var cid = '<?php echo ($info["aid"]); ?>';
$(function(){
	if(my_score > 0){
		$('.big-star span:lt('+ my_score +')').addClass('active');
	}
	$('.cut-wrap').click(function() {				
		$('.cut-preivew').show();
		for(i=0;i<$('.cut-wrap img').length;i++){
			$('.cut-preivew img').eq(i).attr("src",$('.cut-wrap img').eq(i).attr("bigimg"))
		}
		var mySwiper = new Swiper('.imgs-wrap', {
			calculateHeight: true,
			noSwiping : true,
			slidesPerView: 'auto',
			loop: true,
			pagination : '.pagination',
		});
	});
	$('.cut-preivew .close').click(function() {
		$('.cut-preivew').hide();
	});

    getMsg();
	$('.m-bottom .btn').click(function(){
        /*if(uid <= 0){
            window.location.href = "<?php echo U('/public/login');?>";
            return false;
        }*/
        if($('.input').text()){
            insert_msg(0,$('.input').text());
        }else{

            $('.m-container').stop().animate({
                scrollTop: $('.discuss-model').position().top + $('.m-container').scrollTop()
            }, 500);
        }

	});


	
	$('body').on('tap', '.big-star span', function(){
		if(uid <= 0){
			window.location.href = "<?php echo U('/public/login');?>";
			return false;
		}
		if(my_score > 0){
            layer.msg('您已经给"<?php echo ($info["title"]); ?>"评分了');
            return false;
		}
		var score = $(this).index() + 1;
		if(!window.confirm('确认给我评' + score + '星？'))return;

        $.post("<?php echo U('/app/doScore');?>", {cid:cid,score:score}, function (msg) {
            if (msg.status == 1) {
        		$('.big-star span').removeClass('active');
        		$('.big-star span:lt('+ score +')').addClass('active');
            } else {
                layer.msg(msg.info);
            }
        });
	});
	
	
});

function insert_msg(pid,content){
    var cid = "<?php echo ($info["aid"]); ?>";
    var titles = "<?php echo ($info["title"]); ?>";
    if(content){
        var json_text = {"catid": cid, "type":1,"pid":pid,"title":titles,"content":content};
        $.post("<?php echo U('app/doMessage');?>", json_text, function (msg) {
            if (msg.status == 2) {
                window.location.href = "<?php echo U('/public/login');?>";
                return false;
            }
            if(msg.status == 1 ){
                $('#thelist textarea').val('');
                getMsg();
            }

            layer.msg(msg.info);
        });
    }else{
        layer.msg('留言不能为空！');
    }
}

function getMsg(){
    var cid = "<?php echo ($info["aid"]); ?>";
    var json_text = {"catid": cid, "type":1};
    $.post("<?php echo U('app/doMessagelist');?>", json_text, function (msg) {
        if (msg.status == 2) {
            showLogin();return;
        }
        if(msg.status == 1 ){
            var thelist_html = '';
            $(msg.list).each(function(i,n){
                if(n.pid==0){
                    thelist_html += '<div class="list"><div class="list-top"><span class="user"><img src="'+n.head_big+'"></span><div class="right"><div class="group"><div class="name">'+n.name+'<a class="reply" href="javascript:;" onclick="reply_s(this)">回复</a></div> <p class="time">'+n.createtime+'</p></div></div></div><div class="content"><p>'+n.content+'</p></div>';

                    $(msg.list).each(function(ii,nn){
                        if(n.id==nn.pid){

                            thelist_html += '<div class="one-reply"><p class="name">'+nn.name+'</p><p>'+nn.content+'</p></div>';
                        }

                    });

                    thelist_html += '<div class="recommend-mode" style="display:none;margin-top: 20px;"><textarea rows="1" class="re-textarea" id="comment_'+ n.id+'"></textarea><div class="bottom"><a data-pid="'+n.id+'" class="btn active"  style="margin-left:10px;">回复</a><a onclick="closeReply(this);" class="btn">取消</a></div></div></div></div>';
                }
            });
            $('#thelist').html(thelist_html);

            $('#thelist .recommend-mode .active').off("click").on("click",function(){
                var this_pidTemp = $(this).data('pid');
                insert_msg(this_pidTemp,$('#comment_'+this_pidTemp).val());
            });
        }


    });
}

function reply_s(ef){
    var this_pp = $(ef).parent().parent().parent().parent().parent();

    this_pp.find('.recommend-mode').show();
    this_pp.find('.re-textarea').val('');

}
function closeReply(ef2){
    $(ef2).parent().parent().hide();
}

</script>
	<script type="text/javascript">
	$(function(){
		if(window.navigator.userAgent.match(/MicroMessenger/i) ? true : false){
			$('.toweixin').hide();
		}
	});

	new Clipboard('.copyBtn').on('success', function(e) {
		var e = e || window.event;
		setTop('.copy-laye-show-1');
		e.clearSelection();
	}).on('error', function(e) {
		var e = e || window.event;
		setTop('.copy-laye-show-2');
		e.clearSelection();
	});
	$('.copy-laye').on('click', function(e){
		$('.copy-laye').hide();
		$('.copy-laye-content').hide(); 
		$('body').removeAttr('ontouchmove');
		
		e.preventDefault();
	});

	$('.copy-laye').click(function(e){
		if( $(e.target).hasClass('copy-laye') ){
			$('.copy-laye').hide();
			$('body').removeAttr('ontouchmove');
		}
		e.stopPropagation();
	});

	function showtip(title, icon, qrcode){
		$('.copy-laye-content .name').html(title);
		$('.copy-laye-content .ewm img').attr('src', icon);
	}
	</script>

	<script>
	(function(){
	    var bp = document.createElement('script');
	    var curProtocol = window.location.protocol.split(':')[0];
	    if (curProtocol === 'https') {
	        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
	    }
	    else {
	        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
	    }
	    var s = document.getElementsByTagName("script")[0];
	    s.parentNode.insertBefore(bp, s);
	})();
	</script>
<p style="display:none">
<?php echo (C("footer")); ?>
</p>
    </body>
</html>