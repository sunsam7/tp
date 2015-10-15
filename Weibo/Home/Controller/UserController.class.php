<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
        //$this->show('kaixin');
        //echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];die;
        $this->display();
    }
    
    public function login(){
        if (!IS_POST){
            $this->display();
        }else{
            $data = I('post.');
            $user = D('User');
            $this->ajaxReturn($user->login($data['username'],$data['password']));
            //$this->ajaxReturn($user->login2($data));
        }
    }
    
    public function register(){
        if (!IS_POST){
            $this->display();
        }else{
            $data = I('post.');
            $user = D('User');
            $this->ajaxReturn($user->reg($data));
            
        }
    }
    
    public function logout(){
        $this->show('退出');
    }
}