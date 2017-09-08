<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="renderer" content="webkit">
        
        <meta name="baidu-site-verification" content="5CavClpnOL" />
		<link rel="shortcut icon" href="/Public/images/favicon.ico" type="image/x-icon"/>
		<title><?php echo (C("title")); ?></title>
		<script type="text/javascript"  src="/Public/js/uaredirect.js"></script>
		<script type="text/javascript">uaredirect("<?php echo (C("wap_url")); ?>");</script>

		<meta name="keywords" content="<?php echo (C("keywords")); ?>" />
		<meta name="description" content="<?php echo (C("description")); ?>" />
		<link rel="stylesheet" type="text/css" href="/Public/css/reseting.css" />
		<link rel="stylesheet" type="text/css" href="/Public/css/common.css" />
		<link rel="stylesheet" type="text/css" href="/Public/css/lite.css" />
		<link rel="stylesheet" type="text/css" href="/Public/js/layer/skin/default/layer.css">
		<script type="text/javascript" src="/Public/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="/Public/js/common.js" charset="utf-8"></script>

        <!--调用css文件夹里的 ssl.js-->
     <!-- <script type="text/javascript" src="/Public/css/ssl.js" charset="utf-8"></script> -->

		<script type="text/javascript" src="/Public/js/layer/layer.js"></script>

	</head>
	<body>
		<script type="text/javascript">
			$(function () {
        var k = 0

        $(".banner p").hide().eq(0).show();
        $(".b-pre").click(function () {
            clearInterval(autoSlide)
            k--;
            if (k < 0) {
                k = $(".banner p").length - 1;
            }
            $(".banner p").hide().eq(k).fadeIn(800);
            $(".dot span").removeClass("active").eq(k).addClass("active")
        })
        $(".b-next").click(function () {
            clearInterval(autoSlide)
            k++;
            if (k > $(".banner p").length - 1) {
                k = 0;
            }
            $(".banner p").hide().eq(k).fadeIn(800);
            $(".dot span").removeClass("active").eq(k).addClass("active")

        })
        $(".dot span").mouseenter(function () {
            k = $(this).index()
            $(".banner p").hide().eq(k).fadeIn(800);
            $(".dot span").removeClass("active").eq(k).addClass("active")
        })
        var autoSlide = setInterval(function () {
            k++;
            if (k > $(".banner p").length - 1) {
                k = 0;
            }
            $(".banner p").hide().eq(k).fadeIn(800);
            $(".dot span").removeClass("active").eq(k).addClass("active")
        }, 5000)

        $(".banner").mouseenter(function () {
            clearInterval(autoSlide)
        })
        $(".banner").mouseleave(function () {
            autoSlide = setInterval(function () {
                k++;
                if (k > $(".banner p").length - 1) {
                    k = 0;
                }
                $(".banner p").hide().eq(k).fadeIn(800);
                $(".dot span").removeClass("active").eq(k).addClass("active")
            }, 5000)
        })



    })
		</script>
		<div class="body-container-1">
						<div class="top_fixed">
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

			<div class="banner">
				<div class="left"><a class="b-pre"><i></i></a></div>
				<div class="right"><a class="b-next"><i></i></a></div>
				<div class="dot">
				<?php if(is_array($flash)): $i = 0; $__LIST__ = $flash;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="<?php if($key == 0): ?>active<?php endif; ?>"></span><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<?php if(is_array($flash)): $i = 0; $__LIST__ = $flash;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["url"]); ?>" target="_blank"><p><img src="<?php echo ($vo["pic"]); ?>" alt="<?php echo ($vo["title"]); ?>" height="403"></p></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
            <div class="containers" style="position: relative; z-index: 1000;margin-top: -112px;">
                <div class="search">

                </div>
                <div class="f-cb f-pt20 f-pb20" style="position: absolute;z-index: 1001;margin-top: -89px;">
                    <div class="f-ml50 g-w155 f-tac s-c-ffffff f-fl" >
                	<span class="f-db f-fs3 f-mt5">
                    	超过<span class="s-c-ff7101">3500</span>&nbsp;个小程序
                    </span>
                    <span class="f-db  f-fs3">
                    	在轻应用商店注册
                    </span>
                    </div>
                    <div class="s-bg-ffffff f-br5 g-h53 g-w895 f-ml30 f-fl f-cb">
                        <form id="search_form" method="get" action="/app/lists.html">
                            <span class="form-group f-ib f-fl">
                    	<input type="text" style="border:0px;" name="keyword" class=" input-lg f-mt55 f-fs2" id="keyword" placeholder="搜索微信小程序或微信公众号">
                    </span>
                    <span class="f-ib f-fr">
                    	<button class="btn-danger" type="submit">
                        	<span class="f-db f-pt5 f-pb5">
                            	<i><img class="f-ib" src="/Public/images/search.png"></i>
                            	<em class=" f-fwb">找应用</em>
                            </span>
                        </button>
                    </span>
                        </form>
                    </div>
                </div>
                <div style="border-radius:0px 0px 5px 5px" class="s-bg-f9f9f9 f-pA10 f-fs2">
                    <span class="hot f-ml227">hot</span>
                    <span class="s-c-686868 f-ml20">热门搜索：</span>
                    <span id="searchlists"></span>
                    <script>
                        var searchlists = "<?php echo (C("search_key")); ?>";
                        var s_lists = searchlists.split(',');
                        var html_sear = '';
                        for(var ii=0;ii<s_lists.length;ii++){
                            html_sear +=  '<span class="f-ml10"><a class="link-686868" href="/app/lists.html?keyword='+s_lists[ii]+'">'+s_lists[ii]+'</a></span>';
                        }
                        document.getElementById("searchlists").innerHTML=html_sear;
                    </script>

                </div>
            </div>
			<div class="specialbox containers f-mt20">
				<div class="title-common clear"><h2 class="fl"><label></label>特色专题</h2><a href="<?php echo U('/special/');?>" class="fr rigth-more">查看更多<label></label></a></div>
				<div class="special-content clear">
				<div class="scroll clear imgScale">
				<?php if(is_array($special)): $key = 0; $__LIST__ = $special;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key; if($key < 6): ?><a class="content" href="<?php echo U('/special/'.$vo['aid']);?>" target="_blank"><img onload="setImgWH(this)" src="<?php echo ($vo["thumbnail"]); ?>" alt="<?php echo ($vo["title"]); ?>" title="<?php echo ($vo["title"]); ?>" class="scale_return" style="height: 100%;"></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</div>
				</div>
			</div>
			 
			<div class="showbox containers">
				<div class="title-common clear" style="padding-top: 24px;">
					<h2 class="fl">
						<label>
						</label>
						精选推荐
					</h2>
					<a href="app.html" class="fr rigth-more">
						查看更多
						<label>
						</label>
					</a>
				</div>
				<div class="show-content containers clear wrapper">
					<?php if(is_array($toplist)): $i = 0; $__LIST__ = $toplist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="list" href="<?php echo U('/app/'.$vo[aid]);?>">
						<div class="imgLeft">
							<span>
								<img onload="setImgWH(this)" src="<?php echo ($vo["thumbnail"]); ?>" />
							</span>
						</div>
						<div class="dataRight">
							<div class="title clear">
								<h3 class="ellipsis">
									<?php echo ($vo["title"]); ?>
								</h3>
								<span class="app-try">
									小程序
								</span>
                                <span class="app-try-2">
									公众号
								</span>
							</div>
							<div class="score-show2">
								<span>
									<i style="width: <?php echo ($vo["width"]); ?>%;"></i>
								</span>
								<p><?php echo ($vo["score"]); ?></p>
							</div>
							<p class="introduce"><?php echo ($vo["description"]); ?></p>
						</div>
						<div class="list-bottom clear">
							<?php $apparr=explode(',',$vo['tags']); foreach($apparr as $k=>$v){ if($k<3){ echo "<label>$v</label>"; } } ?>
							<p class="view-count">
								<label>
								</label>
								<?php echo ($vo["n"]); ?>
							</p>
						</div>
						<div class="qrcode">
							<img src="<?php echo ((isset($vo["qrcode"]) && ($vo["qrcode"] !== ""))?($vo["qrcode"]):'/Public/images/default_qrcode.png'); ?>" />
							<p>
								小程序体验
							</p>
						</div>
                        <div class="open_qrcode">
                            <img src="<?php echo ((isset($vo["open_qrcode"]) && ($vo["open_qrcode"] !== ""))?($vo["open_qrcode"]):'/Public/images/default_gzh_qrcode.png'); ?>" />
                            <p>
                                关注公众号
                            </p>
                        </div>
					</a><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>

            <div class="showbox containers">
                <div class="title-common clear" >
                    <h2 class="fl">
                        <label>
                        </label>
                        热门排行
                    </h2>
                    <a href="app.html?o=n" class="fr rigth-more">
                        查看更多
                        <label>
                        </label>
                    </a>
                </div>
                <div class="show-content containers clear wrapper">
                    <?php if(is_array($hot_list)): $i = 0; $__LIST__ = $hot_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="list" href="<?php echo U('/app/'.$vo[aid]);?>">
                            <div class="imgLeft">
							<span>
								<img onload="setImgWH(this)" src="<?php echo ($vo["thumbnail"]); ?>" />
							</span>
                            </div>
                            <div class="dataRight">
                                <div class="title clear">
                                    <h3 class="ellipsis">
                                        <?php echo ($vo["title"]); ?>
                                    </h3>
								<span class="app-try">
									小程序
								</span>
                                <span class="app-try-2">
									公众号
								</span>
                                </div>
                                <div class="score-show2">
								<span>
									<i style="width: <?php echo ($vo["width"]); ?>%;"></i>
								</span>
                                    <p><?php echo ($vo["score"]); ?></p>
                                </div>
                                <p class="introduce"><?php echo ($vo["description"]); ?></p>
                            </div>
                            <div class="list-bottom clear">
                                <?php $apparr=explode(',',$vo['tags']); foreach($apparr as $k=>$v){ if($k<3){ echo "<label>$v</label>"; } } ?>
                                <p class="view-count">
                                    <label>
                                    </label>
                                    <?php echo ($vo["n"]); ?>
                                </p>
                            </div>
                            <div class="qrcode">
                                <img src="<?php echo ((isset($vo["qrcode"]) && ($vo["qrcode"] !== ""))?($vo["qrcode"]):'/Public/images/default_qrcode.png'); ?>" />
                                <p>
                                    小程序体验
                                </p>
                            </div>
                            <div class="open_qrcode">
                                <img src="<?php echo ((isset($vo["open_qrcode"]) && ($vo["open_qrcode"] !== ""))?($vo["open_qrcode"]):'/Public/images/default_gzh_qrcode.png'); ?>" />
                                <p>
                                    关注公众号
                                </p>
                            </div>
                        </a><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>

            <div class="showbox containers">
                <div class="title-common clear" >
                    <h2 class="fl">
                        <label>
                        </label>
                        最新上线
                    </h2>
                    <a href="app.html?o=t" class="fr rigth-more">
                        查看更多
                        <label>
                        </label>
                    </a>
                </div>
                <div class="show-content containers clear wrapper">
                    <?php if(is_array($new_list)): $i = 0; $__LIST__ = $new_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="list" href="<?php echo U('/app/'.$vo[aid]);?>">
                            <div class="imgLeft">
							<span>
								<img onload="setImgWH(this)" src="<?php echo ($vo["thumbnail"]); ?>" />
							</span>
                            </div>
                            <div class="dataRight">
                                <div class="title clear">
                                    <h3 class="ellipsis">
                                        <?php echo ($vo["title"]); ?>
                                    </h3>
								<span class="app-try">
									小程序
								</span>
                                <span class="app-try-2">
									公众号
								</span>
                                </div>
                                <div class="score-show2">
								<span>
									<i style="width: <?php echo ($vo["width"]); ?>%;"></i>
								</span>
                                    <p><?php echo ($vo["score"]); ?></p>
                                </div>
                                <p class="introduce"><?php echo ($vo["description"]); ?></p>
                            </div>
                            <div class="list-bottom clear">
                                <?php $apparr=explode(',',$vo['tags']); foreach($apparr as $k=>$v){ if($k<3){ echo "<label>$v</label>"; } } ?>
                                <p class="view-count">
                                    <label>
                                    </label>
                                    <?php echo ($vo["n"]); ?>
                                </p>
                            </div>
                            <div class="qrcode">
                                <img src="<?php echo ((isset($vo["qrcode"]) && ($vo["qrcode"] !== ""))?($vo["qrcode"]):'/Public/images/default_qrcode.png'); ?>" />
                                <p>
                                    小程序体验
                                </p>
                            </div>
                            <div class="open_qrcode">
                                <img src="<?php echo ((isset($vo["open_qrcode"]) && ($vo["open_qrcode"] !== ""))?($vo["open_qrcode"]):'/Public/images/default_gzh_qrcode.png'); ?>" />
                                <p>
                                    关注公众号
                                </p>
                            </div>
                        </a><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
            <div class="specialbox containers f-pb20">
               <!-- <div class="title-common clear"><h2 class="fl"><label></label>特色专题</h2><a href="<?php echo U('/special/');?>" class="fr rigth-more">查看更多<label></label></a></div>-->
                <div class="special-content clear">
                    <div class="scroll clear imgScale">
                        <?php if(is_array($special)): $key = 0; $__LIST__ = $special;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key; if($key > 5): ?><a class="content" href="<?php echo U('/special/'.$vo['aid']);?>" target="_blank"><img onload="setImgWH(this)" src="<?php echo ($vo["thumbnail"]); ?>" alt="<?php echo ($vo["title"]); ?>" title="<?php echo ($vo["title"]); ?>" class="scale_return" style="height: 100%;"></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
            </div>
			<?php if(is_array($appcates)): $i = 0; $__LIST__ = $appcates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="showbox containers">
				<div class="title-common clear">
					<h2 class="fl">
						<label>
						</label>
						<?php echo ($vo["name"]); ?>
					</h2>
					<a href="<?php echo U('/app/'.$vo[dir]);?>" class="fr rigth-more">
						查看更多
						<label>
						</label>
					</a>
				</div>
				<div id="thelist" class="show-content containers clear">
					<?php if($vo[app]): if(is_array($vo["app"])): $i = 0; $__LIST__ = $vo["app"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$app): $mod = ($i % 2 );++$i;?><a class="list" href="<?php echo U('/app/'.$app[aid]);?>">
						<div class="imgLeft">
							<span>
								<img onload="setImgWH(this)" src="<?php echo ($app["thumbnail"]); ?>" />
							</span>
						</div>
						<div class="dataRight">
							<div class="title clear">
								<h3 class="ellipsis">
									<?php echo ($app["title"]); ?>
								</h3>

								<span class="app-try">
									小程序
								</span>
                                <span class="app-try-2">
									公众号
								</span>
							</div>
							<div class="score-show2">
								<span>
									<i style="width: <?php echo ($app["width"]); ?>%;"></i>
								</span>
								<p><?php echo ($app["score"]); ?></p>
							</div>
							<p class="introduce"><?php echo ($app["description"]); ?></p>
						</div>
						<div class="list-bottom clear">
							<?php $apparr=explode(',',$app['tags']); foreach($apparr as $k=>$v){ if($k<3){ echo "<label>$v</label>"; } } ?>
							<p class="view-count">
								<label>
								</label>
								<?php echo ($app["n"]); ?>
							</p>
						</div>
						<div class="qrcode">
							<img src="<?php echo ((isset($app["qrcode"]) && ($app["qrcode"] !== ""))?($app["qrcode"]):'/Public/images/default_qrcode.png'); ?>" />
							<p> 小程序体验 </p>
						</div>
                        <div class="open_qrcode">
                            <img src="<?php echo ((isset($app["open_qrcode"]) && ($app["open_qrcode"] !== ""))?($app["open_qrcode"]):'/Public/images/default_gzh_qrcode.png'); ?>" />
                            <p> 关注公众号 </p>
                        </div>
					</a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
				</div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
			<div id="wrapper-hot" class="hotbox containers clear">
				<div class="title-common clear">
					<h2 class="fl">
						<label>
						</label>
						热门评测
					</h2>
					<a class="fr rigth-more" href="/news/">
						查看更多
						<label>
						</label>
					</a>
				</div>
				<div class="content clear">
					<?php if(is_array($evalist)): $i = 0; $__LIST__ = $evalist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('/eva/'.$vo[aid]);?>">
						<div class="img-hot" style="background: url(<?php echo ($vo["thumbnail"]); ?>) center;background-size: auto 100%">
							 
						</div>
						<div class="data-hot">
							<h3>
								<?php echo ($vo["title"]); ?>
							</h3>
							<div class="foot-hot clear">
								<label title="<?php echo ($vo["keywords"]); ?>
