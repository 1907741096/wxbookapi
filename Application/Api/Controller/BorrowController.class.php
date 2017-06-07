<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/6/7
 * Time: 13:12
 */
namespace Api\Controller;
use Think\Controller;
class BorrowController extends Controller{
    public function getBorrowByUserId($userid){
        $data['userid']=$userid;
        $res=D('Borrow')->select($data);
        if($res){
            foreach($res as $i => $r){
                $d=D('Book')->getBookById($r['bookid']);
                $res[$i]['image']=$d['image'];
                $res[$i]['title']=$d['title'];
            }
            json(array('status'=>1,'borrow'=>$res));
        }else{
            json(array('status'=>0));
        }
    }
}