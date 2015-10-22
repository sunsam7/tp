<?php
namespace Admin\Controller;
use Think\Controller;

class IndexController extends Controller{
    public function index(){
        //echo 'admin index';
        header('location:'.U('Index/userlist'));
        //$this->display();
    }
    
    public function userlist(){
        //$this->display();
        $user_list = D('User')->getUserlist();
        //dump($user_list);
        $this->assign('user_list',$user_list);
        $this->display();
    }
}