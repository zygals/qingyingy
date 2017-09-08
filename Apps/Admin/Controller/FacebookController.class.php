<?php


namespace Admin\Controller;

class FacebookController extends ComController
{

    //新增
    public function add($act = null)
    {

        if ($act) {
            $data['content'] = I('post.content', '', 'strip_tags');
            if ($data['content'] == '') {
                $this->error('反馈内容不能为空！');
            }
            $data['v'] = THINK_VERSION;
            $data['url'] = $_SERVER['SERVER_NAME'];

            $url = "http://www.ekcms.com/api/facebook/add";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $r = curl_exec($ch);
            if ($r == 'ok') {
                $this->success('感谢您的反馈！');
                exit(0);
            } else {
                $this->error('系统错误，请稍后再试！');
            }
        }

        $this->display();
    }
}