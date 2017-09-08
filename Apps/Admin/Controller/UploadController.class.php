<?php


namespace Admin\Controller;

use Think\Upload;
use Vendor\TTKClient;

class UploadController extends ComController
{
    
    public function index($type = null)
    {

    }

    public function uploadpic()
    {
		
        $Img = I('Img');
        $Path = null;
        if ($_FILES['img']) {
			
			if(C('ttk_open')==1){
				if(!C('tietuku_accesskey')||!C('tietuku_secretkey')||!C('tietuku_aid')||!C('tietuku_return_type')){
					exit("<script>alert('请在”系统设置-自定义变量“设置贴图库配置！')</script>");
				}
				$ttk=new TTKClient(C('tietuku_accesskey'),C('tietuku_secretkey'));
				$res=$ttk->curlUpFile(C('tietuku_aid'),'img');
				$res=json_decode($res,true);
				$Img=$res[C('tietuku_return_type')];
				
			}else{
				$Img = $this->saveimg($_FILES);
			}
            
        }
        $BackCall = I('BackCall');
        $Width = I('Width');
        $Height = I('Height');
        if (!$BackCall) {
            $Width = $_POST['BackCall'];
        }
        if (!$Width) {
            $Width = $_POST['Width'];
        }
        if (!$Height) {
            $Width = $_POST['Height'];
        }
        $this->assign('Width', $Width);
        $this->assign('BackCall', $BackCall);
        $this->assign('Img', $Img);
        $this->assign('Height', $Height);
        $this->display('Uploadpic');
    }

    private function saveimg($files)
    {
		
        $mimes = array(
            'image/jpeg',
            'image/jpg',
            'image/jpeg',
            'image/png',
            'image/pjpeg',
            'image/gif',
            'image/bmp',
            'image/x-png'
        );
        $exts = array(
            'jpeg',
            'jpg',
            'jpeg',
            'png',
            'pjpeg',
            'gif',
            'bmp',
            'x-png'
        );
		$rootPath='./Public/';
		$savePath='attached/'.date('Y')."/".date('m')."/";
		mkdirs($rootPath.$savePath);
        $upload = new Upload(array(
            'mimes' => $mimes,
            'exts' => $exts,
            'rootPath' => $rootPath,
            'savePath' => $savePath,
            'subName'  =>  array('date', 'd'),
        ));
        $info = $upload->upload($files);
		
        if(!$info) {// 上传错误提示错误信息
            $error = $upload->getError();
            echo "<script>alert('{$error}')</script>";
        }else{// 上传成功
            foreach ($info as $item) {
                $filePath[] = __ROOT__."/Public/".$item['savepath'].$item['savename'];
            }
            $ImgStr = implode("|", $filePath);
            return $ImgStr;
        }
    }

    public function batchpic()
    {
		
        $ImgStr = I('Img');
        $ImgStr = trim($ImgStr, '|');
        $Img = array();
        if (strlen($ImgStr) > 1) {
            $Img = explode('|', $ImgStr);
        }
        $Path = null;
        $newImg = array();
        $newImgStr = null;
        if ($_FILES) {
			if(C('ttk_open')==1){
				if(!C('tietuku_accesskey')||!C('tietuku_secretkey')||!C('tietuku_aid')||!C('tietuku_return_type')){
					exit("<script>alert('请在”系统设置-自定义变量“设置贴图库配置！')</script>");
				}
				$ttk=new TTKClient(C('tietuku_accesskey'),C('tietuku_secretkey'));
				$res=$ttk->curlUpFile(C('tietuku_aid'),'uploadimg');
				$res=json_decode($res,true);
				foreach($res as $v){
					$Imgs[]=$v[C('tietuku_return_type')];
				}
				$newImgStr=implode('|',$Imgs);
			}else{
				$newImgStr = $this->saveimg($_FILES);
			}
			
            if ($newImgStr) {
                $newImg = explode('|', $newImgStr);
            }

        }
        $Img = array_merge($Img,$newImg);
        $ImgStr = implode("|", $Img);
        $BackCall = I('BackCall');
        $Width = I('Width');
        $Height = I('Height');
        if (!$BackCall) {
            $BackCall = $_POST['BackCall'];
        }
        if (!$Width) {
            $Width = $_POST['Width'];
        }
        if (!$Height) {
            $Height = $_POST['Height'];
        }
        $this->assign('Width', $Width);
        $this->assign('BackCall', $BackCall);
        $this->assign('ImgStr', $ImgStr);
        $this->assign('Img', $Img);
        $this->assign('Height', $Height);
        $this->display('Batchpic');
    }
}
