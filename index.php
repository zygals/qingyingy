<?php
//echo 333444;
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
// 检测是否是新安装
if(file_exists("./Public/install") && !file_exists("./Public/install/install.lock")){
    $url=$_SERVER['HTTP_HOST'].trim($_SERVER['SCRIPT_NAME'],'index.php').'Public/install/index.php';
    header("Location:http://$url");
    die;
}
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',false);


//不懂代码的 以下不要改动
define('APP_INC',true);
$other=include("other.php");
if(is_array($other)){
	foreach($other as $k=>$v){
		define($k,$v);
	}
}else{
	define('WAP_DOMAIN','m.xxx.cn');  
	define('ADMIN_DIR','admin'); 
}


//百度地图JS ak
define('BMAP_AK', 'keGddAecUevnX67LB4gdY9VfCQGiMqIz');
//百度地图php ak
define('BMAP_FWQ_AK','infdGfuDvAQoDWad81shIrKtNG6BqUHt');

define('APP_PATH','./Apps/');
require './ThinkPHP/ThinkPHP.php';

