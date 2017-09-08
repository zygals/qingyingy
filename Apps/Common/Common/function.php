<?php
//返回当前页完整url
function refersh_url(){
	$url = trim('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'],'?');
	return base64_encode($url);
}
//广告处理
function ad($aid){
	if(!$aid) return false;
	$res=M('ad')->cache('funcad'.$aid)->getByAid($aid);
	$end='<script class="status'.$res[aid].'">var status'.$res[aid].'="'.$res[status].'";if(status'.$res[aid].'==0){$(".status'.$res[aid].'").parent().hide()}</script>';
	if($res['status']==0){
		echo $end;
	}
	
	if($res['type']==1){
		echo '<a href="'.$res['url'].'" target="_blank"><img src="'.$res['pic'].'" alt="'.$res['title'].'" width="'.$res['width'].'" height="'.$res['height'].'" /></a>'.$end;
	}
	if($res['type']==2){
		echo '<a href="'.$res['url'].'" target="_blank">'.$res['word'].'</a>'.$end;
	}
	if($res['type']==3){
		echo '<span></span>'.$res['code'].$end;
	}
}


class Helper_Tool
{
  static function unicodeDecode($data)
  {  
    function replace_unicode_escape_sequence($match) {
      return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
    }  
 
    $rs = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $data);
 
    return $rs;
  }  
}
// $data = Helper_Tool::unicodeDecode($name);
//将UNICODE编码后的内容进行解码
function unicode2utf8($name)
{
    //转换编码，将Unicode编码转换成可以浏览的utf-8编码
    $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
    preg_match_all($pattern, $name, $matches);
    if (!empty($matches))
    {
        $name = '';
        for ($j = 0; $j < count($matches[0]); $j++)
        {
            $str = $matches[0][$j];
            if (strpos($str, '\\u') === 0)
            {
                $code = base_convert(substr($str, 2, 2), 16, 10);
                $code2 = base_convert(substr($str, 4), 16, 10);
                $c = chr($code).chr($code2);
                $c = iconv('UCS-2', 'UTF-8', $c);
                $name .= $c;
            }
            else
            {
                $name .= $str;
            }
        }
    }
    return $name;
}
function unicode2utf8tags($name)
{
    $json = '{"str":"'.$name.'"}';
	$arr = json_decode($json,true);
	if(empty($arr)) return ''; 
	return $arr['str'];
}
function UpImage($callBack = "image", $width = 100, $height = 100, $image = "")
{

    echo '<iframe scrolling="no" frameborder="0" border="0" onload="this.height=this.contentWindow.document.body.scrollHeight;this.width=this.contentWindow.document.body.scrollWidth;" width=' . $width . ' height="' . $height . '"  src="' . U('Upload/uploadpic',
            array('Width' => $width, 'Height' => $height, 'BackCall' => $callBack)) . '"></iframe>
         <input type="hidden" ' . 'value = "' . $image . '"' . 'name="' . $callBack . '" id="' . $callBack . '">';
}

function BatchImage($callBack = "image", $width = 100, $height = 100, $image = "")
{
    
    echo '<iframe scrolling="no" frameborder="0" border="0" width=100% onload="this.height=this.contentWindow.document.body.scrollHeight;" src="' . U('Upload/batchpic',
            array('Width' => $width, 'Height' => $height, 'BackCall' => $callBack)) . '"></iframe>
		<input type="hidden" ' . 'value = "' . $image . '"' . 'name="' . $callBack . '" id="' . $callBack . '">';
}


/*
 * 函数：网站配置获取函数
 * @param  string $k      可选，配置名称
 * @return array          用户数据
*/
function setting($k = 'all')
{
    $cache = S($k);
    //如果缓存不为空直接返回
    if (null != $cache) {
        return $cache;
    }
    $data = '';
    $setting = M('setting');
    //判断是否查询全部设置项
    if ($k == 'all') {
        $setting = $setting->field('k,v')->select();
        foreach ($setting as $v) {
            $config[$v['k']] = $v['v'];
        }
        $data = $config;

    } else {
        $result = $setting->where("k='{$k}'")->find();
        $data = $result['v'];

    }
    //建立缓存
    if ($data) {
        S($k, $data);
    }
    return $data;
}

/**
 * 函数：格式化字节大小
 * @param  number $size 字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '')
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) {
        $size /= 1024;
    }
    return round($size, 2) . $delimiter . $units[$i];
}

/**
 * 函数：加密
 * @param string            密码
 * @return string           加密后的密码
 */
function password($password)
{
    /*
    *后续整强有力的加密函数
    */
    return md5('Q' . $password . 'W');

}

/**
 * 随机字符
 * @param number $length 长度
 * @param string $type 类型
 * @param number $convert 转换大小写
 * @return string
 */
function random($length = 6, $type = 'string', $convert = 0)
{
    $config = array(
        'number' => '1234567890',
        'letter' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'string' => 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789',
        'all' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
    );

    if (!isset($config[$type])) {
        $type = 'string';
    }
    $string = $config[$type];

    $code = '';
    $strlen = strlen($string) - 1;
    for ($i = 0; $i < $length; $i++) {
        $code .= $string{mt_rand(0, $strlen)};
    }
    if (!empty($convert)) {
        $code = ($convert > 0) ? strtoupper($code) : strtolower($code);
    }
    return $code;
}

//获取所有的子级id
function category_get_sons($sid, &$array = array())
{
    //获取当前sid下的所有子栏目的id
    $categorys = M("category")->where("pid = {$sid}")->select();

    $array = array_merge($array, array($sid));
    foreach ($categorys as $category) {
        category_get_sons($category['id'], $array);
    }
    $data = $array;
    unset($array);
    return $data;

}
//获取所有的子级id
function category_get_sons_app($sid, &$array = array())
{
    //获取当前sid下的所有子栏目的id
    $categorys = M("appcate")->where("pid = '{$sid}'")->select();

    $array = array_merge($array, array($sid));
    foreach ($categorys as $category) {
        category_get_sons($category['id'], $array);
    }
    $data = $array;
    unset($array);
    return $data;

}


/**
 * 获取文章url地址
 * url结构：分类/子分类/子分类
 * 使用方法：模板中{:articleUrl(array('aid'=>$val['aid']))}
 *
 *
 * @param $data
 * @return $string
 */
function articleUrl($data)
{
    //如果数组为空直接返回空字符
    if (!$data) {
        return '';
    }
    //如果参数错误直接返回空字符
    if (!isset($data['aid'])) {
        return '';
    }

    $aid = (int)$data['aid'];

    //获取文章信息
    $article = M('article')->where(array('aid' => $aid))->find();
    //获取当前内容所在分类
    $category = M('category')->where(array('id' => $article['sid']))->find();
    //获取当前分类
    $categoryUrl = $category['dir'];
    //遍历获取当前文章所在分类的有上级分类并且组合url
    while ($category['pid'] <> 0) {
        $category = M('category')->where(array('id' => $category['pid']))->find();
        $categoryUrl = $category['dir'] . "/" . $categoryUrl;
        //如果上级分类已经无上级分类则退出
    }

    $categoryUrl = __ROOT__ . "/" . $categoryUrl;
    //组合文章url
    $articleUrl = $categoryUrl . '/' . $aid . ".html";
    return $articleUrl;

}
function mkdirs($dir, $mode = 0777)
{
    if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
    if (!mkdirs(dirname($dir), $mode)) return FALSE;
    return @mkdir($dir, $mode);
} 








