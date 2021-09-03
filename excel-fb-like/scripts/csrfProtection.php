<?php

function csrfGenerateToken(Request $req, Response $res, Next $next) {
    $random = bin2hex(random_bytes(64));
    $hash = sha1($random);
    Session::put(array(
        'csrfToken' => $hash
    ));
    if (isset($next)) {
        $next->execute($req, $res);
    }
}

function csrfValidateToken(Request $req, Response $res, Next $next) {
    $csrfToken = isset($req->params['csrfToken']) ? $req->params['csrfToken'] : '';
    if (hash_equals(Session::get('csrfToken') , $csrfToken)) {
        $next->execute($req, $res);
    }
}
