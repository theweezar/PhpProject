'use strict';

require('slick-carousel');

var viewUtils = require('../utils/viewUtils');

const homePage = {
    /**
     * Init homepage banner slick
     */
    initHomepageBannerSlick: function () {
        var homePageBanner = $('.homepage-banner-sidebar');
        var slickConfig = homePageBanner.data('slick');

        if (!slickConfig) {
            slickConfig = {
                infinite: false,
                speed: 200,
                slidesToShow: 1,
                arrows: false,
                dots: true
            };
        }

        $('.homepage-banner-sidebar').slick(slickConfig);
    },
    /**
     * Init popular courses slick on homepage
     */
    initPopularCourseSlick: function () {
        var slickConfig = {
            infinite: false,
            speed: 200,
            slidesToShow: 4,
            arrows: false,
            dots: true
        };

        var popularCourse = $('.popular-course-slick');
        var sliderItems = popularCourse.find('.slider-item');

        if (viewUtils.isMobile()) {
            slickConfig.arrows = true;
            slickConfig.slidesToShow = 1;
        }

        if (sliderItems.length >= 4 || viewUtils.isMobile()) {
            popularCourse.slick(slickConfig);
        }
    },
    /**
     * Initt skill interest slick on homepage
     */
    initSkillInterestSlick: function () {
        var slickConfig = {
            infinite: false,
            speed: 200,
            slidesToShow: 3,
            arrows: false
        };

        if (viewUtils.isMobile()) {
            slickConfig.slidesToShow = 1;
        }

        var skillContent = $('.skill-interest-content');
        var skillBlocks = skillContent.find('.wp-block-group');
        var skillSlickContainer = $('<div>').addClass();
        $.each(skillBlocks, function () {
            var block = $(this);
            skillSlickContainer.append(block.clone());
            block.remove();
        });

        skillContent.append(skillSlickContainer);

        skillSlickContainer.slick(slickConfig);
    }
};

module.exports = homePage;
