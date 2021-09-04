<?php

require(ROOT.'/controllers/AccountController.php');
require(ROOT.'/controllers/AdminController.php');
require(ROOT.'/controllers/CustomerController.php');
require(ROOT.'/scripts/middleware.php');
require(ROOT.'/scripts/csrfProtection.php');

/**
 * Testing Section
 */

Route::get('testing', function(Request $req, Response $res) {
    echo Url::abs('');
});

/**
 * Account Section
 */
Route::get('/', function(Request $req, Response $res) {
    $res->redirect('customer');
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

Route::get('changepassword', 'validateLogged', 'csrfGenerateToken', [AccountController::class, 'renderFormChangePassword']);

Route::post('changepassword', 'validateLogged', 'csrfValidateToken', 'csrfGenerateToken', [AccountController::class, 'changePassword']);

Route::get('admin/package', 'validateAdmin', 'csrfGenerateToken', [AdminController::class, 'rederFormRegisterPackage']);

Route::post('admin/package', 'validateAdmin', 'csrfValidateToken', 'csrfGenerateToken', [AdminController::class, 'registerPackage']);

/**
 * Customer Section
 */
Route::get('customer', 'validateGuest', 'csrfGenerateToken', [CustomerController::class, 'renderCustomerPostList']);

Route::post('insertpost', 'validateGuest', 'csrfValidateToken', 'csrfGenerateToken', [CustomerController::class, 'insertCustomerPost']);

Route::get('history', 'validateGuest', [CustomerController::class, 'renderHistory']);



