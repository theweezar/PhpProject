<?php

require(ROOT.'/databases/DatabaseHelpers.php');
require(ROOT.'/scripts/logginHelpers.php');

class AccountController {
    
    public function renderRegisterForm(Request $req, Response $res) {
        $res->render('admin/register.php', array(
            'csrfToken' => array(
                'name' => 'csrfToken',
                'value' => Session::get('csrfToken')
            )
        ));
    }

    public function registerAccount(Request $req, Response $res) {
        $status = null;
        $validate = $req->validate(array(
            'realname' => ['required'],
            'username' => ['required'],
            'password' => ['required']
        ));

        if (!$validate['valid']) {
            $status = array(
                'success' => false,
                'message' => 'Vui lòng nhập đầy đủ thông tin'
            );
        } else {
            $realname = $req->params['realname'];
            $username = $req->params['username'];
            $password = $req->params['password'];
            $user = array(
                'realname' => $realname,
                'username' => $username,
                'password' => $password,
                'isadmin' => isset($req->params['isadmin']) ? 1 : 0
            );
            $db = new DatabaseHelpers();
            $status = $db->register($user);
            $db->close();
            if ($status['success']) {
                $status['newUsername'] = $username;
                $status['newPassword'] = $password;
            }
            $res->render('admin/register.php', array(
                'status' => $status,
                'csrfToken' => array(
                    'name' => 'csrfToken',
                    'value' => Session::get('csrfToken')
                )
            ));
        }
    }

    public function login(Request $req, Response $res) {
        $validate = $req->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        $message = '';
        if ($validate['valid']) {
            $username = $req->params['username'];
            $password = $req->params['password'];
            $rurl = $req->params['rurl'];
            $db = new DatabaseHelpers();
            $dbUser = $db->validateLogin(array(
                'username' => $username,
                'password' => $password
            ));
            $db->close();
            if ($dbUser == null) {
                $message = 'Sai tên tài khoản hoặc mật khẩu';
            } else {
                // var_dump($dbUser);
                if (strcmp($rurl, '1') == 0) {
                    if (strcmp($dbUser['isadmin'], '1') == 0) {
                        userLogged(true, $dbUser);
                        $res->redirect('admin');
                    } else {
                        $message = 'Tài khoản không hợp lệ';
                    }
                }
    
                if (strcmp($rurl, '0') == 0) {
                    if (strcmp($dbUser['isadmin'], '0') === 0) {
                        userLogged(false, $dbUser);
                        $res->redirect('/');
                    } else {
                        $message = 'Tài khoản Không hợp lệ';
                    }
                }
            }
        } else {
            $message = 'Sai tên tài khoản hoặc mật khẩu';
        }
        $res->render('login.php', array(
            'rurl' => $req->params['rurl'],
            'message' => $message,
            'csrfToken' => array(
                'name' => 'csrfToken',
                'value' => Session::get('csrfToken')
            )
        ));
    }

    public function logout(Request $req, Response $res) {
        $rurl = Session::get('isadmin') ? '1':'0';
        var_dump(Session::all());
        Session::destroy();
        $res->redirect(Url::build('login', array(
            'rurl' => $rurl
        )));
    }

    public function renderFormChangePassword(Request $req, Response $res) {
        $res->render('changePassword.php', array(
            'csrfToken' => array(
                'name' => 'csrfToken',
                'value' => Session::get('csrfToken')
            )
        ));
    }

    public function changePassword(Request $req, Response $res) {
        if (Input::validate('oldpassword', 'required') && Input::validate('newpassword', 'required')
        && Input::validate('confirmpassword', 'required')) {
            $oldpassword = Input::get('oldpassword');
            $newpassword = Input::get('newpassword');
            $confirmpassword = Input::get('confirmpassword');
            $db = new DatabaseHelpers();
            $dbUser = $db->validateLogin(array(
                'username' => Session::get('username'),
                'password' => $oldpassword
            ));

            if (!isset($dbUser)) {
                $status = array(
                    'success' => false,
                    'message' => 'Sai mật khẩu cũ'
                );
            } else if (strcmp($newpassword, $confirmpassword) !== 0) {
                $status = array(
                    'success' => false,
                    'message' => 'Mật khẩu xác nhận sai'
                );
            } else if ($db->changePassword(array(
                'username' => Session::get('username'),
                'password' => $confirmpassword
            ))) {
                $status = array(
                    'success' => true,
                    'message' => 'Đổi mật khẩu thành công'
                );
            } else {
                $status = array(
                    'success' => false,
                    'message' => 'Đổi mật khẩu thất bại'
                );
            }
            $db->close();
        } else {
            $status = array(
                'success' => false,
                'message' => 'Vui lòng nhập đầy đủ thông tin'
            );
        }
    }
}