<?php


//统计总使用次数
$counter = intval(@file_get_contents("times.txt"));  
$counter++;  
$fp = fopen("times.txt","w");  
fwrite($fp, $counter);  
fclose($fp);

//ajax获取信息专用接口
if($_GET['id']=="msg"){
echo @file_get_contents("news.txt");
exit();
}
?>
<html> 
<head>
<meta charset="utf-8">
<link rel="icon" href="http://cdn.u1.huluxia.com/g3/M01/EA/20/wKgBOV4k70aAVFkMAACSNDCr8Yk703.jpg_160x160.jpeg">
<title>YQY的聊天室</title>
<style>
body{
text-align:center;
font-size:15pt;
background-color:#1f9baa;
}

h1{
margin-top:8%;
}

.main{
background-image:url('http://wwww.ql-aa.xyz/homework/branch/img/index.php');
background-size:100% 100%;
width:90%;
margin:5% 5%;
border-radius: 5px / 5px;
}

.form{
text-align:center;
margin:5% 30%;
}

.a{
font-size:8pt;
text-align:center;
}

.from-input{
color:black;
border-radius: 15px / 15px;
}

.form-submit{
color:black;
border-radius: 50px / 50px;
margin-left:60%;
height:25px;
width:75px;
}

a{
text-decoration:none;
}

.textarea{
border-radius: 10px / 10px;
color:black;
font-size:9pt;
}

.fieldset{
border-radius: 8px / 8px;
}

.ajaxcanshu{
font-size:50%;
}

.textarea-input{
border-radius: 10px / 10px;
color:black;
font-size:9pt;
}
</style>
</head>
<body onLoad="Autofresh()">

<?php
/*云体检通用漏洞防护补丁v1.1
更新时间：2013-05-25
功能说明：防护XSS,SQL,代码执行，文件包含等多种高危漏洞
*/
$url_arr=array(
'xss'=>"\\=\\+\\/v(?:8|9|\\+|\\/)|\\%0acontent\\-(?:id|location|type|transfer\\-encoding)",
);
$args_arr=array(
'xss'=>"[\\'\\\"\\;\\*\\<\\>].*\\bon[a-zA-Z]{3,15}[\\s\\r\\n\\v\\f]*\\=|\\b(?:expression)\\(|\\<script[\\s\\\\\\/]|\\<\\!\\[cdata\\[|\\b(?:eval|alert|prompt|msgbox)\\s*\\(|url\\((?:\\#|data|javascript)",
'sql'=>"[^\\{\\s]{1}(\\s|\\b)+(?:select\\b|update\\b|insert(?:(\\/\\*.*?\\*\\/)|(\\s)|(\\+))+into\\b).+?(?:from\\b|set\\b)|[^\\{\\s]{1}(\\s|\\b)+(?:create|delete|drop|truncate|rename|desc)(?:(\\/\\*.*?\\*\\/)|(\\s)|(\\+))+(?:table\\b|from\\b|database\\b)|into(?:(\\/\\*.*?\\*\\/)|\\s|\\+)+(?:dump|out)file\\b|\\bsleep\\([\\s]*[\\d]+[\\s]*\\)|benchmark\\(([^\\,]*)\\,([^\\,]*)\\)|(?:declare|set|select)\\b.*@|union\\b.*(?:select|all)\\b|(?:select|update|insert|create|delete|drop|grant|truncate|rename|exec|desc|from|table|database|set|where)\\b.*(charset|ascii|bin|char|uncompress|concat|concat_ws|conv|export_set|hex|instr|left|load_file|locate|mid|sub|substring|oct|reverse|right|unhex)\\(|(?:master\\.\\.sysdatabases|msysaccessobjects|msysqueries|sysmodules|mysql\\.db|sys\\.database_name|information_schema\\.|sysobjects|sp_makewebtask|xp_cmdshell|sp_oamethod|sp_addextendedproc|sp_oacreate|xp_regread|sys\\.dbms_export_extension)",
'other'=>"\\.\\.[\\\\\\/].*\\%00([^0-9a-fA-F]|$)|%00[\\'\\\"\\.]");
$referer=empty($_SERVER['HTTP_REFERER']) ? array() : array($_SERVER['HTTP_REFERER']);
$query_string=empty($_SERVER["QUERY_STRING"]) ? array() : array($_SERVER["QUERY_STRING"]);
check_data($query_string,$url_arr);
check_data($_GET,$args_arr);
check_data($_POST,$args_arr);
check_data($_COOKIE,$args_arr);
check_data($referer,$args_arr);
function W_log($log)
{
  $logpath=$_SERVER["DOCUMENT_ROOT"]."/log.txt";
  $log_f=fopen($logpath,"a+");
  fputs($log_f,$log."\r\n");
  fclose($log_f);
}
function check_data($arr,$v) {
 foreach($arr as $key=>$value)
 {
  if(!is_array($key))
  { check($key,$v);}
  else
  { check_data($key,$v);}
  if(!is_array($value))
  { check($value,$v);}
  else
  { check_data($value,$v);}
 }
}
function check($str,$v)
{
  foreach($v as $key=>$value)
  {
  if (preg_match("/".$value."/is",$str)==1||preg_match("/".$value."/is",urlencode($str))==1)
    {
      date_default_timezone_set('Asia/Shanghai');
      W_log("<br>IP: ".$_SERVER["REMOTE_ADDR"]."<br>时间: ".date("Y-m-d H:i:s")."<br>页面:".$_SERVER["PHP_SELF"]."<br>提交方式: ".$_SERVER["REQUEST_METHOD"]."<br>提交数据: ".$str);
      print "您的提交带有不合法参数,谢谢合作";
      exit();
    }
  }
}
?>