">
									<?php echo ($vo["keywords"]); ?>
								</label>
								<p class="view-count fr">
									<label>
									</label>
									<?php echo ($vo["n"]); ?>
								</p>
							</div>
						</div>
					</a><?php endforeach; endif; else: echo "" ;endif; ?>
					<div class="lookmore">
						<a href="/eva.html">
							查看更多
						</a>
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
		<script type="text/javascript">
			$(function() {
				$(".list .app-try").mouseenter(function() {
					$index = $(this).parents(".list").find('.qrcode');
					$(".qrcode").hide();
					$index.stop(true, true).fadeIn();
				});
				$(".list .app-try").mouseleave(function() {
					$index = $(this).parents(".list").find('.qrcode');
					$(".qrcode").hide();
					$index.stop(true, true).fadeOut();
				});

                $(".list .app-try-2").mouseenter(function() {
                    $index = $(this).parents(".list").find('.open_qrcode');
                    $(".open_qrcode").hide();
                    $index.stop(true, true).fadeIn();
                });
                $(".list .app-try-2").mouseleave(function() {
                    $index = $(this).parents(".list").find('.open_qrcode');
                    $(".open_qrcode").hide();
                    $index.stop(true, true).fadeOut();
                });
				
			});
			//图片变大变小
			$(function() {
				$("#wrapper-hot").on('mouseenter', '.content >a',
				function() {
					$(this).find("img").addClass("scale").removeClass("scale_return");
				});
				$("#wrapper-hot").on('mouseleave', '.content >a',
				function() {
					$(this).find("img").addClass("scale_return").removeClass("scale");
				});
			})
		</script>
	</body>

</html>