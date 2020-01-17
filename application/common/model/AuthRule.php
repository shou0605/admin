<?php
/**
 * 菜单
 * @author sj
 * @time 2020.1.14
 */
namespace app\common\model;

class AuthRule extends Base{
    /* 自动完成 */
    //写入（包含新增、更新）时自动完成
    protected $auto = [];
    //新增时自动完成
    protected $insert = [
        'module' => 'admin', //模块
        'status' => 1, //状态[0禁用-1启用]
    ];
    //更新时自动完成
    protected $update = [];

    //自动写入时间
    protected $autoWriteTimestamp = true;    //模型中定义autoWriteTimestamp属性，true时间戳-datetime时间格式-false关闭写入
    //只读字段
    protected $readonly = [];    //模型中定义readonly属性，配置指定只读字段

    /**
     * 获取菜单列表
     * @param boole $is_all 是否显示全部菜单
     * @param int $type 1菜单列表转html代码 2权限列表转html代码 3首页菜单转html
     * @param string $rules  规则 *为全选
     * @param int $pid 选中id
    **/
    public function getList($type=1,$rules='',$pid=0){
        $where = ['status'=>1,'module'=>'admin'];

        if(in_array($type,[1,2])) $where['class'] = [1,2];

        $data = self::where($where)
            ->order('sort DESC')
            ->field('id,pid,name,is_show,class,path,icon')
            ->select()->toArray();
        $list = self::sortArrayRecursio($data);

        switch($type){
            case 1:
                $html = self::getMenuListToHtmlSelect($list, $i = 1, $html = '',$pid);
                break;
            case 2:
                $html = '<input type="checkbox" class="autoCheckboxAll" onclick="SelectAll(this)">全选<br/>';
                $html .= self::getAuthRuleListToHtmlSelect($list,$rules);
                break;
            case 3:
                $html = self::getIndexMenuToHtml($list);
                break;
        }

        return $html;
    }

    /**
     * 判断当前用户是否有权限
    **/
    public function isAuth($uid,$url){
        $user = Admin::get($uid);
        if($user->authGroup->id==1) return true; //超管

        if(!$user || $user->status==0 || $user->authGroup->status!=1) return false;//判断是否被禁用或者删除

        //判断权限
        $rule_id = self::where(['path'=>$url])->value('id');
        if(!($rule_id && in_array($rule_id,explode(',',$user->authGroup->rules)))) return false;
        return true;
    }


    /**
     * 递归-数组整理
     * @param array $data 需要整理的数据
     * @param int $pid 从指定父ID开始整理
     * @param string $pid_name 父ID名称
     * @param string $list_name 自数组名称
     * @return array 多维数组
     */
    private function sortArrayRecursio($data, $option = []){
        $option = array_merge(array(
            'parent_id'      => 0, //指定父id开始整理
            'id_name'        => 'id', //id键名
            'parent_id_name' => 'pid',
            'child'          => 'child', //子集键名
        ), $option);
        //递归
        $fn = function($data, $option) use (&$fn){
            $return = array();
            if(isset($data[$option['parent_id']]) && is_array($data[$option['parent_id']])){
                foreach($data[$option['parent_id']] as $k => $v){
                    $new_option          = array_merge(
                        $option,
                        array('parent_id' => $v[$option['id_name']])
                    );
                    $v[$option['child']] = isset($data[$v[$option['id_name']]]) ? $fn($data, $new_option) : [];
                    $return[]            = $v;
                }
            }
            return $return;
        };
        //先分组
        $group_data = array();
        foreach($data as $k => $v){
            $group_data[$v[$option['parent_id_name']]][] = $v;
        }

        return $fn($group_data, $option);
    }

    /**
     * 菜单列表转html代码
     * @param $data
     * @param int $i
     * @param string $html
     * @param int $pid 选中id
     * @return string
     */
    private function getMenuListToHtmlSelect($data, $i = 1, $html = '', $pid = 0){
        $num = 1;
        foreach($data as $k => $v){
            $html .= '<option value="'.$v['id'].'"';
            if($pid==$v['id']) $html .= ' selected';
            $html .= '>';
            for($m = 1; $m<$i; $m++) $html .= '　　';
            $html .= $i>1 ? ($num==count($data) ? '└─' : '├─') : '　 ';
            $html .= $v['name'];
            if($v['is_show']==0 && $v['pid']==0) $html .= "(不显示菜单)";
            $html .= '</option>';
            if(!empty($v['child'])) $html = self::getMenuListToHtmlSelect($v['child'], $i+1, $html, $pid);
            $num++;
        }
        return $html;
    }

    /**
     * 权限列表转html代码
     * @param $data
     * @param int $i
     * @param string $rules 规则 (* 全部 也就是admin权限)
     * @param string $html
     * @return string
     */
    private function getAuthRuleListToHtmlSelect($data, $rules='', $i = 1, $html = ''){
        $num = 1;
        foreach($data as $k => $v){
            if($num==1){
                if(empty($v['child'])){
                    $html.='<div class="div_'.$v['pid'].'">';
                }else{
                    $html.='<div>';
                }
            }
            for($m = 0; $m<$v['class']; $m++) $html .= '　　';
            $html .='<input type="checkbox"value="'.$v['id'].'" name="rules[]"';
            if($rules == '*') $html.='checked';
            if(in_array($v['id'],explode(',',$rules))) $html.='checked';
            $html .='>';
            $html .= $v['name'];
            if(!empty($v['child'])) $html = self::getAuthRuleListToHtmlSelect($v['child'],$rules,$i+1, $html);
            if($num==count($data)) $html .= '</div>';
            if($v['pid']<2 && empty($v['child'])) $html .='<br/>';
            if($num%4==0 && count($data)>$num && $v['class']==3) $html .='<br/>';//避免超出
            $num++;
        }
        return $html;
    }

    /**
     * 首页菜单转html
     * @param $data
     * @param int $i
     * @param string $html
     * @return string
    **/
    public function getIndexMenuToHtml($data,$i=0,$html=''){
        $num = 1;
        foreach($data as $k=>$v){
            //一级分类
            if($v['class']==1)$html .= "<dl><dt><i class='Hui-iconfont'>".$v['icon']."</i> ".$v['name']."<i class='Hui-iconfont menu_dropdown-arrow'>&#xe6d5;</i></dt>";

            //二级分类
            if($v['class']==2){
                $url = url($v['path']);
                if($num==1) $html .="<dd><ul>";
                $html .= "<li><a _href='".$url."' data-title='".$v['name']."' href='javascript:void(0)'>".$v['name']."</a></li>";
                if($num==count($data)) $html .= '</ul></dd>';
            }
            if(!empty($v['child'])) $html = self::getIndexMenuToHtml($v['child'],$i+1, $html);

            if($v['class']==1) $html.="</dl>";
            $num++;
        }
        return $html;
    }
}
