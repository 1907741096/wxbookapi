<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/6/2
 * Time: 11:11
 */
namespace Api\Controller;
use Think\Controller;
class CartController extends Controller{
    public function checkCart($userid,$bookid){
        $data['userid']=$userid;
        $data['bookid']=$bookid;
        $res=D("Cart")->getCartById($data);
        if($res&&$res['status']==1){
            json(true);
        }
        json(false);
    }
    public function changeCart($userid,$bookid){
        $data['userid']=$userid;
        $data['bookid']=$bookid;
        $res=D("Cart")->getCartById($data);
        if($res&&$res['status']==1){
            $id=$res['id'];
            $status=0;
            if(D('Cart')->updateCart($id,$status)){
                json(false);
            }
        }else{
            if($res){
                $id=$res['id'];
                $status=1;
                if(D('Cart')->updateCart($id,$status)){
                    json(true);
                }
            }else{
                if(D('Cart')->addCart($data)){
                    json(true);
                }
            }
        }
    }
    public function getCartByUserId($userid){
        $data=D('Cart')->getCartByUserId($userid);
        foreach($data as $i => $d) {
            $res=D('Book')->getBookById($d['bookid']);
            $data[$i]['bookid']=$res['bookid'];
            $data[$i]['title']=$res['title'];
            $data[$i]['image']=$res['image'];
            $data[$i]['count']=$res['count'];
        }
        json($data);
    }
    public function deleteCartById($id){
        D('Cart')->updateCart($id,0);
        json(true);
    }

}