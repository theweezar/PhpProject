<div class="header">
    <div class="dropdown mt-4 header-navigation">
        <button class="btn btn-secondary text-dark bg-transparent rounded-0 dropdown-toggle" type="button"
            id="headerAdminMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Administration
        </button>
        <div class="dropdown-menu w-100 rounded-0 shadow" aria-labelledby="headerAdminMenuButton">
            <ul class="nav flex-column px-3">
                <li class="nav-item">
                    <a href="<?php echo add_query_arg(
                                CM_Controller::get_node('CM_Course_Controller', 'route_render_course_dashboard'),
                                admin_url('admin.php')
                            ) ?>">Course</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo add_query_arg(
                                CM_Controller::get_node('CM_Course_Controller', 'route_render_course_content_detail_dashboard'),
                                admin_url('admin.php')
                            ) ?>">Course Content</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo add_query_arg(
                                CM_Controller::get_node('CM_Category_Controller', 'route_render_category_dashboard'),
                                admin_url('admin.php')
                            ) ?>">Category</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo add_query_arg(
                                CM_Controller::get_node('CM_Media_Controller', 'route_render_media_container'),
                                admin_url('admin.php')
                            ) ?>">Media</a>
                </li>
            </ul>
        </div>
    </div>
</div>