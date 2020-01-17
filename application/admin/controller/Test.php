<?php
/**
 * 控制器-测试
 * @author sj
 * @time 2020.1.9
 */
namespace app\admin\controller;

class Test extends \think\Controller{

    //图片
    public function images(){
        return $this->fetch('');
    }
    //编辑器
    public function editor(){
        return $this->fetch('');
    }
}