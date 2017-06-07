<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/5/29
 * Time: 9:58
 */
namespace Api\Controller;
use Think\Controller;
class CommonController extends Controller{
    public function curl($url,$type="get",$arr=""){
        $curl=curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl,  CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        if($type=='post'){
            curl_setopt($curl,CURLOPT_POST,1);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$arr);
        }
        $data=curl_exec($curl);
        if(curl_errno($curl)){
            var_dump(curl_error($curl));
        }
        curl_close($curl);
        return $data;
    }
}