<?php  
/**
 * 调用API
 * 陆长文
 * 2015-6-9
 */ 

function postData($url, $data)  
{  
    $curl = 'http://112.74.113.225:8090'.$url;
    $ch = curl_init();  
    $timeout = 300;   
    curl_setopt($ch, CURLOPT_URL, $curl);  
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