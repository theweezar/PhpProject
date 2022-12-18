<?php

// Check if the plugin wp-plugin-tpsvc-course-management exists
if (!class_exists('CM_Initialization')) {
    return;
}

get_header();

$current_locale = Custom_Locale::get_current_locale();
$courses = CM_Course_Mgr::get_all_courses_with_content($current_locale);
$big_course_tile = count($courses) > 0 ? $courses[0] : null;

?>

<main id="site-content" class="main-group overflow-hidden" data-current-locale="<?php echo $current_locale; ?>">
    <!-- Homepage banner -->
    <div class="homepage-banner-wrapper mb-5">
        <?php
        // Display the registered sidebar homepage-banner-sidebar
            echo Fn_Utils::get_page_content('homepage-banner-sidebar');
        ?>
    </div>

    <!-- Homepage content -->
    <!-- Go to Setting -> Reading -> Edit homepage displays -->

    <div class="container">

        <div class="container optimize-screen-size" id="homepage-event">
            <?php
            echo Fn_Utils::get_page_content('homepage-event-content');
            ?>
        </div>

        <!-- course recommended -->
        <div class="container optimize-screen-size" id="homepage-course-recommended">
            <div class="recommended-course-container">
                <div class="row title-group">
                    <div class="col-8 text-left">
                        <?php echo Resource::text('homepage.recommended.courses', 'homepage'); ?>
                    </div>
                    <div class="col-4 text-right">
                        <a class="see-more-btn" type="button" href="#">
                            <!-- <?php echo Resource::text('common.see.more', 'common'); ?>
                            <i class="fa fa-chevron-right" aria-hidden="true"></i> -->
                        </a>
                    </div>
                </div>
                <div class="content-group">
                    <div class="courses">
                        <?php
                        if (isset($big_course_tile)) {
                            ?>
                        <div class="course spot-light d-none d-lg-flex">
                            <?php ?>
                            <div class="img-block">
                                <a href="#">
                                    <div class="empty-image">
                                        <img src="<?php echo $big_course_tile[CM_Course_Content_Detail_Table::$course_thumbnail_url]; ?>"
                                            alt="<?php echo $big_course_tile[CM_Course_Content_Detail_Table::$course_content_detail_id]; ?>">
                                    </div>
                                </a>
                            </div>
                            <div class="content-block">
                                <div class="about-course row align-items-center">
                                    <div class="information col-9">
                                        <h4 class="roboto-serif">
                                            <?php echo $big_course_tile[CM_Course_Table::$course_name]; ?>
                                        </h4>
                                        <a href="#" class="m-0 p-0">
                                            Ms. Tú
                                        </a>
                                        <p class="text-ellipsis-line-4th">
                                            <?php echo $big_course_tile[CM_Course_Content_Detail_Table::$short_description]; ?>
                                        </p>
                                    </div>
                                    <div class="instructor col-3">
                                        <!-- <img src="../../assets/images/itachi_mordern_look.jpg" alt="course-instructor"> -->

                                    </div>
                                </div>
                                <div class="action-course row align-items-center">
                                    <div class="company-group col-8">

                                    </div>
                                    <div class="action-group col-4">
                                        <h4 class="price">
                                            <?php echo CM_Format_Helper::format_money($big_course_tile[CM_Course_Table::$price]); ?>
                                        </h4>
                                        <button class="btn buy-now-btn">
                                            <?php echo Resource::text('common.register.course.now', 'common'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>

                        <?php
                        // Load the rest recommended course
                        if (count($courses) > 1) {
                            ?>
                        <div class="slider popular-course-slick <?php echo count($courses) - 1 < 4 ? 'd-flex' : '' ?>">
                            <?php
                            for ($idx = 1; $idx < count($courses); $idx++) { 
                                $course = $courses[$idx];
                                ?>
                            <div class="slider-item">
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
                        </div>
                        <?php
                        }
                        
                        ?>
                    </div>
                </div>

            </div>

        </div>

        <div class="container optimize-screen-size" id="homepage-blog">
            <?php
            echo Fn_Utils::get_page_content('homepage-blog-content');
            ?>
        </div>

        <div class="why-learning-content optimize-screen-size">
            <?php
            echo Fn_Utils::get_page_content('homepage-why-learning-content');
            ?>
        </div>

    </div>

</main>

<!-- Modal -->
<div class="modal enable-modal-handler fade" id="contentModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>