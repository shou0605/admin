<?php
/**
 * 控制器-后台操作
 * @author sj
 * @time 2020.1.11
 */

namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\facade\Request;
use think\db\Where;
use think\Db;

class Admin extends AdminBase{
    /**
     * 操作日志
    **/
    public function operat_list(){
        $where = new Where();
        input('start_time')=='' && input('end_time')=='' || $where['create_time'] =array('between',array(strtotime(input('start_time')),strtotime(input('end_time'))));

        if(input('keyword')!='' && input('keyvalue')!='') $where[input('keyword')] = input('keyvalue');
        $list =  Db::name('LogOperat')
            ->where($where)
            ->order('id DESC')
            ->paginate(10,false,[
                'query' => Request::instance()->param(),
            ]);


        foreach($list as $k => $v){
            $v['create_time']     = date('Y-m-d H:i:s',$v['create_time']);
            $list->offsetSet($k, $v);
        }
        return $this->fetch('',[
            'list' => $list,
            'page' => $list->render(),
            'param' => request()->param(),
        ]);
    }

    /**
     * 管理员列表
    **/
    public function user_list(){
        $where = new Where();
        if(input('keyword')!='' && input('keyvalue')!=''){
            switch(input('keyword')){
                case 'username':
                    $where[input('keyword')] = input('keyvalue');
                    break;
                case 'nickname':
                    $where[input('keyword')] =['like', '%'.input('keyvalue').'%'];
                    break;
            }
        }
        $list = model('Admin')->getAdmin(true,$where)->each(function($v,$k){
            $desc = $v->AuthGroup->title;
            $v['desc'] = $desc ? $desc : '-';
        });

        return $this->fetch('',[
            'list' => $list,
            'page' => $list->render(),
            'param' => request()->param(),
        ]);
    }

    /**
     * 管理员禁用
    **/
    public function user_upstate($id,$state){
        if($id==1) $this->adminReturn(300,'admin禁止修改');

        $admin = model('Admin')->get($id);
        $admin->status = $state;
        $result = $admin->save();
        if($result){
            $this->adminReturn(200,'修改成功',['up' => [
                'txt'=>$state==1 ? '正常' :'禁用',
                'state'=>$state==1 ? 0 :1,
            ]]);
        }
        $this->adminReturn(300,'修改失败');
    }

    /**
     * 管理员删除
    **/
    public function user_del($ids=''){
        if(!$ids) $this->adminReturn(300,'请选择要操作的数据');
        $ids = explode(',',$ids);

        $result = Db::name('Admin')
            ->where(['id' => $ids])
            ->delete();
        if($result)$this->adminReturn(200,'删除成功');
        $this->adminReturn(300,'删除失败');
    }

    /**
     * 管理员添加
     **/
    public function user_add(){
        if(!$this->request->isPost()){
            $group = Db::name('AuthGroup')
                ->where(['status'=>1])
                ->select();
            return $this->fetch('',[
                'group' => $group,
            ]);
        }

        $param = $this->param([
            'username|登录账号'  => ['require'],
            'nickname|昵称'  => ['require'],
            'password|密码'     => ['require'],
            'type|权限组'     => ['require','number'],
        ]);
        $param===false && $this->adminReturn(300, $this->getError());
        if(Db::name('Admin')->where(['username'=>$param['username']])->find()) $this->adminReturn(300,'已存在登录账户');

        $result = model('Admin')->allowField(true)->isUpdate(false)->save($param);
        if($result)$this->adminReturn(200,'添加成功');
        $this->adminReturn(300,'添加失败');
    }

    /**
     * 管理员编辑
     **/
    public function user_edit($id=0){
        if(!$this->request->isPost()){
            $group = Db::name('AuthGroup')
                ->where(['status'=>1])
                ->select();
            $info = model('Admin')->get($id);
            return $this->fetch('',[
                'group' => $group,
                'info' => $info,
            ]);
        }

        $param = $this->param([
            'id|id'  => ['require'],
            'nickname|昵称'  => ['require'],
            'password|密码'     => [],
            'type|权限组'     => ['require','number'],
        ]);
        $param===false && $this->adminReturn(300, $this->getError());
        if(empty($param['password'])) unset($param['password']);

        $result = model('Admin')->allowField(true)->isUpdate(true)->save($param);
        if($result)$this->adminReturn(200,'更新成功');
        $this->adminReturn(300,'更新失败');
    }
}