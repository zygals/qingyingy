<?php


namespace Admin\Controller;

use Vendor\Tree;

class UserController extends ComController
{

    public function index($sid = 0, $p = 1)
    {


        $p = intval($p) > 0 ? $p : 1;

        $user = M('user');
        $pagesize = 20;#每页数量
        $offset = $pagesize * ($p - 1);//计算记录偏移量
        $prefix = C('DB_PREFIX');
        $keyword = I('get.keyword','','');
        $where = '1 = 1 ';
       
        if ($keyword) {
            $where .= "and {$prefix}user.name like '%{$keyword}%' ";
        }
        //默认按照时间降序
        $orderby = "uid desc";
       
       


        $count = $user->where($where)->count();
        $list = $user->field("{$prefix}user.*")->where($where)->order($orderby)->limit($offset . ',' . $pagesize)->select();
		//echo $user->_sql();exit;
        $page = new \Think\Page($count, $pagesize);
        $page = $page->show();
        $this->assign('list', $list);
        $this->assign('page', $page);
        $this->display();
    }

    public function del()
    {

        $uids = isset($_REQUEST['uids']) ? $_REQUEST['uids'] : false;
        if ($uids) {
            if (is_array($uids)) {
                $uids = implode(',', $uids);
                $map['uid'] = array('in', $uids);
            } else {
                $map = 'uid=' . $uids;
            }
            if (M('user')->where($map)->delete()) {
                addlog('删除会员，uid：' . $uids);
                $this->success('恭喜，会员删除成功！');
            } else {
                $this->error('参数错误！');
            }
        } else {
            $this->error('参数错误！');
        }

    }

    public function edit($uid)
    {

        $uid = intval($uid);
        $user = M('user')->where('uid=' . $uid)->find();
        if ($user) {
            $this->assign('user', $user);
        } else {
            $this->error('参数错误！');
        }
        $this->display('form');
    }

    public function update($uid = 0)
    {

        $uid = intval($uid);
        $data['name'] = I('post.name','','trim');
        $data['sex'] = I('post.sex','','trim');
        $data['type'] = I('post.type','','trim');
        $data['status'] = I('post.status','','intval');
        $data['head'] = I('post.head','','trim');
        $data['city'] = I('post.city','','trim');
		
		
        if ($uid) {
            M('user')->data($data)->where('uid=' . $uid)->save();
            addlog('编辑会员，uid：' . $uid);
            $this->success('恭喜！会员编辑成功！',U('user/index'),1);
        } else {
            $uid = M('user')->data($data)->add();
            if ($uid) {
                addlog('新增会员，uid：' . $uid);
                $this->success('恭喜！会员新增成功！');
            } else {
                $this->error('抱歉，未知错误！');
            }

        }
    }
}