<?php

function userLogged($isadmin, $user) {
    if (isset($isadmin)) {
        Session::put(array(
            'logged' => true,
            'isadmin' => $isadmin,
            'userId' => $user['id'],
            'username' => $user['username']
        ));
    }
}