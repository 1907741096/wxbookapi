<?php
/**
 * Created by PhpStorm.
 * User: 王振远
 * Date: 2017/6/2
 * Time: 11:23
 */
namespace Common\Model;
use Think\Model;
class CartModel extends Model
{
    private $_db = "";

    public function __construct()
    {
        $this->_db = M('Cart');
    }

    public function addCart($data)
    {
        return $this->_db->add($data);
    }

    public function getCartById($data)
    {
        return $this->_db->where($data)->find();
    }

    public function updateCart($id, $status)
    {
        $data['status'] = $status;
        return $this->_db->where('id=' . $id)->save($data);
    }

    public function getCartByUserId($userid)
    {
        $data['userid'] = $userid;
        $data['status'] = 1;
        return $this->_db->where($data)->select();
    }
}
