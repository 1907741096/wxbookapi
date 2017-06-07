<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/5/19
 * Time: 14:59
 */

namespace Api\Controller;//11f889aeed90ec7e870113d971884de9
use Think\Controller;

class BookController extends Controller
{
    public function getBookById($id){
        $res=D('Book')->getBookByBookId($id);
        if($res){
            return json($res);
        }
        json(false);
    }

    public function getBookByIsbn($isbn){
        $res=D('Book')->getBookByIsbn($isbn);
        if($res){
            return json($res);
        }
        json(false);
    }

    public function getBookByTitle($title){
        $res=D('Book')->getBookByTitle($title);
        return json($res);
    }

    public function getBookByAuthor($author,$start=0,$count=20){
        $res=D('Book')->getBookByAuthor($author,$start,$count);
        return json($res);
    }

    public function getBookByTag($tag,$start=0,$count=20){
        $res=D('Book')->getBookByTag($tag,$start,$count);
        return json($res);
    }

    public function getBookBySearch($search){
        if(preg_match("/^[a-zA-Z\s]+$/",$search)){
            $datas=D('Book')->getBook($start=0,$count=10000);
            $res=[];
            foreach($datas as $data) {
                if (strpos(first_szm(trim($data['title'])), strtolower($search))!==false){
                    array_push($res, $data);
                }
            }
        }elseif(preg_match("/^[0-9\s]+$/",$search)){
            $data=D('Book')->getBookByBookId($search);
            $res=['books'=>$data];
        }else{
            $res=D('Book')->getBookByTitle($search);
        }
        return json($res);
    }

}