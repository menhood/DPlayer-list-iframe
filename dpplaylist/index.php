<meta charset="utf-8">
<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
//输出参数设置页面
$index=
        <<<EOF
    <div class="container">
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                            </button> <a class="navbar-brand" href="#">iframe生成</a>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="active"> <a href="/">返回首页</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="row clearfix">
                        <div class="col-md-12 column">
                            	<h3 class="text-center">DPlayer播放列表生成</h3>
                            	<h3 class="text-center">注意：<small>视频文件名必须是连续纯数字，如<strong style="color:pink">01.mp4</strong>、<strong style="color:pink" >02.mp4</strong>、<strong style="color:pink" >03.mp4</strong>……</small>只支持<strong style="color:red" >MP4</strong>文件</h3>
                            <form class="form-horizontal" role="form" action="" method="post" name="dpform" id="dpform">
                                <div class="form-group">
                                    <label for="listname" class="col-sm-2 control-label">列表名称:</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="listname" type="text" value="" name="listname" placeholder="请输入列表名称，例如：王子变青蛙" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="col-sm-2 control-label">视频地址:</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="url" type="text" value="" name="url" placeholder="请输入列表视频的目录地址，暂不支持中文。如：https://menhood.320.io/?/%E5%8A%A8%E6%BC%AB/VioletEvergarden/zllyhhy/" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pic" class="col-sm-2 control-label">封面地址:</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="pic" type="text" value="" name="pic" placeholder="请输入视频封面地址，暂不支持中文" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="max" class="col-sm-2 control-label">最大集数:</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="max" type="text" value="" name="max" placeholder="请输入视频集数（数字）" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="width" class="col-sm-2 control-label">播放器宽度:</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="width" type="text" value="" name="width" placeholder="请输入播放器宽度，支持px及百分比等css属性,默认100%" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="height" class="col-sm-2 control-label">播放器高度:</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="height" type="text" value="" name="height" placeholder="请输入播放器高度，支持px及百分比等css属性,默认720px" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <a href="javascript:void(0);" onclick="check()">
                                                <label>
                                                    <input type="checkbox" id="autoplay" value="false" name="autoplay" />自动播放</label>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <a href="javascript:void(0);" onclick="check()">
                                                <label>
                                                    <input type="checkbox" id="danmaku" value="false" name="danmaku" />开启弹幕</label>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="display:none">
                                    <div class="col-sm-offset-2 col-sm-10">
                                       <input type="text"  value="true" name="changebody" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                       <a href="javascript:void(0);" onclick="check()"> <button type="submit" class="btn btn-default">生成</button></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
        function check() {
            if (document.getElementById("autoplay").checked) {
                document.getElementById("autoplay").value = "true";
            } else {
                document.getElementById("autoplay").value = "false";
            }
            if (document.getElementById("danmaku").checked) {
                document.getElementById("danmaku").value = "true";
            } else {
                document.getElementById("danmaku").value = "false";
            }
        }
         $(function () {  
        $('#dpform').bootstrapValidator({
　　　　　　　　message: '内容无效！',
            　feedbackIcons: {
                　　　　　　　　valid: 'glyphicon glyphicon-ok',
                　　　　　　　　invalid: 'glyphicon glyphicon-remove',
                　　　　　　　　validating: 'glyphicon glyphicon-refresh'
            　　　　　　　　   },
            fields: {
                listname: {
                    message: '列表名称验证失败',
                    validators: {
                        notEmpty: {
                            message: '列表名称不能为空'
                        }
                    }
                },
                url: {
                    validators: {
                        notEmpty: {
                            message: 'url地址不能为空'
                        }
                    }
                },
                max: {
                    validators: {
                        notEmpty: {
                            message: '集数地址不能为空'
                        }
                    }
                }
            }
        });  
             
         });
        </script>    
