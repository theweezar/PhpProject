'use strict';

/**
 * Append the error message
 * @param {string} message - The error message
 * @param {JQuery<HTMLElement>} currentForm - The current jquery form
 */
function appendAlertMessage(message, currentForm) {
    currentForm.find('.alert-message').remove();

    var alertHtml = `
        <div class="alert alert-danger alert-message" role="alert">
            ${message}
        </div>
    `;
    
    $(alertHtml).insertBefore(currentForm.find('.action-btn-group'));
}

const register = {
    submitRegisterForm: function () {
        $('body').on('submit', 'form[name="register-form"]', function (e) {
            e.preventDefault();

            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                method: 'post',
                data: form.serialize(),
                cache : false
            }).done(function (response) {
                console.log(response);
            }).fail(function () {});
        });
    },
    submitLoginForm: function () {
        $('body').on('submit', 'form[name="login-form"]', function (e) {
            e.preventDefault();

            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                method: 'post',
                data: form.serialize(),
                cache : false
            }).done(function (response) {
                if (response && !response.success) {
                    appendAlertMessage(response.message, form);
                }

                if (response.redirect_url) {
                    window.location.href = response.redirect_url;
                }
            }).fail(function () {});
        });
    }
};

module.exports = register;