'use strict';

window.$ = window.jQuery;
var execModule = require('./utils/execModule');

$(document).ready(function () {
    require('./3rdParty/bootstrap');
    execModule(require('./components/customAction'));
    execModule(require('./components/commonEvents'));
    execModule(require('./course/course'));
    execModule(require('./category/category'));
    execModule(require('./media/media'));
});