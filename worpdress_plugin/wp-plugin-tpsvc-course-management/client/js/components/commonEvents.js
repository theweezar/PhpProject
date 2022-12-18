'use strict';

var formUtils = require('./formUtils');

var commonEvents = {
    /**
     * Init the event change locale on form
     */
    initEventChangeObjectLocale: function () {
        $('body').on('change.changeLocale', '.form-group.locale select', function (e) {
            var self = $(this);
            var currentURL = new URL(window.location.href);
            currentURL.searchParams.set('locale', self.val());
            window.location.href = currentURL.href;
        });
    },
    /**
     * Init the event delete the record based on the link configuration
     */
    initDeleteButtonEvent: function () {
        $('body').on('click.delete', '.btn-delete', function (e) {
            e.preventDefault();

            var self = $(this);
            var ajaxPostUrl = self.data('ajax-post-admin-url');
            var deleteNonce = self.data('delete-wpnonce');
            var deleteAction = self.data('delete-action');
            var deleteTargetID = self.data('delete-target-id');
            var deleteEntity = self.data('delete-target-entity');
            var isConfirmed = confirm(`Are you sure you want to delete "${deleteEntity}" with ID "${deleteTargetID}"`);
            var additionalData;

            if (!isConfirmed) return;

            // This event will update the additional data before making a request to the server
            $('body').trigger(`beforeDeleteAjax:${deleteAction.toUpperCase()}`, {
                addAdditionalData: function (inAdditionalData) {
                    additionalData = inAdditionalData;
                }
            });

            $.ajax({
                url: ajaxPostUrl,
                method: 'post',
                data: {
                    action: deleteAction,
                    deleteTargetID: deleteTargetID,
                    _wpnonce: deleteNonce,
                    additionalData: additionalData
                }
            }).done(function (response) {
                // This event will be triggered after ajax complete and success
                $('body').trigger(`afterDeleteAjax:${deleteAction.toUpperCase()}`, response);
            }).fail(function (error) {
                console.log(error);
            })
        });
    },
    /**
     * Init normal form submit event
     */
    initFormSubmitEvent: function () {
        $('body').on('submit.commomFormSubmit', '.cm-form', function (e) {
            e.preventDefault();

            var form = $(this);
            var formData = new FormData(form[0]);
            var ajaxAction = form.find('input[name=action]').val();
            var submitBtn = form.find('[type=submit]');
            var ajaxConfig = {};

            console.log('submit');

            // This event will update the form data before making a request to the server
            // The param will contains the callback to upate the form data
            $('body').trigger(`beforeAjax:${ajaxAction.toUpperCase()}`, {
                updateFormData: function (newFormData) {
                    formData = newFormData;
                },
                addAjaxConfig: function (newConfig) {
                    ajaxConfig = newConfig;
                },
                currentForm: form
            });

            formUtils.setFormControlReadonly(form, true);
            submitBtn.buttonLoading().start();

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                ...ajaxConfig
            }).done(function (response) {
                $('body').trigger(`afterAjax:${ajaxAction.toUpperCase()}`, response);
            }).fail(function (error) {
                console.log(error);
            }).always(function () {
                formUtils.setFormControlReadonly(form, false);
                submitBtn.buttonLoading().stop();
            });
        });
    },
    /**
     * Init event for the Media picker
     */
    initMediaPickerEvent: function () {
        // Init event load the media tree list on front page
        $('body').on('mediaFilePicker:loadDirectory', function (e, data) {
            var fileList = data.response.file_list;
            var mediaModal = data.mediaModal;
            var mediaTreeList = mediaModal.find('.media-tree');
            var mediaRootDir = mediaModal.data('media-root-dir');

            mediaTreeList.empty();
            fileList.forEach(function (fileObj) {
                var dir_path = fileObj.file_path.replace(new RegExp(`.*${mediaRootDir}`, 'g'), '');
                var htmlItem = `
                    <li class="media-tree-item ${fileObj.is_dir ? 'is-dir' : 'is-file'}"
                        data-file-path="${fileObj.file_path}" data-dir-path="${dir_path}">
                        ${fileObj.file_name}
                    </li>
                `;
                mediaTreeList.append(htmlItem);
            });
        });

        $('body').on('click.loadDirectory', '.media-tree-item.is-dir', function (e) {
            e.preventDefault();
        });

        // Init event load directory after showing the modal
        $('#media-file-picker').on('show.bs.modal', function (e) {
            // do something...
            var self = $(this);
            
            $.ajax({
                url: self.data('ajax-url'),
                method: 'GET',
                data: {
                    action: self.data('get-media-tree-action'),
                    currentDir: self.data('current-dir')
                }
            }).done(function (response) {
                if (!response.success) {
                    return;
                }

                $('body').trigger('mediaFilePicker:loadDirectory', {
                    response: response,
                    mediaModal: self
                });
            }).fail(function (error) {
                console.log(error);
            });
        })

        // Click to select the media tree item
        $('body').on('click.selectMediaTreeItem', 'li.media-tree-item.is-file', function (e) {
            $('ul.media-tree li.media-tree-item').removeClass('selected');
            $(this).addClass('selected');
        });

        $('body').on('click.selectMediaTreeDir', 'li.media-tree-item.is-dir', function (e) {
            var self = $(this);
            var mediaModal = self.parents('.media-file-picker');
            $.ajax({
                url: mediaModal.data('ajax-url'),
                method: 'GET',
                data: {
                    action: mediaModal.data('get-media-tree-action'),
                    currentDir: self.data('dir-path')
                }
            }).done(function (response) {
                if (!response.success) {
                    return;
                }

                $('body').trigger('mediaFilePicker:loadDirectory', {
                    response: response,
                    mediaModal: self
                });
            }).fail(function (error) {
                console.log(error);
            });
        });

        // Click to apply the selected file item
        $('body').on('click.mediaPickerApply', '.media-file-picker .btn-apply', function (e) {
            e.preventDefault();

            var mediaPickerModal = $('#media-file-picker');
            var inputToApply = $(`input[name=${mediaPickerModal.data('input-to-apply')}]`);
            var selectMediaItem = $('.media-tree-item.selected');
            var mediaPreview = $('.media-preview');

            if (selectMediaItem.length === 0) return;

            inputToApply.val(selectMediaItem.data('file-path'));
            mediaPreview.find('img').attr('src', selectMediaItem.data('file-path'));
            mediaPickerModal.modal('hide');
        });

        // Click to restore the previous value
        $('body').on('click.mediaRestore', '.btn-restore', function (e) {
            e.preventDefault();

            var self = $(this);
            var inputToApply = self.parents('.form-group').find('input');
            var mediaPreview = $('.media-preview');
            inputToApply.val(inputToApply.data('restore-value'));
            mediaPreview.find('img').attr('src', inputToApply.data('restore-value'));
        });
    }
};

module.exports = commonEvents;
