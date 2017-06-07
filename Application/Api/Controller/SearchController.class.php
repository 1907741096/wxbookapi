<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/6/7
 * Time: 17:08
 */
namespace Api\Controller;
use Think\Controller;
class SearchController extends Controller{
    public function addSearch($userid,$content){
        $data['userid']=$userid;
        $data['content']=$content;
        $data['create_time']=time();
        $res=D('Search')->add($data);
        json($res);
    }
    public function getSearchByUserId($userid,$start=0,$count=10){
        $data['userid']=$userid;
        $data['status']=1;
        $res=D('Search')->select($data,$start,$count);
        json($res);
    }
    public function deleteSearchByUserId($userid){
        $data['status']=0;
        $res=D('Search')->updateByUserId($userid,$data);
        json($res);
    }

}