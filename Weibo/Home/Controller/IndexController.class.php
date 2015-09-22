<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('kaixin');
    }
    
    public function say($input='hello world'){
        //$this->show('Hi,'.$input);
        $this->assign('name',$input);
        $this->display();
    }
}