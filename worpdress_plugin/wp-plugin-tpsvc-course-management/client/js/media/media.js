'use strict';

var media = {
    initBeforeAjaxUploadCustomMedia: function () {
        $('body').on('beforeAjax:SUBMIT_UPLOAD_CUSTOM_MEDIA', function (e, data) {
            data.addAjaxConfig({
                contentType: false,
                processData: false
            });
        });
    },
    initAfterAjaxUploadCustomMedia: function () {
        $('body').on('afterAjax:SUBMIT_UPLOAD_CUSTOM_MEDIA', function (e, response) {
            window.location.reload();
        });
    },
    initMediaPreviewEvent: function () {
        $('body').on('click.mediaPreview', '.media-preview-trigger', function () {
            var self = $(this);
            var filePath = self.parents('tr').data('file-path');
            var mediaPreviewModal = $('#media-preview-modal');

            if (/(.jpg|.png|.jpeg|.gif)$/g.test(filePath)) {
                var previewEl = $('<img>')
                            .attr('src', filePath)
                            .attr('alt', filePath)
                            .css({
                                width: '100%',
                                height: 'auto'
                            });
                mediaPreviewModal.find('.modal-body').empty().append(previewEl);
                mediaPreviewModal.modal('show');
            }
        });
    }
};

module.exports = media;
