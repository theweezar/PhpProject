<?php

function validateAdmin(Request $req, Response $res, Next $next) {
    $validate = Session::get('logged') && Session::get('isadmin') ? true : false;
    if (!$validate) {
        $res->redirect(Url::build('/login', array(
            'rurl' => 1
        )));
    } else {
        $next->execute($req, $res);
    }
}

function validateGuest(Request $req, Response $res, Next $next) {
    $validate = Session::get('logged') && !Session::get('isadmin') ? true : false;
    if (!$validate) {
        $res->redirect(Url::build('/login', array(
            'rurl' => 0
        )));
    } else {
        $next->execute($req, $res);
    }
}

function validateLogged(Request $req, Response $res, Next $next) {
    $validate = Session::get('logged') ? true : false;
    if (!$validate) {
        // If users not logged and they're trying to access login, this middleware will allow them to access login page
        if ($req->path == 'GET/login') {
            $next->execute($req, $res);
        } else {
            $res->redirect(Url::build('/login', array(
                'rurl' => $req->params['rurl']
            )));
        }
    } else {
        // If users logged and they're trying to access login, this middleware will redirect them to work page
        if ($req->path == 'GET/login') {
            $res->redirect(Url::build(Session::get('isadmin') ? '/admin' : '/customer'));
        } else {
            $next->execute($req, $res);
        }
    }
}