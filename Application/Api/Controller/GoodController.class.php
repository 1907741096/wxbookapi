<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/6/1
 * Time: 13:35
 */
namespace Api\Controller;
use Think\Controller;
class GoodController extends Controller{
    public function checkGood($userid,$bookid){
        $data['userid']=$userid;
        $data['bookid']=$bookid;
        $res=D("Good")->getGoodById($data);
        if($res&&$res['status']==1){
            json(true);
        }
        json(false);
    }
    public function changeGood($userid,$bookid){
        $data['userid']=$userid;
        $data['bookid']=$bookid;
        $res=D("Good")->getGoodById($data);
        if($res&&$res['status']==1){
            $id=$res['id'];
            $status=0;
            if(D('Good')->updateGood($id,$status)){
                $book=D('Book')->getBookById($bookid);
                $d['good']=$book['good']-1;
                D('Book')->updateBookById($book['id'],$d);
                json(false);
            }
        }else{
            if($res){
                $id=$res['id'];
                $status=1;
                if(D('Good')->updateGood($id,$status)){
                    $book=D('Book')->getBookById($bookid);
                    $d['good']=$book['good']+1;
                    D('Book')->updateBookById($book['id'],$d);
                    json(true);
                }
            }else{
                if(D('Good')->addGood($data)){
                    $book=D('Book')->getBookById($bookid);
                    $d['good']=$book['good']+1;
                    D('Book')->updateBookById($book['id'],$d);
                    json(true);
                }
            }
        }
    }
    public function getGoodByUserId($userid,$start=0,$count=9){
        $data=D('Good')->getGoodByUserId($userid,$start,$count);
        foreach($data as $i => $d) {
            $res=D('Book')->getBookById($d['bookid']);
            $data[$i]['bookid']=$res['bookid'];
            $data[$i]['title']=$res['title'];
            $data[$i]['image']=$res['image'];
            $data[$i]['rating']=$res['rating'];
        }
        json($data);
    }
}