<?php

namespace Mobile\Controller;

use Vendor\Page;

class NewsController extends ComController{
	private function getcate(){
		$cates=M('category')->cache('mgetcate',3600)->order('id asc')->select();
		$this->assign('cates',$cates);
	}
    public function index(){
		$this->getcate();
		$m=M('article');
		$where[status]=array('eq','1');
		$p=I('get.p','0','intval');
		$list = $m->cache('mnews_index_list_'.$p,3600)->where($where)->order('aid desc')->page($_GET['p'].',12')->select();
		$this->assign('list',$list);
		$count      = $m->cache('mnews_index_list_count',3600)->where($where)->count();
		$Page       = new \Think\Page($count,12);
		$show       = $Page->show();
		$this->assign('page',$show);
        $this->display();
    }
    public function lists(){
		$this->getcate();
		$p=I('get.p','0','intval');
		$dir=I('get.dir','','strip_tags,trim');
		$cate=M('category')->field(true)->where("dir='{$dir}'")->find();
		$this->assign('cate',$cate);
		$m=M('article');
		$list = $m->cache('mnews_lists_list_'.$p.$dir,3600)->where("sid='{$cate['id']}' and status=1")->order('aid desc')->page($_GET['p'].',10')->select();
		
		$this->assign('list',$list);
		$count      = $m->cache('mnews_list_list_count'.$p.$dir,3600)->where("sid='{$cate['id']}' and status=1")->count();
		$Page       = new \Think\Page($count,10);
		$show       = $Page->show();
		$this->assign('page',$show);
        $this->display();
    }
    public function read(){
		$id=I('get.id','','intval');
		M('article')->where("aid=$id")->setInc('n');
		$info=M('article')->where("aid=$id and status=1")->find();
		if(empty($id) or empty($info)){
			$this->error('未审核或已被删除');
		}
		$this->assign('info',$info);
		//上下篇
		$prevInfo=M('article')->field('aid,title')->order("aid desc")->where("aid < '{$id}'")->find();
		$prev['title']=$prevInfo['title']?$prevInfo['title']:'没有了';
		$prev['url']=$prevInfo['aid']?U('/news/'.$prevInfo['aid']):'javascript:;';
		$nextInfo=M('article')->order("aid asc")->where("aid > '{$id}'")->find();
		$next['title']=$nextInfo['title']?$nextInfo['title']:'没有了';
		$next['url']=$nextInfo['aid']?U('/news/'.$nextInfo['aid']):'javascript:;';
		$this->assign('prev',$prev);
		$this->assign('next',$next);
        $this->display();
    }
    
}