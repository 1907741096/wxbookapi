<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/5/30
 * Time: 12:25
 */
namespace Common\Model;
use Think\Model;
class UserModel extends Model{
    private $_db="";
    public function __construct(){
        $this->_db=M('user');
    }

    public function addUser($data){
        return $this->_db->add($data);
    }
    public function getUserByUsername($username){
        return $this->_db->where('username='.$username)->find();
    }
    public function getUserById($id){
        return $this->_db->where('id='.$id)->find();
    }
    public function getUserByOpenId($openid){
        $data['openid']=$openid;
        return $this->_db->where($data)->find();
    }
    public function updateUserById($id,$data){
        return $this->_db->where('id='.$id)->save($data);
    }
}