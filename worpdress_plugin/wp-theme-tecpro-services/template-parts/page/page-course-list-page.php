<?php
$courses = array();
// var_dump(CM_Database::get_simple_log());
// Get all master categories to display the menu
$master_categories = CM_Category_Mgr::get_all_master_categories();
$selected_category_id = CM_Request::get_param('category_id');

// If use press the course link, the first master category will be selected
if (strcmp($selected_category_id, '') === 0 && count($master_categories) > 0) {
    $selected_category_id = $master_categories[0][CM_Category_Table::$category_id];
}

$selected_category = CM_Category_Mgr::get_category($selected_category_id);

// If category not found, redirect to 404 page
if (count($selected_category) === 0) {
    Fn_Utils::redirect_to_404('Category not found.');
    return;
}

$parent_selected_category = $selected_category[0][CM_Category_Table::$parent_category_id];

if (strcmp($parent_selected_category, '') !== 0) {
    // If users select sub-category


} else {
    // If users select master category
    $course_items = CM_Category_Mgr::get_all_courses_in_master_category($selected_category_id);
    $course_id_list = array_column($course_items, CM_Category_Item_Table::$course_id);
    $courses = CM_Course_Mgr::get_courses_with_content_by_id_list($course_id_list, Custom_Locale::get_current_locale());
}

?>

<div class="container-fluid px-0 clp-box background-image"
    style="background-image: url(<?php echo CM_Media::get('common/common-bg-top.png') ?>)">
    <div class="container-fluid px-0" id="course-listing-page">
        <div class="main-section course-list-banner align-items-center">
            <div class="row optimize-screen-size">
                <div class="col-12 col-lg-3 course-list-banner-title">
                    <h4 class="title">Choose your skill</h4>
                </div>
                <div class="col-12 col-lg-9 course-list-banner-type">
                    <ul class="nav">

                        <?php
                        foreach ($master_categories as $idx => $category) {
                            $category_id = $category[CM_Category_Table::$category_id];
                            $category_name = $category[CM_Category_Attribute_Table::$category_name];
                            ?>
                        <li class="nav-item">
                            <a class="nav-link btn <?php echo strcmp($category_id, $selected_category_id) === 0 ? 'active' : '' ?>"
                                href="<?php echo add_query_arg(
                                array(
                                    'category_id' => $category_id
                                ),
                                Fn_Utils::parse_page_url('course-list-page')
                            ) ?>">
                                <?php echo strcmp($category_name, '') !== 0 ? $category_name : $category_id ?>
                            </a>
                        </li>
                        <?php
                        }
                        ?>

                    </ul>
                </div>
                <!-- <div class="col-12 course-list-banner-content">
                    <?php
                    // Display the registered sidebar homepage-banner-sidebar
                    // dynamic_sidebar("clp-tester-banner-sidebar");
                    ?>
                </div> -->
            </div>
        </div>
        <!-- <div class="clp-sub-section row background-sub-image"
            style="background-image: url(<?php echo CM_Media::get('common/common-plp-sub-background.png') ?>)">
            <div class="row optimize-screen-size">
                <div class="col-12 col-lg-3 course-list-title">
                    <h4 class="title roboto-serif">Our recent course</h4>
                </div>
                <div class="col-12 col-lg-9 course-list-items">
                    <div class="slider">
                        
                    </div>
                </div>
            </div>
        </div> -->
        <div class="main-section course-list-section">
            <div class="row">
                <!-- <div class="col-12 col-lg-3 left-area filter-and-sort-area border">
                    <h5>Filter & Sort</h5>
                </div> -->
                <div class="col-12 container right-area">
                    <div class="courses-list-area row">
                        <?php
                        // Render courses
                        foreach ($courses as $idx => $course) {
                            ?>
                        <div class="col-6 col-lg-4 d-lg-flex justify-content-lg-center mb-2 mb-lg-5">
                            <?php
                                get_template_part('template-parts/course/course-tile', null, array(
                                    'index' => $idx + 1,
                                    'course' => $course
                                ));
                                ?>
                        </div>
                        <?php
                        }
                        ?>
                        <!-- <div class="col-12 google-facebook-ad horizontal">
                            <h2>google/ facebook ad</h2>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>