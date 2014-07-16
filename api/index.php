<?php
require 'config.inc.php';
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$conn = new model();


function getlist($page, $table){
    global $conn;
    $page = isset($page) ? intval($page) : 1;    
    echo $conn->entry($table,$page); //列表专用
}

// 客户列表
$app->get('/client/:page',function($page){
    getlist($page,'tech_info');
});


$app->post('/client/',function(){
    
    var_dump($_POST);

});

$app->put('/client/:id',function($id){ });
$app->delete('/client/:id',function($id){ });

// 业务列表
$app->get('/operation',function(){  });
$app->post('/operation/:id',function($id){ });
$app->put('/operation/:id',function($id){ });
$app->delete('/operation/:id',function($id){ });

// 帐号列表
$app->get('/account/:page',function($page){
    getlist($page,'tags');
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