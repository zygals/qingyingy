<?php


namespace Admin\Controller;

class SettingController extends ComController
{
    public function other()
    {
		
		$other=include ("other.php");
        $this->assign('other', $other);

        $this->display();
    }
    public function otherupdate()
    {
		
		if(IS_POST){
			
			$post=I('post.');
			$str="<?php\r\n if(!defined('APP_INC')){die();}\r\n return array(\r\n";
			foreach($post as $k=>$v){
				$str.= "\t'$k'=>'$v',\r\n";
			}
			$str.=");";
			$res=file_put_contents("other.php",$str);
			if($res){
				$cache = \Think\Cache::getInstance();
				$cache->clear();
				
				$admindir=$post['ADMIN_DIR']?$post['ADMIN_DIR']:'admin';
				$this->success('设置成功',U('/'.$admindir.'/Setting/other'),1);
			}else{
				$this->success('请设置/other.php为可读写入权限','',3);
			}
			
			exit;
		}else{
			$this->error('请求方式错误');
		}
    }
    public function setting()
    {

        $vars = M('setting')->where('type=1')->select();
        $this->assign('vars', $vars);

        $this->display();
    }

    public function update()
    {
		
        $data = $_POST;
        $data['sitename'] = I('post.sitename','','strip_tags') ;
        $data['title'] = I('post.title','','strip_tags') ;
        $data['keywords'] = I('post.keywords','','strip_tags') ;
        $data['description'] = I('post.description','','strip_tags') ;
		if(get_magic_quotes_gpc()){
			$data['footer'] = I('post.footer','','stripslashes') ;
			$data['cypc'] = I('post.cypc','','stripslashes') ;
			$data['cywap'] = I('post.cywap','','stripslashes') ;
		}else{
			$data['footer'] = I('post.footer','','') ;
			$data['cypc'] = I('post.cypc','','') ;
			$data['cywap'] = I('post.cywap','','') ;
		}
        $data['open_cy'] = I('post.open_cy','','intval') ;
        $Model = M('setting');
        foreach ($data as $k => $v) {
            $Model->data(array('v' => $v))->where("k='{$k}'")->save();
        }
        //清除旧的缓存数据
        $cache = \Think\Cache::getInstance();
        $cache->clear();
        addlog('修改网站配置。');
        $this->success('恭喜，网站配置成功！');
    }
}