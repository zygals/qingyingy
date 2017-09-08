<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>

    <head>
		<meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="renderer" content="webkit">
		<link rel="shortcut icon" href="/Public/images/favicon.ico" type="image/x-icon"/>
		<title><?php if($info['seotitle']): echo ($info['seotitle']); else: echo ($info["title"]); endif; ?> - <?php echo (C("sitename")); ?></title>
		<script type="text/javascript"  src="/Public/js/uaredirect.js"></script>
		<script type="text/javascript">uaredirect("<?php echo (C("wap_url")); echo U('/app/'.$info['aid']);?>");</script>
		<meta name="keywords" content="<?php if($info['keywords']): echo ($info['keywords']); else: echo ($info["tags"]); endif; ?>" />
		<meta name="description" content="<?php echo ($info["description"]); ?>" />
		<link rel="stylesheet" type="text/css" href="/Public/css/reseting.css" />
		<link rel="stylesheet" type="text/css" href="/Public/css/common.css" />
		<link rel="stylesheet" type="text/css" href="/Public/css/lite.css" />
		<link rel="stylesheet" type="text/css" href="/Public/css/list.css" />
		<link rel="stylesheet" type="text/css" href="/Public/js/layer/skin/default/layer.css">
		<script type="text/javascript" src="/Public/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="/Public/js/common.js" charset="utf-8"></script>
		<script type="text/javascript" src="/Public/js/layer/layer.js"></script>
	</head>

    <body>

<script type="text/javascript">
    $(function () {
        var w = ($(".imgsroll li").length * 149) - 8;
        if (w > 740) {
            $(".imgbox").addClass("overflow-x");
            $(".imgsroll").css("width", w);
        } else {
            $(".imgbox").removeClass("overflow-x");
        }
    });
</script>

