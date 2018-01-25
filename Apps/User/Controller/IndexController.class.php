<?php

namespace User\Controller;

use Think\Controller;
use LT\ThinkSDK\ThinkOauth;
use Vendor\TTKClient;
use Think\Upload;

Header('Content-Type: text/html; charset=utf-8');

class IndexController extends Controller
{
	public function _empty(){
        header("HTTP/1.0 404 Not Found");
        $this -> display("Public:404");
		die();
    }
	public function _initialize()
    {
        C(setting());
		$allclick=file_get_contents(RUNTIME_PATH.'allclick.txt');
		file_put_contents(RUNTIME_PATH.'allclick.txt',$allclick+1);
		$this->assign('allclick',$allclick);
        //用户登录信息
		$uid=cookie('uid');
        $myapp = array();
		if($this->check_user_salt()){
			$user=M('user')->getByUid($uid);
			$this->assign('user',$user);

            //取我的小程序
            $myapp = M('app')->where("uid=$uid")->field('aid,title,status')->order('aid asc')->select();

		}

            $this->assign('myapp',$myapp);



    }
	public function logout(){
		
		cookie(null);
		redirect('/');
	}
    //会员首页
    public function index(){
		$uid=cookie('uid');
		if(!$this->check_user_salt()) redirect( U('/user/index/nologin'));
		
        $this->display();
    }
	
	public function message(){
		$uid=cookie('uid');
		if(!$this->check_user_salt()) redirect( U('/user/index/nologin'));
		
		 $this->display();
	}
	public function contact(){
		$uid=cookie('uid');
		if(!$this->check_user_salt()) redirect( U('/user/index/nologin'));
		
		 $this->display();
	}
	/*
	 *  百度地图：根据ip定位城市-zyg
	 * */
	public function getPoint(){
        //百度地图：根据ip定位城市坐标
        $user_ip =  $_SERVER['REMOTE_ADDR'];
        if($user_ip=='127.0.0.1' || !$user_ip){
            $user_ip='124.202.184.186';
        }//请求接口
        $ret= httpGet("http://api.map.baidu.com/location/ip?ip=$user_ip&ak=i5FHCLVvOE9AiquzKFTUNP1MFufetFGw&coor=bd09ll");
        //发布者当前城市
        return json_decode($ret,true);
    }
	/*
	 * 发布小程序表单页面
	 *
	 * zyg添加地图功能
	 * */
	public function apply(){
		$uid=cookie('uid');

        if(!$this->check_user_salt()) redirect( U('/user/index/nologin'));
        $point=$this->getPoint();
        $this->assign('point',$point['content']['point']);

        $cates=M('appcate')->where("pid='0'")->select();
		$this->assign('cates',$cates);

		 $this->display();
	}

	/*
	 * 修改小程序表单页面
	 *  $id:小程序id
	 * zyg添加地图功能
	 * */
	public function applied(){
	   $appid=I('get.id','','int');
		$uid=cookie('uid');
        //查询详情
        $row_app = M('app')->where("uid=$uid and aid = $appid")->find();
        if(!$row_app){
            $this->redirect('index');
        }
        if($row_app['zuobiao']){
            $arr = explode(',',$row_app['zuobiao']);
            $row_app['zuobiaox']= $arr[0];
            $row_app['zuobiaoy']= $arr[1];
        }else{
            $point=$this->getPoint()['content']['point'];
            $row_app['zuobiaox']= $point['x'];
            $row_app['zuobiaoy']= $point['y'];
        }

        $cates=M('appcate')->where("pid='0'")->select(); //一级分类
        $cid= M('appcate')->where("id={$row_app['sid']}")->field('pid,name')->find(); //app二级分类
        $row_app['cid_name']=$cid['name'];
        if(!$row_app['pid']){

            $row_app['pid']=$cid['pid'];
            $pid= M('appcate')->where("id={$cid['pid']}")->field('name')->find(); //app一级分类
            $row_app['pid_name']= $pid['name'];
        }else{
            $pid= M('appcate')->where("id={$row_app['pid']}")->field('name')->find(); //app一级分类
            $row_app['pid_name']= $pid['name'];
        }

        $cates_child= M('appcate')->where("pid={$cid['pid']}")->select();
        $this->assign('cates',$cates);
        $this->assign('cates_child',$cates_child);
        $this->assign('row_app',$row_app);
        if($row_app['screen']){
            $imgs =  explode('|',$row_app['screen']);
            dump($row_app['screen']);
            $this->assign('imgs',$imgs);
        }


        $this->display();
	}
	public function nologin(){
		$uid=cookie('uid');
		if($this->check_user_salt()) redirect(U('/user/index/index'));
		 $this->display();
	}
	public function saveInfo(){
		$uid=cookie('uid');
		if(!$this->check_user_salt()){
			$ajax['status']=0;
			$ajax['msg']='未登录';
			$this->ajaxReturn($ajax);
		}else{
			$data['head']=I('head','','strip_tags');
			$data['head_big']=I('head_big','','strip_tags');
			$data['name']=I('name','','strip_tags');
			$data['sex']=I('sex','','strip_tags');
			$res=M('user')->where("uid='{$uid}'")->data($data)->save();
			$ajax['status']=1;
			$ajax['msg']='保存成功';
			$this->ajaxReturn($ajax);
		}
	}
	public function setavatar(){
		if(C('ttk_open')==1){
			$ttk=new TTKClient(C('tietuku_accesskey'),C('tietuku_secretkey'));
			$res=$ttk->uploadFile(C('tietuku_aid'),$_FILES['file']['tmp_name'],$_FILES['file']['name']);
			$res=json_decode($res,true);
			if(!empty($res['linkurl'])){
				$ajax['status']=1;
				$ajax['info']='上传成功';
				$ajax['url']=$res[C('tietuku_return_type')];
				$this->ajaxReturn($ajax);
			}else{
				$ajax['status']=0;
				$ajax['info']=$res['info'];
				$this->ajaxReturn($ajax);
			}
		}else{
			$mimes = array('image/jpeg','image/jpg','image/jpeg','image/png','image/pjpeg','image/gif','image/bmp','image/x-png');
			$exts = array('jpeg','jpg','jpeg','png','pjpeg','gif','bmp','x-png');
			$rootPath='./Public/';
			$savePath='attached/'.date('Y')."/".date('m')."/";
			mkdirs($rootPath.$savePath);
			$upload = new Upload(array(
				'mimes' => $mimes,
				'exts' => $exts,
				'rootPath' => $rootPath,
				'savePath' => $savePath,
				'subName'  =>  array('date', 'd'),
			));
			$info = $upload->upload($_FILES);
			
			if($info) {
				foreach ($info as $item) {
					$filePath[] = __ROOT__."/Public/".$item['savepath'].$item['savename'];
				}
				$ImgStr = implode("|", $filePath);
				$ajax['status']=1;
				$ajax['info']='上传成功';
				$ajax['url']=$ImgStr;
				$this->ajaxReturn($ajax);
			}
			else{
				
				$ajax['status']=0;
				$ajax['info']= $upload->getError();
				$this->ajaxReturn($ajax);
			}
		}
	}

