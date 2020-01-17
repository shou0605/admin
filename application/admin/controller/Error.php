<?php
/**
 * 控制器-空控制器
 * @author sj
 * @time 2020.1.9
 */
namespace app\admin\controller;
use app\common\controller\AdminBase;

class Error extends AdminBase{

    public function _empty(){
        echo '无效模块';
    }

}