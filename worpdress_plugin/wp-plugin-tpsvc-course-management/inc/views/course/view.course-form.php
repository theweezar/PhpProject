<div class="cm-page-title">
    <h2>
        <?php
        if (strcmp($args['current_course_id'], '') === 0) {
            echo 'New Course';
        } else {
            echo 'Edit course "' . $args['current_course_id'] . '"';
        }
        ?>
    </h2>
</div>

<div class="cm-form-wrapper">
    <form action="<?php echo admin_url('admin-post.php') ?>" class="course_form cm-form" method="post">

        <input type="hidden" name="action" value="<?php echo $args['ajax_action'] ?>">

        <?php wp_nonce_field($args['nonce_name']); ?>

        <?php
            $course_form = $args['course_form'];
            
            foreach ($course_form as $form_control_id => $form_control) {
                switch ($form_control['type']) {
                    case CM_Form::$type_select:
                        CM_Form::render_form_control_select($form_control_id, $form_control);
                        break;

                    case CM_Form::$type_text_area:
                        CM_Form::render_form_control_text_area($form_control_id, $form_control);
                        break;

                    default:
                        CM_Form::render_form_control_input($form_control_id, $form_control);
                        break;
                }
            }
        ?>

        <div class="form-group submit-action d-flex">
            <a class="btn btn-secondary" href="<?php echo add_query_arg(
                                CM_Controller::get_node('CM_Course_Controller', 'route_render_course_dashboard'),
                                admin_url('admin.php')
                            ) ?>">Back</a>

            <input class="btn btn-primary ml-auto" type="submit" value="Submit">
        </div>

    </form>
</div>