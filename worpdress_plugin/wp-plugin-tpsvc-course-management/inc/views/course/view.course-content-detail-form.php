<div class="cm-page-title">
    <h2>
        <?php
        if (strcmp($args['current_course_ct_id'], '') === 0) {
            echo 'New Course';
        } else {
            echo 'Edit course content "' . $args['current_course_ct_id'] . '"';
        }
        ?>
    </h2>
</div>

<div class="cm-form-wrapper">
    <?php 
    $page_action = $args['page_action'];
    ?>

    <form action="<?php echo admin_url('admin-post.php') ?>" enctype="multipart/form-data"
        class="course_ct_form cm-form <?php echo $page_action; ?>" method="post">

        <input type="hidden" name="action" value="<?php echo $args['ajax_action'] ?>">

        <?php wp_nonce_field('wp_admin_add_new_course_content'); ?>

        <?php
            $course_ct_form = $args['course_ct_form'];

            // Form create new
            if (strcmp($page_action, CM_Main::$page_action_new) === 0) {
                CM_Form::render_form_control_input(CM_Course_Content_Detail_Table::$course_content_detail_id, $course_ct_form[CM_Course_Content_Detail_Table::$course_content_detail_id]);
            }

            // Form edit
            if (strcmp($page_action, CM_Main::$page_action_edit) === 0) {
                foreach ($course_ct_form as $form_control_id => $form_control) {
                    switch ($form_control['type']) {
                        case CM_Form::$type_text:
                            CM_Form::render_form_control_input($form_control_id, $form_control);
                            break;

                        case CM_Form::$type_select:
                            CM_Form::render_form_control_select($form_control_id, $form_control);
                            break;
    
                        case CM_Form::$type_file:
                            CM_Form::render_form_control_file($form_control_id, $form_control);
                            break;
    
                        case CM_Form::$type_text_area:
                            CM_Form::render_form_control_text_area($form_control_id, $form_control);
                            break;
                    }
                }
            }
        ?>

        <div class="form-group submit-action d-flex">
            <a class="btn btn-secondary" href="<?php echo add_query_arg(
                                CM_Controller::get_node('CM_Course_Controller', 'route_render_course_content_detail_dashboard'),
                                admin_url('admin.php')
                            ) ?>">Back</a>

            <input class="btn btn-primary ml-auto" type="submit" value="Submit">
        </div>

    </form>
</div>

<!-- Pick file modal -->
<div class="modal fade media-file-picker" id="media-file-picker" tabindex="-1" role="dialog" aria-labelledby="media-file-picker-label"
    data-get-media-tree-action="get_media_tree_data"
    data-ajax-url="<?php echo admin_url('admin-ajax.php') ?>"
    data-current-dir=""
    data-media-root-dir="<?php echo CM_Media::get_media_base_dir_path() ?>"
    data-input-to-apply="<?php echo CM_Course_Content_Detail_Table::$course_thumbnail_url ?>"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="media-file-picker-label">Choose media files</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-9">
                        <ul class="media-tree">

                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-apply">Choose</button>
            </div>
        </div>
    </div>
</div>