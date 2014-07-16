<?php
/**
 * PDO数据处理类
 * @author Mark.Chen <sim_cn@qq.com>
 * @version 0.1
 */

class db extends PDO{
    
    public $db;
    public $error;
    public $rs;
    public $debug = false; //true false
    
    /**
     * 构造函数生成 $this->db;
     * @param 数据库配置文件
     * @return NULL
     */
    public function __construct($cfg,$charSet = 'utf8'){
        try {
            $this->db = new PDO($cfg['dsn'], $cfg['user'], $cfg['pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES '$charSet';"));
        } catch (PDOException $e) {
            die ("出错! " . $e->getMessage() . "<br/>");
        }
    }
    
    /**
     * 析构函数，关闭数据库链接
     * @return NULL
     */
    public function __destruct(){
        $this->db = null;
    }
    
    /**
     * 增加数据返回最后一次更新的id
     * @param $_POST
     * @param 表名
     * @return LastID;
     */
    public function insert($data,$table){
        $i=0;
        foreach($data as $k=>$v){
            $key[$i] = $k;
            $value[$i] = ':'.$k;
            $i++;
        }
        $sql = 'INSERT INTO `'.$table.'` ('.join(',',$key).') VALUES ('.join(',',$value).')';
        $dd = $this->db->prepare($sql);
        $dd->execute($data);
        return $this->db->lastInsertId();
    }
    
    /**
     * 更新数据
     * @param 
     */
    public function up($data,$table,$where = '1'){
        $i=0;
        foreach($data as $k=>$v){
            $value[$i] = $k.'=:'.$k;
            $i++;
        }
        $sql = "UPDATE `$table` SET ".join(',',$value)." WHERE $where";
        $dd = $this->db->prepare($sql);
        return $dd->execute($data);
    }
    
    /**
     * 执行sql语句
     */
    public function run($sql){
        $this->rs = $this->db->prepare($sql);
        return $this->rs->execute();
    }
    
    /**
     * 分页取数据
     * @param sql
     * @param 开始位置
     * @param 获取记录数量
     * @return array()
     */
    public function selectlimit($sql,$offset=0, $num=10){
        $sql .= ' LIMIT '.$offset.','.$num;
        $this->run($sql);
        return $this->getall($sql);
    }
    
    /**
     * 取单一数据
     */
    public function getone($sql){
        $this->run($sql);
        return $this->rs->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * 取一列数据
     */
    public function getrow($sql){
        $this->run($sql);
        return $this->rs->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * 所有数据
     */
    public function getall($sql){
        $this->run($sql);
        return $this->rs->fetchAll(PDO::FETCH_ASSOC);
    }
   
    /**
     * 删除数据
     */
    public function _delete($sql){
        return $this->run($sql);
    }
    
    /**
     * 更新数据
     */
    public function update($sql){
        return $this->run($sql);
    }
    
    /**
     * 统计表格中的数据大小
     */
    public function num($table,$where = '1=1'){
        $sql = "SELECT count(*) as n FROM `$table` WHERE $where";
        $d = $this->getone($sql);
        return $d['n'];
    }

    //// 转化为json格式
    public function tojson($data){
        if(is_array($data)){
            return json_encode($data);            
        }
        $this->error = '无数据';
        return '';
    }
    
}




?>