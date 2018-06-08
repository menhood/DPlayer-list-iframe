<?php
header('Access-Control-Allow-Origin:*'); 

$dpmax=$_POST['max'];
$dpautoplay=$_POST['autoplay'];
$dpurl=$_POST['url'];
$dppic=$_POST['pic'];
$dpid=md5($dpurl);
$width=$_POST['width'];
$height=$_POST['height'];
$danmaku=$_POST['danmaku'];
$true='true';
$danmakuoption=
<<<EOF
danmaku: {
            id: '{$dpid}',
            api: 'https://api.menhood.wang/dplayer',
            token: 'tokendemo',
            maximum: 3000,
            user: 'Menhood',
            bottom: '15%',
            unlimited: true
        },
EOF;

if ($danmaku !== $true){
    $danmakuoption='';
}
for ($i=1;$i<=$dpmax;$i++){
    if($i<10){
		     $dplistli=
		     <<<EOF
		     {$dplistli}<a href="javascript:void(0)" onclick="switchDPlayer('0{$i}')" ><li><span>P{$i}</span></li></a>
EOF;
}else{
            $dplistli=
            <<<EOF
            {$dplistli}<a href="javascript:void(0)" onclick="switchDPlayer({$i})" ><li><span>P{$i}</span></li></a>
EOF;
}
}
$dplist= 
        <<<EOF
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="https://cdn.bootcss.com/dplayer/1.22.2/DPlayer.min.css">
<script src="https://cdn.bootcss.com/flv.js/1.4.2/flv.min.js"></script>
<script src="https://cdn.bootcss.com/hls.js/0.9.1/hls.min.js"></script>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
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

<script src="https://cdn.bootcss.com/dplayer/1.22.2/DPlayer.min.js"></script>
<script>
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
var ysrc = dp2.video.src;
var ssrc;
var flv='.flv';
var mp4='.mp4';
var m3u8='.m3u8';
function switchDPlayer(num) {
    var nums = String(num);
    switch (true) {
      case /[0-9]\d*.MP4/i.test(ysrc):
        ssrc = ysrc.replace(/[0-9]\d*.MP4/i,nums+mp4);
        break;
      case /[0-9]\d*.flv/i.test(ysrc):
        ssrc = ysrc.replace(/[0-9]\d*.flv/i,nums+flv);
        break;
      case /[0-9]\d*.m3u8/i.test(ysrc):
        src = ysrc.replace(/[0-9]\d*.m3u8/i,nums+m3u8);
        break;
    }

    
    
    if (ssrc !== ysrc) {
        dp2.switchVideo({
            url: ssrc,
            pic: '{$dppic}',
            type: 'auto',
        }, {
            id: '{$dpid}',
            api: 'https://api.menhood.wang/dplayer',
            maximum: 3000,
            user: 'Menhood'
        });
    }
    dp2.toggle();
}

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
echo $dplist;

?>