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
	
	public function get($table, $page, $size = 5){
        $sql = "SELECT * FROM $table WHERE 1=1" ;
        $start = ($page - 1) * $size; //初始位置
        return $this->tojson(  $this->selectlimit($sql, $start, $size) );		
	}
	
    public function put($table,$id){
        return '';
    }

    public function post($table,$id){
        return '';
    }

    public function dele($table,$id){
        return '';
    }
    
}

?>
