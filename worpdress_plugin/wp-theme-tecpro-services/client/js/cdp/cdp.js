'use strict';

const CDP = {
    initSeeMoreEvent: function () {
        var targetTextClass = $('.see-more-btn').find('.text');
        targetTextClass = $(targetTextClass).text(targetTextClass.data('openLabel'));

        $('.see-more-btn').on('click.seeMoreClick', function (e) {
            e.preventDefault();
            var targetToggledClass = $(this).parent().prev('.paragraph-box').children('.paragraph');
            var targetTextClass = $(this).find('.text');
            var targetIconClass = $(this).find('.icon .fa');

            var toggledClass = 'text-ellipsis-line-4th';
            var onOffIconsClass = {
                open : 'fa-caret-square-o-down',
                close: 'fa-caret-square-o-up'
            }

            targetToggledClass = $(targetToggledClass);
            targetTextClass = $(targetTextClass);
            targetIconClass = $(targetIconClass);

            if (targetToggledClass.hasClass(toggledClass)) {
                // Open -> Close
                targetToggledClass.removeClass(toggledClass);
                targetTextClass.text(targetTextClass.data('closeLabel'));
                targetIconClass.removeClass(onOffIconsClass.open).addClass(onOffIconsClass.close);
            } else {
                targetToggledClass.addClass(toggledClass);
                targetTextClass.text(targetTextClass.data('openLabel'));
                targetIconClass.removeClass(onOffIconsClass.close).addClass(onOffIconsClass.open);
            }

        });
    }
};

module.exports = CDP;
