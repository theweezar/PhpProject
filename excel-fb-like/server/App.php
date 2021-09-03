<?php

require(ROOT.'/controllers/AccountController.php');
require(ROOT.'/controllers/AdminController.php');
require(ROOT.'/controllers/CustomerController.php');
require(ROOT.'/scripts/middleware.php');
require(ROOT.'/scripts/csrfProtection.php');

Route::get('/', function(Request $req, Response $res) {
    $res->redirect(Url::build('/login', array(
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

/**
 * Admin Section
 */
Route::get('admin', 'validateAdmin', [AdminController::class, 'renderCustomerList']);

Route::get('admin/register', 'validateAdmin', 'csrfGenerateToken', [AccountController::class, 'renderRegisterForm']);

Route::post('admin/register', 'validateAdmin', 'csrfValidateToken', 'csrfGenerateToken', [AccountController::class, 'registerAccount']);

Route::get('admin/customer', 'validateAdmin', 'csrfGenerateToken', [AdminController::class, 'renderCustomerDetail']);

Route::get('admin/customerhistory', 'validateAdmin', [AdminController::class, 'renderCustomerHistory']);

Route::post('admin/activate', 'validateAdmin', 'csrfValidateToken', 'csrfGenerateToken', [AdminController::class, 'activateCustomer']);

Route::get('changepassword', 'validateAdmin', 'csrfGenerateToken', [AccountController::class, 'renderFormChangePassword']);

Route::post('changepassword', 'validateAdmin', 'csrfValidateToken', 'csrfGenerateToken', [AccountController::class, 'changePassword']);

/**
 * Customer Section
 */
Route::get('customer', 'validateGuest', 'csrfGenerateToken', [CustomerController::class, 'renderCustomerPostList']);

Route::post('insertpost', 'validateGuest', 'csrfValidateToken', 'csrfGenerateToken', [CustomerController::class, 'insertCustomerPost']);

Route::get('history', 'validateGuest', [CustomerController::class, 'renderHistory']);



