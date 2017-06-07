<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/6/6
 * Time: 16:19
 */
namespace Api\Controller;
use Think\Controller;

class CommentController extends Controller{
    public function getCommentByBookid($bookid,$start=0,$count=1){
        $data['bookid']=$bookid;
        $data['status']=1;
        $res=D('Comment')->getComment($data,$start,$count);
        if($res){
            foreach ($res as $i => $r){
                $u=D('User')->getUserById($r['userid']);
                $res[$i]['face']=$u['face'];
                $res[$i]['name']=$u['name'];
            }
            json(array('status'=>1,'comment'=>$res));
        }else{
            json(array('status'=>0));
        }
    }
}