<h1>聊天室</h1>
<div class="main">

<tt>
<?php
//随机生成一串数字
function number($length) 
{
 $chars = array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'); 
 $keys = array_rand($chars, $length); 
 $n = ''; 
 for($i = 0; $i <= $length; $i++)
 {
  $n .= $chars[$keys[$i]]; 
 }
 return $n;
}

//操作ajax.txt
function ajaxfile(){
$filewenjian=fopen("ajax.txt","w w+");
fputs($filewenjian,number(5));
fclose($filewenjian);
}

/*聊天室主程序*/
date_default_timezone_set('Asia/Shanghai');
$time = date("Y年m月d日-H时i分s秒");
if($_COOKIE['用户名']==null){
$user=$_POST['username'];
}else{
$user=$_COOKIE['用户名'];
}

$news=$_POST['news'];
$id=$_GET['id'];
$url="index.php";
setcookie('用户名',$user,time()+10*60,'/');

if($id=="send" && $user!="" && $news!=""){
$wenjian=file_get_contents("news.txt");
$a=fopen("news.txt","w w+");
fputs($a,$user."($time)：\n".$news."\n\n".$wenjian);
fclose($a);
ajaxfile();
header("Location:$url");

}else if($id=="[清除]"){
//清除用户名
setcookie("用户名", '');
//删除聊天文件
unlink("news.txt");
//刷新ajax参数
ajaxfile();
header("Location:$url");
}
?>
<br>

<form action="?id=send" method="post" class="form">
<?php
/*用户协议*/
if($_GET['id']=="xy"){
$time = date("Y年m月d日H时i分s秒"); 
echo '
<script>
alert("用户协议:\n 请勿涉及黄，赌，毒等违法的事\n 2020年2月6日-'.$time.' \n \n by 阿豆子");
window.location.href="index.php";
</script>
';

}
if($_COOKIE['用户名']==null){
echo '
<p>请输入昵称：<br><input type="text" name="username" value="guest'.number(6).'" required placeholder="  请输入用户名" class="from-input"></p>
';
}else{
echo '<p style="margin-top:3%; font-size:9pt; text-shadow: 5px 5px 4px rgba(0,0,0,.5);">用户名：'.$_COOKIE['用户名'].'</p>';
}
?>


<textarea type="text" name="news" autocomplete="off" required placeholder="请输入消息" class="textarea-input">
</textarea>

<p><input type="submit" value="发送" class="form-submit"></p>
</form>
<hr>
<textarea class="textarea" readonly rows="40" cols="100" id="msg">

<?php
echo @file_get_contents("news.txt");
?>

</textarea>

<div>
<p>统计:<br>

<?php
/*统计访问次数*/
$fwcs=$_COOKIE['访问次数'];
if(isset($fwcs)){
$fwcs++;
setcookie('访问次数',$fwcs,time()+3600*24*365,'/');
echo '访问次数'.$fwcs.'</p>';
}else{
echo '您好像是第一次访问</p>';
setcookie('访问次数','1',time()+3600*24*365,'/');
}
?>
</div>

<br>
<fieldset class="fieldset">
<br>

<div>
<?php

/*设置ajax*/
$ajax=$_COOKIE['ajax'];
if(!isset($ajax)){
setcookie('ajax','on',time()+3600*24*365,'/');
header("Location:index.php");
}else if($_GET['ajax']=='on'){
setcookie('ajax','on',time()+3600*24*365,'/');
echo '<script>alert("已开启自动刷新"); window.location.href="index.php";</script>';
}else if($_GET['ajax']=='off'){
setcookie('ajax','off',time()+3600*24*365,'/');
echo '<script>alert("已关闭自动刷新"); window.location.href="index.php";</script>';
}

