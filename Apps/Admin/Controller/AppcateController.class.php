<?php


namespace Admin\Controller;

use Vendor\Tree;


class AppcateController extends ComController
{

    public function index()
    {


        $appcate = M('appcate')->field('id,pid,name,o')->order('o asc,id asc')->select();
        $appcate = $this->getMenu($appcate);
        $this->assign('appcate', $appcate);
        $this->display();
    }

    public function del()
    {

        $id = isset($_GET['id']) ? intval($_GET['id']) : false;
        if ($id) {
            $data['id'] = $id;
            $appcate = M('appcate');
            if ($appcate->where('pid=' . $id)->count()) {
                die('2');//存在子类，严禁删除。
            } else {
                $appcate->where('id=' . $id)->delete();
                addlog('删除小程序分类，ID：' . $id);
            }
            die('1');
        } else {
            die('0');
        }

    }

    public function edit()
    {

        $id = isset($_GET['id']) ? intval($_GET['id']) : false;
        $currentappcate = M('appcate')->where('id=' . $id)->find();
        $this->assign('currentappcate', $currentappcate);

        $appcate = M('appcate')->field('id,pid,name')->where("id <> {$id}")->order('o asc,id asc')->select();
        $tree = new Tree($appcate);
        $str = "<option value=\$id \$selected>\$spacer\$name</option>"; //生成的形式
        $appcate = $tree->get_tree(0, $str, $currentappcate['pid']);

        $this->assign('appcate', $appcate);
        $this->display('form');
    }

    public function add()
    {

        $pid = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
        $appcate = M('appcate')->field('id,pid,name')->order('o asc,id asc')->select();
        $tree = new Tree($appcate);
        $str = "<option value=\$id \$selected>\$spacer\$name</option>"; //生成的形式
        $appcate = $tree->get_tree(0, $str, $pid);

        $this->assign('appcate', $appcate);
        $this->display('form');
    }

    public function update($act = null)
    {
        if ($act == 'order') {
            $id = I('post.id', 0, 'intval');
            if (!$id) {
                die('0');
            }
            $o = I('post.o', 0, 'intval');
            M('appcate')->data(array('o' => $o))->where("id='{$id}'")->save();
            addlog('小程序分类修改排序，ID：' . $id);
            die('1');
        }

        $id = I('post.id', false, 'intval');
        $data['type'] = I('post.type', 0, 'intval');
        $data['pid'] = I('post.pid', 0, 'intval');
        $data['name'] = I('post.name');
        $data['dir'] = I('post.dir','',array('strip_tags','trim'));
        $data['seotitle'] = I('post.seotitle', '', 'htmlspecialchars');
        $data['keywords'] = I('post.keywords', '', 'htmlspecialchars');
        $data['description'] = I('post.description', '', 'htmlspecialchars');
        $data['content'] = I('post.content');
        $data['url'] = I('post.url');
        $data['cattemplate'] = I('post.cattemplate');
        $data['contemplate'] = I('post.contemplate');
        $data['o'] = I('post.o', 0, 'intval');
        $data['thumbnail'] = I('post.thumbnail', '', 'trim');
        if ($data['name'] == '') {
            $this->error('小程序分类名称不能为空！');
        }
        if ($data['dir'] == '') {
            $this->error('目录名称不能为空！');
        }
        if ($id) {
            if (M('appcate')->data($data)->where('id=' . $id)->save()) {
                addlog('小程序分类修改，ID：' . $id . '，名称：' . $data['name']);
                $this->success('恭喜，小程序分类修改成功！');
                die(0);
            }
        } else {
            $id = M('appcate')->data($data)->add();
            if ($id) {
                addlog('新增小程序分类，ID：' . $id . '，名称：' . $data['name']);
                $this->success('恭喜，新增小程序分类成功！', 'index');
                die(0);
            }
        }
        $this->success('恭喜，操作成功！');
    }
}
