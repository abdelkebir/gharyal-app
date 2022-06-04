define([
    'jquery',
    'Amasty_Base/vendor/slick/slick.min'
], function ($) {
    'use strict';

    $.widget('aminsta.gridSlider', {
        options: {},

        _create: function () {
            $(this.element).slick(this.options);
        }
    });

    return $.aminsta.gridSlider;
});
