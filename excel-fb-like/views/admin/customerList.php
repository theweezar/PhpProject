<?php
Layout::start('Thông tin khách hàng');
$customers = $viewData['customers'];
?>
<div class="container customer-list-wrapper">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Danh sách tài khoản</h1>
    <p class="mb-4">
        Danh sách bao gồm các thông tin tài khoản của khách hàng.
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tài khoản</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="th-createdat">Ngày tạo</th>
                            <th class="th-realname">Họ và tên</th>
                            <th class="th-username">Tên tài khoản</th>
                            <th class="th-like">Lượt like</th>
                            <th class="th-comment">Lượt comment</th>
                            <th class="th-status">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                    foreach ($customers as $key => $customer) {
                        ?>
                        <tr class="customer-row <?php echo strcmp($customer['likes'], '0') === 0 && strcmp($customer['comments'], '0') === 0 ? 'active-off' : ''; ?>"
                            data-url="<?php echo Url::build('/admin/customer', array('id' => $customer['id'])); ?>"
                            data-key="<?php echo $customer['id']; ?>" data-order="<?php echo $key; ?>">
                            <td class="text-center">
                                <?php echo $customer['created_at']; ?>
                            </td>
                            <td>
                                <?php echo $customer['realname']; ?>
                            </td>
                            <td>
                                <?php echo $customer['username']; ?>
                            </td>
                            <td class="text-right">
                                <?php echo $customer['likes']; ?>
                            </td>
                            <td class="text-right">
                                <?php echo $customer['comments']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo strcmp($customer['active'], '1') === 0 ? 'ĐANG HOẠT ĐỘNG' : 'VÔ HIỆU HÓA'; ?>
                            </td>
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