<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/6/6
 * Time: 9:55
 */
namespace Api\Controller;
use Think\Controller;
class CommendController extends Controller{
    public function addCommend(){
        unset($_POST['star']);
        $d['bookid']=$_POST['bookid'];
        $d['status']=1;
        $r=D('Commend')->getCommend($d);
        if($r){
            json(array('status'=>0,'message'=>'图书已被推荐，请勿重复推荐'));
        }
        $res=D('Commend')->add($_POST);
        if($res){
            json(array('status'=>1,'message'=>'推荐成功，管理员添加图书后将发消息通知您'));
        }else{
            json(array('status'=>0,'message'=>'推荐失败'));
        }
    }
}