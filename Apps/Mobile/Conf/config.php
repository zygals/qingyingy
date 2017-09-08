<?php
return array(
	'VIEW_PATH'=>'./Themes/',
	'DEFAULT_THEME' => 'WAP',
	// Cookie设置
	'COOKIE_EXPIRE'         =>  3600*24*30,    // Cookie有效期
	'COOKIE_PATH'           =>  '/',     // Cookie路径
	'COOKIE_PREFIX'         =>  'qt_',  // Cookie前缀 避免冲突
	
	// 开启路由
	'URL_ROUTER_ON'   => true,
	'URL_ROUTE_RULES'=>array(
		'App/doScore' => 'App/doScore',
        'App/doMessage' => 'App/doMessage',
        'App/doMessagelist' => 'App/doMessagelist',
		'App/category' => 'App/category',
		'App/apply' => 'App/apply',
		'/^app\/(\d+)$/' => 'App/info?id=:1',
		'/^app\/(\S+)$/' => 'App/lists?dir=:1',
		'/^app\/(\S+)\/p\/(\d+)$/' => 'App/lists?dir=:1&p=:2',
		'/^news\/(\d+)$/' => 'News/read?id=:1',
		'/^news\/(\S+)$/' => 'News/lists?dir=:1',
		'/^news\/(\S+)\/p\/(\d+)$/' => 'News/lists?dir=:1&p=:2',
		'/^eva\/(\d+)$/' => 'Eva/read?id=:1',
		'/^special\/(\d+)$/' => 'special/view?id=:1',

	)
);