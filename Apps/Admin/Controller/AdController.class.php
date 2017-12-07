<?php


namespace Admin\Controller;

use Vendor\Tree;

class AdController extends ComController
{
/*
 * alter table qw_ad add pos tinyint default 1 comment '位置(如1 首页搜索下3张图(360*240)，2 首页特色专题上2张图(580*240) 3 首页购物上1张图 4 首页热门评测下1张图...)';
 * */
//广告图位置数组
public static $pos = [
    ['id'=>1,'name'=>'首页搜索下3张图(360*240)'],
    ['id'=>2,'name'=>'首页特色专题上2张图(580*240)'],
    ['id'=>3,'name'=>'首页购物上1张图(1200*240)'],
    ['id'=>4,'name'=>'首页热门评测下1张图(1200*240)'],
];
    public function add(){
		$this->assign('pos',self::$pos);
        $this->display('form');
    }

    public function index($sid = 0, $p = 1)
    {


        $p = intval($p) > 0 ? $p : 1;

        $ad = M('ad');
        $pagesize = 20;#每页数量
        $offset = $pagesize * ($p - 1);//计算记录偏移量
        $prefix = C('DB_PREFIX');
        $where = '1 = 1 ';
       //$keyword = I('get.keyword','','');
        $position = I('get.position');
        $st = I('get.status');
        if ($position) {
            $where .= "and {$prefix}ad.position='{$position}' ";
        }
        if ($st!=='' && ($st==1 || $st==0)) {
            $where .= "and {$prefix}ad.status='{$st}' ";
        }
        $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

       
       /* if ($keyword) {
            $where .= "and {$prefix}ad.title like '%{$keyword}%' ";
        }*/
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
        $this->assign('pos',self::$pos);
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
            $this->assign('pos',self::$pos);
            $this->assign('ad', $ad);
        } else {
            $this->error('参数错误！');
        }
        $this->display('form');
    }

    public function update($aid = 0)
    {

        $aid = intval($aid);
        $data['type'] = I('post.type','1','intval'); //类型默认为1 图片类型

		//if($data['type']==1){
			$data['pic'] = I('post.pic','','trim');
            $data['url'] = I('post.url','','trim');
			//$data['width'] = I('post.width','auto','trim');
			//$data['height'] = I('post.height','auto','trim');
		//}
		/*if($data['type']==2){
			$data['word'] = I('post.word','','trim');
		}*/
	/*	if($data['type']==1 || $data['type']==2){
			$data['url'] = I('post.url','','trim');
		}
		if($data['type']==3){
			if(get_magic_quotes_gpc()){
				$data['code'] = I('post.code','','trim,stripslashes');
			}else{
				$data['code'] = I('post.code','','trim');
			}
			
		}*/
        $data['title'] = I('post.title','','trim');
        $data['position'] = I('post.position','1','intval');
//        dump($data['position']);
        $data['status'] = I('post.status','','intval');
		if(!$data['pic']){
			$this->error('图片广告必须上传图片');
		}
       /* if($data['type']==2 && !$data['word']){
			$this->error('文字广告必须填写广告文字');
		}
        if($data['type']==3 && !$data['code']){
			$this->error('代码广告必须填写广告代码');
		}
        if(($data['type']==1 || $data['type']==2) && !$data['url']){
			$this->error('必须填写链接');
		}*/
		
        if ($aid) {
            M('ad')->data($data)->where('aid=' . $aid)->save();
            addlog('编辑广告，AID：' . $aid);
            $this->success('恭喜！广告编辑成功！',U('ad/index'),1);
        } else {
//       dump($data);exit;
            $data['create_time'] = time();
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