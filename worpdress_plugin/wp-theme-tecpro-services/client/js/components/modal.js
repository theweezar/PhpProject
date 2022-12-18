'use strict';

const modal = {
    handleOpenModal: function () {
        $(".modal-opener").on('click.openTargetModal', function(e) {
            e.preventDefault();
            let thisElement = $(this);
            let targetModal = $(thisElement.data('target'));

            let modalSeacher = thisElement.closest('.event, .blog');
            let modalTitle;
            let modalContent;
                        
            if (modalSeacher){
                modalTitle = modalSeacher.find('.use-heading').html()
                modalContent = modalSeacher.find('.use-content').html();
            }

            console.log(modalSeacher, modalTitle, modalContent)

            if (targetModal.length) {
                targetModal.modal('show');
                $('.modal-title', targetModal).html(modalTitle);
                $('.modal-body', targetModal).html(modalContent);
            }
        });
    },
};

module.exports = modal;

