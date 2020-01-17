<?php
/**
 * 服务层基类
 * @author sj
 * @time 2020.1.9
 */
namespace app\common\service;

abstract class Base{

	//错误信息
	protected $error = '';

	/**
	 * 构造方法
	 * @access public
	 * @param array|object $data 数据
	 */
	public function __construct(){
	}

	/**
	 * 获取错误信息
	 * @return string
	 */
	public function getError(){
		return $this->error;
	}


}
