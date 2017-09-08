<?php


namespace Admin\Controller;

use Vendor\Tree;

class EvaController extends ComController
{

    public function add(){
		
        $this->display('form');
    }

    public function index($sid = 0, $p = 1)
    {


        $p = intval($p) > 0 ? $p : 1;

        $eva = M('eva');
        $pagesize = 20;#每页数量
        $offset = $pagesize * ($p - 1);//计算记录偏移量
        $prefix = C('DB_PREFIX');
        $keyword = I('get.keyword','','');
        $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';
        $where = '1 = 1 ';
       
        if ($keyword) {
            $where .= "and {$prefix}eva.title like '%{$keyword}%' ";
        }
        //默认按照时间降序
        $orderby = "aid desc";
        if ($order == "asc") {

            $orderby = "t asc";
        }
       


        $count = $eva->where($where)->count();
        $list = $eva->field("{$prefix}eva.*")->where($where)->order($orderby)->limit($offset . ',' . $pagesize)->select();
		//echo $eva->_sql();exit;
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
            if (M('eva')->where($map)->delete()) {
                addlog('删除评测，AID：' . $aids);
                $this->success('恭喜，评测删除成功！');
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
        $eva = M('eva')->where('aid=' . $aid)->find();
        if ($eva) {
            $this->assign('eva', $eva);
        } else {
            $this->error('参数错误！');
        }
        $this->display('form');
    }

    public function update($aid = 0)
    {

        $aid = intval($aid);
        $data['title'] = isset($_POST['title']) ? $_POST['title'] : false;
        $data['seotitle'] = isset($_POST['seotitle']) ? $_POST['seotitle'] : '';
        $data['keywords'] = I('post.keywords', '', 'strip_tags');
        $data['description'] = I('post.description', '', 'strip_tags');
        if(get_magic_quotes_gpc()){
			$data['content'] = I('post.content','','stripslashes');
		}else{
			$data['content'] = I('post.content','','');
		}
        $data['thumbnail'] = I('post.thumbnail', '', 'strip_tags');
        $data['t'] = time();
		$data['app'] = I('post.app', '', 'strip_tags');
		$data['befrom'] = I('post.befrom', '', '');
        if (!$data['app'] or !$data['title'] or !$data['content']) {
            $this->error('警告！标题、关联小程序、内容为必填项目。');
        }
		
        if ($aid) {
            M('eva')->data($data)->where('aid=' . $aid)->save();
            addlog('编辑评测，AID：' . $aid);
            $this->success('恭喜！评测编辑成功！',U('eva/index'),1);
        } else {
            $aid = M('eva')->data($data)->add();
            if ($aid) {
                addlog('新增评测，AID：' . $aid);
                $this->success('恭喜！评测新增成功！');
            } else {
                $this->error('抱歉，未知错误！');
            }

        }
    }
}