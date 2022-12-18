'use strict';

const menu = {
    openMenuSidebar: function () {
        $('body').on('click', '.open-menu-btn, .close-right-sidebar-btn', function () {
            var body = $('body');
            var menuOpened = body.hasClass('menu-opened');
            body.toggleClass('menu-opened', !menuOpened);
        });
    },
    toggleFooterMenuDropdown: function () {
        $('body').on('click.toggleFooterMenuDropdown', '.custom-dropdown-trigger .icon-arrow', function (e) {
            var icon = $(this).find('.fa');
            var dropdownMenuSection = icon.parents('.custom-dropdown-menu');
            var menu = dropdownMenuSection.find('.menu');
            menu.toggleClass('expand');
            icon.toggleClass('fa-angle-up', menu.hasClass('expand'));
            icon.toggleClass('fa-angle-down', !menu.hasClass('expand'));
        });
    }
};

module.exports = menu;
