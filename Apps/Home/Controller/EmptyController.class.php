<?php
namespace Home\Controller;
use Think\Controller;
class EmptyController extends ComController{
	//空操作_empty()方法
    public function _empty(){
        header("HTTP/1.0 404 Not Found");
        $this -> display("Public:404");
		die();
    }
    public function index(){
        header("HTTP/1.0 404 Not Found");
        $this -> display("Public:404");
		die();
    }
}
?>