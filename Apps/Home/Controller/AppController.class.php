<?php

namespace Home\Controller;

use Vendor\Page;

class AppController extends ComController{
	private function getcates($id=''){
		
		if(!$id){
			$cates=M('appcate')->cache('appgetcates',3600)->where("pid='0'")->select();
		}else{
			$r=M('appcate')->field('pid')->where("id=$id")->find();
			if($r[pid]!=0){
				$id=$r[pid];
				$this->assign('pid',$id);
			}
			$cates=M('appcate')->cache('appcates0',3600)->where("pid=0 ")->order('o asc,id asc')->select();
			$subcates=M('appcate')->cache('appsubcates'.$id,3600)->where("pid=$id ")->order('o asc,id asc')->select();
			$subdir=M('appcate')->field('dir')->where("pid=$id ")->find();
			$this->assign('subdir',$subdir['dir']);
		}
		
		$this->assign('cates',$cates);
		$this->assign('subcates',$subcates);
	}
    public function index(){
		$this->getcates();
		$m=M('app');
		$where[status]=array('eq','1');
		$order='istop desc,aid desc';
		$o=I('get.o');
		if($o=='t'){
			$order='t desc';
		}
		if($o=='n'){
			$order='n desc';
		}
		$p=I('get.p','','intval');
		$count      = $m->cache('app_index_list_count_',3600)->where($where)->count();
		$Page       = new \Think\Page($count,21);
		$show       = $Page->show();
		$list = $m->cache('app_index_list_'.$p.'_'.$o,600)->where($where)->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($list as $kk=>$vv){
			$scoreres=M('appscore')->cache('appsnum'.$vv['aid'],3600)->field('num')->where("aid='{$vv['aid']}'")->order("score desc")->limit(5)->select();
			$list[$kk]['width']=$vv['score']>100?100:$vv['score'];
			$list[$kk]['score']=sprintf("%.1f",$vv['score']/10);
			$list[$kk]['score']=$list[$kk]['score']>10?10:$list[$kk]['score'];
		}
		$this->assign('list',$list);
		
		
		
		$this->assign('page',$show);
        $this->display();
    }
    public function lists(){
		$p=I('get.p','','intval');
		$dir=I('get.dir','','strip_tags,trim');
		$cate=M('appcate')->field(true)->where("dir='{$dir}'")->find();
		$this->getcates($cate[id]);
		if($cate[pid]==0){
			$cates=M('appcate')->field('id,pid')->where("pid='{$cate[id]}'")->select();
			foreach($cates as $k=>$v){
				$ids.=$v[id].',';
			}
			$ids=trim($ids,',');
		}else{
			$ids=$cate[id];
		}
		$m=M('app');
		$where['status']=array('eq','1');
		
		$keyword=I('get.keyword','','strip_tags,trim');
		if(isset($_GET['keyword']) and empty($keyword)){
			$this->error('关键词不能为空');
		}
		if(!empty($keyword)){
			$where['_complex']=array(
				'title'=>array('like',"%$keyword%"),
				'tags'=>array('like',"%$keyword%"),
				'_logic'=>'OR'
			);
			$this->assign('keyword',$keyword);
		}else{
			$where['sid']=array('in',$ids);
		}
		$order='aid desc';
		$o=I('get.o');
		if($o=='t'){
			$order='t desc';
		}
		if($o=='n'){
			$order='n desc';
		}
		$count      = $m->cache('lists_app_count_'.$p.'_'.$dir.'_'.$keyword,3600)->where($where)->count();
		$Page       = new \Think\Page($count,21);
		$show       = $Page->show();
		$list = $m->cache('lists_app_'.$p.'_'.$dir.'_'.$o.'_'.$keyword,600)->where($where)->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();
		
		foreach($list as $kk=>$vv){
			$scoreres=M('appscore')->cache('appsnum'.$vv['aid'],3600)->field('num')->where("aid='{$vv['aid']}'")->order("score desc")->limit(5)->select();
			$list[$kk]['width']=$vv['score']>100?100:$vv['score'];
			$list[$kk]['score']=sprintf("%.1f",$vv['score']/10);
			$list[$kk]['score']=$list[$kk]['score']>10?10:$list[$kk]['score'];
		}
		//echo $m->_sql();exit;
		$this->assign('cate',$cate);
		$this->assign('list',$list);
		
		$this->assign('page',$show);
		//分类
		$subcate=M('appcate')->where("id='{$cate[id]}'")->find();
		if($subcate['pid']>0){
			$r=M('appcate')->where("id='{$subcate['pid']}'")->find();
			$url=U('/app/'.$r['dir']);
			$catename='<label></label><a href="'.$url.'">'.$r['name'].'</a>';
		}
		$url=U('/app/'.$subcate['dir']);
		$catename.='<label></label><a href="'.$url.'">'.$subcate['name'].'</a>';
		$this->assign('catename',$catename);
        $this->display();
    }
    public function info(){
		$aid=I('get.id','','intval');
		$uid=cookie('uid');
		
		M('app')->where("aid=$aid")->setInc('n');
		$info=M('app')->where("aid=$aid and status=1")->find();
		if(!$info) $this->error('小程序未收录或未审核');
		$info['width']=$info['score']>100?100:$info['score'];
		$info['score']=sprintf("%.1f",$info['score']/10);
		$info['score']=$info['score']>10?10:$info['score'];
		$this->assign('info',$info);
		//分类
		$subcate=M('appcate')->where("id='{$info['sid']}'")->find();
		
		if($subcate['pid']>0){
			$r=M('appcate')->where("id='{$subcate['pid']}'")->find();
			$catename='<label><a href="'.U('/app/'.$r['dir']).'" target="_blank">'.$r['name'].'</a></label>';
		}
		$catename.='<label><a href="'.U('/app/'.$subcate['dir']).'" target="_blank">'.$subcate['name'].'</a></label>';
		$this->assign('catename',$catename);
		//标签
		$tags=explode(',',$info['tags']);
		foreach($tags as $v){
			$tagstr.='<span><a href="/app/lists.html?keyword='.$v.'" target="_blank">'.$v.'</a></span>';
		}
		$this->assign('tags',$tagstr);
		//评分处理
		$s=M('appscore');
		$scoreres=$s->field('score,num')->where("aid=$aid")->order("score desc")->limit(5)->select();
		$score=array();
		$snum=0;
		foreach($scoreres as $k=>$v){
			$score[$v['score']]=$v['num'];
			$snum+=$v['num'];
		}
		$sinfo=array();
		$flag=100/$snum;
		for($i=5;$i>0;$i--){
			$sinfo[$i]['num']=$score[$i]?$score[$i]:0;#5-1评分人数
			$sinfo[$i]['width']=$score[$i]*$flag;#5-1评分宽度
		}
		$has=S('has_score_'.$uid.'_'.$aid);
		if($uid && $has){
			$this->assign('hasScore',$has);
		}
		$this->assign('sinfo',$sinfo);
		$this->assign('snum',$snum);
		$this->display();
	}
	public function apply(){
		$uid=cookie('uid');
		if(empty($uid)) $this->error('请登录','/');
		$cates=M('appcate')->where("pid='0'")->select();
		$this->assign('cates',$cates);
		$this->display();
	}
	public function doScore(){
		if(!IS_AJAX) $this->_empty();
		$uid=cookie('uid');
		//$uid = 2;
		if(empty($uid)){
			$ajax['status']=2;
			$ajax['info']='未登录';
			$this->ajaxReturn($ajax);
		}else{
			$m=M('appscore');
			$aid=I('post.cid','','intval');
			$score=I('post.score','','intval');
			//检查用户是否已评分
			if(S('has_score_'.$uid.'_'.$aid)==1){
				$ajax['status']=0;
				$ajax['info']='您已评分';
				$this->ajaxReturn($ajax);
			}
			//更新评分
			switch($score){
				case 5 : M('app')->where("aid=$aid")->setInc('score',2);break;
				case 4 : M('app')->where("aid=$aid")->setInc('score',1);break;
				case 2 : M('app')->where("aid=$aid")->setDec('score',1);break;
				case 1 : M('app')->where("aid=$aid")->setDec('score',2);break;
			}
			$res=$m->where("aid=$aid and score=$score")->find();
			if($res){
				$r=$m->where("aid=$aid and score=$score")->setInc('num');
			}else{
				$r=$m->data(array('aid'=>$aid,'score'=>$score))->add();
			}
			if($r){
				S('has_score_'.$uid.'_'.$aid,$score,3600*24);
				$ajax['status']=1;
				$ajax['info']='评分成功';
				$this->ajaxReturn($ajax);
			}
		}
	}