EOF;
//准备工作 定义变量 获取传入参数
header('Access-Control-Allow-Origin:*'); 
date_default_timezone_set('PRC');//定义时区
$time = date(Y."-".m."-".d."_".G.":".i.":".s);//获取日期时间
$cip=$_SERVER["REMOTE_ADDR"];//获取客户端ip
$changebody=$_POST['changebody'];
$listname=$_POST['listname'];//获取文件名
$dpmax=$_POST['max'];//获取最大集数
$dpautoplay=$_POST['autoplay'];//获取是否自动播放
$dpurl=$_POST['url'];//获取视频地址
$dppic=$_POST['pic'];//获取封面地址
$dpid=md5($dpurl);//创建danmaku id
$width=$_POST['width'];//获取播放器div宽度
$height=$_POST['height'];//获取播放器div高度
$danmaku=$_POST['danmaku'];//获取是否开启弹幕
$true='true';//用于判断弹幕开关
$hosturl=str_replace("index.php","",'//'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);//解析生成目录url
//弹幕参数 可在此修改弹幕服务器地址及其他参数
$danmakuoption=
<<<EOF
danmaku: {
            id: '{$dpid}',
            api: 'https://api.menhood.wang/dplayer',
            token: 'tokendemo',
            maximum: 3000,
            user: cip,
            bottom: '15%',
            unlimited: true
        },
EOF;
//用于判断自动播放/弹幕开关
if ($dpautoplay==null){
    $dpautoplay='false';
}
if($danmaku == null){
    $danmaku='false';
}
if ($danmaku !== $true){
    $danmakuoption='';
}
$width=$_POST['width'];
//判断是否填写宽高，如未填写则为默认值
if($width == null){
    $width='100%';
}
$height=$_POST['height'];
if($height == null){
    $height='720px';
}
if ($dppic==null){
    $dppic='';
}
//各种参数，用于查看赋值
$dump='<br>$listname:'. $listname.'<br>$url:'. $dpurl.'<br>$pic:'. $dppic.'<br>$max:'. $dpmax.'<br>$autoplay:'. $dpautoplay.'<br>$danmaku:'. $danmaku.'<br>$width:'. $width.'<br>$height:'. $height.'<br>$playlistarr:'. var_dump($playlistarr);

$suffix=".mp4";
for ($n=1;$n<=$dpmax;$n++){
    if ($n<10){
        $playlistarr=$playlistarr.'"'.$dpurl.'0'.$n.$suffix.'",';
    }else {
        $playlistarr=$playlistarr.'"'.$dpurl.$n.$suffix.'",';
    } 
}
$playlistarr="[".rtrim($playlistarr, ',')."]";
$playlistarr=str_replace("/","\/",$playlistarr);
//生成播放列表，1-9数字前加0
for ($i=0;$i<$dpmax;$i++){
        $pn=$i+1;
		     $dplistli=
		     <<<EOF
		     {$dplistli} \n <a href="javascript:void(0)" onclick="switchDPlayer('{$i}')" ><li id="p{$i}"><span>P{$pn}</span></li></a>
EOF;
}
$dpurl=$dpurl."01".$suffix;
//播放器页面参数
$html= 
        <<<EOF
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="https://cdnjs.loli.net/ajax/libs/dplayer/1.22.2/DPlayer.min.css">
<script src="https://cdnjs.loli.net/ajax/libs/flv.js/1.4.2/flv.min.js"></script>
<script src="https://cdnjs.loli.net/ajax/libs/hls.js/0.9.1/hls.min.js"></script>
<script src="https://cdnjs.loli.net/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.loli.net/ajax/libs/blueimp-md5/2.10.0/js/md5.min.js"></script>
<style>
body{margin:0;padding:0;}
#dplayer2{
margin: 0;
padding: 0;
verflow: hidden;}
.button{
position: relative;
display: inline-block;
vertical-align: top;
margin-right: 10px;
cursor: pointer;
background-color: #fff;
border: 1px solid #e5e9ef;
border-radius: 4px;
padding: 6px;
margin:5px;
}
.button:hover{
   border: 1px solid #00a1d6; 
   color:#00a1d6;
}
.playing{
   box-sizing: border-box;
   border: 1px solid #00a1d6; 
   color:#00a1d6;
}
.dplistul {
    display:none;
    z-index:99;
    float:left!important;
    width:auto!important;
    list-style:none!important;
    padding:0!important;
    margin:0!important;
    border:0!important;
    transition:1s!important;
}
.dplistul li {
    float:left!important;
    list-style:none!important;
    margin:5px!important;
    border-radius:10px!important;
    height:30px!important;
    line-height:30px!important;
    text-align:center!important;
    width:50px!important;
    background-color:#fff!important;
    color:pink!important;
}
.dplistul li:hover {
    background-color:pink!important;
    color:#fff!important;
}
.dplistul li a {
    color:pink!important
}
.dplistul li a:hover {
    color:#fff!important
}
</style>
</head>
<body>
<div id="dplayer2" class="dplayer dplayer-arrow"></div>
<script src="https://cdnjs.loli.net/ajax/libs/dplayer/1.22.2/DPlayer.min.js"></script>
<script src="https://api.menhood.wang/getcip/getcipv2.php"></script>
<script>
//生成播放器
window.dp2 = new DPlayer({
    container: document.getElementById('dplayer2'),
    autoplay: {$dpautoplay},
    theme: '#FADFA3',
    volume: 0.2,
    mutex: true,
    video: {
        url: '{$dpurl}',
        pic: '{$dppic}',
        type: 'auto'
    },
    {$danmakuoption}
    contextmenu: [
        {
            text: 'Plugin-API-Adr',
            link: 'https://api.menhood.wang/'
            }
    ]
});
//切换分P，并自动播放
var list={$playlistarr};
var ysrc = dp2.options.video.url;
var ssrc;
var nums='';
function switchDPlayer(num) {
    ssrc = list[num];
    var nums = num;
    if (ssrc !== ysrc) {
        dp2.switchVideo({
            url: ssrc,
            pic: '{$dppic}',
            type: 'auto',
        }, {
            id: md5(ssrc),
            api: 'https://api.menhood.wang/dplayer',
            maximum: 3000,
            user: 'Menhood'
        });
		ysrc=ssrc;
    };
    document.getElementById('p'+nums).className="playing";
    dp2.toggle();
}
//显示/隐藏播放列表
$(function(){
        $("#ShowButton_2").click(
            function(){
                 if($("#dplistuls").css("display")=='none'){
                    $("#dplistuls").slideDown();
                    
                    $("#ShowButton_2").val("选择集数");
                 }else{
                    $("#dplistuls").slideUp();
                    $("#ShowButton_2").val("选择集数");
                 }
            });
        });
