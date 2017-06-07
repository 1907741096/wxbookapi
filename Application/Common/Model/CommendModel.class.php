<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/6/6
 * Time: 10:09
 */
namespace Common\Model;
use Think\Model;
class CommendModel extends Model{
    private $_db="";
    public function __construct(){
        $this->_db=M('Commend');
    }
    public function getCommend($data){
        return $this->_db->where($data)->select();
    }
    public function add($data){
        return $this->_db->add($data);
    }
}