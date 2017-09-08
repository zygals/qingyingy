<?php

namespace Home\Controller;

use Vendor\Page;

class EvaController extends ComController{
	
    public function index(){

		$m=M('eva');
		$p=I('get.p','0','intval');
		$where['status']=array('eq','1');
		$count      = $m->where($where)->count();
		$Page       = new \Think\Page($count,8);
		$list = $m->where($where)->order('aid desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);
		$show       = $Page->show();
		$this->assign('page',$show);
        $this->display();
    }
   
    public function read(){
		$id=I('get.id','','intval');
		M('eva')->where("aid=$id")->setInc('n');
		$info=M('eva')->where("aid=$id and status=1")->find();
		if(empty($id) or empty($info)){
			$this->error('未审核或已被删除');
		}
		$this->assign('info',$info);
		if(!empty($info['app'])){
			$app=M('app')->where("status=1 and title='{$info['app']}'")->find();
			$this->assign('app',$app);
		}
		//上下篇
		$prevInfo=M('eva')->field('aid,title')->order("aid desc")->where("aid < '{$id}'")->find();
		$prev['title']=$prevInfo['title']?$prevInfo['title']:'没有了';
		$prev['url']=$prevInfo['aid']?U('/eva/'.$prevInfo['aid']):'javascript:;';
		$nextInfo=M('eva')->order("aid asc")->where("aid > '{$id}'")->find();
		$next['title']=$nextInfo['title']?$nextInfo['title']:'没有了';
		$next['url']=$nextInfo['aid']?U('/eva/'.$nextInfo['aid']):'javascript:;';
		$this->assign('prev',$prev);
		$this->assign('next',$next);
        $this->display();
    }
    
}