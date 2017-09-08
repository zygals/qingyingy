<?php
return array(
    //网站配置信息
    'COOKIE_SALT' => 'xxxwf', //设置cookie加密密钥
	'LOG_RECORD' => false, // 开启日志记录
	'DATA_CACHE_TYPE' => DATA_CACHE_TYPE?DATA_CACHE_TYPE:'File', // 数据缓存类型
	'COOKIE_DOMAIN'         =>  COOKIE_DOMAIN?'.'.COOKIE_DOMAIN:'',      // Cookie有效域名
	'URL_HTML_SUFFIX'       =>  defined('URL_SUFFIX')?URL_SUFFIX:'',  // URL伪静态后缀设置 html,htm,php

    //备份配置
    'DB_PATH_NAME' => 'db',        //备份目录名称,主要是为了创建备份目录
    'DB_PATH' => './db/',     //数据库备份路径必须以 / 结尾；
    'DB_PART' => '20971520',  //该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M
    'DB_COMPRESS' => '1',         //压缩备份文件需要PHP环境支持gzopen,gzwrite函数        0:不压缩 1:启用压缩
    'DB_LEVEL' => '9',         //压缩级别   1:普通   4:一般   9:最高
    
	//扩展配置文件
    'LOAD_EXT_CONFIG' => 'db,sdk_config',
    'URL_MODEL' => 2,
	'DEFAULT_MODULE' => 'Home', // 默认模块
	'URL_MODULE_MAP'    =>    array(ADMIN_DIR=>'admin'),//模块映射，后台目录路径
	'MODULE_ALLOW_LIST'     =>  array('Home','User','mobile',ADMIN_DIR), // 配置你原来的分组列表
	
	//域名部署
	'APP_SUB_DOMAIN_DEPLOY'   =>    WAP_DOMAIN?1:0, // 开启子域名或者IP配置
	// 'APP_DOMAIN_SUFFIX'=>'com.cn',  //二级域名后缀 如www.sina.com.cn，则填写com.cn
	'APP_SUB_DOMAIN_RULES'    =>    array( 
		WAP_DOMAIN  => 'Mobile',
	),
	
	//贴图库配置
	'ttk_open' => ttk_open,
	'tietuku_accesskey' => tietuku_accesskey,
	'tietuku_secretkey' => tietuku_secretkey,
	'tietuku_aid' => tietuku_aid,
	'tietuku_return_type' => tietuku_return_type,
);
