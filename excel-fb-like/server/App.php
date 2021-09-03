<?php

require(ROOT.'/controllers/AccountController.php');
require(ROOT.'/controllers/AdminController.php');
require(ROOT.'/scripts/middleware.php');
require(ROOT.'/scripts/csrfProtection.php');

Route::get('/', function(Request $req, Response $res) {
    $res->redirect(Url::build('login', array(
        'rurl' => 0
    )));
});

Route::get('error', function(Request $req, Response $res) {
    $params = $req->getParams();
    $res->render('error.php', $params);
});

Route::get('login', 'validateLogged', 'csrfGenerateToken', function(Request $req, Response $res) {
    $params = $req->getParams();
    $res->render('login.php', array(
        'rurl' => isset($params['rurl']) ? $params['rurl'] : '0',
        'message' => isset($params['message']) ? $params['message'] : '',
        'csrfToken' => array(
            'name' => 'csrfToken',
            'value' => Session::get('csrfToken')
        )
    ));
});

Route::post('login', 'csrfValidateToken', 'csrfGenerateToken', [AccountController::class, 'login']);
Route::get('logout', [AccountController::class, 'logout']);
Route::get('admin', 'validateAdmin', [AdminController::class, 'renderCustomerList']);
Route::get('admin/register', 'csrfGenerateToken', [AccountController::class, 'renderRegisterForm']);
Route::post('admin/register', 'csrfValidateToken', 'csrfGenerateToken', [AccountController::class, 'registerAccount']);

