<?php
/**
 * 操作日志
 * @author sj
 * @time 2020.1.9
 */
namespace app\common\model;

class LogOperat extends Base{
    //自动写入时间戳
    protected $autoWriteTimestamp = true;
    //字段类型转化
    protected $type = [
        'create_time' => 'timestamp'
    ];
}