	private function check_user_salt(){
		$uid=cookie('uid');
		if(!$uid) return false;
		$salt=cookie('salt');
		if($uid && md5($uid.C('COOKIE_QT'))==$salt){
			return true;
		}
		return false;
	}
	
	
	
	
	
	
	
	
    //登录地址
    public function login($type = null,$ref='/')
    {
		
        empty($type) && $this->error('参数错误');
		
		cookie('ref',$ref,300);
		
        //加载ThinkOauth类并实例化一个对象
        $sns = ThinkOauth::getInstance($type);

        //跳转到授权页面
        redirect($sns->getRequestCodeURL());
		
    }

    //授权回调地址
    public function callback($type = null, $code = null)
    {
        (empty($type) || empty($code)) && $this->error('参数错误');

        //加载ThinkOauth类并实例化一个对象
        $sns = ThinkOauth::getInstance($type);

        //腾讯微博需传递的额外参数
        $extend = null;
        if ($type == 'tencent') {
            $extend = array('openid' => $this->_get('openid'), 'openkey' => $this->_get('openkey'));
        }

        //请妥善保管这里获取到的Token信息，方便以后API调用
        //调用方法，实例化SDK对象的时候直接作为构造函数的第二个参数传入
        //如： $qq = ThinkOauth::getInstance('qq', $token);
        $token = $sns->getAccessToken($code, $extend);

        //获取当前登录用户信息
        if (is_array($token)) {
            $user_info = A('Type', 'Event')->$type($token);
			$this->check_user($token,$user_info);
            // echo("<h1>恭喜！使用 {$type} 用户登录成功</h1><br>");
            // echo("授权信息为：<br>");
            // dump($token);
            // echo("当前登录用户信息为：<br>");
            // dump($user_info);
        }
    }
	private function check_user($token,$user_info){
		$m=M('user');
		$user=$m->where("openid='{$token['openid']}'")->find();
		if($user['status']=='0'){
			cookie(null);
			cookie('uid',null);
			cookie('openid',null);
			$this->error('该用户已被禁止，请联系管理员',U('/index/index'));
		}
		if(empty($user)){
			$data['openid']=$token['openid'];
			$data['access_token']=$token['access_token'];
			$data['refresh_token']=$token['refresh_token'];
			$data['name']=$user_info['name'];
			$data['type']=$user_info['type'];
			$data['sex']=$user_info['sex'];
			$data['city']=$user_info['city'];
			$data['head']=$user_info['head'];
			$data['head_big']=$user_info['head_big'];
			$data['lasttime']=time();
			$uid=$m->data($data)->add();
			
		}else{
			// $data['city']=$user_info['city'];
			// $data['head']=$user_info['head'];
			$data['lasttime']=time();
			$m->where("uid='{$user['uid']}'")->data($data)->save();
			$uid=$user['uid'];
		}
		$salt=md5($uid.C('COOKIE_QT'));
		cookie('uid',$uid);
		cookie('salt',$salt);
		$ref=base64_decode(cookie('ref'))?base64_decode(cookie('ref')):'/';
		cookie('ref',null);
		redirect($ref);
	}
}