<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/5/19
 * Time: 18:08
 */

namespace Api\Controller;


use Think\Controller;

class Top250Controller extends Controller
{
    public function getBook($start=0,$count=20){
        $res=D('Top250')->getbook($start,$count);
        return json($res);
    }

    public function getBookBySearch($search){
        if(preg_match("/^[a-zA-Z\s]+$/",$search)){
            $datas=D('Top250')->getBook($start=0,$count=10000);
            $res=[];
            foreach($datas as $data) {
                if (strpos(first_szm(trim($data['title'])), strtolower($search))!==false){
                    array_push($res, $data);
                }
            }
        }elseif(preg_match("/^[0-9\s]+$/",$search)){
            $res=D('Top250')->getBookById($search);
        }else{
            $res=D('Top250')->getBookByTitle($search);
        }
        return json($res);
    }
}