if($ajax=='on'){
//获取ajax参数
echo '
<script>
ajaxcanshu='.@file_get_contents("ajax.txt").';
var xmlobj;
var ajax;
    function createXMLHttpRequest(){
      if(window.ActiveXObject){
        xmlobj=new ActiveXObject("Microsoft.XMLHTTP");
        ajax=new ActiveXObject("Microsoft.XMLHTTP");
      }
      else if(window.XMLHttpRequest){
        xmlobj=new XMLHttpRequest();
        ajax=new XMLHttpRequest();
      }
    }
    //设置ajax
    function Autofresh(){
      createXMLHttpRequest();     
      xmlobj.open("GET","ajax.txt",true);
      xmlobj.onreadystatechange=doAjax;
      xmlobj.send();
    }
    //定时获取ajax参数
    function doAjax(){
      if(xmlobj.readyState==4 && xmlobj.status==200){
        var time_span=document.getElementById("ajax");
        time_span.innerHTML=xmlobj.responseText;
        if(time_span.innerHTML==ajaxcanshu){
        }else{
        aa();
        }
        setTimeout("Autofresh()",1000);
      }
    }
    //获取新信息
    function aa(){
      ajax.open("GET","?id=msg",true);
      ajax.onreadystatechange=goajax;
      ajax.send();
 }
 //更新信息
	function goajax(){
    	if(ajax.readyState==4 && ajax.status==200){
		var ok=document.getElementById("msg");
		ok.innerHTML=ajax.responseText;
}
}

  </script>
  <p class="ajaxcanshu">ajax参数:<kbd id="ajax">无</kbd></p>
';
}

/*菜单*/
if($_GET['id']=='cd'){
echo '
<a href="?id=xy" class="a">用户协议</a><br>
<a href="?id=[清除]" class="a">清除所有信息</a><br>
<a href="?id=sc" class="a">上传文件</a><br>
<a href="?id=源码信息" class="a">源码信息</a><br>
';
if($ajax=='on'){
echo '<a href="index.php?ajax=off" class="a">关闭自动刷新</a><br>';
}else if($ajax=='off'){
echo '<a href="index.php?ajax=on" class="a">打开自动刷新</a><br>';
}
echo '<a href="../.." class="a">返回</a><br>';

}else if($_GET['id']=='sc'){
/*上传文件*/
echo '
<form action="?id=sc" method="post" enctype="multipart/form-data">
<p>请选择要上传的文件:<br><input type="file" name="myFile"></p>
<p>请输入密码:<input type="password" name="password" autocomplete="new-password" value="'.$_POST['password'].'"></p>
<input type="submit" value="上传">
</form>
';

if($_POST['password']=="adouzi"){
$wenjian = $_FILES['myFile']['name'];
$lj = $_FILES['myFile']['tmp_name'];
$wen = strrpos($wenjian, '.');
//查找字符串在另一字符串中最后一次出现的位置
$jian = substr($wenjian, $wen);
//返回字符串的一部分
@copy($lj, 'upload/'.base64_encode(time().$wenjian)."$jian");
}else{
if($_POST==null){
echo "<p>上传试试吧！</p>";
}else{
echo '<script>alert("你无权操作");</script>';
}
echo '<a href="index.php" class="a">返回</a><br>';
}
}else if($_GET['id']=='源码信息'){
/*源码基本信息*/
echo '
<h3>源码信息</h3>
<p>源码版本:<font color="red"><b>v6.0</b></font><br>
统计：共使用'.$counter.'次</p><br>
<a href="?id=gengxin" class="a">检查更新</a><br>
<a href="index.php" class="a">返回</a>
<p style="margin-top:3%; font-size:5pt; text-shadow: 3px 5px 5px #656B79;">Copyright © 2020 Design by 阿豆子</p>
';
}else if($_GET['id']=='gengxin'){

$yuan=@file_get_contents("http://adouzi.aote.xyz/api/gengxin/?id=gengxin-lts&banben=6.0");
preg_match('/<p id="zhuangtai">(.*?)<\/p>/',$yuan,$ma);
if($ma[1]=='ok'){
echo $yuan;
}else{
echo '<p>获取版本信息失败!<br>请手动查询</p>';
}
echo '<a href="index.php" class="a">返回</a><br>';
}else{
echo '<a href="?id=cd">菜单</a><br>';
}
?>
</div>

</fieldset>
<br>
</tt>
</div>
</body>
</html>