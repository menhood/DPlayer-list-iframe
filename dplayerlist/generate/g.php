<?php
$listname=$_POST['listname'];
$url=$_POST['url'];
$pic=$_POST['pic'];
$max=$_POST['max'];
$autoplay=$_POST['autoplay'];
$danmaku=$_POST['danmaku'];
if ($autoplay==null){
    $autoplay='false';
}
if($danmaku == null){
    $danmaku='false';
}
$width=$_POST['width'];
if($width == null){
    $width='100%';
}
$height=$_POST['height'];
if($height == null){
    $height='720px';
}
$dump='<br>$listname:'. $listname.'<br>$url:'. $url.'<br>$pic:'. $pic.'<br>$max:'. $max.'<br>$autoplay:'. $autoplay.'<br>$danmaku:'. $danmaku.'<br>$width:'. $width.'<br>$height:'. $height;
$html=
<<<EOF
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
        <form action="//api.menhood.wang/dplayerlist/dplayerlistget.php" method="post" name="dpform" style="display:none">
            <input type="text" style="display:none" value="{$url}" name="url" />
            <input type="text" style="display:none" value="{$pic}" name="pic" />
            <input type="text" style="display:none" value="{$max}" name="max" />
            
            <input type="text" style="display:none" value="{$width}" name="width" />
            <input type="text" style="display:none" value="{$height}" name="height" />
            <input type="text" style="display:none" value="{$autoplay}" name="autoplay" />
            <input type="text" style="display:none" value="{$danmaku}" name="danmaku" />
        </form>
        <script type="text/javascript">
        window.onload=function pgonload(){
            document.dpform.submit();
        }
        </script>  
    </body>
</html>

EOF;
if (fopen($listname.".html", "r")){die("The file already exists! Please rename");
}
$myfile = fopen($listname.".html", "w") or die("Unable to create file! Please check permissions");
fwrite($myfile, $html);
fclose($myfile);
echo <<<EOF
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style></style>
        <title>DPlayer列表生成</title>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
.copy{
    border:solid #fff 2px;
    background-color: pink;
    color:#fff
}
.box{
background-color: #fff;
border: 1px solid #ecf0f1;
font-size: 1.1em;
padding: 30px 20px 30px 25px;
}
</style>

<div class="container">
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                            </button> <a class="navbar-brand" href="/">API-Menhood</a>

                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="active"> <a href="/">返回首页</a>
                                </li>
                                <li > <a href="javascript:void(0)" onclick="varinfo()">Info</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="row clearfix">
                        <div class="col-md-12 column">
                            	<h3 class="text-center"><small>生成完毕,点击<strong style="color:pink">复制代码</strong>按钮可复制，iframe大小适配请自行更改</small></h3>
                                <div class="hidden"  id="copysuccess">
				 <a href="javascript:void(0)" onclick="closealert()" class="close">×</a>
				<span class="glyphicon glyphicon-ok"></span><strong> 复制成功!</strong> 
			            </div>
                            <form class="form" role="form" action="" method="" name="infoform">
                                <div class="form-group" width=80% >
                                    <label for="listname" class="col-sm-2 control-label">访问地址：</label>
                                    <div class="col-sm-8">
                                        <input class="form-control"  id="iframesrc" type="text" value="//api.menhood.wang/dplayerlist/generate/{$listname}.html" />
                                    </div>
                                </div>
                                <button type="button" class="btn btn-info" onclick="copyurl()">复制网址</button>
                                <a href="{$listname}.html" class="btn btn-info" ">访问测试</a>
                                <hr>
                                <div class="form-group" width=80% >
                                    <label for="url" class="col-sm-2 control-label">调用代码：</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="code" type="text" value='<iframe src="//api.menhood.wang/dplayerlist/generate/{$listname}.html" frameborder=no scrolling=no width=100%  height=750 ></iframe>' />
                                    </div>
                                </div> <button type="button" class="btn btn-info" onclick="copycode()">复制代码</button>
                                  
                                
                            </form>
                            <div class="hidden" id="varinfodiv">{$dump}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
function copycode()
    {
        document.getElementById("code").select(); // 选择对象
        document.execCommand("Copy"); // 执行浏览器复制命令
        document.getElementById("copysuccess").className='alert alert-success alert-dismissible fade in';
    }
function copyurl()
    {
        document.getElementById("iframesrc").select();
        document.execCommand("Copy"); // 执行浏览器复制命令
        document.getElementById("copysuccess").className='alert alert-success alert-dismissible fade in';
    }
function closealert(){
    document.getElementById("copysuccess").className='hidden';
}    
function varinfo(){
    document.getElementById("varinfodiv").className='alert alert-info alert-dismissable';
}
</script>
EOF;

?>
