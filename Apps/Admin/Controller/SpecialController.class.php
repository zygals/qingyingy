<?php


namespace Admin\Controller;

use Vendor\Tree;

class SpecialController extends ComController
{

    public function add(){
		
        $this->display('form');
    }

    public function index($sid = 0, $p = 1)
    {


        $p = intval($p) > 0 ? $p : 1;

        $special = M('special');
        $pagesize = 20;#每页数量
        $offset = $pagesize * ($p - 1);//计算记录偏移量
        $prefix = C('DB_PREFIX');
        $keyword = I('get.keyword','','');
        $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';
        $where = '1 = 1 ';
       
        if ($keyword) {
            $where .= "and {$prefix}special.title like '%{$keyword}%' ";
        }
        //默认按照时间降序
        $orderby = "t desc";
        if ($order == "asc") {

            $orderby = "t asc";
        }
       


        $count = $special->where($where)->count();
        $list = $special->field("{$prefix}special.*")->where($where)->order($orderby)->limit($offset . ',' . $pagesize)->select();
		//echo $special->_sql();exit;
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
            if (M('special')->where($map)->delete()) {
                addlog('删除专题，AID：' . $aids);
                $this->success('恭喜，专题删除成功！');
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
        $special = M('special')->where('aid=' . $aid)->find();
		//dump($special);exit;
        if ($special) {
            $this->assign('special', $special);
			//包含小程序
			if(!empty($special['apps'])){
				$apps=M('app')->field('aid,title')->where("aid in ({$special[apps]})")->select();
				$this->assign('apps',$apps);
			}
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
        $data['n'] = I('post.n', '', 'intval');
		$data['befrom'] = I('post.befrom', '', '');
		$data['apps'] = implode(',',I('post.apps'));
		
        if ( !$data['title'] or !$data['content']) {
            $this->error('警告！标题、内容为必填项目。');
        }
		
        if ($aid) {
            M('special')->data($data)->where('aid=' . $aid)->save();
            addlog('编辑专题，AID：' . $aid);
            $this->success('恭喜！专题编辑成功！');
        } else {
            $aid = M('special')->data($data)->add();
            if ($aid) {
                addlog('新增专题，AID：' . $aid);
                $this->success('恭喜！专题新增成功！');
            } else {
                $this->error('抱歉，未知错误！');
            }

        }
    }
	public function getAppId(){
		$text=I('post.text','','strip_tags,trim');
		$res=M('app')->where("title='{$text}'")->find();
		if($res){
			$ajax['code']=1;
			$ajax['aid']=$res['aid'];
			$ajax['title']=$res['title'];
			$this->ajaxReturn($ajax);
		}else{
			$ajax['code']=0;
			$ajax['msg']='没找到小程序';
			$this->ajaxReturn($ajax);
		}
	}
}