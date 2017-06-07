<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/6/7
 * Time: 13:16
 */
namespace Common\Model;
use Think\Model;
class BorrowModel extends Model{
    private $_db='';
    public function __construct(){
        $this->_db=M('Borrow');
    }
    public function select($data){
        return $this->_db->where($data)->select();
    }
}