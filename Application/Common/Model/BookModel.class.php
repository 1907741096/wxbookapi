<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/5/19
 * Time: 15:08
 */
namespace Common\Model;
use Think\Model;

class BookModel extends Model{

    private $_db='';

    public function __construct(){
        $this->_db=M('book');
    }
    public function getBook($start,$count){
        $res=$this->_db->limit($start,$count)->select();
        return $res;
    }
    public function getBookById($id){
        return $this->_db->where('id='.$id)->find();
    }
    public function getBookByBookId($bookid){
        $res=$this->_db->where('bookid='.$bookid)->find();
        return $res;
    }
    public function getBookByIsbn($isbn){
        $res=$this->_db->where('isbn='.$isbn)->limit(1)->select();
        return $res;
    }
    public function getBookByTitle($title){
        $data['title']=array('like','%'.$title.'%');
        $res=$this->_db->where($data)->select();
        return $res;
    }
    public function getBookByAuthor($author,$start,$count){
        $data['author']=array('like','%'.$author.'%');
        $res=$this->_db->where($data)->limit($start,$count)->select();
        return $res;
    }
    public function getBookByTag($tag,$start,$count){
        $data['tags']=array('like','%'.$tag.'%');
        $res=$this->_db->where($data)->limit($start,$count)->select();
        return $res;
    }
    public function updateBookById($id,$data){
        return $this->_db->where('id='.$id)->save($data);
    }
}