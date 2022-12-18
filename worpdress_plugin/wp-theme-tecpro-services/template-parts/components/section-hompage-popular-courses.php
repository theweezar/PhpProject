<div class="popular-section">
    <section>
        <div class="popular-title text-center">
            <p><?php echo Resource::text('homepage.new.course.label', 'homepage'); ?></p>
        </div>
        <div class="popular-course-wrapper">
            <div class="popular-course-slick">
                <?php
                foreach ($courses as $idx => $course) {
                ?>
                    <div class="popular-slick-item">
                        <?php
                        get_template_part('template-parts/course/course-tile', null, array(
                            'index' => $i + 1,
                            'course' => $course
                        ));
                        ?>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
</div>