</script>
<input type="button" id="ShowButton_2" name="ShowButton_2" value="选择集数" class="button">
<ul class="dplistul" id="dplistuls">{$dplistli}</ul>
</body>
</html>
EOF;
//生成播放页面
$myfile = fopen(__DIR__.'/'.'generate'.'/'.$listname.".html", "w") or die("Unable to open file!");
fwrite($myfile, $html);
fclose($myfile);
//log内容
$logcontent='User:'.$cip.' | Time:'.$time. '<br>'.$dump.'<hr>';
//写入log
$log=fopen("log.html", "a") or die("Unable to open file!");
fwrite($log, $logcontent);
fclose($log);
//生成结果页面容器
$result=
        <<<EOF
<div class="container">
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                            </button> <a class="navbar-brand" href="/">邻男</a>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="active"> <a href="javascript:history.go(-1)">返回</a>
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
                                        <input class="form-control"  id="iframesrc" type="text" value="{$hosturl}generate/{$listname}.html" />
                                    </div>
                                </div>
                                <button type="button" class="btn btn-info" onclick="copyurl()">复制网址</button>
                                <a href="{$hosturl}generate/{$listname}.html" class="btn btn-info" target="_blank">访问测试</a>
                                <hr>
                                <div class="form-group" width=80% >
                                    <label for="url" class="col-sm-2 control-label">调用代码：</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="code" type="text" value='<iframe src="{$hosturl}generate/{$listname}.html" frameborder=no scrolling=no width=100%  height=750 ></iframe>' />
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
//复制代码
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
//提示框    
function closealert(){
    document.getElementById("copysuccess").className='hidden';
}
//变量赋值信息框
function varinfo(){
    document.getElementById("varinfodiv").className='alert alert-info alert-dismissable';
}
</script>
EOF;
//输出结果页面
if($changebody == 'true'){$index = $result;}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdnjs.loli.net/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="https://cdnjs.loli.net/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css" rel="stylesheet">
        <script src="https://cdnjs.loli.net/ajax/libs/0.5.3/js/bootstrapValidator.min.js"></script>
        <script src="https://cdnjs.loli.net/ajax/libs/blueimp-md5/2.10.0/js/md5.min.js"></script>
        <title>DPlayer列表生成</title>
    </head>
    <body>
        <?php  echo $index; ?>
    </body>

</html>
