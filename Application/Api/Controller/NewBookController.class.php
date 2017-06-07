<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/5/19
 * Time: 17:34
 */
namespace Api\Controller;
use Think\Controller;

class NewBookController extends Controller{

    public function getBook($start=0,$count=20){
        $res=D('NewBook')->getBook($start,$count);
        return json($res);
    }

    public function getBookBySearch($search){
        if(preg_match("/^[a-zA-Z\s]+$/",$search)){
            $datas=D('NewBook')->getBook($start=0,$count=10000);
            $res=[];
            foreach($datas as $data) {
                if (strpos(first_szm(trim($data['title'])), strtolower($search))!==false){
                    array_push($res, $data);
                }
            }
        }elseif(preg_match("/^[0-9\s]+$/",$search)){
            $res=D('NewBook')->getBookById($search);
        }else{
            $res=D('NewBook')->getBookByTitle($search);
        }
        return json($res);
    }
}