<div class="body-container">

    			<div class="top_fixed">
            	<div align="center" style="padding: 5px 0px;border-bottom: 1px solid #f7f7f7">
                	<div class="s-bg-ffffff f-br5 g-h53 g-w500 f-ml30 f-cb" style="width:500px;height:33px; background:#f7f7f7">
                        <form action="/app/lists.html" method="get" id="search_form">
                            <span class="form-group f-ib f-fl">
                    	<input type="text" placeholder="搜索微信小程序或微信公众号" id="keyword" class=" input-lg f-mt5 f-fs1" style="width:360px;padding:3px 10px;background:#f7f7f7" name="keyword" style="border:0px;">
                    </span>
                    <span class="f-ib f-fr">
                    	<button type="submit" class="btn-danger" style="width:90px; height:33px; font-size:14px;">
                        	<span class="f-db f-pt5 f-pb5">
                            	<i><img src="/Public/images/search.png" class="f-ib" width="16"></i>
                            	<em class=" f-fwb">找应用</em>
                            </span>
                        </button>
                    </span>
                        </form>
                    </div>
                </div>
				<div class="top containers clear">
					<a href="/">
						<!-- <img class="img1" src="/Public/images/logo.png" /> -->
						<img class="img2" src="/Public/images/logo2.png" />
					</a>
                    <div class="fr">
                        <?php if($user): ?><a href="<?php echo U('/user/index');?>" class="avater fr" title="进入会员中心">
							<span>
								<img onload="setImgWH(this)" src="<?php echo ($user["head"]); ?>" style="width: 100%;">
							</span>
                            </a>
                            <?php else: ?>
                            <a class="fr login">登录</a><?php endif; ?>
                        <!--<div class="searchbox">
                            <form id="search_form" action="<?php echo U('app/lists');?>" method="get">
                                <input type="text" name="keyword" id="keyword" value="" placeholder="搜索微信小程序"
                                />
                                <a onclick="$('#search_form').submit();">
                                    <label>
                                    </label>
                                </a>
                            </form>
                        </div>-->
                    </div>
					<div class="nav clear">
						<a class="<?php if(CONTROLLER_NAME == 'Index'): ?>active<?php endif; ?>" href="/">首页</a>
						<!--<a class="<?php if(CONTROLLER_NAME == 'Charts'): ?>active<?php endif; ?>" href="<?php echo U('/charts');?>">排行榜</a>-->
						<a class="<?php if(CONTROLLER_NAME == 'App'): ?>active<?php endif; ?>" href="<?php echo U('/app');?>">轻应用商店</a>
						<a class="<?php if(CONTROLLER_NAME == 'Special'): ?>active<?php endif; ?>" href="<?php echo U('/special');?>">专题</a>
						<a class="<?php if(CONTROLLER_NAME == 'News'): ?>active<?php endif; ?>" href="<?php echo U('/news');?>">文章</a>
						<a class="<?php if(CONTROLLER_NAME == 'Eva'): ?>active<?php endif; ?>" href="<?php echo U('/eva');?>">评测</a>
                        <a class="<?php if(CONTROLLER_NAME == 'apply'): ?>active<?php endif; ?>" href="/user/index/apply/"><span>上传</span> <span class="f-ib "><img src="/Public/images/upload_img.png"></span></a>
					</div>

				</div>
			</div>
			<!--登录弹窗的dom-->
			<div class="loginbox">
				<a href="/">
					<img class="logo1" src="/Public/images/logo2.png" />
				</a>
				<div class="hr">
					<p>登录/注册</p>
				</div>
				<div class="login-way">
					<a href="<?php echo U('/User/index/login?type=qq&ref='.refersh_url());?>">
						<span class="qq"></span>
						<p>QQ</p>
					</a>
					<a href="<?php echo U('/User/index/login?type=sina&ref='.refersh_url());?>">
						<span class="wb"></span>
						<p>微博</p>
					</a>
				</div>
			</div>
			<script type="text/javascript">
           
            $(function () {
               
                //登录弹窗
                $(".login").click(function () {
                    showLogin();
                })
            });

            function showLogin() {
                layer.open({
                    type: 1,
                    title: '',
                    area: ['408px', 'auto'],
                    closeBtn: 1,
                    shadeClose: true, //开启遮罩关闭
                    content: $('.loginbox')
                });
            }
        </script>


    <div class="title_common containers">
        <a href="/">首页</a>
        <label></label>
        <a href="<?php echo U('/app/');?>">轻应用商店</a>
        <label></label>
        <span><?php echo ($info["title"]); ?></span>
    </div>
    <div class="detailbox containers clear">
        <div class="detailLeft fl">
            <div class="data clear">
                <div class="img fl">
                    <img onload="setImgWH(this)" src="<?php echo ($info["thumbnail"]); ?>"/>
                </div>
                <div class="dataList fl">
					<div class="clear">
						<h3 class="fl"><?php echo ($info["title"]); ?></h3>
						<div class="score-show2 fl"><span><i style="width: <?php echo ($info["width"]); ?>%;"></i></span><p><?php echo ($info["score"]); ?></p></div>
						<span class="fr view-count"><label></label><?php echo ($info["n"]); ?></span>
					</div>
					<p>分类：<?php echo ($catename); ?></p>
					<p>标签：<?php echo ($tags); ?></p>
					
                </div>
            </div>
            <div class="detaltext">						
                <div class="lite_detail clear">
                    <div class="lite-text fl">
                        <h3><label></label><?php echo ($info["title"]); ?> 信息</h3>
                        <div class="fl">
                            <p>作者</p>
                            <p>发布时间</p>
                            <p>查看要求</p>
                        </div>
                        <div class="fl">
                            <p><?php echo ($info["zuozhe"]); ?></p>
                            <p><?php echo (date('Y-m-d',$info["t"])); ?></p>
                            <p><?php echo ((isset($info["yaoqiu"]) && ($info["yaoqiu"] !== ""))?($info["yaoqiu"]):'微信最新版本客户端，6.5.3 版本以上。'); ?></p>
                        </div>
                    </div>
					<div class="lite-code fr" style="width:180px">
                       <div>
                       		 <img src="<?php echo ((isset($info["qrcode"]) && ($info["qrcode"] !== ""))?($info["qrcode"]):'/Public/images/default_qrcode.png'); ?>"/>
                        	 <p>小程序二维码</p>
                       </div>
                       <div style="margin-top:10px;">
                       		<img src="<?php echo ((isset($info["open_qrcode"]) && ($info["open_qrcode"] !== ""))?($info["open_qrcode"]):'/Public/images/default_gzh_qrcode.png'); ?>"/>
                        	<p>公众号二维码</p>
                       </div>
                    </div>
					 
                    
                </div>
                <h3><label></label><?php echo ($info["title"]); ?> 介绍</h3>
                <p><?php echo ($info["description"]); ?></p>
                <h3><label></label><?php echo ($info["title"]); ?> 截图</h3>
                <div class="imgbox">
                    <ul class="imgsroll clear">
						<?php $info[screen]=trim($info[screen],'|'); $arr=explode('|',$info[screen]); foreach($arr as $v){ echo '<li><img onload="setImgWH(this)" src="'.$v.'"/></li>'; } ?>
					</ul>
                </div>

				<h3><label></label><?php echo ($info["title"]); ?> 评分</h3>
				<div class="mark clear">
					<div class="mark-left fl">
						<div class="num fl"><?php echo ($info["score"]); ?></div>
						<div class="fl many">
							<div class="score-detail clear">
								<div class="scoreblack">
									<div style="width: <?php echo ($info["width"]); ?>%;" class="scorelight"></div>
								</div>
							</div>
							<p>共<?php echo ($snum); ?>人参与评分</p>
						</div>
					</div>
					<div class="mark-right fl">
						<div>
							<label>5星</label>
							<div class="bar">
								<div style="width: <?php echo ($sinfo[5]['width']); ?>%;" class="bar-active"></div>
							</div>
							<span><?php echo ($sinfo[5]['num']); ?>条</span>
						</div>
						<div>
							<label>4星</label>
							<div class="bar">
								<div style="width: <?php echo ($sinfo[4]['width']); ?>%;" class="bar-active"></div>
							</div>
							<span><?php echo ($sinfo[4]['num']); ?>条</span>
						</div>
						<div>
							<label>3星</label>
							<div class="bar">
								<div style="width: <?php echo ($sinfo[3]['width']); ?>%;" class="bar-active"></div>
							</div>
							<span><?php echo ($sinfo[3]['num']); ?>条</span>
						</div>
						<div>
							<label>2星</label>
							<div class="bar">
								<div style="width: <?php echo ($sinfo[2]['width']); ?>%;" class="bar-active"></div>
							</div>
							<span><?php echo ($sinfo[2]['num']); ?>条</span>
						</div>
						<div>
							<label>1星</label>
							<div class="bar">
								<div style="width: <?php echo ($sinfo[1]['width']); ?>%;" class="bar-active"></div>
							</div>
							<span><?php echo ($sinfo[1]['num']); ?>条</span>
						</div>
					</div>
				</div>
				<?php if(!$hasScore): ?><div class="score-box text-center clear">
					<p class="fl">请给小程序评分吧</p>
					<ul class="grade clear score">
						<li title="很差"><span></span></li>
						<li title="较差"><span></span></li>
						<li title="还行"><span></span></li>
						<li title="推荐"><span></span></li>
						<li title="力荐"><span></span></li>									
					</ul>
					<input type="hidden" value="" name="score" id="score">
					<a id="save" class="btn">确认评分</a>
					<script type="text/javascript">
						$(function () {
							// 评分的js
							var n = 0
							var m = 0
							$(".score li").click(function () {
								n = $(this).index()
								$(".score span").removeClass("active")
								$(".score span:lt(" + (n + 1) + ")").addClass('active')
								$('#score').val(n + 1);
							})
							$(".score li").mouseenter(function () {
								m = $(this).index()
								$(".score span:lt(" + (m + 1) + ")").addClass('active2')
							})
							$(".score li").mouseleave(function () {
								m = $(this).index()
								$(".score span:lt(" + (m + 1) + ")").removeClass('active2')
							})

							// 评分
							$('#save').click(function () {
								var cid = '<?php echo ($info["aid"]); ?>';
								var score = $('#score').val();
								if (!score) {
									layer.msg('您还未打分！');
									return;
								}
								$.post("<?php echo U('app/doScore');?>", {cid: cid, score: score}, function (msg) {
									if (msg.status == 2) {
										showLogin();return;
									}
									if(msg.status == 1 ){
										window.location.reload();
									}
									if(msg.status == 0 ){
										$('#save').remove();
									}
									layer.msg(msg.info);
								});
							});
						})
					</script> 
				</div><?php endif; ?>
				
            </div>
            <div class="comment-common" style="margin-left:40px; margin-right: 40px;">


                <!--PC版-->
				<?php if(C('open_cy') == '1'): ?><h3><label></label>评论</h3>
                    <div class="editbox" style="margin-top: 10px">
                        <textarea placeholder="说说你的看法吧" class="textarea" id="message_content"></textarea>
                    </div>
                    <div class="clear">
                        <a href="javascript:void(0)" class="editBtn fr commentBtn" id="message_btn">评论</a>
                    </div>
                    <div class="comment-list" id="thelist">

                    </div>
                    <script>
                        getMsg();
                        $('#message_btn').click(function () {

                            insert_msg(0,$('#message_content').val());
                        });

                        function insert_msg(pid,content){
                            var cid = "<?php echo ($info["aid"]); ?>";
                            var titles = "<?php echo ($info["title"]); ?>";
                            if(content){
                                var json_text = {"catid": cid, "type":1,"pid":pid,"title":titles,"content":content};
                                $.post("<?php echo U('app/doMessage');?>", json_text, function (msg) {
                                    if (msg.status == 2) {
                                        showLogin();return;
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
                                       thelist_html += '<div class="comment clear"><a class="avater-comment fl"><img src="'+n.head_big+'" onload="setImgWH(this)" style="width: 100%;"></a>';
                                       thelist_html += '<div class="data-comment"><div class="name-comment clear"><h4 class="fl">'+n.name+'</h4><span class="fl">'+n.createtime+'</span><a class="fr reply" onclick="reply_s(this)">回复</a></div><p>'+n.content+'</p>';
                                           $(msg.list).each(function(ii,nn){
                                               if(n.id==nn.pid){

                                                   thelist_html += '<div class="has-reply"><p class="name">'+nn.name+'</p><p>'+nn.content+'</p></div>';
                                               }

                                           });

                                       thelist_html += '<div class="reply-content" style="display:none"><textarea rows="1" class="re-textarea" id="comment_'+ n.id+'"></textarea><div class="clear"><a data-pid="'+n.id+'" class="editBtn fr active replayBtn">回复</a><a onclick="closeReply(this);" class="cancel fr">取消</a></div></div></div></div>';
                                       }
                                   });
                                    $('#thelist').html(thelist_html);

                                    $('#thelist .replayBtn').off("click").on("click",function(){
                                        var this_pidTemp = $(this).data('pid');
                                        insert_msg(this_pidTemp,$('#comment_'+this_pidTemp).val());
                                    });
                                }


                            });
                        }

                        function reply_s(ef){
                            var this_pp = $(ef).parent().parent();
                            this_pp.find('.reply-content').show();
                            this_pp.find('.re-textarea').val('');

                        }
                        function closeReply(ef2){
                            $(ef2).parent().parent().hide();
                        }
                    </script><?php endif; ?>

            </div>
        </div>
        		<div class="articleRight">
            <div class="switch-right">
			<div class="switch-tops clear"><a><span>发布</span></a><a><span>关注我们</span></a><span><span></span></span></div>
			<div class="content r-release"><a class="applyBtn"><label class="rse"></label><p>发布小程序</p></a><span class="subBtn"><label class="ar"></label><p>文章投稿</p><div class="submit-pop"><span class="closePOP"></span><p>投稿邮箱：</p><p><?php echo (C("email")); ?></p></div></span></div><div class="content r-attent"><span class="wxBtn"><label class="wx"></label><p>官方微信</p><div class="wx-pop"><span class="closePOP"></span><img src="/Public/images/code-weixin.png"/><p>扫一扫关注 小程序官方微信</p></div></span><a href="<?php echo (C("weibo")); ?>" target="_blank"><label class="wb"></label><p>新浪微博</p></a></div><!--<div class="content r-code"><img class="fl" src=""/><div class="fl"><p>扫一扫</p><span>( 暂不支持下载 )</span></div></div>--></div><script type="text/javascript">
    $(function () {
        $(".switch-right .content").eq(0).show();
        $(".switch-tops a").eq(0).addClass("active");
        $(".switch-tops a").eq(2).find("span").addClass("active")
        var n = 0;
        var flag = true;
        var flag2 = true;
        $(".switch-tops a").click(function () {
            n = $(this).index();
            if (n == 0) {
                $(".switch-tops a span").removeClass("active")
                $(".switch-tops a").eq(2).find("span").addClass("active")
            } else if (n == 2) {
                $(".switch-tops a span").removeClass("active")
                $(".switch-tops a").eq(1).find("span").addClass("active")
            } else if (n == 1) {
                $(".switch-tops a span").removeClass("active")
            }
            $(".switch-right .content").hide().eq(n).show();
            $(".switch-tops a").removeClass("active").eq(n).addClass("active")
        })

        $(".closePOP").click(function (event) {
            event.stopPropagation()
            $(this).parent().hide()
        })
        $(".subBtn").click(function () {
            if (flag) {
                $(".submit-pop").show()
            } else {
                $(".submit-pop").hide()
            }
            flag = !flag
        })
        $(".wxBtn").click(function () {
            if (flag2) {
                $(".wx-pop").show()
            } else {
                $(".wx-pop").hide()
            }
            flag2 = !flag2
        })
    })
