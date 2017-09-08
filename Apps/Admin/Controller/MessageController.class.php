<?php


namespace Admin\Controller;

use Vendor\Tree;

class MessageController extends ComController
{

    public function add(){
		
        $this->display('form');
    }

    public function index($sid = 0, $p = 1)
    {


        $p = intval($p) > 0 ? $p : 1;

        $message = M('message');
        $pagesize = 20;#每页数量
        $offset = $pagesize * ($p - 1);//计算记录偏移量
        $prefix = C('DB_PREFIX');

        $where = 'flag = 1 ';
       

        //默认按照时间降序
        $orderby = "createtime desc";

        $count = $message->where($where)->count();
        $list = $message->field("{$prefix}message.*")->where($where)->order($orderby)->limit($offset . ',' . $pagesize)->select();
		//echo $ad->_sql();exit;
        $page = new \Think\Page($count, $pagesize);
        $page = $page->show();
        $this->assign('list', $list);
        $this->assign('page', $page);
        $this->display();
    }

    public function del()
    {

        $messageid = isset($_REQUEST['id']) ? $_REQUEST['id'] : false;
        if ($messageid) {
            $map = 'id=' . $messageid;
            if (M('message')->where($map)->delete()) {
                addlog('删除广告，AID：' . $aids);
                $this->success('恭喜，留言删除成功！');
            } else {
                $this->error('参数错误！');
            }
        } else {
            $this->error('参数错误！');
        }

    }

}