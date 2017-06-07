<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/6/1
 * Time: 15:16
 */
namespace Api\Controller;
use Think\Controller;
class CollectController extends Controller{
    public function checkCollect($userid,$bookid){
        $data['userid']=$userid;
        $data['bookid']=$bookid;
        $res=D("Collect")->getCollectById($data);
        if($res&&$res['status']==1){
            json(true);
        }
        json(false);
    }
    public function changeCollect($userid,$bookid){
        $data['userid']=$userid;
        $data['bookid']=$bookid;
        $res=D("Collect")->getCollectById($data);
        if($res&&$res['status']==1){
            $id=$res['id'];
            $status=0;
            if(D('Collect')->updateCollect($id,$status)){
                $book=D('Book')->getBookById($bookid);
                $d['collect']=$book['collect']-1;
                D('Book')->updateBookById($book['id'],$d);
                json(false);
            }
        }else{
            if($res){
                $id=$res['id'];
                $status=1;
                if(D('Collect')->updateCollect($id,$status)){
                    $book=D('Book')->getBookById($bookid);
                    $d['collect']=$book['collect']+1;
                    D('Book')->updateBookById($book['id'],$d);
                    json(true);
                }
            }else{
                if(D('Collect')->addCollect($data)){
                    $book=D('Book')->getBookById($bookid);
                    $d['collect']=$book['collect']+1;
                    D('Book')->updateBookById($book['id'],$d);
                    json(true);
                }
            }
        }
    }
    public function getCollectByUserId($userid,$start=0,$count=9){
        $data=D('Collect')->getCollectByUserId($userid,$start,$count);
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