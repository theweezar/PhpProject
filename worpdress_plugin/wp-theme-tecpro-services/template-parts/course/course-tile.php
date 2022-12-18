<?php
$course = $args['course'];
?>

<div class="course">
    <div class="course-tile">
        <div class="course-image-wrapper">
            <div class="course-merchant-msg d-none">
                <span class="msg-value"></span>
            </div>
            <div class="course-price">
                <span class="value">
                    <?php echo CM_Format_Helper::format_money($course[CM_Course_Table::$price]); ?>
                </span>
            </div>
            <div class="course-image">
                <div class="img-box">
                    <img src="<?php echo $course[CM_Course_Content_Detail_Table::$course_thumbnail_url] ?? ''; ?>"
                        alt="">
                </div>
            </div>
        </div>

        <div class="course-detail">
            <div class="course-name">
                <a
                    href="<?php echo add_query_arg(array('cid' => $course[CM_Course_Table::$course_id]), '/course-detail-page'); ?>">
                    <?php echo $course[CM_Course_Table::$course_name]; ?>
                </a>
            </div>

            <!-- <div class="instructor">
                <a href="#">Ms. Tú</a>
            </div> -->

            <div class="course-short-desc cut-text text-ellipsis-line-4th">
                <?php echo $course[CM_Course_Content_Detail_Table::$short_description]; ?>
            </div>

            <div class="course-review-wrapper">
                <div class="d-flex align-items-end">
                    <div class="course-review-snippet">
                        <div class="course-company-seal">
                        </div>
                        <div class="course-rating-stars d-none">
                            <div class="review-point d-inline-block">5.0</div>
                            <div class="review-stars d-inline-block">
                                <ul class="nav star-wrapper">
                                    <li class="nav-item star-item"><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li class="nav-item star-item"><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li class="nav-item star-item"><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li class="nav-item star-item"><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li class="nav-item star-item"><i class="fa fa-star" aria-hidden="true"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>

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

                        <!-- <div class="d-flex align-items-center">
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
        </div>
    </div>
</div>