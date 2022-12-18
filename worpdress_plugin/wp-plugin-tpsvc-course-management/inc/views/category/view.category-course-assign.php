<?php
$current_category_id = $args['current_category_id'];
$category_items = $args['category_items'];
?>

<div class="cm-page-title d-flex">
    <h2>
        Assign course to category "<?php
        echo $current_category_id;
        ?>"
    </h2>
</div>

<div>
    <form action="<?php echo admin_url('admin-ajax.php') ?>" class="course-search-box" method="get">
        <div class="input-group mb-3">
            <?php
            wp_nonce_field($args['search_nonce_name']);
            ?>
            <input type="hidden" name="action" value="<?php echo $args['search_ajax_action'] ?>">
            <input type="hidden" name="current_category_id" value="<?php echo $current_category_id ?>">
            <input type="text" class="form-control rounded-0" name="keyword" placeholder="Search courses"
                aria-label="Search courses" aria-describedby="search-course-box">
            <div class="input-group-append">
                <button type="submit" class="input-group-text rounded-0" id="search-course-box">
                    <span class="dashicons dashicons-search"></span>
                </button>
            </div>
        </div>
    </form>
</div>

<div>
    <div class="row">
        <div class="col-lg-6">
            <div class="d-flex align-items-center mb-3">
                <span>Course list</span>
                <a href="<?php echo admin_url('admin-post.php') ?>"
                    data-ajax-action="<?php echo $args['assign_course_ajax_action'] ?>"
                    data-category-id="<?php echo $current_category_id ?>"
                    class="btn assign-course-btn btn-secondary d-flex align-items-center justify-content-center ml-auto">
                    <span>Assign course</span>
                    <span class="dashicons dashicons-arrow-right-alt2"></span>
                </a>
            </div>
            <div class="course-box course-search-result border border-secondary">

            </div>
        </div>

        <div class="col-lg-6">
            <div class="d-flex align-items-center mb-3">
                <span>Assigned course list</span>
                <a href="<?php echo admin_url('admin-post.php') ?>"
                    data-ajax-action="<?php echo $args['remove_course_ajax_action'] ?>"
                    data-category-id="<?php echo $current_category_id ?>"
                    class="btn unassign-course-btn btn-light border border-secondary d-flex align-items-center justify-content-center ml-auto">
                    <span>Remove course</span>
                    <span class="dashicons dashicons-arrow-left-alt2"></span>
                </a>
            </div>
            <div class="course-box assigned-course-list border border-secondary">
                <?php
                foreach ($category_items as $key => $item) {
                    $course_id = $item[CM_Category_Item_Table::$course_id];
                    ?>
                <div class="option unassign-option" data-course-id="<?php echo $course_id; ?>">
                    <?php echo $course_id; ?>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>