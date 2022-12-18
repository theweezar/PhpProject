'use strict';

module.exports = {
    /**
     * Init events for course dashboard page
     */
    initCourseDashboardEvent: function () {
        $('body').on('afterDeleteAjax:SUBMIT_DELETE_COURSE_CONTENT', function (e, response) {
            if (!response.success) {
                alert(response.message);
                return;
            }

            $(`tr[data-course-content-id="${response.deleted_id}"]`).remove();
        });
    },
    /**
     * Init the course form
     */
    initCourseForm: function () {
        $('body').on('afterAjax:SUBMIT_ADD_NEW_COURSE', function (e, response) {
            if (!response.success) {
                alert(response.message);
                return;
            }

            window.location.href = response.redirect_url;
        });

        $('body').on('afterAjax:SUBMIT_UPDATE_COURSE', function (e, response) {
            alert(response.message);
        });

        $('body').on('afterDeleteAjax:SUBMIT_DELETE_COURSE', function (e, response) {
            $(`tr[data-course-id="${response.deleted_course_id}"]`).remove();
        });
    },
    /**
     * Init the course content detail form
     */
    initCourseContentForm: function () {
        $('body').on('afterAjax:SUBMIT_ADD_NEW_COURSE_CONTENT', function (e, response) {
            if (!response.success) {
                alert(response.message);
                return;
            }

            window.location.href = response.redirect_url;
        });

        $('body').on('afterAjax:SUBMIT_UPDATE_COURSE_CONTENT', function (e, response) {
            alert(response.message);
        });
    }
};
