<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>图片上传</title>
    <style>
    body {
        margin: 0;
        padding: 0;
    }
    .iconbox{
        margin: 0;
        padding: 0;
    }
    .icon{
        float: left;
        margin: 0 10px 10px 0;
        width: <?php echo ($Width); ?>px;
        height: <?php echo ($Height); ?>px;
        text-align: center;
        overflow: hidden;
        border: 1px solid #CCC;
        line-height: <?php echo ($Height); ?>px;
        position: relative;
    }
    .icon img{
        max-height:<?php echo ($Height); ?>px;
    }
    .icon .remove{
        position: absolute;
        width: 40px;
        height: 20px;
        top: 0;
        right: 0;
        line-height: 20px;
        font-size: 12px;
        color: #FFF;
        background: #C00;
        cursor: pointer;
    }
    .file_box {
        display: inline-block;
        float: left;
        margin: 0 10px 10px 0;
        width: <?php echo ($Width); ?>px;
        height: <?php echo ($Height); ?>px;
        text-align: center;
        line-height: <?php echo ($Height); ?>px;
        color: #FFF;
        background: #3E4B5B;
        position: relative;
        overflow: hidden;
        margin: 0 0 10px 0;
    }

    .file_box:hover {
        color: #FFF;
    }
    #uploadicon {
        position: absolute;
        right: 0;
        top: 0;
        font-size: 100px;
        opacity: 0;
    }
    </style>
    <script src="/Public/qwadmin/js/jquery.js" type="text/javascript"></script>
</head>

<body>
    <form enctype="multipart/form-data" id="PostMe"  method="post" name="upform">
		<input type="hidden" value="<?php echo ($Width); ?>" name="Width">
        <input type="hidden" value="<?php echo ($Height); ?>" name="Height">
        <input type="hidden" value="<?php echo ($BackCall); ?>" name="BackCall">
        <input type="hidden" value="<?php echo ($ImgStr); ?>" name="Img" id="Img">
        <div class="iconbox">
            <div class="uplist">
            </div>
            <a class="file_box">＋<input type="file" name="uploadimg[]" id="uploadicon" accept="image/jpeg,image/jpg,image/png,image/gif" multiple  value="上传"/></a>
        </div>
    </form>
    <br>
    <script type="text/javascript">

        // 移除功能使用
        function arrange(){
            var ImgStr="";
            $("#ht").html('ABC');
            $('.iconimg').each(function(index){
                if(index!=0) ImgStr+='|';
                ImgStr+=$(this).attr('src');
            });
            $('#<?php echo ($BackCall); ?>',parent.document).val(ImgStr);
            $('#Img').val(ImgStr);
        }
        // 根据上级标签设置显示图片
        function setImg() {
            // 初始化时从上级调用数值过来 否则从此处设置上级内容
            if ($('#Img').val()=='') {
                $('#Img').val($('#<?php echo ($BackCall); ?>',parent.document).val());
            }else{
                $('#<?php echo ($BackCall); ?>',parent.document).val($('#Img').val());
            }
            var imgArray = $('#Img').val().split("|");
            var divstr='';
            for (var i = 0;i<imgArray.length;i++) {
                if(imgArray[i] != "" || typeof(imgArray[i]) == "undefined"){
                    divstr = divstr + '<div class="icon"><img class="iconimg" src="'+ imgArray[i]+'"><div class="remove">移除</div></div>'
                }

            }
            $(".uplist").html(divstr)
        }
        setImg();
        $('#uploadicon').on("change",function(){
            arrange();
            $('#PostMe').submit();
        });
        $('.remove').on("click",function(){
            $(this).parent().remove();
            arrange();
        });
    </script>
</body>

</html>