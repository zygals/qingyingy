<?php

namespace Mobile\Controller;

use Vendor\Page;

class ChartsController extends ComController{
    
    public function index(){
		$m=M('app');
		$list = $m->cache('mcharts_app_list',1800)->alias('a')->field("a.*,b.name as catename")->join("left join __APPCATE__ b on a.sid=b.id")->where("a.status=1")->order('a.istop desc,a.n desc')->limit(100)->select();
		$this->assign('list',$list);
        $this->display();
    }
    
}