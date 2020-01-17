<?php
/**
 * 控制器-登录
 * @author sj
 * @time 2020.1.9
 */
namespace app\admin\controller;
use app\common\controller\Base;

class Login extends Base{

    /**
     * 登录页面
    **/
    public function index($username = null, $password = null){
        //视图
        if(!$this->request->isPost()) {
            return $this->fetch();
        }

        //登录
        $uid = model('Admin')->login($username, 'username');
        if(!$uid){
            return json(['code' => 1000, 'msg' => model('Admin')->getError()]);
        }
        //校验密码
        $result = model('Admin')->checkPassword($uid,$password);
        if(!$result){
            return json(['code' => 1000, 'msg' => model('Admin')->getError()]);
        }
        model('Admin')->loginAfter($uid);//记录登录SESSION和COOKIES
        model('Admin')->loginUpdate($uid);//更新登录信息
        return json(['code' => 1, 'msg' => '登录成功！', 'data' => ['url' => url('index/index')]]);
    }

    /**
     * 退出登录
     */
    public function logout(){
        model('Admin')->logout();
        return json(['code' => 0, 'msg' => '退出成功！', 'data' => ['url' => url('login')]]);
    }

}