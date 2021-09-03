<?php
Layout::start('Thông tin chi tiết');
$customer = $viewData['customer'];
$csrfToken = $viewData['csrfToken'];
?>
<div class="container customer-detail-wrapper">
    <h1>Thông tin chi tiết khách hàng</h1>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lượt like và comment còn lại</h6>
                </div>
                <div class="card-body">
                    <table class="w-100 text-center">
                        <thead>
                            <tr>
                                <th class="w-50">
                                    Lượt like
                                </th>
                                <th class="w-50">
                                    Lượt comment
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <td id="likeAmount">
                                <?php echo $customer['likes']; ?>
                            </td>
                            <td id="commentAmount">
                                <?php echo $customer['comments']; ?>
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông tin</h6>
                </div>
                <div class="card-body">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <b>Họ và tên:</b>
                            <span><?php echo $customer['realname']; ?></span>
                        </li>
                        <li class="nav-item">
                            <b>Tên tài khoản:</b>
                            <span><?php echo $customer['username']; ?></span>
                        </li>
                        <li class="nav-item p-0">
                            <b class="d-inline-block">Trạng thái: </b>
                            <span
                                class="<?php echo strcmp($customer['active'], '1') === 0 ? 'text-primary':'text-danger' ?>">
                                <?php echo strcmp($customer['active'], '1') === 0 ? 'ĐANG HOẠT ĐỘNG' : 'HẾT GÓI'; ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Phím chức năng</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex button-box">
                        <div class="button-item">
                            <a href="<?php echo Url::build('/admin/customerhistory', array('id' => $customer['id'])); ?>"
                                class="btn btn-success">
                                Lịch sử
                            </a>
                        </div>
                        <div class="button-item">
                            <button data-toggle="modal" data-target="#warning-activation"
                                class="activate-btn btn btn-warning">
                                Kích hoạt
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="warning-activation" tabindex="-1" role="dialog" aria-labelledby="warning-activation"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="warning-activation">Cảnh báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có muốn tiếp tục kích hoạt tài khoản này không ?
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="<?php echo $csrfToken['name']?>" value="<?php echo $csrfToken['value'] ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <button type="button" class="btn btn-primary" id="activate-btn" data-dismiss="modal"
                        data-url="<?php echo Url::build('/admin/activate') ?>"
                        data-key="<?php echo $customer['id'];?>" data-username="<?php echo $customer['username'];?>">
                        Tiếp tục
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Small modal -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary d-none" id="success-alert-btn" 
    data-toggle="modal" data-target="#success-alert">
        Thành công
    </button>
    <!-- Modal -->
    <div class="modal fade" id="success-alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel">Thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tài khoản được kích hoạt thành công
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tiếp tục</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
Layout::end();