<?php

namespace Home\Controller;

use Vendor\Page;
use Vendor\TTKClient;
use Think\Upload;

class PublicController extends ComController
{
    public function vcode()
    {
        $Verify = new \Think\Verify();
        $Verify->fontSize = 14;
        $Verify->length = 4;
        $Verify->imageW = 100;
        $Verify->imageH = 38;
        $Verify->useNoise = false;
        $Verify->fontttf = '5.ttf';
        $Verify->entry();
    }

    //验证码检测
    public function check_verify($code, $id = '')
    {
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

    //apply getcategory
    public function getCat()
    {
        $pid = I('get.pid', '', 'intval');
        !$pid && exit();
        $cates = M('appcate')->where("pid='{$pid}'")->select();
        if ($cates) {
            $data['status'] = 1;
            $data['info'] = '';
            $str = '<li class="select" data-id="">选择主分类</li>';
            foreach ($cates as $k => $v) {
                $str .= '<li data-id="' . $v['id'] . '">' . $v['name'] . '</li>';
            }
            $data['data'] = $str;
            $this->ajaxReturn($data);
        }
    }

    //发布页上传图片
    public function uploadfile()
    {
        if (C('ttk_open') == 1) {
            $ttk = new TTKClient(C('tietuku_accesskey'), C('tietuku_secretkey'));
            $res = $ttk->uploadFile(C('tietuku_aid'), $_FILES['file']['tmp_name'], $_FILES['file']['name']);
            $res = json_decode($res, true);
            if (!empty($res['linkurl'])) {
                $ajax['status'] = 1;
                $ajax['info'] = '上传成功';
                $ajax['data']['filename'] = $res['findurl'] . '.' . $res['type'];
                $ajax['data']['thumb'] = $res['t_url'];
                $ajax['data']['url'] = $res[C('tietuku_return_type')];
                $this->ajaxReturn($ajax);
            } else {
                $ajax['status'] = 0;
                $ajax['info'] = $res['info'];
                $this->ajaxReturn($ajax);
            }
            //$res=$ttk->uploadFromWeb('你的相册ID','网络图片地址');

        } else {
            $mimes = array('image/jpeg', 'image/jpg', 'image/jpeg', 'image/png', 'image/pjpeg', 'image/gif', 'image/bmp', 'image/x-png');
            $exts = array('jpeg', 'jpg', 'jpeg', 'png', 'pjpeg', 'gif', 'bmp', 'x-png');
            $rootPath = './Public/';
            $savePath = 'attached/' . date('Y') . "/" . date('m') . "/";
            mkdirs($rootPath . $savePath);
            $upload = new Upload(array(
                'mimes' => $mimes,
                'exts' => $exts,
                'rootPath' => $rootPath,
                'savePath' => $savePath,
                'subName' => array('date', 'd'),
            ));
            $info = $upload->upload($_FILES);

            if ($info) {
                foreach ($info as $item) {
                    $filePath[] = __ROOT__ . "/Public/" . $item['savepath'] . $item['savename'];
                }
                $ImgStr = implode("|", $filePath);
                $ajax['status'] = 1;
                $ajax['info'] = '上传成功';
                $ajax['data']['filename'] = $ImgStr;
                $ajax['data']['thumb'] = $ImgStr;
                $ajax['data']['url'] = $ImgStr;
                $this->ajaxReturn($ajax);
            } else {

                $ajax['status'] = 0;
                $ajax['info'] = $upload->getError();
                $this->ajaxReturn($ajax);
            }
        }
    }

    private function post_app()

    {
        $uid = cookie('uid');
        if (empty($uid)) $this->error('请登录', '/');

        $vcode = I('post.verify');//验证码
        if (!$this->check_verify($vcode)) {
            $ajax['status'] = 0;
            $ajax['info'] = '验证码错误';
            $this->ajaxReturn($ajax);
        }

        $data['title'] = I('post.title', '', 'strip_tags,trim');
        $data['sid'] = I('post.cid', '', 'intval');
        $data['pid'] = I('post.pid', '', 'intval');
        $data['zuozhe'] = I('post.author', '', 'strip_tags,trim');
        $data['thumbnail'] = I('post.icon', '', 'strip_tags,trim');
        $data['qrcode'] = I('post.qrcode', '', 'strip_tags,trim');
        $data['open_qrcode'] = I('post.open_qrcode', '', 'strip_tags,trim');
        $data['description'] = I('post.content', '', 'strip_tags,trim');
        $data['screen'] = I('post.attr_imgs', '', 'strip_tags,trim');
        $data['screen'] = str_replace(',', '|', $data['screen']);
        $data['qq'] = I('post.qq', '', 'strip_tags,trim');
        $data['status'] = 0;
        $data['t'] = time();
        $data['tags'] = I('post.tags', '', 'strip_tags,trim');
        $data['uid'] = $uid;
        $data['weizhi'] = I('post.weizhi', '', 'strip_tags,trim');
        $data['zuobiao'] = I('post.zuobiao', '', 'strip_tags,trim');

        if (!$data['title']) {
            $ajax['status'] = 0;
            $ajax['info'] = '请填写标题';
            $this->ajaxReturn($ajax);
        }
        if (!$data['zuozhe']) {
            $ajax['status'] = 0;
            $ajax['info'] = '请填写作者';
            $this->ajaxReturn($ajax);
        }
        if (!$data['thumbnail']) {
            $ajax['status'] = 0;
            $ajax['info'] = '请上传ICON';
            $this->ajaxReturn($ajax);
        }
        if (!$data['qrcode']) {
            $ajax['status'] = 0;
            $ajax['info'] = '请上传二维码';
            $this->ajaxReturn($ajax);
        }
        if (!$data['description']) {
            $ajax['status'] = 0;
            $ajax['info'] = '请填写介绍';
            $this->ajaxReturn($ajax);
        }
        if (!$data['sid']) {
        $ajax['status'] = 0;
        $ajax['info'] = '请选择子分类';
        $this->ajaxReturn($ajax);
    }
        if (!$data['pid']) {
            $ajax['status'] = 0;
            $ajax['info'] = '请选择主分类';
            $this->ajaxReturn($ajax);
        }
        if (!$data['screen']) {
            $ajax['status'] = 0;
            $ajax['info'] = '请上传小程序截图';
            $this->ajaxReturn($ajax);
        }
        if (!$data['qq']) {
            $ajax['status'] = 0;
            $ajax['info'] = '请输入qq';
            $this->ajaxReturn($ajax);
        }
        if (!$data['weizhi']) {
            $ajax['status'] = 0;
            $ajax['info'] = '请在地图选择位置';
            $this->ajaxReturn($ajax);
        }
        if (!$data['zuobiao']) {
            $ajax['status'] = 0;
            $ajax['info'] = '请在地图选择位置';
            $this->ajaxReturn($ajax);
        }
        return $data;
    }

//发布保存
    public  function save()
    {
        $data = $this->post_app(); //处理提交的数据
        $res = M('app')->data($data)->add();
        if ($res) {
            $ajax['status'] = 1;
            $ajax['info'] = '提交成功，等待管理员审核！加QQ40271442快速审核。';
            $this->ajaxReturn($ajax);
        }
    }
//发布编辑
    public  function update()
    {
        $uid = cookie('uid');
        $aid= I('post.aid', '', 'strip_tags,trim');

        $app =  M('app')->where("aid=$aid and uid=$uid")->find();
        if(!$app){
            $this->redirect('index');
        }

        $data = $this->post_app(); //处理提交的数据
        $res = M('app')->data($data)->where('aid=' . $aid)->save();

        if ($res) {
            $ajax['status'] = 1;
            $ajax['info'] = '提交成功，等待管理员审核！加QQ40271442快速审核。';
            $this->ajaxReturn($ajax);
        }
    }
}