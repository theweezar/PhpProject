<?php
$histories = $viewData['histories'];
Layout::start('Danh sách bài viết');
?>

<div class="container">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Lịch sử kích hoạt gói</h1>
    <p class="mb-4">
        Dưới đây là bảng dữ liệu lịch sử
    </p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lịch sử kích hoạt</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="historyTable" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="w-25">Gói</th>
                            <th class="w-75 text-center">Ngày kích hoạt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($histories as $key => $history) {
                                ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td class="text-center"><?php echo $history['activated_at']; ?></td>
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