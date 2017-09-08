<?php


namespace Admin\Controller;

use Vendor\Tree;

class AppController extends ComController
{

    public function add()
    {

        $appcate = M('appcate')->field('id,pid,name')->order('o asc,id asc')->select();
        $tree = new Tree($appcate);
        $str = "<option value=\$id \$selected>\$spacer\$name</option>"; //生成的形式
        $appcate = $tree->get_tree(0, $str, 0);
        $this->assign('appcate', $appcate);//导航
        $this->display('form');
    }

    public function index($sid = 0, $p = 1)
    {
		
		header("Content-type:text/html;charset=utf-8");
        $p = intval($p) > 0 ? $p : 1;

        $app = M('app');
        $pagesize = 20;#每页数量
        $offset = $pagesize * ($p - 1);//计算记录偏移量
        $prefix = C('DB_PREFIX');
        $sid = isset($_GET['sid']) ? $_GET['sid'] : '';
        $keyword = I('get.keyword');
        $status = I('get.status');
        $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';
        $where = '1 = 1 ';
        if ($sid) {
            $sids_array = category_get_sons_app($sid);
            $sids = implode(',',$sids_array);
            $where .= "and {$prefix}app.sid in ($sids) ";
        }
		
        if ($keyword) {
            $where .= "and {$prefix}app.title like '%{$keyword}%' ";
        }
		if($status!==''){
			$where .= "and {$prefix}app.status = '$status' ";
		}
        //默认按照时间降序
        $orderby = "t desc";
        if ($order == "asc") {

            $orderby = "t asc";
        }
        //获取栏目分类
        $appcate = M('appcate')->field('id,pid,name')->order('o asc,id asc')->select();
        $tree = new Tree($appcate);
        $str = "<option value=\$id \$selected>\$spacer\$name</option>"; //生成的形式
        $appcate = $tree->get_tree(0, $str, $sid);
        $this->assign('appcate', $appcate);//导航


        $count = $app->where($where)->count();
        $list = $app->field("{$prefix}app.*,{$prefix}appcate.name")->where($where)->order($orderby)->join("{$prefix}appcate ON {$prefix}appcate.id = {$prefix}app.sid")->limit($offset . ',' . $pagesize)->select();
		//echo $app->_sql();exit;
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
            if (M('app')->where($map)->delete()) {
                addlog('删除小程序，AID：' . $aids);
                $this->success('恭喜，小程序删除成功！');
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
        $app = M('app')->where('aid=' . $aid)->find();
        if ($app) {

            $appcate = M('appcate')->field('id,pid,name')->order('o asc,id asc')->select();
            $tree = new Tree($appcate);
            $str = "<option value=\$id \$selected>\$spacer\$name</option>"; //生成的形式
            $appcate = $tree->get_tree(0, $str, $app['sid']);
            $this->assign('appcate', $appcate);//导航

            $this->assign('app', $app);
        } else {
            $this->error('参数错误！');
        }
        $this->display('form');
    }

    public function update($aid = 0)
    {

        $aid = intval($aid);
        $data['sid'] = isset($_POST['sid']) ? intval($_POST['sid']) : 0;
		if($cr=M('appcate')->field('id,pid')->where("id='{$data['sid']}'")->find()){
			if($cr['pid']<=0){
				$this->error('警告！顶级分类不能添加内容。');				
			}
		}
        $data['title'] = isset($_POST['title']) ? $_POST['title'] : false;
        $data['tags'] = isset($_POST['tags']) ? $_POST['tags'] : '';
        $data['qrcode'] = isset($_POST['qrcode']) ? $_POST['qrcode'] : '';
        $data['open_qrcode'] = isset($_POST['open_qrcode']) ? $_POST['open_qrcode'] : '';
        $data['zuozhe'] = isset($_POST['zuozhe']) ? $_POST['zuozhe'] : '';
	$data['befrom'] = I('befrom','','trim');
        $data['seotitle'] = I('seotitle','','trim');
        $data['keywords'] = I('keywords','','trim');
        
        $data['istop'] = isset($_POST['istop']) ? $_POST['istop'] : '';
        $data['status'] = isset($_POST['status']) ? $_POST['status'] : '';
        $data['yaoqiu'] = I('post.yaoqiu', '', 'strip_tags');
        $data['description'] = I('post.description', '', 'strip_tags');
        //$data['content'] = isset($_POST['content']) ? $_POST['content'] : false;
        $data['thumbnail'] = I('post.thumbnail', '', 'strip_tags');
        $data['screen'] = I('post.screen', '', 'strip_tags');
        $data['t'] = time();
        if (!$data['sid'] or !$data['title']) {
            $this->error('警告！小程序分类、小程序标题为必填项目。');
        }
        if ($aid) {
            M('app')->data($data)->where('aid=' . $aid)->save();
            addlog('编辑小程序，AID：' . $aid);
            $this->success('恭喜！小程序编辑成功！');
        } else {
            $aid = M('app')->data($data)->add();
            if ($aid) {
                addlog('新增小程序，AID：' . $aid);
                $this->success('恭喜！小程序新增成功！');
            } else {
                $this->error('抱歉，未知错误！');
            }

        }
    }
}