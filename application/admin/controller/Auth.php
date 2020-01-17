<?php
/**
 * 控制器-后台操作
 * @author sj
 * @time 2020.1.11
 */

namespace app\admin\controller;

use app\common\controller\AdminBase;
use app\common\model\AuthGroup;
use app\common\model\AuthRule;
use think\Db;
use think\facade\Request;

class Auth extends AdminBase{
    /**
     * 菜单列表
    **/
    public function menu_list($pid=0){
        $list = AuthRule::where(['pid'=>$pid])
            ->order('sort DESC')
            ->paginate(10,false,[
                'query' => Request::instance()->param(),
            ]);
        return $this->fetch('',[
            'pid' => $pid,
            'list' => $list,
            'page' => $list->render(),
        ]);
    }

    /**
     * 菜单添加
    **/
    public function menu_add(){
        if(!$this->request->isPost()) {

            $menu = AuthRule::getList();
            return $this->fetch('', [
                'menu' => $menu,
            ]);
        }

        $param = $this->param([
            'pid|上级菜单' => ['require'],
            'name|名称'  => ['require'],
            'path|链接地址'     => [],
            'sort|排序'     => [],
            'is_show|是否显示菜单' => ['number','between' => '0,1'],
            'icon|icon' => [],
        ]);
        $param===false && $this->adminReturn(300, $this->getError());
        if($param['is_show']==1 && empty($param['icon'])) $this->adminReturn(300,'请输入icon');

        if($param['pid']==0){
            $param['class'] = 1;
        }else{
            $param['class'] = Db::name('AuthRule')->where(['id'=>$param['pid']])->value('class') + 1;
        }
        $param['create_time'] = time();

        $result = Db::name('AuthRule')->data($param)->insert();
        if($result)$this->adminReturn(200,'添加成功');
        $this->adminReturn(300,'添加失败');
    }

    /**
     * 菜单编辑
     **/
    public function menu_edit($id=0){
        if(!$this->request->isPost()) {

            $info = AuthRule::get($id);
            $menu = AuthRule::getList(1,'',$info['pid']);
            return $this->fetch('', [
                'menu' => $menu,
                'info' => $info,
            ]);
        }

        $param = $this->param([
            'id|id' => ['number','require'],
            'pid|上级菜单' => ['require'],
            'name|名称'  => ['require'],
            'path|链接地址'     => [],
            'sort|排序'     => [],
            'is_show|是否显示菜单' => ['number','between' => '0,1'],
            'icon|icon' => [],
        ]);
        $param===false && $this->adminReturn(300, $this->getError());
        if($param['is_show']==1 && empty($param['icon'])) $this->adminReturn(300,'请输入icon');

        if($param['pid']==0){
            $param['class'] = 1;
        }else{
            $param['class'] = Db::name('AuthRule')->where(['id'=>$param['pid']])->value('class') + 1;
        }

        $result = model('AuthRule')->allowField(true)->isUpdate(true)->save($param);
        if($result)$this->adminReturn(200,'更新成功');
        $this->adminReturn(300,'更新失败');
    }

    /**
     * 菜单删除
     **/
    public function menu_del($ids=''){
        if(!$ids) $this->adminReturn(300,'请选择要操作的数据');
        $ids = explode(',',$ids);
        $result = Db::name('AuthRule')
            ->where(['id' => $ids])
            ->delete();
        if($result)$this->adminReturn(200,'删除成功');
        $this->adminReturn(300,'删除失败');
    }

    /**
     * 菜单禁用
     **/
    public function menu_upstate($id,$state){
        $admin = AuthRule::get($id);
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
     * 权限列表
    **/
    public function auth_list(){
        $list = AuthGroup::where([])
            ->paginate(10,false,[
                'query' => Request::instance()->param(),
            ]);
        return $this->fetch('',[
            'list' => $list,
            'page' => $list->render(),
        ]);
    }

    /**
     * 权限添加
    **/
    public function auth_add(){
        if(!$this->request->isPost()) {
            $auth = AuthRule::getList(2);
            return $this->fetch('', ['auth' => $auth]);
        }
        $param = $this->param([
            'title|权限组名' => ['require'],
            'description|简介'  => [],
            'rules|权限'     => [],
        ]);
        $param===false && $this->adminReturn(300, $this->getError());
        $param['rules'] = implode(',',$param['rules']);
        $result = model('AuthGroup')->allowField(true)->isUpdate(false)->save($param);
        if($result)$this->adminReturn(200,'添加成功');
        $this->adminReturn(300,'添加失败');
    }

    /**
     * 权限编辑
     **/
    public function auth_edit($id=0){
        if(!$this->request->isPost()) {
            $info = AuthGroup::get($id);
            if($info['id']==1) $info['rules'] = '*';//超管
            $auth = AuthRule::getList(2,$info['rules']);
            return $this->fetch('', [
                'auth' => $auth,
                'info' => $info,
            ]);
        }
        $param = $this->param([
            'id|id' => ['number','require'],
            'title|权限组名' => ['require'],
            'description|简介'  => [],
            'rules|权限'     => [],
        ]);
        $param===false && $this->adminReturn(300, $this->getError());
        if($param['id']==1)$this->adminReturn(200,'超管禁止更新');

        $param['rules'] = implode(',',$param['rules']);
        $result = model('AuthGroup')->allowField(true)->isUpdate(true)->save($param);
        if($result)$this->adminReturn(200,'更新成功');
        $this->adminReturn(300,'更新失败');
    }

    /**
     * 权限删除
     **/
    public function auth_del($ids=''){
        if(!$ids) $this->adminReturn(300,'请选择要操作的数据');
        $ids = explode(',',$ids);

        if(in_array(1,$ids)) $this->adminReturn(200,'超管禁止删除');

        $result = Db::name('AuthGroup')
            ->where(['id' => $ids])
            ->delete();
        if($result)$this->adminReturn(200,'删除成功');
        $this->adminReturn(300,'删除失败');
    }

    /**
     * 权限状态
     **/
    public function auth_upstate($id,$state){
        if($id==1)$this->adminReturn(200,'超管禁止修改');
        $admin = AuthRule::get($id);
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
}