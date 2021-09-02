<?php

require(ROOT.'/controllers/AccountController.php');
require(ROOT.'/controllers/AdminController.php');

Route::get('/', function(Request $req, Response $res) {
    echo 'Home';
});

Route::get('admin', [AdminController::class, 'checkTicket']);