'use strict';

const viewUtils = {
    isMobile: function () {
        return (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i).test(navigator.userAgent);
    }
};

module.exports = viewUtils;
