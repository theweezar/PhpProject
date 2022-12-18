<div class="cm-page-title d-flex">
    <h2>Course Dashboard</h2>

    <a class="btn btn-success ml-auto" href="<?php echo add_query_arg(array_merge(
                                        CM_Controller::get_node('CM_Course_Controller', 'route_render_course_form_page')
                                    ), admin_url('admin.php')) ?>">New</a>
</div>

<div class="cm-container">
    <table class="cm-table course-dashboard">
        <thead>
            <tr>
                <th class="course-id">Course ID</th>
                <th class="course-name">Course name</th>
                <th class="register-date-range">Register date range</th>
                <th class="learning-period">Learning period</th>
                <th class="content-id">Content ID</th>
                <th class="created-at">Created at</th>
                <th class="action">Action</th>
            </tr>
        </thead>
        <tbody>

        <?php
            $courses = $args['courses'];

            foreach ($courses as $idx => $course) {
                ?>
            <tr data-course-id="<?php echo $course[CM_Course_Table::$course_id];?>">
                <td class="course-id"><?php echo $course[CM_Course_Table::$course_id];?></td>

                <td class="course-name"><?php echo $course[CM_Course_Table::$course_name];?></td>

                <td class="register-date-range">
                <?php echo $course[CM_Course_Table::$start_register_date];?>
                ~
                <?php echo $course[CM_Course_Table::$end_register_date];?>
                </td>

                <td class="learning-period">
                <?php echo $course[CM_Course_Table::$start_date];?>
                ~
                <?php echo $course[CM_Course_Table::$end_date];?>
                </td>

                <td class="content-id"><?php echo $course[CM_Course_Table::$course_content_detail_id];?></td>

                <td class="created-at"><?php echo $course[CM_Course_Table::$created_at];?></td>
            
                <td class="action">
                    <a class="btn btn-edit" href="<?php echo add_query_arg(array_merge(
                                        CM_Controller::get_node('CM_Course_Controller', 'route_render_course_form_page'),
                                        array(
                                            'page_action' => CM_Main::$page_action_edit,
                                            CM_Course_Table::$course_id => $course[CM_Course_Table::$course_id]
                                        )
                                    ), admin_url('admin.php')) ?>"><span class="dashicons dashicons-admin-tools"></span></a>

                    <button type="button" class="btn btn-delete"
                        data-ajax-post-admin-url="<?php echo admin_url('admin-post.php') ?>"
                        data-delete-wpnonce="<?php echo $args['delete_nonce']; ?>"
                        data-delete-action="<?php echo $args['delete_ajax_action']; ?>"
                        data-delete-target-entity="<?php echo 'course'; ?>"
                        data-delete-target-id="<?php echo $course[CM_Course_Table::$course_id]; ?>"
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
