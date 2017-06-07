<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/6/7
 * Time: 17:10
 */
namespace Common\Model;
use Think\Model;
class SearchModel extends Model{
    private $_db='';
    public function __construct(){
        $this->_db=M('Search');
    }
    public function add($data){
        return $this->_db->add($data);
    }
    public function select($data,$start=0,$count=999999){
        return $this->_db->where($data)->limit($start,$count)->select();
    }
    public function updateByUserId($userid,$data){
        return $this->_db->where('userid='.$userid)->save($data);
    }
}