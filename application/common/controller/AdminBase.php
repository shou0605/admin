<?php
/**
 * admin基类
 * @author sj
 * @time 2020.1.9
 */
namespace app\common\controller;

use app\common\model\AuthRule;
use think\session;

abstract class AdminBase extends Base{

    //当前操作地址
    protected $url = '';
    //当前登录uid
    protected $uid = 0;
    //错误信息
    protected $error = '';


    /**
     * 构造函数
     */
    public function initialize(){
        parent::initialize();

        if(!(session('admin') && cookie(service('Tool')->sign(session('admin')['username'])))) $this->redirect("login/index");//cookie失效跳转登录

        //获取当前小写请求地址
        $this->url = strtolower($this->request->controller() .'/'.$this->request->action());

        //判断是否有权限
        if(!AuthRule::isAuth(session('admin')['uid'],$this->url)) exit('无权限');

        //操作日志
        db('log_operat')->insert([
            'url'      => $this->url,
            'name'     => isset($_SESSION['think']['admin']['username']) ? $_SESSION['think']['admin']['username'] : '访问了登录页面',
            'ip'       => service('Tool')->getClientIp(),
            'create_time'  => time(),
        ]);
    }

    public function _empty(){
//		$this->redirect('http://');
        echo '无效方法';
    }

    /**
     * 数据安全校验
     * @param array $rule 预定义接口参数
     * @return array|false
     */
    protected function param($rule = [], $message = []){
        $param = $this->request->param();
        //校验数据
        $result = $this->validate($param, array_filter($rule), $message);
        if($result!==true){
            $this->error = $result;
            return false;
        }
        $data = [];
        foreach($rule as $k => $v){
            list($key) = explode('|', $k);
            $data[$key] = isset($param[$key]) ? $param[$key] : null;
        }
        return $data;
    }

    /**
     * 后台格式返回JSON
     * @param  int $statusCode 200=成功、300=错误、301=超时
     * @param  string $msg 提示信息
     * @param  array $data 附加参数
     */
    protected function adminReturn($statusCode = 300, $msg = '', $data = []){
        if(isset($data['url'])){
            $url              = url($data['url'], '', false, '');
            $data['navTabId'] = db('auth_rule')->where(['name' => trim($url, '/')])->value('id');
        }
        $result = array_merge([
            'statusCode'   => $statusCode,
            'message'      => $msg ? : ($statusCode==200 ? '操作成功！' : '操作失败！'),
            'navTabId'     => '',
            'rel'          => '',
            'callbackType' => 'closeCurrent',  //empty($data['callbackType']) ? 'closeCurrent' : $data['callbackType'],    //closeCurrent关闭页面
            'forwardUrl'   => '',
            'confirmMsg'   => '',
        ], $data);
        abort(json($result));
    }

    /**
     * 获取错误信息
     */
    public function getError(){
        return $this->error;
    }
}
