<?php

class iBase{

    function _one($sql){
        global $conn;
        return $conn->getVar($sql);
    }

    function _row($sql){
        global $conn;
        return $conn->getLine($sql);
    }

    function _all($sql){
        global $conn;
        return $conn->getData($sql);
    }

    function _info($sql){
        return self::_row($sql);
    }

    function _add($sql){
        global $conn;
        $d = $conn->runSql($sql);
        return $conn->lastId();
    }

    function _del($sql){
        global $conn;
        return $conn->runSql($sql);
    }

    function _update($sql){
        global $conn;
        return $conn->runSql($sql);
    }
	
	function _tojson($data){
		return json_encode($data);
	}
	
}

?>