</script>
		<div class="right-content">
			<h2><label></label>相关推荐</h2>
            <div class="lite-new">
				<?php $keynames = explode(',',$info['tags']); $keynames_2 = array(); foreach ($keynames as $key => $value) { array_push($keynames_2,'%'.$value.'%'); } $map['tags'] =array('like',$keynames_2,'OR'); $map['sid'] =$info['sid']; $newnews=M('app')->where($map)->order('n desc')->limit(5)->select(); ?>
				<?php if(is_array($newnews)): $i = 0; $__LIST__ = $newnews;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('/app/'.$vo[aid]);?>" class="clear">
					<div class="img-new">
						<img onload="setImgWH(this)" src="<?php echo ($vo["thumbnail"]); ?>"/>
					</div>
					<div class="data-new"><?php echo ($vo["title"]); ?></div>
					<p>标签：<?php echo (mb_substr($vo["tags"],0,9,'utf-8')); ?></p>
				</a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="right-content">
            <h2><label></label>热门轻应用</h2>
            <div class="lite-new">
                <?php $newapp=M('app')->cache('indextoplist',1800)->where("status=1")->order('n desc')->limit(5)->select(); ?>
				<?php if(is_array($newapp)): $i = 0; $__LIST__ = $newapp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('/app/'.$vo[aid]);?>" class="clear">
					<div class="img-new">
						<img onload="setImgWH(this)" src="<?php echo ($vo["thumbnail"]); ?>"/>
					</div>
					<div class="data-new"><?php echo ($vo["title"]); ?></div>
					<p>标签：<?php echo (mb_substr($vo["tags"],0,9,'utf-8')); ?></p>
				</a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		
		<div class="right-content">
            <h2><label></label>最新轻应用</h2>
            <div class="lite-new">
                <?php $newapp=M('app')->cache('right_new_app',1800)->where("status=1")->order('aid desc')->limit(5)->select(); ?>
				<?php if(is_array($newapp)): $i = 0; $__LIST__ = $newapp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('/app/'.$vo[aid]);?>" class="clear">
					<div class="img-new">
						<img onload="setImgWH(this)" src="<?php echo ($vo["thumbnail"]); ?>"/>
					</div>
					<div class="data-new"><?php echo ($vo["title"]); ?></div>
					<p>标签：<?php echo (mb_substr($vo["tags"],0,9,'utf-8')); ?></p>
				</a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</div>
    </div>

    	 	<style>
			.links_links{border: 1px solid #f4f4f4; padding:12px;}
        	.links_links ul li{ float:left; padding:1px 5px; margin:5px 0px; border-right:solid 1px #f4f4f4;}
			.links_links a:hover{
				color: #22bb62;
			}

        </style>
        <div class="containers f-mt20">
        	<?php $links_s=M('links')->order('o asc')->select(); ?>
        	<div class="links_links">
            	<ul class="f-cb">
                	<?php if(is_array($links_s)): $i = 0; $__LIST__ = $links_s;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                	
                </ul>
            </div>
        	
            
        </div>
        <!-- footer begin -->
        <footer class="s-bg-f4f4f4 f-mt20 g-w-min1200">
            <div class="m-list-nav">
                <a href="<?php echo U('/app');?>">轻应用商店</a>
                <a href="<?php echo U('/news');?>">文章</a>
                <a href="<?php echo U('/eva');?>">测评</a>
                <a href="/news/2.html">媒体报道</a>
                <a href="/news/1.html">联系我们</a>
            </div>
            <div class="s-lh25 s-c-bbbbbb f-tac f-pt25 f-pb25">
                <?php echo (C("footer")); ?>
            </div>
			<div align="center">
				<span style="display:inline-table; margin-right:10px;">
					<a href="http://webscan.360.cn/index/checkwebsite/url/www.qingyy.net" target="_blank">
<!-- <img border="0" src="http://img.webscan.360.cn/status/pai/hash/5ee33ae815b664277ef1f30ba11ab085" style="width:95px;"/> -->
 <img border="0" src="/Public/images/safe360.png" style="width:95px;"/>

</a>
				</span>
				<span style="display:inline-table;">
<!--<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1261757344'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1261757344%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script> -->
					<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1261757344'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1261757344%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script> 
				</span>
			</div>
        </footer>
        <!-- footer end -->
		<div style="position:fixed;right:0;bottom:0;width:300px;height:250px;z-index:1000000;">
			<span style="position:absolute;right:0;top:-30px;font-size:24px;cursor:pointer;" onclick="$(this).parent().remove()">×</span>
			<?php echo ad(2);?>
		</div>
		



</div>

<div class="alert">
    <div class="imgs">
        <div class="close"></div>									
        <p>Pic <span id="index"></span> of <span id="count"></span></p>
        <a class="pre"><span></span></a>
        <a class="next"><span></span></a>
        <img src=""/>
    </div>
</div>

<!-- JiaThis Button BEGIN -->
<div class="jiathis_style_32x32 jiashare">
    <a title="分享QQ空间" class="jiathis_button_qzone"></a>
    <a title="分享QQ好友" class="jiathis_button_cqq"></a>
    <a title="分享微博" class="jiathis_button_tsina"></a>
    <a title="分享微信" class="jiathis_button_weixin"></a>
    <a title="分享豆瓣" class="jiathis_button_douban"></a>
    <a title="复制地址" class="jiathis_button_copy"></a>
</div>
<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
<script type="text/javascript">
    $(function () {
        //二维码显示隐藏
        $(".help-tip .weixin-tip").hover(function () {
            $(".codepop").eq(0).stop(true, true).fadeToggle();
        });
        $(".help-tip .phone-tip").hover(function () {
            $(".codepop").eq(1).stop(true, true).fadeToggle();
        });
    });
    $(function () {
        var wWidth = $(window).width();
        var wHeight = $(window).height();
        var Top = wHeight / 2 - 98;
        if (wWidth < 980) {
            imgLeft = (wWidth - 980) - 118;
        } else {
            imgLeft = (wWidth - 980) / 2 - 168;
        }
        //$(".fixed_box").css("top", Top);
        $(".jiashare").css("left", imgLeft);
        $(window).resize(function () {
            var wHeight = $(window).height();
            var Top = wHeight / 2 - 98;
            var wWidth = $(window).width();
            if (wWidth < 980) {
                imgLeft = (wWidth - 980) - 118;
            } else {
                imgLeft = (wWidth - 980) / 2 - 118;
            }
            //$(".fixed_box").css("top", Top);
            $(".jiashare").css("left", imgLeft);
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        //图片弹窗
        var H = $(window).height()
        $(".imgs").css({"height": H * .7, "width": H * .7 / 1.78, "marginLeft": H * .7 / 1.78 / 2 * -1, "marginTop": H * .7 / 2 * -1})
        var $index = 0;
        var imgSrc = '';
        var flag = true
        $(".imgsroll li").click(function () {
            $(".imgs a").show()
            $index = $(this).index();
            $(".alert").fadeIn()
            imgSrc = $(".imgsroll li").eq($index).find("img").attr("src");
            $(".imgs img").attr("src", imgSrc)
            $("#index").html($index + 1)
            $("#count").html($(".imgsroll li").length)
            if ($index == 0) {
                $(".imgs .pre").hide()
            }
            if ($index == $(".imgsroll li").length - 1) {
                $(".imgs .next").hide()
            }
        })
        $(".imgs .next").click(function () {
            $index++;
            imgSrc = $(".imgsroll li").eq($index).find("img").attr("src");
            $(".imgs img").attr("src", imgSrc)
            if ($index == $(".imgsroll li").length - 1) {
                $(".imgs .next").hide()
            }
            $(".imgs .pre").show()
            $("#index").html($index + 1)
            $("#count").html($(".imgsroll li").length)
        })
        $(".imgs .pre").click(function () {
            $index--;
            if ($index == 0) {
                $(".imgs .pre").hide()
            }
            imgSrc = $(".imgsroll li").eq($index).find("img").attr("src");
            $(".imgs img").attr("src", imgSrc)
            $(".imgs .next").show()
            $("#index").html($index + 1)
            $("#count").html($(".imgsroll li").length)
        })
        $(".imgs a").click(function () {
            if (flag) {
                $(".imgs").addClass("opacityStyle")
                $(".imgs img").removeClass("opacityStyle")
            } else {
                $(".imgs img").addClass("opacityStyle")
                $(".imgs").removeClass("opacityStyle")
            }
            flag = !flag
        })
        $(".alert").click(function (e) {
            $(".alert").fadeOut()
        })
        $(".imgs .close").click(function () {
            $(".alert").fadeOut()
        })
        $(".imgs").click(function (e) {
            e.stopPropagation()
        })
    })
</script>

    </body>
</html>