<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/5/21
 * Time: 13:04
 */
namespace Api\Controller;
use Think\Controller;

class HotBookController extends Controller{
    public function getBook($start=0,$count=20){
        $res=D('HotBook')->getBook($start,$count);
        return json($res);
    }
    public function getBookBySearch($search){
        if(preg_match("/^[a-zA-Z\s]+$/",$search)){
            //字母
            $datas=D('HotBook')->getBook($start=0,$count=10000);
            $res=[];
            foreach($datas as $data) {
                if (strpos(first_szm(trim($data['title'])), strtolower($search))!==false){
                    array_push($res, $data);
                }
            }
        }elseif(preg_match("/^[0-9\s]+$/",$search)){
            //数字
            $res=D('HotBook')->getBookById($search);
        }else{
            //汉字
            $res=D('HotBook')->getBookByTitle($search);
        }
        return json($res);
    }
}