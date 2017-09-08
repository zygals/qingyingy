<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title><?php echo ($current['title']); ?>-轻应用商店后台管理系统</title>

    <meta name="keywords" content="<?php echo (C("keywords")); ?>"/>
    <meta name="description" content="<?php echo (C("description")); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>


    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="/Public/qwadmin/css/bootstrap.css"/>
    <link rel="stylesheet" href="/Public/qwadmin/css/font-awesome.css"/>
    <link rel="stylesheet" href="/Public/qwadmin/css/jquery-ui.css"/>
    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="/Public/qwadmin/css/ace-fonts.css"/>

    <!-- ace styles -->
    <link rel="stylesheet" href="/Public/qwadmin/css/ace.css" class="ace-main-stylesheet" id="main-ace-style"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="/Public/qwadmin/css/ace-part2.css" class="ace-main-stylesheet"/>
    <![endif]-->

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="/Public/qwadmin/css/ace-ie.css"/>

    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="/Public/qwadmin/js/ace-extra.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="/Public/qwadmin/js/html5shiv.js"></script>
    <script src="/Public/qwadmin/js/respond.js"></script>
    <![endif]-->
</head>
<body class="no-skin">
    <!-- #section:basics/navbar.layout -->
    <div id="navbar" class="navbar navbar-default">
        <script type="text/javascript">
            try {
                ace.settings.check('navbar', 'fixed')
            } catch (e) {
            }
        </script>

        <div class="navbar-container" id="navbar-container">
            <!-- #section:basics/sidebar.mobile.toggle -->
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>
            </button>

            <!-- /section:basics/sidebar.mobile.toggle -->
            <div class="navbar-header pull-left">
                <!-- #section:basics/navbar.layout.brand -->
                <a href="<?php echo U('index/index');?>" class="navbar-brand">
                    <small>
                        <i class="fa fa-pinterest"></i>
                        轻应用商店-后台管理系统
                    </small>
                </a>

                <!-- /section:basics/navbar.layout.brand -->

                <!-- #section:basics/navbar.toggle -->

                <!-- /section:basics/navbar.toggle -->
            </div>

            <!-- #section:basics/navbar.dropdown -->
            <div class="navbar-buttons navbar-header pull-right" role="navigation">
                <ul class="nav ace-nav">
                    <!-- #section:basics/navbar.user_menu -->
                    <li class="red">
                        <a href="<?php echo U('cache/clear');?>" title="清除缓存" target="_self">
                            <i class="ace-icon fa glyphicon-trash"></i>
                        </a>
                    </li>
                    <li class="red">
                        <a href="/" title="前台首页" target="_blank">
                            <i class="ace-icon fa fa-home"></i>
                        </a>
                    </li>
                    <li class="light-blue">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <img class="nav-user-photo" src="<?php echo ((isset($user["head"]) && ($user["head"] !== ""))?($user["head"]):'/Public/qwadmin/images/nopic.gif'); ?>" alt="<?php echo ($user["user"]); ?>" />
                            <span class="user-info">
                                <small>欢迎光临，</small>
                                <?php echo ($user["user"]); ?>
                            </span>

                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <li>
                                <a href="<?php echo U('Setting/setting');?>">
                                    <i class="ace-icon fa fa-cog"></i>
                                    设置
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo U('Personal/profile');?>">
                                    <i class="ace-icon fa fa-user"></i>
                                    个人资料
                                </a>
                            </li>

                            <li class="divider"></li>

                            <li>
                                <a href="<?php echo U('logout/index');?>">
                                    <i class="ace-icon fa fa-power-off"></i>
                                    退出
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- /section:basics/navbar.user_menu -->
                </ul>
            </div>

            <!-- /section:basics/navbar.dropdown -->
        </div><!-- /.navbar-container -->
    </div>

    <!-- /section:basics/navbar.layout -->
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>

        <!-- #section:basics/sidebar -->
    <div id="sidebar" class="sidebar responsive">
        <script type="text/javascript">
            try {
                ace.settings.check('sidebar', 'fixed')
            } catch (e) {
            }
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                
                <button class="btn btn-default" title="添加文章" onclick="window.location.href='<?php echo U('article/add');?>'">
                    <i class="ace-icon fa fa-edit"></i>
                </button>
				
				<button class="btn btn-success" title="文章管理" onclick="window.location.href='<?php echo U('article/index');?>'">
                    <i class="ace-icon fa fa-file-text"></i>
                </button>

                <button class="btn btn-info" title="添加小程序" onclick="window.location.href='<?php echo U('app/add');?>'">
                    <i class="ace-icon fa fa-pencil"></i>
                </button>

                <!-- #section:basics/sidebar.layout.shortcuts -->
                <button class="btn btn-warning" title="小程序管理" onclick="window.location.href='<?php echo U('app/index');?>'">
                    <i class="ace-icon fa fa-weixin"></i>
                </button>

                <!-- /section:basics/sidebar.layout.shortcuts -->
            </div>

            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                <span class="btn btn-success"></span>

                <span class="btn btn-info"></span>

                <span class="btn btn-warning"></span>

                <span class="btn btn-danger"></span>
            </div>
        </div><!-- /.sidebar-shortcuts -->

        <ul class="nav nav-list">
            <?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li
                <?php if(($v['id'] == $current['id']) OR ($v['id'] == $current['pid']) OR ($v['id'] == $current['ppid'])): ?>class="active
                    <?php if($current['pid'] != '0'): ?>open<?php endif; ?>
                    "<?php endif; ?>
                >
                <a href="<?php if(empty($v["name"])): ?>#
                <?php else: ?>
                <?php echo U($v['name']); endif; ?>"
                <?php if(!empty($v["children"])): ?>class="dropdown-toggle"<?php endif; ?>
                >
                <i class="<?php echo ($v["icon"]); ?>"></i>
                <span class="menu-text">
                                    <?php echo ($v["title"]); ?>
                                </span>
                <?php if(!empty($v["children"])): ?><b class="arrow fa fa-angle-down"></b><?php endif; ?>
                </a>

                <b class="arrow"></b>
                <?php if(!empty($v["children"])): ?><ul class="submenu">
                        <?php if(is_array($v["children"])): $i = 0; $__LIST__ = $v["children"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><li
                            <?php if(($vv['id'] == $current['id']) OR ($vv['id'] == $current['pid'])): ?>class="active
                                <?php if($current['ppid'] != '0'): ?>open<?php endif; ?>
                                "<?php endif; ?>
                            >
                            <a href="<?php if(empty($vv["children"])): echo U($vv['name']);?>
                            <?php else: ?>
                            #<?php endif; ?>"
                            <?php if(!empty($vv["children"])): ?>class="dropdown-toggle"<?php endif; ?>
                            >
                            <i class="<?php echo ($vv["icon"]); ?>"></i>
                            <?php echo ($vv["title"]); ?>
                            <?php if(!empty($vv["children"])): ?><b class="arrow fa fa-angle-down"></b><?php endif; ?>
                            </a>

                            <b class="arrow"></b>
                            <?php if(!empty($vv["children"])): ?><ul class="submenu">
                                    <?php if(is_array($vv["children"])): $i = 0; $__LIST__ = $vv["children"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vvv): $mod = ($i % 2 );++$i;?><li
                                        <?php if($vvv['id'] == $current['id']): ?>class="active"<?php endif; ?>
                                        >
                                        <a href="<?php echo U($vvv['name']);?>">
                                            <i class="<?php echo ($vvv["icon"]); ?>"></i>
                                            <?php echo ($vvv["title"]); ?>
                                        </a>
                                        <b class="arrow"></b>
                                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul><?php endif; ?>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul><?php endif; ?>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>

        </ul><!-- /.nav-list -->

        <!-- #section:basics/sidebar.layout.minimize -->
        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left"
               data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>

        <!-- /section:basics/sidebar.layout.minimize -->
        <script type="text/javascript">
            try {
                ace.settings.check('sidebar', 'collapsed')
            } catch (e) {
            }
        </script>
    </div>

    <!-- /section:basics/sidebar -->
    <div class="main-content">
        <div class="main-content-inner">
            <!-- #section:basics/content.breadcrumbs -->
                <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try {
                ace.settings.check('breadcrumbs', 'fixed')
            } catch (e) {
            }
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="<?php echo U('index/index');?>">首页</a>
            </li>
            <?php if(isset($current['ptitle'])): ?><li>
                    <a href="#"><?php echo ($current['ptitle']); ?></a>
                </li><?php endif; ?>
            <li class="active"><?php echo ($current['title']); ?></li>
        </ul><!-- /.breadcrumb -->
    </div>

            <!-- /section:basics/content.breadcrumbs -->
            <div class="page-content">
                    <!-- #section:settings.box -->
    <?php if($current["tips"] != ''): ?><div class="alert alert-block alert-success">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
            <!--i class="ace-icon fa fa-check green"></i-->
            <?php echo (htmlspecialchars_decode($current["tips"])); ?>
        </div><?php endif; ?>

                <!-- /section:settings.box -->
                <div class="row">
                    <div class="col-xs-12">
                        <form class="form-horizontal" id="form" method="post" action="<?php echo U('update');?>">

                            <!-- PAGE CONTENT BEGINS -->

                            <input type="hidden" name="aid" value="<?php echo ($app["aid"]); ?>" id="aid"/>
                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-0">
                                    小程序分类 </label>
                                <div class="col-sm-9">
                                    <select id="sid" name="sid" class="col-xs-10 col-sm-5">
                                        <option value="0">--分类--</option>
                                        <?php echo ($appcate); ?>
                                    </select>

                                    <span class="help-inline col-xs-12 col-sm-7">
												<span class="middle">选择所属分类。</span>
											</span>
                                </div>
                            </div>

                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">
                                    小程序标题 </label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" id="title" placeholder="小程序标题"
                                           class="col-xs-10 col-sm-5" value="<?php echo ($app['title']); ?>">
                                    <span class="help-inline col-xs-12 col-sm-7">
												<span class="middle">小程序标题不能为空。</span>
											</span>
                                </div>
                            </div>
							
                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">
                                    标签 </label>
                                <div class="col-sm-9">
                                    <input type="text" name="tags" id="tags" placeholder="标签"
                                           class="col-xs-10 col-sm-5" value="<?php echo ($app['tags']); ?>">
                                    <span class="help-inline col-xs-12 col-sm-7">
												<span class="middle">小程序标签，多个用,隔开。最多5个</span>
											</span>
                                </div>
                            </div>

                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">
                                    作者 </label>
                                <div class="col-sm-9">
                                    <input type="text" name="zuozhe" id="zuozhe" placeholder="作者"
                                           class="col-xs-10 col-sm-5" value="<?php echo ($app['zuozhe']); ?>">
                                    <span class="help-inline col-xs-12 col-sm-7">
												<span class="middle"><a href="<?php if($app['uid'] > 0): echo U('/admin/user/edit',array('uid'=>$app['uid'])); else: ?>javascript:;<?php endif; ?>" target="_blank">Uid:<?php echo ((isset($app["uid"]) && ($app["uid"] !== ""))?($app["uid"]):'0'); ?></a></span>
											</span>
                                </div>
                            </div>
                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">
                                    来源 </label>
                                <div class="col-sm-9">
                                    <input type="text" name="befrom" id="befrom" placeholder="来源"
                                           class="col-xs-10 col-sm-5" value="<?php echo ($app['befrom']); ?>">
                                    <span class="help-inline col-xs-12 col-sm-7">
												<span class="middle"></span>
											</span>
                                </div>
                            </div>
                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">
                                    SEO标题 </label>
                                <div class="col-sm-9">
                                    <input type="text" name="seotitle" id="seotitle" placeholder="SEO标题"
                                           class="col-xs-10 col-sm-5" value="<?php echo ($app['seotitle']); ?>">
                                    <span class="help-inline col-xs-12 col-sm-7">
												<span class="middle"></span>
											</span>
                                </div>
                            </div>
                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">
                                    关键词 </label>
                                <div class="col-sm-9">
                                    <input type="text" name="keywords" id="keywords" placeholder="关键词"
                                           class="col-xs-10 col-sm-5" value="<?php echo ($app['keywords']); ?>">
                                    <span class="help-inline col-xs-12 col-sm-7">
												<span class="middle"></span>
											</span>
                                </div>
                            </div>
                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-3">
                                    描述 </label>
                                <div class="col-sm-9">
                                        <textarea name="description" id="description" placeholder="描述"
                                                  class="col-xs-10 col-sm-8"
                                                  rows="2"><?php echo ($app['description']); ?></textarea>
                                   
                                </div>
                            </div>
                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">
                                    推荐 </label>
								<div class="control-label no-padding-left col-sm-1">
                                    <label>
                                        <input name="istop" id="istop" value="1" class="ace ace-switch ace-switch-2" type="checkbox" <?php if($app[istop] == 1): ?>checked<?php endif; ?>>
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                                <span class="help-inline col-xs-12 col-sm-7">
									<span class="middle">是否推荐到首页</span>
								</span>
                            </div>
							<div class="space-4"></div>
							<div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-1">
                                    审核 </label>
								<div class="control-label no-padding-left col-sm-1">
                                    <label>
                                        <input name="status" id="status" value="1" class="ace ace-switch ace-switch-2" type="checkbox" <?php if($app[status] == 1 or !isset($app[status])): ?>checked<?php endif; ?>>
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                                <span class="help-inline col-xs-12 col-sm-7">
									<span class="middle">是否审核通过</span>
								</span>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-2">
                                    运行要求 </label>
                                <div class="col-sm-9">
                                    <input type="text" name="yaoqiu" id="yaoqiu" placeholder="运行要求"
                                           class="col-xs-10 col-sm-5" value="<?php echo ($app['yaoqiu']); ?>">
                                    <span class="help-inline col-xs-12 col-sm-7">
												<span class="middle">小程序运行要求</span>
											</span>
                                </div>
                            </div>

                            <div class="space-4"></div>

                            
                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-4">
                                    缩略图 </label>
                                <div class="col-sm-9">
                                    <div class="col-xs-10 col-sm-5">
                                        <?php echo UpImage("thumbnail",100,100,$app['thumbnail']);?>
                                    </div>
                                    <span class="help-inline col-xs-12 col-sm-7">
												<span class="middle">仅支持jpg、gif、png、bmp、jpeg，且小于1MB。</span>
											</span>
                                </div>

                            </div>
                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-4">
                                    二维码 </label>
                                <div class="col-sm-9">
                                    <div class="col-xs-10 col-sm-5">
                                        <?php echo UpImage("qrcode",100,100,$app['qrcode']);?>
                                    </div>
                                    <span class="help-inline col-xs-12 col-sm-7">
												<span class="middle">仅支持jpg、gif、png、bmp、jpeg，且小于1MB。</span>
											</span>
                                </div>

                            </div>
                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-4">
                                    公众号 </label>
                                <div class="col-sm-9">
                                    <div class="col-xs-10 col-sm-5">
                                        <?php echo UpImage("open_qrcode",100,100,$app['open_qrcode']);?>
                                    </div>
                                    <span class="help-inline col-xs-12 col-sm-7">
												<span class="middle">仅支持jpg、gif、png、bmp、jpeg，且小于1MB。</span>
											</span>
                                </div>

                            </div>
                            <div class="space-4"></div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" for="form-field-4">
                                    截图 </label>
                                <div class="col-sm-9">
                                    <div class="col-xs-10 col-sm-10">
                                        <?php echo BatchImage("screen",100,150,$app['screen']);?>
                                    </div>
                                    
                                </div>

                            </div>
                            <div class="space-4"></div>

                            


                            <div class="col-md-offset-2 col-md-9">
                                <button class="btn btn-info submit" type="button">
                                    <i class="icon-ok bigger-110"></i>
                                    提交
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="icon-undo bigger-110"></i>
                                    重置
                                </button>
                            </div>

                            <!-- PAGE CONTENT ENDS -->


                        </form>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
        <div class="footer">
        <div class="footer-inner">
            <!-- #section:basics/footer -->
            <div class="footer-content">
                            <span class="bigger-120">
                                <small>Copyright &copy; 2017 <a href="javascript:void(0)" target="_blank">LHCMS</a> All Rights Reserved.</small>
                            </span>
            </div>

            <!-- /section:basics/footer -->
        </div>
    </div>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>

</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script type="text/javascript">
    window.jQuery || document.write("<script src='/Public/qwadmin/js/jquery.js'>" + "<" + "/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='/Public/qwadmin/js/jquery1x.js'>" + "<" + "/script>");
</script>
<![endif]-->
<script type="text/javascript">
    if ('ontouchstart' in document.documentElement) document.write("<script src='/Public/qwadmin/js/jquery.mobile.custom.js'>" + "<" + "/script>");
</script>
<script src="/Public/qwadmin/js/bootstrap.js"></script>

<!-- page specific plugin scripts -->
<script charset="utf-8" src="/Public/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/Public/kindeditor/lang/zh_CN.js"></script>
<script src="/Public/qwadmin/js/bootbox.js"></script>
<!-- ace scripts -->
<script src="/Public/qwadmin/js/ace/elements.scroller.js"></script>
<script src="/Public/qwadmin/js/ace/elements.colorpicker.js"></script>
<script src="/Public/qwadmin/js/ace/elements.fileinput.js"></script>
<script src="/Public/qwadmin/js/ace/elements.typeahead.js"></script>
<script src="/Public/qwadmin/js/ace/elements.wysiwyg.js"></script>
<script src="/Public/qwadmin/js/ace/elements.spinner.js"></script>
<script src="/Public/qwadmin/js/ace/elements.treeview.js"></script>
<script src="/Public/qwadmin/js/ace/elements.wizard.js"></script>
<script src="/Public/qwadmin/js/ace/elements.aside.js"></script>
<script src="/Public/qwadmin/js/ace/ace.js"></script>
<script src="/Public/qwadmin/js/ace/ace.ajax-content.js"></script>
<script src="/Public/qwadmin/js/ace/ace.touch-drag.js"></script>
<script src="/Public/qwadmin/js/ace/ace.sidebar.js"></script>
<script src="/Public/qwadmin/js/ace/ace.sidebar-scroll-1.js"></script>
<script src="/Public/qwadmin/js/ace/ace.submenu-hover.js"></script>
<script src="/Public/qwadmin/js/ace/ace.widget-box.js"></script>
<script src="/Public/qwadmin/js/ace/ace.settings.js"></script>
<script src="/Public/qwadmin/js/ace/ace.settings-rtl.js"></script>
<script src="/Public/qwadmin/js/ace/ace.settings-skin.js"></script>
<script src="/Public/qwadmin/js/ace/ace.widget-on-reload.js"></script>
<script src="/Public/qwadmin/js/ace/ace.searchbox-autocomplete.js"></script>
<script src="/Public/qwadmin/js/jquery-ui.js"></script>
<!-- inline scripts related to this page -->
<script type="text/javascript">
    $(function () {
        $("#tabs").tabs();
        var editor = KindEditor.create('textarea[name="content"]', {
            uploadJson: '/Public/kindeditor/php/upload_json.php',
            fileManagerJson: '/Public/kindeditor/php/file_manager_json.php',
            allowFileManager: true,
            afterBlur: function () {
                this.sync();
            }
        });
        $(".submit").click(function () {
            var sid = $("#sid").val();
            var title = $("#title").val();
            var content = $("#content").val();
            if (sid == 0) {
                bootbox.dialog({
                    title: '友情提示：',
                    message: "小程序分类必须选择。",
                    buttons: {
                        "success": {
                            "label": "确定",
                            "className": "btn-danger"
                        }
                    }
                });
                return;
            }
            if (title == '') {
                bootbox.dialog({
                    title: '友情提示：',
                    message: "小程序标题必须填写。",
                    buttons: {
                        "success": {
                            "label": "确定",
                            "className": "btn-danger"
                        }
                    }
                });
                return;
            }
           
            $("#form").submit();
        });
    });
</script>
</body>
</html>