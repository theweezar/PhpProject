<div class="cm-page-title">
    <h2>
        <?php
        $category_form = $args['category_form'];
        $category_id_form_control = $category_form[CM_Category_Table::$category_id];

        if (strcmp($args['page_action'], CM_Main::$page_action_edit) === 0) {
            echo $category_id_form_control['value'];
        } else {
            echo 'New Category';
        }
        ?>
    </h2>
</div>

<div class="cm-form-wrapper">
    <form action="<?php echo admin_url('admin-post.php') ?>" class="category-form cm-form" method="post">

        <input type="hidden" name="action" value="<?php echo $args['ajax_action'] ?>">
        <input type="hidden" name="<?php echo CM_Category_Table::$parent_category_id; ?>"
            value="<?php echo $args[CM_Category_Table::$parent_category_id]; ?>">

        <?php wp_nonce_field($args['wpnonce_name']); ?>

        <?php

        if (strcmp($args['page_action'], CM_Main::$page_action_new) === 0) {
            CM_Form::render_form_control_input(
                CM_Category_Table::$category_id,
                $category_form[CM_Category_Table::$category_id]
            );
        } else {
            foreach ($category_form as $form_control_id => $form_control) {
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
        }
        ?>

        <div class="form-group submit-action d-flex">
            <a class="btn btn-secondary" href="<?php echo add_query_arg(
                                CM_Controller::get_node('CM_Category_Controller', 'route_render_category_dashboard'),
                                admin_url('admin.php')
                            ) ?>">Back</a>

            <button class="btn btn-primary ml-auto" type="submit">Submit</button>
        </div>

    </form>
</div>