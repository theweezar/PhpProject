<?php

// SYSTEM
require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'system/class.custom-locale.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'system/class.resource.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'system/class.session.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'system/class.request.php');

// FORMS
require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'forms/class.cm-form.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'forms/class.cm-category-form.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'forms/class.cm-course-form.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'forms/class.cm-course-content-detail-form.php');

// DATABASE TABLES
require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'tables/class.cm-category-table.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'tables/class.cm-course-table.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'tables/class.cm-student-table.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'tables/class.cm-category-item-table.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'tables/class.cm-category-attribute-table.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'tables/class.cm-course-content-detail-table.php');

// MANAGER - MGR
require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'managers/class.cm-category-mgr.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'managers/class.cm-student-mgr.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'managers/class.cm-course-mgr.php');

// COMMON CLASSES
require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'class.cm-error-status.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'class.cm-status.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'class.cm-database.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'class.cm-media.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'class.cm-template.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'class.cm-main.php');

// HELPERS CLASSES
require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'helpers/class.cm-format-helper.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'helpers/class.cm-course-helper.php');

require_once(COURSE_MANAGEMENT_DIR . CLASS_DIR . 'helpers/class.cm-search-helper.php');

// CONTROLLERS
require_once(COURSE_MANAGEMENT_DIR . CONTROLER_DIR . 'class.cm-controller.php');

require_once(COURSE_MANAGEMENT_DIR . CONTROLER_DIR . 'class.cm-search-controller.php');

require_once(COURSE_MANAGEMENT_DIR . CONTROLER_DIR . 'class.cm-category-controller.php');

require_once(COURSE_MANAGEMENT_DIR . CONTROLER_DIR . 'class.cm-student-controller.php');

require_once(COURSE_MANAGEMENT_DIR . CONTROLER_DIR . 'class.cm-course-controller.php');

require_once(COURSE_MANAGEMENT_DIR . CONTROLER_DIR . 'class.cm-media-controller.php');

// Require main init script
require_once(COURSE_MANAGEMENT_DIR . 'inc/class.cm-initialization.php');