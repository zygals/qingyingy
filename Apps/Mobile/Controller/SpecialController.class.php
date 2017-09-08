<?php

namespace Mobile\Controller;

use Vendor\Page;

class SpecialController extends ComController{
	public function index(){
		$p=I('get.p','','intval');
		$m=M('special');
		$where['status']=array('eq','1');
		$count      = $m->cache('mspecial_list_list_count',3600)->where($where)->count();
		$Page       = new \Think\Page($count,12);
		$list=S('speciallist_'.$p);
		if(empty($list)){
			$list = $m->where($where)->order('aid desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			foreach($list as $k=>$v){
				$list[$k]['appnum']=count(explode(',',$v['apps']));
				$list[$k]['app']=M('app')->field('aid,thumbnail,title,sid')->where("aid in ({$v['apps']})")->limit(3)->select();
			}
			S('speciallist_'.$p,$list,3600);
		}
		$this->assign('list',$list);
		//dump($list);
		$show       = $Page->show();
		$this->assign('page',$show);
        $this->display();
    }
	public function view(){
		$id=I('get.id','','intval');
		M('special')->where("aid='$id'")->setInc('n');
		$info=M('special')->getByAid($id);
		$info['appnum']=count(explode(',',$info['apps']));
		$this->assign('info',$info);
		$apps=M('app')->where("aid in ({$info['apps']})")->select();
		$this->assign('apps',$apps);
        $this->display();
    }
}