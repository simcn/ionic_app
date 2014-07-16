<?php

/**
 * 格式化安全字符串
 * @modify 2008-11-27
 * @name simcn studio php site framework
 * @package safeinput
 * @author Max.Chen maxtank@qq.com
 * @url http://www.simcn.com  
 * @copyright 2003 - 2008 simcn studio
 */

class safeinput{

	/**
	 * 过滤url
	 * @ parameter $url 用户输入的字符串
	 * @ parameter $maxlen 最长字符串(多余截断)
	 * @ return $url 安全的url
	 **/
	public static function url($url,$maxlen=200){
		return substr(urlencode(str_replace('http://', '', strtolower(trim($url)))),0,$maxlen);
	}
	
	/**
	 * 过滤正文
	 * @ parameter $text 正文
	 * @ return $text 安全的正文
	 **/
	public static function text($text){
		return htmlentities(trim($text), ENT_QUOTES, 'UTF-8');
	}
	
	/**
	 * 数据字段过滤
	 * @ parameter $text 正文
	 * @ return $text 安全的正文
	 **/
	public static function q($text){
		#判断安全转议开关
		if(get_magic_quotes_gpc()==1){ return trim($text); }
		return addslashes(trim($text));
	}
	
	/**
	 * 过滤ID
	 * @ parameter $text 正文
	 * @ return $text 安全的正文
	 **/
	public static function id($id){
		return intval(substr($id,0,10));
	}
	
	/**
	 * 过滤ID
	 * @ parameter $text 正文
	 * @ return $text 安全的正文
	 **/
	public static function input($str,$maxlen = 200){
		return substr(htmlentities(trim($str), ENT_QUOTES,'UTF-8'),$maxlen);
	}

}
	

?>