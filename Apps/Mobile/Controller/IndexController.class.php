<?php

namespace Mobile\Controller;

use Vendor\Page;

class IndexController extends ComController
{
    public function index(){
		$m=M('app');
		//每日精选
		$toplist=$m->cache('mindextoplist',3600)->where("istop=1 and status=1")->order('aid desc')->limit(6)->select();
		$this->assign('toplist',$toplist);
		//分类
		$appcates=M('appcate')->where("pid=0")->order('o asc,id asc')->select();
		foreach($appcates as $k=>$v){
			$cates=M('appcate')->where("pid='{$v[id]}'")->field('id')->select();
			foreach($cates as $kk=>$vv){
				$appcates[$k][cateids].=$vv[id].',';
			}
			$appcates[$k][cateids]=trim($appcates[$k][cateids],',');
		}
		foreach($appcates as $k=>$v){
			$appcates[$k][app]=$m->cache('mindexapps'.$v[id],3600)->where("sid in ($v[cateids]) and status=1")->order('aid desc')->limit(6)->select();
		}
		$this->assign('appcates',$appcates);
		//热文
		//$news=M('article')->cache('mindexnewslist',1800)->order('aid desc')->limit(8)->select();
		$this->assign('news',$news);
		//大横幅
		$flash=M('flash')->where("type =2")->cache('mindexflash',3600*12)->order('o asc')->limit(5)->select();
		$this->assign('flash',$flash);
		//首页专题
		$special=M('special')->cache('mindexspecial',3600)->field('aid,thumbnail,title')->order('aid desc')->limit(5)->select();
		$this->assign('special',$special);
		
		//热门
        $hot_list=$m->where("status=1")->order('n desc')->limit(6)->select();
		$this->assign('hot_list',$hot_list);
		
		//最新
		$new_list=$m->where("status=1")->order('aid desc')->limit(6)->select();
		$this->assign('newlist',$new_list);
		//友情链接
		$flink=M('links')->cache('flink',600)->order('o asc')->select();
		$this->assign('flink',$flink);
        $this->display();
    }
    
}