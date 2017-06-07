<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/5/29
 * Time: 9:33
 */
namespace Common\Model;
use Think\Model;
class TokenModel extends Model{
    private $_db="";
    public function __construct(){
        $this->_db=M('token');
    }
    public function getToken(){
        $res=$this->_db->order('time desc')->find();
        return $res;
    }
    public function addToken($data){
        $res=$this->_db->add($data);
        return $res;
    }
}