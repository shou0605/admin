<?php
/**
 * 工具
 * @author sj
 * @time 2020.1.9
 */
namespace app\common\service;

class Tool extends Base{
	/**
	 * 获取访客IP地址
	 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
	 * @return string|int
	 */
	public function getClientIp($type = 0)
	{
		$type = $type ? 1 : 0;
		static $client_ip = [];
		if ($client_ip) return $client_ip[$type];
		$ip = '';
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$pos = array_search('unknown', $arr);
			if (false !== $pos) unset($arr[$pos]);
			$ip = trim($arr[0]);
		} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (isset($_SERVER['REMOTE_ADDR'])) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		// IP地址合法验证
		$long = sprintf("%u", ip2long($ip));
		$client_ip = $long ? [$ip, $long] : ['0.0.0.0', 0];
		return $client_ip[$type];
	}

	/**
	 * 生成数据签名
	 * @param  mixed $data 需要生成签名的数据
	 * @return string 签名字符串
	 */
	public function sign($data, $algo = 'md5'){
		if(is_array($data)){
			ksort($data);
		}
		$string = serialize($data).config('custom.data_secret_key'); //转为字符串
		return hash($algo, $string); //生成签名
	}
}