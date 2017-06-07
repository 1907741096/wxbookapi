<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/5/22
 * Time: 19:27
 */
namespace Api\Controller;
use Think\Controller;

class PositionController extends Controller{
    public function getposition($id=1,$start=0,$count=3){
        $positions=D('Position')->getPositionByItemid($id,$start,$count);
        $res=[];
        foreach ($positions as $position){
            $r=D('Book')->getBookByBookId($position['bookid']);
            array_push($res, $r);
        }
        return json($res);
    }
}