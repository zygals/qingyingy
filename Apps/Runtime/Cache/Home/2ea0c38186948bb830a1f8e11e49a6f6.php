<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>

    <head>
		<meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="renderer" content="webkit">
		<link rel="shortcut icon" href="/Public/images/favicon.ico" type="image/x-icon"/>
		<title><?php if($cate['seotitle']): echo ($cate['seotitle']); else: echo ($cate["name"]); ?>类微信小程序<?php endif; ?> - <?php echo (C("sitename")); ?></title>
		<script type="text/javascript"  src="/Public/js/uaredirect.js"></script>
		<script type="text/javascript">uaredirect("<?php echo (C("wap_url")); echo U('/app/'.$cate['dir']);?>");</script>
		<meta name="keywords" content="<?php echo ($cate["keywords"]); ?>" />
		<meta name="description" content="<?php echo ($cate["description"]); ?>" />
		<link rel="stylesheet" type="text/css" href="/Public/css/reseting.css" />
		<link rel="stylesheet" type="text/css" href="/Public/css/common.css" />
		<link rel="stylesheet" type="text/css" href="/Public/css/lite.css" />
		<link rel="stylesheet" type="text/css" href="/Public/css/page.css" />
		<link rel="stylesheet" type="text/css" href="/Public/js/layer/skin/default/layer.css">
		<script type="text/javascript" src="/Public/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="/Public/js/common.js" charset="utf-8"></script>
		<script type="text/javascript" src="/Public/js/layer/layer.js"></script>
	</head>

    <body>


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


    <div class="title_common containers"><a href="/">首页</a> <label></label><a href="<?php echo U('/app');?>">轻应用商店</a><?php echo ($catename); ?></div>

    <div class="sort-top containers">
        <div class="keysbox">
            <div class="keys clear">
                <a class="" href="<?php echo U('/app');?>">全部</a>
				<?php if(is_array($cates)): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a <?php if($vo['dir'] == $_GET['dir'] or $pid == $vo[id]): ?>class="active"<?php endif; ?> href="<?php echo U('/app/'.$vo['dir']);?>" title="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<?php if($subcates): ?><div class="type clear">
				<a class="active" href="<?php echo U('/app/'.$subdir);?>">全部</a>
				<?php if(is_array($subcates)): $i = 0; $__LIST__ = $subcates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a <?php if($vo['dir'] == $_GET['dir']): ?>class="active"<?php endif; ?> href="<?php echo U('/app/'.$vo['dir']);?>" title="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div><?php endif; ?>
		</div>
		<?php if(!$keyword): ?><div class="filterbox clear">
            <!--<div class="filterLeft fr clear">
                <a class="c-status active" >已上架<label></label></a>
                <a class="c-status" >未上架<label></label></a>
            </div>-->
			
            <div class="filterRight fl clear">
                <a class="c-order <?php if($_GET[o] == ''): ?>active<?php endif; ?>" href="<?php echo U('/app/'.$_GET[dir]);?>">默认</a>
                <label></label>
                <a class="c-order <?php if($_GET[o] == 't'): ?>active<?php endif; ?>" href="<?php echo U('/app/'.$_GET[dir]);?>?o=t">最新</a>
                <label></label>
                <a class="c-order <?php if($_GET[o] == 'n'): ?>active<?php endif; ?>" href="<?php echo U('/app/'.$_GET[dir]);?>?o=n">最热</a>
            </div>
			
        </div><?php endif; ?>	
    </div>

    <div id="wrapper" class="showbox containers">
        <div id="thelist" class="show-content containers clear paddingTop">
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="list" href="<?php echo U('/app/'.$vo[aid]);?>" title="<?php echo ($vo["title"]); ?>" target="_blank">
				<div class="imgLeft">
					<span>
						<img onload="setImgWH(this)" src="<?php echo ($vo["thumbnail"]); ?>" style="width: 100%;">
					</span>
				</div>
				<div class="dataRight">
					<div class="title clear">
						<h3 class="ellipsis"><?php echo ($vo["title"]); ?></h3>
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
				<div class="list-bottom">
					<?php $apparr=explode(',',$vo['tags']); foreach($apparr as $k=>$v){ if($k<3){ echo "<label>$v</label>"; } } ?>
					
					<p class="view-count"><label></label><?php echo ($vo["n"]); ?></p>
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
		<div class="page_group clear">
		<?php echo ($page); ?>
		</div>
        <!-- <div class="lookmore" style="display:none;"> -->
            <!-- <a href="javascript:;">查看更多</a> -->
        <!-- </div> -->
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
    $(function () {
        var $index = 0;
        $("#wrapper").on('mouseenter', '.list .app-try', function () {
            $index = $(this).parents(".list").index();
            $(".qrcode").hide().eq($index).fadeIn();
        });
        $("#wrapper").on('mouseleave', '.list .app-try', function () {
            $index = $(this).parents(".list").index();
            $(".qrcode").hide();
        });
        $("#wrapper").on('mouseenter', '.list .app-try-2', function () {
            $index = $(this).parents(".list").index();
            $(".open_qrcode").hide().eq($index).fadeIn();
        });
        $("#wrapper").on('mouseleave', '.list .app-try-2', function () {
            $index = $(this).parents(".list").index();
            $(".open_qrcode").hide();
        });
    });
</script>

    </body>
</html>