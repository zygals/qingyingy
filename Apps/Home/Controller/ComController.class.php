<?php


namespace Home\Controller;

use Think\Controller;

class ComController extends Controller
{
	public function _empty(){
        header("HTTP/1.0 404 Not Found");
        $this -> display("Public:404");
		die();
    }
    public function _initialize()
    {
        //如果访问不是https://则转为https:
		if(!isset($_SERVER['HTTPS'])){
		//	header('Location: https://www.qingyy.net/');
		}
		C(setting());
		$allclick=file_get_contents(RUNTIME_PATH.'allclick.txt');
		file_put_contents(RUNTIME_PATH.'allclick.txt',$allclick+1);
		$this->assign('allclick',$allclick);
        //用户登录信息
		$uid=cookie('uid');
		$salt=cookie('salt');
		if($uid && md5($uid.C('COOKIE_QT'))==$salt){
			$user=M('user')->getByUid($uid);
			if($user['status']=='0'){
				$this->error('该用户已被禁止，请联系管理员',U('/index/index'));
			}
			$this->assign('user',$user);
		}
    }
}
