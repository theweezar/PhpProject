window.$ = window.jQuery

var execModule = require('./utils/execModule');

$(document).ready(function () {
    require('./3rdParty/bootstrap');
    execModule(require('./homePage/homePage'));
    execModule(require('./components/menu'));
    execModule(require('./components/account'));
    execModule(require('./components/modal'));
    execModule(require('./cdp/cdp'));
});
