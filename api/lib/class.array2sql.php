<?php
/*
     输入的数据转换为sql语句
     陈为平 2008-3-31
     maxtank@21cn.com
*/

class array2sql{

    //增加1个字段n条记录
    //产生 INSERT INTO table (field) VALUES ('1'),('2'),..('n');
    function into_one_to_many($field,$value,$table){
          $sql = "INSERT INTO ".$table." ($field) VALUES ";
          foreach ($value as &$v) {
             if(trim($v)){
                 $tmp .= "('".$v."'),";
             }
          }
          $sql .= $tmp;
          return substr($sql,0,-1).';';
     }

     /**
      * 增加多个n个字段,n条记录
      * 产生 INSERT INTO table (field,field) VALUES ('1','1'),('2','2'),..('n','n');
      * 传入参数
      *
      * $fv = array(
	    'email'=>array('1','11','111')
	    'name'=>array('2','22','222'),
	    'moeny'=>array('3','33','333'),
	    'sex'=>array('4','44','444')
	);
     **/
     function into_many_to_many($field_value,$table){
          $sql = "INSERT INTO ".$table."";
          $sql .= ' ('.join(',',array_keys($field_value)).") ";
          $sql .= ' VALUES ';
          $tmp = '';
          $field_value = array_values($field_value);
          //print_r($field_value);
          for($i=0; $i<count($field_value[0]);$i++){
               $tmp .= "(";
               for($j=0; $j<count($field_value); $j++){
                    $tmp .= "'".$field_value[$j][$i]."',";
               }
               $tmp =substr($tmp,0,-1)."),";
          }
          return $sql.substr($tmp,0,-1).';';
     }

     //增加多个n个字段,1条记录
     //产生 INSERT INTO table (field,field) VALUES ('1','1')
     //直接传入$_POST处理
     function into_many_to_one($field_value,$table){
          $sql = "INSERT INTO ".$table."";
          $sql .= ' ('.join(',',array_keys($field_value)).") ";
          $sql .= ' VALUES (';
          foreach ($field_value as &$v) {
             $tmp .= "'".$v."',";
          }
          return $sql.substr($tmp,0,-1).');';
     }

     //根所传入的字段删除多条记录
     //产生 DELETE FROM sendmail_maillist WHERE (id='37' or id='37')  ;
     function del_many($field,$value,$table){
          $sql = "DELETE FROM ".$table." WHERE (";
          foreach ($value as &$v) {
              $tmp .= "$field=$v or ";
          }
          return substr($sql.$tmp,0,-4).');';
     }

	 //删除一台记录
	 function del_one($field,$idvalue,$table){
		 return "DELETE FROM `$table` WHERE (`$field`='$idvalue')";
	 }

     //根据传入的参数产生更新记录表记录
     //$new->update(array("isdone"=>"0","url"=>"mobilecomputing.ctocio.com.cn/news/9/8070009.shtml"),array("url"=>"http://mobilecomputing.ctocio.com.cn/news/9/8070009.shtml"));
     function update($field,$condition,$table){
          $sql = "UPDATE ".$table." SET ";
          foreach ($field as $key => $v){
               $tmp .= "$key"."='".$v."',";
          }
          $sql .= substr($tmp,0,-1)." WHERE (";
          foreach ($condition as $key => $v){
               $tmp1 .= "$key"."='".$v."',";
          }
          return $sql.substr($tmp1,0,-1).");";
     }

	 //根据sql产生分页sql ORDER要大写 要有*
	 function pagesql($sql){
	 	$s = explode("ORDER", $sql);
		$sql = explode("*", $s[0]);
	 	return $sql[0].' COUNT(*) '.$sql[1];
	 }

}
?>
