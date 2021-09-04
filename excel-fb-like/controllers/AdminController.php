<?php

class AdminController {
    public function renderCustomerList(Request $req, Response $res) {
        $db = new DatabaseHelpers();
        $customers = $db->getCustomer();
        $db->close();
        $res->render('admin/customerList.php', array(
            'customers' => $customers
        ));
    }

    public function renderCustomerDetail(Request $req, Response $res) {
        $db = new DatabaseHelpers();
        $userId = $req->params['id'];
        $result = $db->getCustomerById($userId);
        $db->close();
        if (count($result) === 0) {
            throw new Exception("Page not found", 404);
        } else {
            $res->render('admin/customerDetail.php', array(
                'customer' => $result[0],
                'csrfToken' => array(
                    'name' => 'csrfToken',
                    'value' => Session::get('csrfToken')
                )
            ));
        }
    }

    public function renderCustomerHistory(Request $req, Response $res) {
        $id = $req->params['id'];
        $db = new DatabaseHelpers();
        $posts = $db->getPosts($id);
        $histories = $db->getHistory($id);
        $db->close();
        $res->render('admin/customerHistory.php', array(
            'posts' => $posts,
            'histories' => $histories
        ));
    }

    public function activateCustomer(Request $req, Response $res) {
        $validate = $req->validate(array(
            'id' => ['required', 'number']
        ));
        if ($validate['valid']) {
            $userId = $req->params['id'];
            $db = new DatabaseHelpers();
            if ($db->activate($userId)) {
                $db->saveHistory($userId);
                $historys = $db->getHistory($userId);
                $users = $db->getCustomerById($userId);
                $res->json(array(
                    'success' => true,
                    'message' => 'Tài khoản đã được kích hoạt',
                    'history' => count($historys) !== 0 ? $historys[count($historys) - 1] : null,
                    'likes' => count($users) !== 0 ? $users[0]['likes'] : 0,
                    'comments' => count($users) !== 0 ? $users[0]['comments'] : 0,
                    'csrfToken' => array(
                        'name' => 'csrfToken',
                        'value' => Session::get('csrfToken')
                    )
                ));
            } else {
                $res->json(array(
                    'success' => false,
                    'message' => 'Có lỗi xảy ra trong cơ sở dữ liệu. Vui lòng tải lại trang.',
                    'userId' => $userId
                ));
            }
            $db->close();
        }
    }

    public function rederFormRegisterPackage(Request $req, Response $res) {
        $res->render('admin/registerPackage.php', array(
            'csrfToken' => array(
                'name' => 'csrfToken',
                'value' => Session::get('csrfToken')
            )
        ));
    }

    public function registerPackage(Request $req, Response $res) {

    }
}
