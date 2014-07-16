<?php

class model extends iBase{
	
	function get($table,$page, $size = 5){
        $sql = "SELECT * FROM $table LIMIT $page, $size" ; //pageNum 从0开始
        echo $sql;
        //return $this->_toJson(  $this->_all($sql) );		
	}
	
    function put($table,$id){

    }

    function post($table,$id){

    }

    function delete($table,$id){

    }

}

?>
