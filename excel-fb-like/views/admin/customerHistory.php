<?php
$posts = $viewData['posts'];
$histories = $viewData['histories'];
Layout::start('Lịch sử đăng bài');
?>
<div class="container post-list-wrapper">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lịch sử đăng bài</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered post-list-table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th width="25%">Ngày tạo</th>
                            <th width="22%">Tên bài viết</th>
                            <th width="33%">Đường dẫn</th>
                            <th width="10%">Like</th>
                            <th width="10%">Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                    foreach ($posts as $key => $post) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $post['created_at']; ?></td>
                            <td><?php echo $post['postname']; ?></td>
                            <td>
                                <a target="_blank" class="link" href="<?php echo $post['postlink']; ?>">
                                    <?php echo $post['postlink']; ?>
                                </a>
                            </td>
                            <td class="text-right"><?php echo $post['likes']; ?></td>
                            <td class="text-right"><?php echo $post['comments']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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