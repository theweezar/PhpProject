'use strict';

var formUtils = {
    /**
     * Set readonly property for all form controls in the current form
     * @param {JQuery} form - The form
     * @param {boolean} isReadonly - True/False
     */
    setFormControlReadonly: function (form, isReadonly) {
        var selector = isReadonly ? '.form-control' : '.form-control:not(.always-readonly)';
        form.find(selector).prop('readonly', isReadonly);
    }
};

module.exports = formUtils;
