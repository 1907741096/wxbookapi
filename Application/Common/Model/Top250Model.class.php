<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/5/19
 * Time: 18:21
 */
namespace Common\Model;
use Think\Model;
class Top250Model extends Model{

    private $_db='';

    public function __construct(){
        $this->_db=M('douban_top250');
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