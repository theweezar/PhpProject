<?php

class CustomerController {
    
    public function renderCustomerPostList(Request $req, Response $res) {
        $db = new DatabaseHelpers();
        $customers = $db->getCustomerById(Session::get('userId'));
        if (count($customers) === 0) {
            // báo lỗi
        } else {
            $customer = $customers[0];
            $posts = $db->getPosts(Session::get('userId'));
            $db->close();
            $res->render('guest/postList.php', array(
                'customer' => $customer,
                'posts' => $posts,
                'csrfToken' => array(
                    'name' => 'csrfToken',
                    'value' => Session::get('csrfToken')
                )
            ));
        }
    }

    public function insertCustomerPost(Request $req, Response $res) {
        $validateInfo = $req->validate(array(
            'postname' => ['required'],
            'postlink' => ['required']
        ));
        $validateLikeCmt = $req->validate(array(
            'likes' => ['required', 'number'],
            'comments' => ['required', 'number']
        ));
        $status = null;
        if (!$validateInfo['valid']) {
            $status = array(
                'success' => false,
                'message' => 'Vui lòng điền đầy đủ thông tin'
            );
        } else if (!$validateLikeCmt['valid']) {
            $status = array(
                'success' => false,
                'message' => 'Vui lòng điền số like và comment, nếu như không yêu cầu thì nhập 0'
            );
        } else {
            $postname = $req->params['postname'];
            $postlink = $req->params['postlink'];
            $likes = $req->params['likes'];
            $comments = $req->params['comments'];

            // Nếu cả like và comment đều bằng 0 thì ko nhận
            if (strcmp($likes, '0') === 0 && strcmp($comments, '0') === 0) {
                $status = array(
                    'success' => false,
                    'message' => 'Không được yêu cầu cả hai like và comment đều bằng 0'
                );
            } else {
                $db = new DatabaseHelpers();

                $pass = $db->calculateLikeAndComment(array(
                    'userId' => Session::get('userId'),
                    'likes' => $likes,
                    'comments' => $comments
                ));
    
                if (!isset($pass)) {
                    $status = array(
                        'success' => false,
                        'message' => 'Đã có lỗi xảy ra trong cơ sở dữ liệu'
                    );
                } else if (!$pass['passLikes']) {
                    $status = array(
                        'success' => false,
                        'message' => 'Bạn không đủ lượt like'
                    );
                } else if (!$pass['passComments']) {
                    $status = array(
                        'success' => false,
                        'message' => 'Bạn không đủ lượt comment'
                    );
                } else if (!$db->proceedUseLikeAndComment(array(
                    'userId' => Session::get('userId'),
                    'likes' => $pass['afterLikes'],
                    'comments' => $pass['afterComments']
                ))) {
                    $status = array(
                        'success' => false,
                        'message' => 'Đã có lỗi xảy ra trong cơ sở dữ liệu'
                    );
                } else {
                    // var_dump($pass);
                    $status = $db->addPost(array(
                        'userId' => Session::get('userId'),
                        'postname' => $postname,
                        'postlink' => $postlink,
                        'likes' => $likes,
                        'comments' => $comments
                    ));

                    if ($status['success']) {
                        $newPost = $db->getNewPost(Session::get('userId'));
                        $status['post'] = $newPost[0];
                        $status['afterLikes'] = $pass['afterLikes'];
                        $status['afterComments'] = $pass['afterComments'];
                    }

                    $status['csrfToken'] = array(
                        'name' => 'csrfToken',
                        'value' => Session::get('csrfToken')
                    );
                }
                $db->close();
            }
        }
        $res->json($status);
    }

    public function renderHistory(Request $req, Response $res) {
        
    }
}