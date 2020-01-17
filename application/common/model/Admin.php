<?php
/**
 * 管理员用户
 * @author sj
 * @time 2020.1.9
 */
namespace app\common\model;

use think\facade\Request;


class Admin extends Base{

    /* 自动完成 */
    //写入（包含新增、更新）时自动完成
    protected $auto = [];
    //新增时自动完成
    protected $insert = [
        'status' => 1,
        'register_ip'
    ];
    //字段类型转化
    protected $type = [
        'last_login_time' => 'timestamp'
    ];
    //更新时自动完成
    protected $update = [];

    //自动写入时间
    protected $autoWriteTimestamp = true;    //模型中定义autoWriteTimestamp属性，true时间戳-datetime时间格式-false关闭写入
    protected $createTime = 'register_time';

    //只读字段
    protected $readonly = ['username', 'id'];    //模型中定义readonly属性，配置指定只读字段

    //默认密码加密KEY
    protected $secret_key = '&17@:iY$0?(twB]kru)46J^!9l;.,Z5oE[bI_QmA';

    /**
     * 读取器颜色
    **/
    public function getColorTypeAttr($value){
        $color = 'default';
        switch($value){
            case 1: $color='blue';break;
            case 2: $color='green';break;
            case 3: $color='red';break;
            case 4: $color='yellow';break;
            case 5: $color='orange';break;
        }
        return $color;
    }

    /**
     * 修改器-密码
     */
    public function setPasswordAttr($value){
        return md5($this->secret_key.$value);
    }

    /**
     * 修改器-注册IP
     */
    public function setRegisterIpAttr(){
        return service('Tool')->getClientIp(1);
    }

    /**
     * 用户登录认证
     * @param  string $username 用户名
     * @param  integer $type 用户名类型 （1-用户名，2-手机，3-邮箱，4-UID）
     * @return int|false 登录成功-用户ID
     */
    public function login($username, $type = 'username'){
        $login_type = ['username', 'id'];
        if(!in_array($type, $login_type)){
            $this->error = '登录类型错误';
            return false;
        }
        //获取用户信息
        $user = $this->get([$type => $username]);
        //登陆校验
        if(!$user){
            $this->error = '用户不存在';
            return false;
        }
        if($user->status!=1){
            $this->error = '用户被禁用';
            return false;
        }
        //登录成功，返回用户ID
        return $user->id;
    }

    /**
     * 密码校验
     * @param int $user_id 用户ID
     * @param string $password 密码
     * @return bool
     */
    public function checkPassword($uid, $password){
        $user = $this->get(['id' => $uid]);
        //密码校验
        $en_password = $this->setPasswordAttr($password);

        if($user->password!=$en_password){
            $this->error = '密码错误';
            return false;
        }
        return true;
    }



    /**
     * 登录记录
     * @param int $user 用户ID
     */
    public function loginUpdate($user_id){
        $this->isUpdate(true)->save([
            'last_login_time' => time(),
            'last_login_ip'   => service('Tool')->getClientIp(),
            'login_num'       => db()->raw('`login_num`+1'),
        ], ['id' => $user_id]);
    }

    /**
     * 登录后置操作
     * @param int $user 用户ID
     */
    public function loginAfter($uid){
        $user = $this->get($uid);
        //记录登录SESSION和COOKIES
        $auth = [
            'uid'  => $user->id,
            'username' => $user->username,
            'color_type' => $user->color_type,
            'last_login_ip' => $user->last_login_ip,
            'login_num' => ++$user->login_num,
            'last_login_time' => date('Y-m-d H:i:s',$user->last_login_time),
        ];
        session('admin', $auth);
        cookie(service('Tool')->sign($auth['username']), $user->nickname, 7200);//设置登录时长2小时
    }

    /**
     * 注销当前用户
     * @return void
     */
    public function logout(){
        //清空session
        session('admin',null);
    }


    /**
     * 获取管理员列表
     * @param boole $is_page 是否分页
    **/
    public function getAdmin($is_page=false,$where){
        $list =  self::where($where);
        if($is_page){
            $list = $list->order('status DESC,id DESC')
                ->paginate(10,false,[
                    'query' => Request::instance()->param(),
                ]);
        }else{
            $list = $list->find();
        }
        return $list;
    }

    public function authGroup(){
        return $this->hasOne('AuthGroup','id','type');
    }
}
