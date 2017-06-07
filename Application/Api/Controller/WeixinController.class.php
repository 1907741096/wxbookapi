<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/5/29
 * Time: 8:46
 */
namespace Api\Controller;
class WeixinController extends CommonController{

    public function getToken(){
        $res=D('Token')->getToken();
        if(!$res||$res['time']<time()){
           $arr=$this->curl("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".C('appid')."&secret=".C('secret'));

           $data=json_decode($arr,true);
           $res['token']=$data['access_token'];
           $res['time']=$data['expires_in']+time()-3;
           unset($res['id']);
           D('Token')->addToken($res);
        }
        return $res['token'];
    }
    public function getQrCode($id){
        $token=$this->getToken();
        $url="https://cli.im/api/qrcode/code?text=$id&mhid=vBSWCwDsyMghMHcsKNdcOas";
        $res=$this->curl($url);
        $imgStart=strpos($res,"<img src=\"")+10;
        $imgEnd=strpos($res,"\"",$imgStart);
        $img=substr($res,$imgStart,$imgEnd-$imgStart);
        json($img);
    }

}