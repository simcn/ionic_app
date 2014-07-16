<?php
/**
 * 数据库读取接口
 */
class model extends db{

    /**
     * 构造函数生成 $this->db;
     * @param 数据库配置文件
     * @return NULL
     */
    public function __construct(){
        global $dbConfig;
        if(is_array($dbConfig)){
            parent::__construct($dbConfig);
        }else{
            die('$dbConfig 未定义');
        }
    }
    
    /**
     * 管理员相关
     */
    public function checkAdmin($user,$pass){
        if($user=='chenwp' && $pass='197997'){
            $_SESSION['lingganAdmin'] == md5('~~~197997~~~~');
            return true;
        }
        return false;
    }
    
    public function isAdminCheck(){
        if($_SESSION['lingganAdmin'] == md5('~~~197997~~~~')){
            header("Location:index.php");
        }
    }
    
    
    
    /**
     * 通用列表获取方法
     */
    public function tablelist($table,$o=0,$n=10,$where='1=1', $order=' ORDER BY `id` DESC'){
        $sql = 'SELECT * FROM `'.$table.'` WHERE '.$where.$order;
        //echo $sql;
        return $this->selectlimit($sql,$o,$n);
    }
    
    /**
     * 标签列表
     * @param 开始地址
     * @param 数据量
     * @return data
     */
    public function taglist($o = 0,$n = 10){
        $sql = 'SELECT * FROM `tags` ORDER BY `id` DESC';
        return $this->selectlimit($sql,$o,$n);
    }
    
    /**
     * Summary
     * @param object $data Description
     * @param object $table Description
     * @return object  Description
     */
    public function add($data,$table){
        return $this->insert($data,$table);
    }
    
    /**
     * 删除表里的某条记录
     * @param object $id Description
     * @param object $table Description
     * @return object  Description
     */
    public function del($id,$table){
        $sql = "DELETE FROM `$table` WHERE (`id`='$id')";
        return $this->delete($sql);
    }
    
    /**
     * 返回正文页面信息
     * @param string $id id
     * @param string $table 表名
     * @return array 单组记录
     */
    public function info($id,$table){
        $sql = "SELECT * FROM `$table` WHERE id=$id";
        return $this->getrow($sql);
    }
    
    /**
     * 更新记录段态
     * @param int $id 编号
     * @param string $table 表名
     * @return y/n
     */
    public function s($id,$table,$msg='已发布', $f = 's'){
        $sql = "UPDATE $table SET `s` = '$msg' WHERE id = $id;";
        return $this->update($sql);
    }
	
	/**
	 * 取最大的id
	 *
	 */
	public function get_max_id($table = 'simple-album'){
		$sql = "SELECT * FROM  $table ORDER BY  `id` DESC LIMIT 0 , 1";
		return $this->getrow($sql);
	}
	
	
    
}


?>