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
        $next->execute($req, $res);
    } else {
        $res->redirect(Url::build(Session::get('isadmin') ? '/admin' : '/customer'));
    }
}