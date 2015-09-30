<?php
namespace Home\Model;

use Think\Model;
class UserModel extends Model{
    public function reg($data){
        if (!preg_match("/^[a-zA-Z_-]{4,20}$/", $data['username'])){
            $info = array('status'=>0,'info'=>'用户名不符合规范');
            return $info;
        }
        if (empty($data['password']) || $data['password'] != $data['password2']){
            $info = array('status'=>0,'info'=>'密码空或两次不一致');
            return $info;
        }
//         $User = M('User');
        $map['username'] = $data['username'];
        if($this->where($map)->find()){
            $info = array('status'=>0,'info'=>'用户名已存在');
            return $info;
        }

        //dump($data);
        $data_int['username'] = $data['username'];
        $data_int['password'] = md5($data['password']);
        $data_int['ip'] = $_SERVER['REMOTE_ADDR'];
        $data_int['lasttime'] = time();
        
        //dump($data_int);
        if($this->add($data_int)){
            $info = array('status'=>1,'info'=>'注册成功');
        }else{
            $info = array('status'=>0,'info'=>'注册不成功');
        }
        return $info;
    }
    
    public function login($username,$password){
        if (!$username || !$password){
            $info = array('status'=>0,'info'=>'登录信息不完整');
            return $info;
        }
        $data_login['username'] = $username;
        $data_login['password'] = md5($password);
        if($this->where($data_login)->find()){
            $info = array('status'=>1,'info'=>'登录成功');
        }else{
            $info = array('status'=>0,'info'=>'用户名或密码错误');
        }
        return $info;
        
    }
}

?>