<?php  
/** 
 *@一个完整的POST调用API的过程 百度知道 
 *@author: bo.xiao   
 */  
/*
    $url = 'http://112.74.113.225:8090/member/register';  
    $data = array(  
        'api_key'=>'3qQ2Edm62Vd4bAVCwNoxgn0l',  
        'method'=>'baidu.zhidao.getQuestionList',  
        'call_id'=>'1308713190',  
        'cid'=>59533,  
        'qstatus'=>1,  
        'format'=>'json',  
        'page_no'=>1,  
        'page_size'=>25,  
        'keywords'=>'财务',  
        'bd_sig'=>'2bad1c47bb75e0363a689f4b09743afb'  
    );  
  
    $json_data = postData($url, $data);  
    $array = json_decode($json_data,true);  
    echo '<pre>';print_r($array);  
      */
	$url = 'http://112.74.113.225:8090/';
    function postData($url, $data)  
    {  
        $ch = curl_init();  
        $timeout = 300;   
        curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_POST, true);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  
        $handles = curl_exec($ch);
        //错误处理
        if($handles === FALSE)
        {
        	$handles = curl_error($ch);
        }
        curl_close($ch);  
        return $handles;  
    }  
  
?>  