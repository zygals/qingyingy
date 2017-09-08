<?php

namespace Mobile\Controller;

use Vendor\Page;
use Vendor\TTKClient;

class UserController extends ComController
{
	public function index(){
		$uid=cookie('uid');
		$salt=cookie('salt');
		if(!$uid || md5($uid.C('COOKIE_QT'))!=$salt){
			redirect(U('/index/index'));
		}
		$this->display();
	}
	public function logout(){
		cookie(null);
		cookie('uid',null);
		cookie('openid',null);
		cookie(null);
		redirect('/');
	}
}