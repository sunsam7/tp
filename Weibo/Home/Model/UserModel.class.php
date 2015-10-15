<?php
namespace Home\Model;

use Think\Model;
class UserModel extends Model{
    protected $patchValidate = true;    //批量验证开
    protected $_map = array(    //字段映射
        'uname' => 'username',
        'upw'   => 'password',
    );
    
    protected $_validate = array(   //自动验证
        array('username','/^[\w\d_-]{4,20}$/','用户名4到20位，英文和数字'),
        array('password','/^([\w\d]{8,16})$/','密码8到16位，英文和数字',0,'',1),
        array('password2','password','两次密码不一致',0,'confirm'),
        array('username','','用户已存在',0,'unique',1),
        array('username','checkName','帐号错误！',1,'function',4),  // 只在登录时候验证
        array('password','checkPwd','密码错误！',1,'function',4), // 只在登录时候验证
    );
    
    protected $_auto = array(   //自动完成
        array('password','md5',3,'function'),
        array('ip','get_client_ip',1,'function'),
        array('createtime','time',1,'function'),
        array('lasttime','time',3,'function'),
    );
    
    public function reg($data){
        /* if (!preg_match("/^[a-zA-Z_-]{4,20}$/", $data['username'])){
            $info = array('status'=>0,'info'=>'用户名不符合规范');
            return $info;
        }
        if (empty($data['password']) || $data['password'] != $data['password2']){
            $info = array('status'=>0,'info'=>'密码空或两次不一致');
            return $info;
        } */
        //$User = M('User');
        /* $map['username'] = $data['uname'];
        if($this->where($map)->find()){
            $info = array('status'=>0,'info'=>'用户名已存在');
            return $info;
        } */

        //dump($data);
        /* $data_int['username'] = $data['uname'];
        $data_int['password'] = $data['upw'];
        $data_int['ip'] = $_SERVER['REMOTE_ADDR'];
        $data_int['lasttime'] = time(); */
        
        if (!$this->create()){
            $info = array('status'=>0,'info'=>$this->getError());
            return $info;
        }
        
        //dump($data_int);
        if($this->add()){
            $info = array('status'=>1,'info'=>'注册成功');
        }else{
            $info = array('status'=>0,'info'=>'注册不成功');
        }
        return $info;
    }
    
    /**
     * 
     * @param string $username
     * @param string $password
     * @return multitype:number string
     */
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
    
    public function login2($data){
        //dump($data);die;
        if (!$this->create($data,4)){ // 登录验证数据
            // 验证没有通过 输出错误提示信息
            return $this->getError();
        }else{
            // 验证通过 执行登录操作
            return 'ok';
        }
    }
}

?>