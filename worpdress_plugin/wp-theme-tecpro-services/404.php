<?php
get_header();

$current_locale = Custom_Locale::get_current_locale();
$courses = CM_Course_Mgr::get_all_courses_with_content($current_locale);
?>

<div class="container-fluid background-image" style="background-image: url(<?php echo CM_Media::get('common/common-bg-top.png'); ?>)">
    <div class="container optimize-screen-size page-404" id="page-404">
        <div class="row box-container">
            <div class="col-12 top-box">
                <h1>Trang không tìm thấy</h1>
            </div>
            <div class="col-12 col-lg-4 left-box">
                <p>Xin lỗi bạn vì sự bất tiện này</p>
                <a href="/"> Quay về trang chủ <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
            </div>
            <div class="col-12 col-lg-8 right-box">
                <h1 style="background-image: url(<?php echo CM_Media::get('common/common-bg-text.jpg'); ?>);">404</h1>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>
