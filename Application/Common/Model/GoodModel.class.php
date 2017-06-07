<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/6/1
 * Time: 14:30
 */
namespace Common\Model;
use Think\Model;
class GoodModel extends Model{
    private $_db="";
    public function __construct(){
        $this->_db=M('Good');
    }
    public function addGood($data){
        return $this->_db->add($data);
    }
    public function getGoodById($data){
        return $this->_db->where($data)->find();
    }
    public function updateGood($id,$status){
        $data['status']=$status;
        return $this->_db->where('id='.$id)->save($data);
    }
    public function getGoodByUserId($userid,$start,$count){
        $data['userid']=$userid;
        $data['status']=1;
        if(!$count){
            $this->_db->where($data)->select();
        }
        return $this->_db->where($data)->limit($start,$count)->select();
    }
}