'use strict';

var category = {
    /**
     * Init events for the category form
     */
    initCategoryForm: function () {
        $('body').on('afterAjax:SUBMIT_ADD_NEW_CATEGORY', function (e, response) {
            if (!response.success) {
                alert(response.message);
                return;
            }

            window.location.href = response.redirect_url;
        });

        $('body').on('afterAjax:SUBMIT_UPDATE_CATEGORY', function (e, response) {
            alert(response.message);
        });
    },
    /**
     * Remove row after the category is deleted
     */
    initDeleteCategoryEvent: function () {
        $('body').on('afterDeleteAjax:SUBMIT_DELETE_CATEGORY', function (e, response) {
            var deletedCategoryId = response.deleted_category_id;
            $(`.category-dashboard tr#${deletedCategoryId}`).remove();
        });
    },
    /**
     * Switch the tab between sub-category tab and assigned course tab on category dashboard page
     */
    onChangeCategoryTab: function () {
        $('#category-tab-btn-wrapper button[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            return;
            var self = $(e.target);
            var btnTabId = self.attr('id');
            $(`.cm-page-title .btn:not(.${btnTabId}-change)`).addClass('d-none');
            $(`.cm-page-title .btn.${btnTabId}-change`).removeClass('d-none');
        })
    },
    /**
     * Search course
     */
    onSubmitSearchCourse: function () {
        $('body').on('submit.searchCourse', 'form.course-search-box', function (e) {
            e.preventDefault();

            var form = $(this);
            var courseResult = $('.course-search-result');
            courseResult.spinner().start();

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: form.serialize()
            }).done(function (response) {
                console.log(response);

                if (response && !response.success) {
                    var result = response.result;
                    courseResult.empty();

                    result.forEach(function (rs) {
                        courseResult.append(`
                            <div class="option assign-option" data-course-id="${rs.course_id}">${rs.course_id}</div>
                        `);
                    });

                    return;
                }

            }).fail(function (error) {
                console.log(error);
                courseResult.empty();
            }).always(function () {
                courseResult.spinner().stop();
            });
        });
    },
    /**
     * Init all events that relate to the course option list
     */
    initEventsForOptionList: function () {
        $('body').on('click.selectOption', '.course-box .option', function () {
            var self = $(this);
            self.toggleClass('selected', !self.hasClass('selected'));
        });
    },
    /**
     * Init event to assign course to category
     */
    assignCourseToCategory: function () {
        $('body').on('click.assignCourse', '.assign-course-btn', function (e) {
            e.preventDefault();
            var self = $(this);
            var courseResults = $('.course-search-result');
            var selectedCourse = courseResults.find('.assign-option.selected');
            var selectedCourseIDList = [];

            if (selectedCourse.length === 0) {
                alert('There is no selected course to assign.');
                return;
            }

            $.each(selectedCourse, function () {
                var course = $(this);
                selectedCourseIDList.push(course.data('course-id'));
            });

            $.ajax({
                url: self.attr('href'),
                method: 'POST',
                data: {
                    action: self.data('ajax-action'),
                    categoryID: self.data('category-id'),
                    selectedCourseIDList: selectedCourseIDList
                }
            }).done(function (response) {
                if (response && !response.success) {
                    if (response.message) {
                        alert(response.message);
                    }

                    if (response.existent_course_list) {
                        var existent_course_id = response.existent_course_list.map(function (course) {
                            return course.course_id;
                        });
                        alert(`Existent course: ${existent_course_id.join(', ')}`);
                    }

                    return;
                }

                selectedCourse.remove();
                var assignedCourseList = $('.assigned-course-list');
                var courses = response.courses;
                assignedCourseList.empty();
                courses.forEach(function (course) {
                    assignedCourseList.append(`
                    <div class="option unassign-option" data-course-id="${course.course_id}">
                        ${course.course_id}
                    </div>
                    `);
                });

            }).fail(function (error) {
                console.log(error);
            })
        })
    },
    /**
     * Init event unassign course from categroy
     */
    unassignCourseFromCategory: function () {
        $('body').on('click.unassignCourse', '.unassign-course-btn', function (e) {
            e.preventDefault();
            var self = $(this);
            var assignedCourseList = $('.assigned-course-list');
            var selectedCourse = assignedCourseList.find('.unassign-option.selected');
            var selectedCourseIDList = [];

            if (selectedCourse.length === 0) {
                alert('There is no selected course to delete.');
                return;
            }

            $.each(selectedCourse, function () {
                var course = $(this);
                selectedCourseIDList.push(course.data('course-id'));
            });

            $.ajax({
                url: self.attr('href'),
                method: 'POST',
                data: {
                    action: self.data('ajax-action'),
                    categoryID: self.data('category-id'),
                    selectedCourseIDList: selectedCourseIDList
                }
            }).done(function (response) {
                if (response && !response.success) {
                    if (response.message) {
                        alert(response.message);
                    }

                    return;
                }

                assignedCourseList.empty();
                var coursesListAfterDeleting = response.course_list_after_deleting;
                coursesListAfterDeleting.forEach(function (course) {
                    assignedCourseList.append(`
                    <div class="option unassign-option" data-course-id="${course.course_id}">
                        ${course.course_id}
                    </div>
                    `);
                });
            }).fail(function (error) {
                console.log(error);
            })
        });
    }
};

module.exports = category;