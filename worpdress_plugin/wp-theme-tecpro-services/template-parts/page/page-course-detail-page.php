<?php
$cid = CM_Request::get_param('cid');

$query_course = CM_Course_Mgr::get_course_with_content($cid, Custom_Locale::get_current_locale());

if (count($query_course) === 0) {
    return Fn_Utils::redirect_to_404();
}

$course = $query_course[0];
?>

<div class="container-fluid cdp-box background-image"
    style="background-image: url(<?php echo CM_Media::get('common/common-bg-top.png') ?>)">
    <div class="container optimize-screen-size" id="course-detail-page">
        <div class="main-section">
            <div class="row cdp-section preview course-preview-container mx-0">
                <div class="col-12 col-lg-3 course-preview-box course-image-box ">
                    <div class="course-img">
                        <img src="<?php echo $course[CM_Course_Content_Detail_Table::$course_thumbnail_url]; ?>" alt="">
                    </div>
                </div>
                <div class="col-12 col-lg-5 course-preview-box course-info-box ">
                    <div class="title-box mt-2">
                        <h3 class="title roboto-serif">
                            <?php echo $course[CM_Course_Table::$course_name]; ?>
                        </h3>
                        <div class="badge-box">
                            <div class="badge badge-primary">English</div>
                        </div>
                        <!-- <a href="#" class="author">Giáo viên <span>Lương Cẩm Tú</span></a> -->
                        <div class="description">
                            <p class="paragraph text-ellipsis-line-4th">
                                <?php echo $course[CM_Course_Content_Detail_Table::$short_description]; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 rating-box w-100 row mx-0 px-0">
                        <div class="rating-star-box col-6">
                            <div class="rating-stars d-none">
                                5.0
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-6 pr-0">
                            <div class="comment-snippet ml-auto">
                                <div class="maximum-student-wrapper">
                                    <div class="d-flex justify-content-end align-items-center flex-wrap">
                                        <div class="student-amount font-weight-bold">
                                            <?php echo $course[CM_Course_Table::$number_of_student]; ?>
                                        </div>
                                        <div class="student-icon icon-box ml-2">
                                            <i class="fa fa-user-o font-weight-bold" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="d-flex justify-content-end align-items-center flex-wrap">
                                    <div class="comment-amount font-weight-bold">
                                        10
                                    </div>
                                    <div class="comment-icon icon-box ml-2">
                                        <i class="fa fa-comment-o" aria-hidden="true"></i>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-0">
                        <hr class="line">
                    </div>
                </div>
                <div
                    class="col-12 col-lg-4 course-preview-box course-pricing-box d-flex flex-column align-items-center align-items-lg-end">
                    <div class="pricing-item">
                        <div class="due-date">
                            <h4>
                                <?php echo Resource::text('cdp.start.on', 'cdp'); ?>
                                <span>
                                    <?php echo $course[CM_Course_Table::$start_date]; ?>
                                </span>
                            </h4>
                        </div>
                        <div class="pricing row">
                            <div class="col-3">
                                <div class="title roboto-serif">
                                    <?php echo Resource::text('cdp.pricing', 'cdp'); ?>
                                </div>
                            </div>
                            <div class="col-9">
                                <h3 class="new-price mb-0">
                                    <span>
                                        <?php echo CM_Format_Helper::format_money($course[CM_Course_Table::$price]); ?>
                                    </span>
                                </h3>
                                <!-- <h5 class="old-price">
                                    <span>3.600.000đ</span>
                                </h5> -->
                                <!-- <div class="time-left">
                                    <span>4</span> days left at this price!
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="buy-action-btn-box">
                        <button class="btn gradient-button">
                            <?php echo Resource::text('cdp.register.course', 'cdp'); ?>
                            <!-- <div class="sale-off-badge badge badge-danger">Giảm -20%</div> -->
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-section row">
            <div class="col-12 col-lg-8 card-white-box-shadow cdp-section primary-info course-primary-container">
                <div class="row mx-0">
                    <div class="cdp-sub-section about course-about-box col-12">
                        <h2 class="title">
                            <?php echo Resource::text('cdp.about.course', 'cdp'); ?>
                        </h2>
                        <div class="content">
                            <div class="about-description paragraph-box">
                                <p class="paragraph text-ellipsis-line-4th">
                                    <?php echo html_entity_decode($course[CM_Course_Content_Detail_Table::$about_this_course], ENT_QUOTES); ?>
                                </p>
                            </div>
                            <div class="see-more see-more-btn-box">
                                <a href="" class="see-more-btn">
                                    <span class="icon"><i class="fa fa-caret-square-o-down"
                                            aria-hidden="true"></i></span>
                                    <span class="text" data-close-label='Tóm tắt' data-open-label="Xem thêm"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="cdp-sub-section what-you-learn course-goal-box col-12 ">
                        <h2 class="title">
                            <?php echo Resource::text('cdp.what.you.learn', 'cdp'); ?>
                        </h2>
                        <?php echo html_entity_decode($course[CM_Course_Content_Detail_Table::$what_you_will_learn], ENT_QUOTES); ?>
                    </div>
                    <!-- <div class="cdp-sub-section instructors course-instructors-box col-12">
                    <h2 class="title">
                        <?php # echo Resource::text('cdp.instructors', 'cdp'); 
                        ?>    
                    </h2>
                    <div class="content">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 instructor ">
                                <div class="instructor-image">
                                    <img src="
                                    <?php // echo CM_Media::get('common/common-empty-ava.png') 
                                    ?>
                                    " alt="instructor-image">
                                </div>
                                <div class="instructor-name">
                                    <h3 class="title roboto-serif">Lương Cẩm Tú</h3>
                                </div>
                                <div class="instructor-description">
                                    <p>Full time Tester<br>
                                        Tecpro Services Teacher<br>
                                        1 year Tester</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                    <!-- company-benefit.html : Comming soon -->
                    <!-- footer-buy-btn.html : Comming soon -->
                </div>
            </div>
            <div class="col-12 col-lg-4 d-flex cdp-section course-extra-container">
                <div class="course-extra-box card-white-box-shadow">
                    <div class="title">
                        <?php echo Resource::text('cdp.course.summary', 'cdp'); ?>
                    </div>
                    <hr>
                    <ul class="content list-group">
                        <li class="learners list-group-item">
                            <span class="icon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
                            <span>
                                <?php echo $course[CM_Course_Table::$number_of_student]; ?>
                                <?php echo Resource::text('cdp.learners', 'cdp'); ?>
                            </span>
                        </li>
                        <li class="number-of-weeks list-group-item">
                            <span class="icon"><i class="fa fa-calendar-o" aria-hidden="true"></i></span>
                            <span>3 tuần (gồm 1 tuần ngoại khóa)</span>
                        </li>
                        <li class="day-per-week list-group-item">
                            <span class="icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                            <span>3 - 4 giờ / tuần </span>
                        </li>
                    </ul>
                    <div class="learning-methods">
                        <h5 class="title">
                            <?php echo Resource::text('cdp.course.methods', 'cdp'); ?>
                        </h5>
                        <hr>
                        <ul class="methods list-group">
                            <li class="list-group-item">
                                <span class="online">
                                    <b>
                                        <?php echo Resource::text('cdp.online', 'cdp'); ?>
                                    </b>
                                </span>
                                <span class="way">
                                    <?php echo Resource::text('cdp.online.way', 'cdp'); ?>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <span class="offline">
                                    <b>
                                        <?php echo Resource::text('cdp.offline', 'cdp'); ?>
                                    </b>
                                </span>
                                <span class="way">
                                    <?php echo Resource::text('cdp.offline.way', 'cdp'); ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?php echo html_entity_decode($course[CM_Course_Content_Detail_Table::$additional_content], ENT_QUOTES); ?>
    </div>
</div>