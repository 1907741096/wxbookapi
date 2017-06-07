<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/6/6
 * Time: 16:21
 */
namespace Common\Model;
use Think\Model;
class CommentModel extends Model{
    private $_db='';
    public function __construct(){
        $this->_db=M('Comment');
    }
    public function getComment($data,$start,$count){
        return $this->_db->where($data)->limit($start,$count)->select();
    }
}