<?php

class model extends db{

    public function __construct(){
        global $dbConfig;
        if(is_array($dbConfig)){
            parent::__construct($dbConfig);
        }else{
            die('$dbConfig 未定义');
        }
    }

    public function entry($table, $page, $size = 5){
        $sql = "SELECT * FROM $table WHERE 1=1" ;
        $start = ($page - 1) * $size; //初始位置
        return $this->tojson(  $this->selectlimit($sql, $start, $size) );  
    }
	
    // Read 取正文
	public function get($table,$id){
	
	}
	
    // Update 更新正文
    public function put($table,$id){
        return '';
    }

    // Create 新加正文
    public function post($table,$post){        
        return $this->insert($post,$table);
    }
    // DELETE 删除内容
    public function delete($table,$id){
        return '';
    }

}

?>
