<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/6/3
 * Time: 9:27
 */
namespace Api\Controller;
use Think\Controller;
class ReserveController extends Controller{
    public function checkReserve($userid,$bookid){
        $data['userid']=$userid;
        $data['bookid']=$bookid;
        $data['borrow_time']=array('gt',time());
        $res=D("Reserve")->getReserveById($data);
        if($res&&$res['status']==1){
            json(true);
        }
        json(false);
    }

    public function changeReserve($userid,$bookid){
        $data['userid']=$userid;
        $data['bookid']=$bookid;
        $data['borrow_time']=array('gt',time());
        $res=D("Reserve")->getReserveById($data);
        if($res&&$res['status']==1){
            $id=$res['id'];
            $status=0;
            if(D('Reserve')->updateReserve($id,$status)){
                json(array('status'=>1,'message'=>'取消成功'));
            }
        }else{
            $b=D('Book')->getbookbyid($bookid);
            if($b['count']<=0){
                json(array('status'=>0,'message'=>'暂无库存'));
            }
            if($res){
                $id=$res['id'];
                $status=1;
                if(D('Reserve')->updateReserve($id,$status)){
                    json(array('status'=>1,'message'=>'预订成功，请在三天内前来借取'));
                }
            }else{
                if(D('Reserve')->addReserve($data)){
                    json(array('status'=>1,'message'=>'预订成功，请在三天内前来借取'));
                }
            }
        }
    }
    public function getReserveByUserId($userid,$start=0,$count=9){
        $data=D('Reserve')->getReserveByUserId($userid,$start,$count);
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