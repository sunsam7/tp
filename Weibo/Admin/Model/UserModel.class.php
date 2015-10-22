<?php
namespace Admin\Model;
use Think\Model;

class UserModel extends Model{
    public function getUserlist(){
        return $this->order('createtime DESC')->select();
    }
}