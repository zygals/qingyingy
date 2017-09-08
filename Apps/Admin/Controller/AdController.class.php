<?php


namespace Admin\Controller;

use Vendor\Tree;

class AdController extends ComController
{

    public function add(){
		
        $this->display('form');
    }

    public function index($sid = 0, $p = 1)
    {


        $p = intval($p) > 0 ? $p : 1;

        $ad = M('ad');
        $pagesize = 20;#每页数量
        $offset = $pagesize * ($p - 1);//计算记录偏移量
        $prefix = C('DB_PREFIX');
        $keyword = I('get.keyword','','');
        $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';
        $where = '1 = 1 ';
       
        if ($keyword) {
            $where .= "and {$prefix}ad.title like '%{$keyword}%' ";
        }
        //默认按照时间降序
        $orderby = "aid desc";
        if ($order == "asc") {

            $orderby = "t asc";
        }
       


        $count = $ad->where($where)->count();
        $list = $ad->field("{$prefix}ad.*")->where($where)->order($orderby)->limit($offset . ',' . $pagesize)->select();
		//echo $ad->_sql();exit;
        $page = new \Think\Page($count, $pagesize);
        $page = $page->show();
        $this->assign('list', $list);
        $this->assign('page', $page);
        $this->display();
    }

    public function del()
    {

        $aids = isset($_REQUEST['aids']) ? $_REQUEST['aids'] : false;
        if ($aids) {
            if (is_array($aids)) {
                $aids = implode(',', $aids);
                $map['aid'] = array('in', $aids);
            } else {
                $map = 'aid=' . $aids;
            }
            if (M('ad')->where($map)->delete()) {
                addlog('删除广告，AID：' . $aids);
                $this->success('恭喜，广告删除成功！');
            } else {
                $this->error('参数错误！');
            }
        } else {
            $this->error('参数错误！');
        }

    }

    public function edit($aid)
    {

        $aid = intval($aid);
        $ad = M('ad')->where('aid=' . $aid)->find();
        if ($ad) {
            $this->assign('ad', $ad);
        } else {
            $this->error('参数错误！');
        }
        $this->display('form');
    }

    public function update($aid = 0)
    {

        $aid = intval($aid);
        $data['type'] = I('post.type','','intval');
		if($data['type']==1){
			$data['pic'] = I('post.pic','','trim');
			$data['width'] = I('post.width','auto','trim');
			$data['height'] = I('post.height','auto','trim');
		}
		if($data['type']==2){
			$data['word'] = I('post.word','','trim');
		}
		if($data['type']==1 || $data['type']==2){
			$data['url'] = I('post.url','','trim');
		}
		if($data['type']==3){
			if(get_magic_quotes_gpc()){
				$data['code'] = I('post.code','','trim,stripslashes');
			}else{
				$data['code'] = I('post.code','','trim');
			}
			
		}
        $data['title'] = I('post.title','','trim');
        $data['status'] = I('post.status','','intval');
		if($data['type']==1 && !$data['pic']){
			$this->error('图片广告必须上传图片');
		}
        if($data['type']==2 && !$data['word']){
			$this->error('文字广告必须填写广告文字');
		}
        if($data['type']==3 && !$data['code']){
			$this->error('代码广告必须填写广告代码');
		}
        if(($data['type']==1 || $data['type']==2) && !$data['url']){
			$this->error('必须填写链接');
		}
		
        if ($aid) {
            M('ad')->data($data)->where('aid=' . $aid)->save();
            addlog('编辑广告，AID：' . $aid);
            $this->success('恭喜！广告编辑成功！',U('ad/index'),1);
        } else {
            $aid = M('ad')->data($data)->add();
            if ($aid) {
                addlog('新增广告，AID：' . $aid);
                $this->success('恭喜！广告新增成功！');
            } else {
                $this->error('抱歉，未知错误！');
            }

        }
    }
}