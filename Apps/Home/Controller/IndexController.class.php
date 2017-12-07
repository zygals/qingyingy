<?php

namespace Home\Controller;

use Vendor\Page;

class IndexController extends ComController
{
    public function index(){
		$m=M('app');
		//每日精选
		$toplist=$m->cache('indextoplist',3600)->where("istop=1 and status=1")->order('t desc')->limit(6)->select();
		foreach($toplist as $kk=>$vv){
			$scoreres=M('appscore')->cache('appsnum'.$vv['aid'],3600)->field('num')->where("aid='{$vv['aid']}'")->order("score desc")->limit(5)->select();
			$toplist[$kk]['width']=$vv['score'];
			$toplist[$kk]['score']=sprintf("%.1f",$vv['score']/10);
		}
		$this->assign('toplist',$toplist);

        //热门
        $hot_list=$m->cache('indexhotlist',3600)->where("status=1")->order('n desc')->limit(5)->select();
        foreach($hot_list as $kk=>$vv){
            $hot_scoreres=M('appscore')->field('num')->where("aid='{$vv['aid']}'")->order("score desc")->limit(5)->select();
            $hot_list[$kk]['width']=$vv['score'];
            $hot_list[$kk]['score']=sprintf("%.1f",$vv['score']/10);
        }
        $this->assign('hot_list',$hot_list);

        //最新
        $new_list=$m->cache('indexnewlist',3600)->where("status=1")->order('aid desc')->limit(6)->select();
        foreach($new_list as $kk=>$vv){
            $new_scoreres=M('appscore')->field('num')->where("aid='{$vv['aid']}'")->order("score desc")->limit(5)->select();
            $new_list[$kk]['width']=$vv['score'];
            $new_list[$kk]['score']=sprintf("%.1f",$vv['score']/10);
        }
        $this->assign('new_list',$new_list);

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
			$appcates[$k]['app']=$m->cache('indexapps'.$v['id'],3600)->where("sid in ($v[cateids]) and status=1")->order('aid desc')->limit(3)->select();
			foreach($appcates[$k]['app'] as $kk=>$vv){
				$scoreres=M('appscore')->cache('appsnum'.$vv['aid'],3600)->field('num')->where("aid='{$vv['aid']}'")->order("score desc")->limit(5)->select();
				$appcates[$k]['app'][$kk]['width']=$vv['score'];
				$appcates[$k]['app'][$kk]['score']=sprintf("%.1f",$vv['score']/10);
			}
		}
		
		$this->assign('appcates',$appcates);
		//热文
		/*$news=M('article')->cache('indexnewslist',1800)->order('aid desc')->limit(8)->select();
		$this->assign('news',$news);*/

        //热门评测
        $evalist=M('eva')->cache('indexevalist',1800)->order('aid desc')->limit(4)->select();
		$this->assign('evalist',$evalist);

		//大横幅
		$flash=M('flash')->where("type =1")->cache('indexflash',3600*12)->order('o asc')->limit(5)->select();
		$this->assign('flash',$flash);
        //首页所有广告位
        $ads=M('ad')->where("status =1")->cache('indexads',3600*12)->order('aid desc')->select();
        $this->assign('ads',$ads);
        		//dump($ads);exit;
		//首页专题
		$special=M('special')->cache('indexspecial',3600)->field('aid,thumbnail,title')->order('aid desc')->limit(10)->select();
		$this->assign('special',$special);
		//友情链接
		$flink=M('links')->cache('flink',600)->order('o asc')->select();
		$this->assign('flink',$flink);
        $this->display();
    }
    
}