    public function doMessage(){

        if(!IS_AJAX) $this->_empty();
        $uid=cookie('uid');
        //$uid = 2;

        if(empty($uid)){
            $ajax['status']=2;
            $ajax['info']='未登录';
            $this->ajaxReturn($ajax);
        }else{
            $m=M('message');
            $typeTemp = I('post.type','','intval');
            $contentTemp = I('post.content');

            $createtimeTemp = date("Y-m-d H:i:s");
            $pidTemp = I('post.pid','','intval');
            $catidTemp = I('post.catid','','intval');
            $titleTemp = I('post.title');
            $usernameTemp = "";

            $datates['type'] = $typeTemp;
            $datates['content'] = $contentTemp;
            $datates['uid'] = $uid;
            $datates['createtime'] = $createtimeTemp;
            $datates['flag'] = 1;
            $datates['pid'] = $pidTemp;
            $datates['catid'] = $catidTemp;
            $datates['title'] = $titleTemp;
            $datates['username'] = $usernameTemp;

            $r=$m->data($datates)->add();

            if($r){

                $ajax['status']=1;
                $ajax['info']='评论成功';
                $this->ajaxReturn($ajax);
            }
        }
    }

    public function doMessagelist(){

        if(!IS_AJAX) $this->_empty();
        $m=M('message');
        $user_model=M('user');
        $typeTemp = I('post.type','','intval');
        $catidTemp = I('post.catid','','intval');
        $datates['type'] = $typeTemp;
        $datates['catid'] = $catidTemp;
        $datates['flag'] = 1;
        $r=$m->join('as message left join qw_user as user on message.uid = user.uid')
            ->field('message.id,message.uid,message.pid,message.content,message.createtime,user.name,user.head_big')
            ->where("message.type=".$typeTemp." and catid=".$catidTemp)
            ->order("message.id desc")
            ->select();
        if($r){

            $ajax['status']=1;
            $ajax['list'] = $r;
            $this->ajaxReturn($ajax);
        }
    }
	
}