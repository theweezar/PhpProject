'use strict';

/**
 * Create function for spinner action
 * @returns {Object} - The spinner action of the element
 */
function spinnerAction () {
    var self = typeof this === 'object' ? this : $('body')
    var position = typeof this === 'object' ? 'element' : 'window';
    return {
        start: function () {
            self.addClass('position-relative');
            self.prepend(
                `
                <div class="spinner-container ${position}">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </div>
                `
            );
        },
        stop: function () {
            $('.spinner-container').remove();
        }
    };
}

/**
 * Replace the current button content with a loader element
 * @returns {Object} - The button loader action of the element
 */
function loadingButtonAction () {
    if (typeof this !== 'object') return;

    var self = $(this);
    var spinnerHtml = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;

    if (!self.hasClass('btn')) return;

    var height = self.innerHeight();
    var width = self.innerWidth();

    return {
        start: function () {
            var currentHtml = self.html();
            var currentHtmlEl = $(currentHtml);

            if (currentHtmlEl.hasClass('spinner-border')) return;

            self.css({
                height: height + 2,
                width: width
            })
                .data('html-content', currentHtml)
                .attr('data-html-content', currentHtml)
                .empty()
                .append(spinnerHtml)
                .prop('disabled', true);
        },
        stop: function () {
            var previousHtml = self.data('html-content') ? self.data('html-content') : '...';
            self.empty().append(previousHtml).removeAttr('style').prop('disabled', false);
        }
    }
}

var customAction = {
    initializeSpinner: function () {
        var extendAction = {spinner: spinnerAction};
        // Extend for the body
        $.extend(extendAction);

        // Extend for only the JQUERY Element
        $.fn.extend(extendAction);
    },
    initializeLoadingActionForButton: function () {
        var extendAction = {buttonLoading: loadingButtonAction};
        $.fn.extend(extendAction);
    }
}

module.exports = customAction;
