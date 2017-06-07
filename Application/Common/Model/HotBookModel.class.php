<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/5/21
 * Time: 13:07
 */
namespace Common\Model;
use Think\Model;
class HotBookModel extends Model{

    private $_db='';

    public function __construct(){
        $this->_db=M('douban_hotbook');
    }
    public function getBook($start,$count){
        $res=$this->_db->limit($start,$count)->select();
        return $res;
    }
    public function getBookByTitle($title){
        $data['title']=array('like','%'.$title.'%');
        $res=$this->_db->where($data)->select();
        return $res;
    }
    public function getBookById($id){
        $data['bookid']=array('like','%'.$id.'%');
        $res=$this->_db->where($data)->select();
        return $res;
    }
}