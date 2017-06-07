<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/5/30
 * Time: 10:31
 */
namespace Api\Controller;
use Think\Controller;
class UserController extends Controller{
    public function getUserById($id){
        $res=D('User')->getUserById($id);
        json($res);
    }

    public function addUser(){
        $data=$_POST;
        if(trim($data['username'])==''){
            json(array('status'=>0,'message'=>'账号不能为空'));
        }
        if(strlen(trim($data['password']))<6){
            json(array('status'=>0,'message'=>'密码不少于6位'));
        }
        if(trim($data['password'])!=trim($data['password1'])){
            json(array('status'=>0,'message'=>'两次密码不一致'));
        }
        if(trim($data['school'])==''){
            json(array('status'=>0,'message'=>'学校不能为空'));
        }
        $res=D('User')->getUserByUsername($data['username']);
        if($res){
            json(array('status'=>0,'message'=>'账号已存在'));
        }
        if($data['openid']){
            $res=D('User')->getUserByOpenId($data['openid']);
            if($res){
                json(array('status'=>0,'message'=>'该微信已注册'));
            }
        }


        $data['password']=md5(C('MD5_PRE').$data['password']);
        $res=D('User')->addUser($data);
        if($res){
            json(array('status'=>1,'message'=>'添加成功','id'=>$res));
        }
        json(array('status'=>0,'message'=>'添加失败'));
    }
    public function checkUser(){
        $data=$_POST;
        if(trim($data['username'])==''){
            json(array('status'=>0,'message'=>'账号不能为空'));
        }
        if(trim($data['password'])==''){
            json(array('status'=>0,'message'=>'密码不能为空'));
        }
        $res=D('User')->getUserByUsername($data['username']);
        if(!$res) {
            json(array('status' => 0, 'message' => '账号不存在'));
        }
        $data['password']=md5(C('MD5_PRE').$data['password']);
        $data['create_time']=time();
        if($res['password']==$data['password']){
            json(array('status' => 1, 'message' => '登录成功','id'=>$res['id']));
        }else{
            json(array('status' => 0, 'message' => '密码错误'));
        }
    }
    public function getUserByOpenId($openid){
        $res=D('User')->getUserByOpenId($openid);
        json($res);
    }
    public function updateUser(){
        $data=$_POST;
        if(trim($data['name'])==''){
            json(array('status'=>0,'message'=>'昵称不能为空'));
        }
        if(trim($data['school'])==''){
            json(array('status'=>0,'message'=>'学校不能为空'));
        }
        $id=$data['id'];
        unset($data['id']);
        $res=D('User')->updateUserById($id,$data);
        if($res){
            json(array('status'=>1,'message'=>'修改成功'));
        }
        json(array('status'=>0,'message'=>'修改失败'));
    }
    public function updateUserByPush($id,$push){
        $data['push']=$push;
        D('User')->updateUserById($id,$data);
    }
    public function updateUserByTime($id,$time){
        $data['push_time']=$time;
        D('User')->updateUserById($id,$data);
    }
}