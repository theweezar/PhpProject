<?php
$customer = $viewData['customer'];
$posts = $viewData['posts'];
$token = $viewData['csrfToken'];
Layout::start('Danh sách bài viết');
?>
<div class="container post-list-wrapper">
    <h1 class="h3 mb-2 text-gray-800 text-center">Thêm bài post</h1>
    <div class="d-flex justify-content-center post-form-insert-wrapper mb-4">
        <form id="form-insert-post" method="post" action="<?php echo Url::build('/insertpost') ?>">
            <div class="form-group">
                <label for="postname">Tên post (đặt tên gợi nhớ cho bạn)</label>
                <input type="text" class="form-control" id="postname" name="postname" placeholder="">
            </div>
            <div class="form-group">
                <label for="postlink">Link post (để chế độ công khai) </label>
                <input type="text" class="form-control" id="postlink" name="postlink" placeholder="">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="likes">Lượt like yêu cầu</label>
                    <input type="text" class="form-control" id="likes" name="likes" placeholder="">
                </div>
                <div class="form-group col-md-6">
                    <label for="comments">Lượt comment yêu cầu</label>
                    <input type="text" class="form-control" id="comments" name="comments" placeholder="">
                </div>
            </div>

            <input type="hidden" id="token" name="<?php echo $token['name'] ?>"
                value="<?php echo $token['value'] ?>">

            <button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#exampleModal">
                Gửi yêu cầu
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger" id="exampleModalLabel">Cảnh báo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Vui lòng kiểm tra đầy đủ thông tin vì một khi đã đăng bài thì bạn sẽ không chỉnh sửa hay xóa
                            được.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button type="button" id="submit-form-insert-post" class="btn btn-primary"
                                data-dismiss="modal">Tiếp tục</button>
                            <!-- <input type="submit" class="btn btn-primary" value="Tiếp tục" name="submit"> -->
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            if (isset($status)) {
                ?>
            <div class="my-3 alert <?php echo $status['success'] ? 'alert-success':'alert-danger' ?>" role="alert">
                <?php echo $status['message']; ?>
            </div>
            <?php
            }
            ?>
        </form>
    </div>
    <!-- Page Heading -->
    <div class="card shadow mb-4 d-none d-lg-block">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin cá nhân</h6>
        </div>
        <div class="card-body">
            <table class="w-100">
                <thead>
                    <tr>
                        <th class="w-25">Họ và tên</th>
                        <th class="w-25">Tên tài khoản</th>
                        <th class="w-25 text-center">Like(Đang có)</th>
                        <th class="w-25 text-center">Comment(Đang có)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $customer['realname']; ?></td>
                        <td><?php echo $customer['username']; ?></td>
                        <td class="text-center current-likes"><?php echo $customer['likes']; ?></td>
                        <td class="text-center current-comments"><?php echo $customer['comments']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card shadow mb-4 d-block d-lg-none">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin</h6>
        </div>
        <div class="card-body">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <b class="d-inline-block title">Họ và tên</b>
                    <span><?php echo $customer['realname']; ?></span>
                </li>
                <li class="nav-item">
                    <b class="d-inline-block title">Tên tài khoản</b>
                    <span><?php echo $customer['username']; ?></span>
                </li>
                <li class="nav-item">
                    <b class="d-inline-block title">Lượt like</b>
                    <span class="current-likes"><?php echo $customer['likes'] ?></span>
                </li>
                <li class="nav-item">
                    <b class="d-inline-block title">Lượt comment</b>
                    <span class="current-comments"><?php echo $customer['comments'] ?></span>
                </li>
                <li class="nav-item p-0">
                    <b class="d-none d-lg-block">Trạng thái hoạt động: </b>
                    <b class="d-inline-block title d-lg-none">Trạng thái: </b>
                    <span class="<?php echo strcmp($customer['active'], '1') === 0 ? 'text-primary':'text-danger' ?>">
                        <?php echo strcmp($customer['active'], '1') === 0 ? 'ĐANG HOẠT ĐỘNG' : 'HẾT GÓI'; ?>
                    </span>
                </li>
            </ul>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bài viết</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered post-list-table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="25%">Ngày tạo</th>
                            <th width="22%">Tên bài viết</th>
                            <th width="33%">Đường dẫn</th>
                            <th width="10%">like</th>
                            <th width="10%">Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                    foreach ($posts as $key => $post) {
                        ?>
                        <tr>
                            <td><?php echo $post['created_at']; ?></td>
                            <td><?php echo $post['postname']; ?></td>
                            <td>
                                <a target="_blank" class="link" href="<?php echo $post['postlink']; ?>">
                                    <?php echo $post['postlink']; ?>
                                </a>
                            </td>
                            <td><?php echo $post['likes']; ?></td>
                            <td><?php echo $post['comments']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
Layout::end();
?>