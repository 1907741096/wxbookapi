<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/5/22
 * Time: 19:29
 */
namespace Common\Model;
use Think\Model;

class PositionModel extends Model{
    private  $_db='';
    public function __construct(){
        $this->_db=M('position');
    }
    public function getPositionByItemid($id,$start,$count){
        $res=$this->_db->where('itemid='.$id)->order('listorder desc')->limit($start,$count)->select();
        return $res;
    }
}