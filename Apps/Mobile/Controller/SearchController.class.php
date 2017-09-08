<?php

namespace Mobile\Controller;

use Vendor\Page;

class SearchController extends ComController{
	
    public function index(){

		$keywords=C('search_keys');
		$keywords=explode('|',trim($keywords,'|'));
		$this->assign('keywords',$keywords);
        $this->display();
    }
    public function result(){
		
		$keyword=I('get.keyword','','strip_tags,trim');
		$t=I('get.t','','strip_tags,trim');
		if(empty($keyword)){
			$this->error('关键词不能为空','',1);
		}
		if(!empty($keyword)){
			switch($t){
				case 'app':$m = M('app'); break;
				case 'eva':$m = M('eva'); break;
				case 'news':$m = M('article'); break;
				default :$m = M('app');
			}
			$where="status=1 and title like '%{$keyword}%'";
			$count      = $m->where($where)->count();
			$Page       = new \Think\Page($count,10);
			$show       = $Page->show();
			$list = $m->where($where)->field('content',true)->order('aid desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('count',$count);
			$this->assign('list',$list);
			$this->assign('page',$show);
			
		}
		$this->assign('keyword',$keyword);
		$this->assign('t',$t?$t:'app');
        $this->display('index');
    }
   
    
}