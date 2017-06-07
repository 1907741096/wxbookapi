<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/6/3
 * Time: 9:35
 */
namespace Common\Model;
use Think\Model;
class ReserveModel extends Model{
    private $_db='';
    public function __construct(){
        $this->_db=M('Reserve');
    }
    public function getReserveById($data){
        return $this->_db->where($data)->find();
    }
    public function addReserve($data){
        $data['borrow_time']=time()+3*24*60*60;
        return $this->_db->add($data);
    }
    public function updateReserve($id,$status){
        $data['status']=$status;
        return $this->_db->where('id='.$id)->save($data);
    }
    public function getReserveByUserId($userid,$start,$count){
        $data['userid'] = $userid;
        $data['status'] = 1;
        $data['borrow_time']=array('gt',time());
        if (!$count) {
            $this->_db->where($data)->select();
        }
        return $this->_db->where($data)->limit($start, $count)->select();
    }
}