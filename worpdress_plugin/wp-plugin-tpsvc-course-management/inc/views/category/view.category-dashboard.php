<?php
$parent_category_id = $args[CM_Category_Table::$parent_category_id];
$current_category_id = $args['current_category_id'];
$link_create_new_category = '';
$label_create_new_category = '';

if (strcmp($parent_category_id, '') === 0) {
    $label_create_new_category = 'New';
    $link_create_new_category = add_query_arg(array_merge(
        CM_Controller::get_node('CM_Category_Controller', 'route_render_category_form_page')
    ), admin_url('admin.php'));
} else {
    $label_create_new_category = 'New sub-category';
    $link_create_new_category = add_query_arg(array_merge(
        CM_Controller::get_node('CM_Category_Controller', 'route_render_category_form_page'),
        array(
            CM_Category_Table::$parent_category_id => $parent_category_id
        )
    ), admin_url('admin.php'));
}

$link_go_back = add_query_arg(array_merge(
    CM_Controller::get_node('CM_Category_Controller', 'route_render_category_dashboard'),
    array(
        CM_Category_Table::$parent_category_id => $args['pre_parent_category_id']
    )
), admin_url('admin.php'));

$link_courses_assign = add_query_arg(array_merge(
    CM_Controller::get_node('CM_Category_Controller', 'route_render_courses_assign_page'),
    array(
        CM_Category_Table::$category_id => $current_category_id
    )
), admin_url('admin.php'));
?>

<div class="cm-page-title d-flex">
    <h2>
        <?php
        echo strcmp($current_category_id, '') !== 0 ? $current_category_id : 'Category Dashboard';
        ?>
    </h2>

    <div class="ml-auto">
        <?php
        if (strcmp($parent_category_id, '') !== 0) {
        ?>
        <a class="btn btn-secondary border border-dark" href="<?php echo $link_go_back ?>">
            Back
        </a>
        <?php
        }
        ?>

        <a class="btn btn-secondary ml-2" href="<?php echo $link_create_new_category; ?>">
            <?php echo $label_create_new_category; ?>
        </a>

        <a class="btn btn-secondary ml-2" href="<?php echo $link_courses_assign; ?>">
            Assign courses
        </a>
    </div>
</div>

<div class="cm-container category-container">
    <ul class="nav nav-tabs" id="category-tab-btn-wrapper" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="category-tab" data-toggle="tab" data-target="#category" type="button"
                role="tab" aria-controls="home" aria-selected="true">Sub categories</button>
        </li>

        <?php
        if (strcmp($parent_category_id, '') !== 0) {
        ?>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="assigned-course-tab" data-toggle="tab" data-target="#assigned-course"
                type="button" role="tab" aria-controls="profile" aria-selected="false">Assigned courses</button>
        </li>
        <?php
        }
        ?>

    </ul>
    <div class="tab-content" id="category-tab-content">
        <!-- Sub categories tab -->
        <div class="tab-pane fade show active" id="category" role="tabpanel" aria-labelledby="category-tab">
            <table class="cm-table category-dashboard border">
                <thead>
                    <tr>
                        <th class="category-id">Category ID</th>
                        <th class="created-at">Created at</th>
                        <th class="action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $categories = $args['categories'];

                    foreach ($categories as $key => $category) {
                        $category_id = $category[CM_Category_Table::$category_id];
                    ?>
                    <tr id="<?php echo $category_id ?>" data-category-id="<?php echo $category_id ?>">
                        <td class="category-id">
                            <a href="<?php echo add_query_arg(array_merge(
                                                CM_Controller::get_node('CM_Category_Controller', 'route_render_category_dashboard'),
                                                array(
                                                    CM_Category_Table::$parent_category_id => $category_id
                                                )
                                            ), admin_url('admin.php')) ?>"><?php echo $category_id; ?></a>
                        </td>

                        <td class="created-at"><?php echo $category[CM_Category_Table::$created_at]; ?></td>

                        <td class="action">
                            <a class="btn btn-edit" href="<?php echo add_query_arg(array_merge(
                                                                    CM_Controller::get_node('CM_Category_Controller', 'route_render_category_form_page'),
                                                                    array(
                                                                        'page_action' => CM_Main::$page_action_edit,
                                                                        CM_Category_Table::$category_id => $category_id,
                                                                        CM_Category_Attribute_Table::$locale => Custom_Locale::$default_locale
                                                                    )
                                                                ), admin_url('admin.php')) ?>">
                                <span class="dashicons dashicons-admin-tools"></span>
                            </a>

                            <button type="button" class="btn btn-delete"
                                data-ajax-post-admin-url="<?php echo admin_url('admin-post.php') ?>"
                                data-delete-wpnonce="<?php echo $args['delete_wpnonce']; ?>"
                                data-delete-action="<?php echo $args['delete_ajax_action']; ?>"
                                data-delete-target-entity="<?php echo 'category'; ?>"
                                data-delete-target-id="<?php echo $category_id; ?>">
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

        <!-- Assigned courses tab -->
        <?php
        if (strcmp($parent_category_id, '') !== 0) {
        ?>
        <div class="tab-pane fade" id="assigned-course" role="tabpanel" aria-labelledby="assigned-course-tab">
            <table class="cm-table assign-course-dashboard border">
                <thead>
                    <tr>
                        <th class="category-id">Course ID</th>
                        <th class="created-at">Course name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $course_in_category = $args['course_in_category'];

                    foreach ($course_in_category as $key => $course) {
                        ?>
                    <tr>
                        <td class="py-2"><?php echo $course[CM_Course_Table::$course_id] ?></td>
                        <td><?php echo $course[CM_Course_Table::$course_name] ?? 'name' ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        }
        ?>

    </div>

</div>