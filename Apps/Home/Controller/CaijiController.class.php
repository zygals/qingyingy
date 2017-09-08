<?php

namespace Home\Controller;

use Vendor\TTKClient;

class CaijiController extends ComController{
    
	public function _initialize(){
		parent::_initialize();
		$pwd=I('pwd');
		$locoy_pwd=C('LOCOY_PWD');
		if($pwd!=$locoy_pwd && $locoy_pwd){
			$this->error('发布密码错误');
		}
	}
	//评测入库 火车头接口
	public function evaadd(){
		$post['title']=I('post.title','','strip_tags');
		$info=M('eva')->where("title='{$post['title']}'")->find();
		if($info){
			exit("失败:标题重复");
		}
		$post['sid']=I('post.sid','','intval');
		$post['keywords']=trim(I('post.keywords','','strip_tags'),',');
		if(get_magic_quotes_gpc()){
			$post['content'] = I('post.content','','stripslashes');
		}else{
			$post['content'] = I('post.content','','');
		}
		//去除最后一张图片
		$pattern = '/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i';  
		preg_match_all($pattern, $post['content'], $matches); 
		$post['content']=str_replace(end($matches[0]),'',$post['content']);
		
		$post['n']=I('post.n','','intval');
		$post['t']=time();
		$post['status']=1;
		$post['befrom']=I('post.befrom','','strip_tags');
		$post['thumbnail']=$this->getPicUrl(I('post.thumbnail'),'s_url');
		$post['app']=I('post.app','','strip_tags');
		$post['description']='';
		if(empty($post['title']) or empty($post['content'])){
			exit('失败:标题和内容不能为空');
		}
		$res=M('eva')->data($post)->add();
		if($res){
			exit('增加成功！');
		}else{
			exit("失败:".M('eva')->_sql());
		}
	}
	//文章入库 火车头接口
	public function newsadd(){
		$post['title']=I('post.title','','strip_tags');
		$info=M('article')->where("title='{$post['title']}'")->find();
		if(!$info){
			$post['sid']=I('post.sid','','intval');
			$post['keywords']=trim(I('post.keywords','','strip_tags'),',');
			if(get_magic_quotes_gpc()){
				$post['content'] = I('post.content','','stripslashes');
			}else{
				$post['content'] = I('post.content','','');
			}
			//去除最后一张图片
			$pattern = '/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i';  
			preg_match_all($pattern, $post['content'], $matches); 
			$post['content']=str_replace(end($matches[0]),'',$post['content']);
		
			$post['n']=I('post.n','','intval');
			$post['t']=time();
			$post['status']=1;
			$post['befrom']=I('post.befrom','','strip_tags');
			$post['thumbnail']=$this->getPicUrl(I('post.thumbnail'));
			$post['description']='';
			if(empty($post['title']) or empty($post['content'])){
				exit('失败:标题和内容不能为空');
			}
			$res=M('article')->data($post)->add();
		}
		/*
		else{
			$post['content']=I('post.content','','');
			$post['t']=time();
			$res=M('article')->where("aid='{$info['aid']}'")->save($post);
		}
		*/
		if($res){
			exit('增加成功！');
		}else{
			exit("失败:".M('article')->_sql());
		}
	}
	public function getnewscates(){
		$list=M('category')->order("id asc")->select();
		echo '<select>';
		foreach($list as $v){
			echo '<option value="'.$v['id'].'">'.$v['name'].'</option>';
		}
		echo '</select>';
	}
	//小程序火车头接口
	public function appadd(){
		$title = I('post.title','','trim');
		$has=M('app')->where("title='{$title}'")->find();
		if(!$has){
			$data['title']=$title;
			$sid=$this->getSid( I('post.cat_arr','','trim') );
			$data['sid'] = $sid;
			$data['tags'] = trim(I('post.tags','','trim'),',');
			$data['qrcode'] = $this->getPicUrl(I('post.qrcode','','trim'));#
			$data['zuozhe'] = I('post.author','','unicode2utf8tags');
			$data['istop'] = I('post.recommend');
			$data['status'] = I('post.status');
			$data['yaoqiu'] = '';
			$data['description'] = I('post.content','','trim');
			$thumb=$this->getPicUrl(I('post.icon'));
			$data['thumbnail'] = $thumb?$thumb:I('post.icon','','trim');#
			$data['screen'] = $this->getPicUrls(I('post.attr_imgs','','trim'));#
			$data['n'] = I('post.hits');
			$data['t'] = time();
			
			$res1=M('app')->data($data)->add();
			if($res1) exit('增加成功');
		}else{
			$data['sid'] = $this->getSid( I('post.cat_arr','','trim') );
			//$data['istop'] = I('post.recommend');
			$data['n'] = I('post.hits');
			$data['status'] = I('post.status');
			//$data['tags'] = I('post.tags','','trim');
			
			if(!$has['qrcode']) {
				$data['qrcode'] = $this->getPicUrl(I('post.qrcode'));
			}
			$res2=M('app')->where("aid='{$has['aid']}'")->data($data)->save();
			if($res2) exit('更新成功');
		}
	}
	private function getSid($cat){
		trim($cat,',');
		if(!$cat) return;
		if(strpos($cat,',')!==false){
			$cats=explode(',',$cat);
			$cat=$cats[1];
		}else{
			$cat=$cat;
		}
		$a=M('appcate')->cache('appcategetsid',3600)->order('id asc')->select();
		foreach($a as $v){
			$arr[$v['name']]=$v[id];
		}
		return $arr[$cat];
	}
	private function getPicUrl($url,$returnType='t_url'){
		if(!$url) return '';
		$ttk=new TTKClient(C('tietuku_accesskey'),C('tietuku_secretkey'));
		$res=$ttk->uploadFromWeb(C('tietuku_aid'),trim($url));
		$res=json_decode($res,true);
		
		if($res){
			return $res[$returnType];
		}
	}
	private function getPicUrls($url){
		if(!$url) return;
		$arr=explode(',',$url);
		foreach($arr as $v){
			$ttk=new TTKClient(C('tietuku_accesskey'),C('tietuku_secretkey'));
			$res=$ttk->uploadFromWeb(C('tietuku_aid'),$v);
			$res=json_decode($res,true);
			$return[]=$res['s_url'];
		}
		return implode('|',$return);
	}
}