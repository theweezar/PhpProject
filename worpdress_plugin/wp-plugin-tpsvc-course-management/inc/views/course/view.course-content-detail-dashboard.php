<div class="cm-page-title d-flex">
    <h2>Course Content Dashboard</h2>

    <a class="btn btn-success ml-auto" href="<?php echo add_query_arg(array_merge(
                                        CM_Controller::get_node('CM_Course_Controller', 'route_render_course_content_detail_form_page')
                                    ), admin_url('admin.php')) ?>">New</a>
</div>

<div class="cm-container">
    <table class="cm-table course-content-dashboard">
        <thead>
            <tr>
                <th class="course-content-id">Course Content ID</th>
                <th class="course-content-name">Course Content Name</th>
                <th class="action">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $course_contents = $args['course_contents'];

            foreach ($course_contents as $idx => $course_contents) {
            ?>
                <tr data-course-content-id="<?php echo $course_contents[CM_Course_Content_Detail_Table::$course_content_detail_id]; ?>"
                    data-course-content-obj='<?php echo json_encode(array(
                                                                CM_Course_Content_Detail_Table::$course_content_detail_id => $course_contents[CM_Course_Content_Detail_Table::$course_content_detail_id]
                        )); ?>'>
                    <td class="course-content-id"><?php echo $course_contents[CM_Course_Content_Detail_Table::$course_content_detail_id]; ?></td>
                    <td class="course-content-name"></td>
                    <td class="action">
                        <a class="btn btn-edit" href="<?php echo add_query_arg(array_merge(
                                                            CM_Controller::get_node('CM_Course_Controller', 'route_render_course_content_detail_form_page'),
                                                            array(
                                                                'page_action' => CM_Main::$page_action_edit,
                                                                CM_Course_Content_Detail_Table::$course_content_detail_id => $course_contents[CM_Course_Content_Detail_Table::$course_content_detail_id],
                                                                CM_Course_Content_Detail_Table::$locale => Custom_Locale::$default_locale
                                                            )
                                                        ), admin_url('admin.php')) ?>"><span class="dashicons dashicons-admin-tools"></span></a>

                        <button type="button" class="btn btn-delete"
                            data-ajax-post-admin-url="<?php echo admin_url('admin-post.php') ?>"
                            data-delete-wpnonce="<?php echo $args['delete_nonce']; ?>"
                            data-delete-action="<?php echo $args['delete_ajax_action']; ?>"
                            data-delete-target-entity="<?php echo 'Course content detail'; ?>"
                            data-delete-target-id="<?php echo $course_contents[CM_Course_Content_Detail_Table::$course_content_detail_id]; ?>"
                        >
                            <span class="dashicons dashicons-trash"></span>
                        </button>
                    </td>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
</div>