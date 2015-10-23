<?php
namespace Admin\Model;
use Think\Model;
use Think\Page;

class UserModel extends Model{
    public function getUserlist(){
        $perpage = 5;
        $data = $this->order('createtime DESC')->page(I('p'),$perpage)->select();
        $count = $this->count();
        
        $page = new Page($count,$perpage);
        $show = $page->show();
        //dump($show);exit;
        return array('list'=>$data,'page'=>$show);
    }
}