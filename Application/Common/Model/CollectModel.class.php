<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/6/1
 * Time: 15:20
 */
namespace Common\Model;
use Think\Model;
class CollectModel extends Model{
    private $_db="";
    public function __construct(){
        $this->_db=M('Collect');
    }
    public function addCollect($data){
        return $this->_db->add($data);
    }
    public function getCollectById($data){
        return $this->_db->where($data)->find();
    }
    public function updateCollect($id,$status){
        $data['status']=$status;
        return $this->_db->where('id='.$id)->save($data);
    }
    public function getCollectByUserId($userid,$start,$count){
        $data['userid']=$userid;
        $data['status']=1;
        if(!$count){
            $this->_db->where($data)->select();
        }
        return $this->_db->where($data)->limit($start,$count)->select();
    }
}