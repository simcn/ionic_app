<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

function toJson($data){
    return json_encode($data);
}

// 客户列表
$app->get('/client',function(){ 
    $data = array(
        'name'=>'one',
        'phone'=>'123456709'
    );
    echo toJson($data);
});
$app->post('/client/:id',function($id){ });
$app->put('/client/:id',function($id){ });
$app->delete('/client/:id',function($id){ });

// 业务列表
$app->get('/operation',function(){ 
    $data = array(
        'name'=>'one',
        'phone'=>'123456709'
    );
    echo toJson($data);
});
$app->post('/operation/:id',function($id){ });
$app->put('/operation/:id',function($id){ });
$app->delete('/operation/:id',function($id){ });

// 帐号列表
$app->get('/account',function(){
    $data = array(
        'name'=>'one',
        'phone'=>'123456709'
    );
    echo toJson($data);
});
$app->post('/account/:id',function($id){
	echo $id;
});
$app->put('/account/:id',function($id){ });
$app->delete('/account/:id',function($id){ });

// GET route
$app->get('/',function () {
        $template = '<img src="ui/logo.png" >';
		$template .= '<h1>hello Hybird</h1>';
        echo $template;
    }
);

$app->run();