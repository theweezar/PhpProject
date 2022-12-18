<div class="cm-page-title d-flex">
    <h2>
        Media container
    </h2>
</div>

<div class="form-wrapper mb-4">
    <form class="cm-form media-form" action="<?php echo admin_url('admin-post.php') ?>" method="post"
        enctype="multipart/form-data">
        <?php wp_nonce_field($args['upload_media_nonce']); ?>
        <input type="hidden" name="action" value="<?php echo $args['upload_media_ajax_action'] ?>">
        <input type="hidden" name="current_dir" value="<?php echo $args['current_dir'] ?>">
        <input type="file" name="media_files[]" id="media_files" multiple="true">
        <button class="btn btn-success" type="submit">
            Upload
        </button>
    </form>
</div>

<div class="table-wrapper">
    <div class="table-header">
        <table class="cm-table media-table">
            <thead>
                <tr>
                    <th class="file-checkbox text-center">
                        <input type="checkbox" name="media-checkbox-all" id="media-checkbox-all">
                    </th>
                    <th class="file-name">File name</th>
                    <th class="file-size">Size</th>
                    <th class="file-action">Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="table-body">
        <table class="cm-table media-table">
            <tbody>
                <?php
            $file_list = $args['file_list'];
            $current_dir = $args['current_dir'];

            foreach ($file_list as $idx => $file) {
            ?>
                <tr data-file-path="<?php echo $file['file_path'] ?>">
                    <td class="text-center file-checkbox">
                        <input type="checkbox" name="media-checkbox" id="media-checkbox">
                    </td>
                    <td class="media-preview-trigger">
                        <?php
                        if ($file['is_dir']) {
                        ?>
                        <a href="<?php echo add_query_arg(array_merge(
                                            CM_Controller::get_node('CM_Media_Controller', 'route_render_media_container'),
                                            array(
                                                'dir' => urlencode(CM_Media::make_path($current_dir . $file['file_name']))
                                            )
                                        ), admin_url('admin.php')) ?>">
                            <?php echo $file['file_name'] ?>
                        </a>
                        <?php
                        } else {
                        ?>
                        <span><?php echo $file['file_name'] ?></span>
                        <?php
                        }
                        ?>
                    </td>
                    <td class="file-size">
                        <?php echo $file['file_size'] ?>
                    </td>
                    <td class="file-action"></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal media-preview -->
<div class="modal fade media-preview-modal" id="media-preview-modal" tabindex="-1" role="dialog"
    aria-labelledby="media-preview-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body d-flex justify-content-center align-items-center">

            </div>
        </div>
    </div>
</div>