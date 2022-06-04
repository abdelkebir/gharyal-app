define([
    'jquery'
], function ($) {
    'use strict';

    $.widget('mage.amInstLoader', {
        _create: function () {
            var wrapper = $('<span class="aminst-loader"></span>');

            for (var i = 0; i < 4; i++) {
                wrapper.append('<span class="aminst-loader-dot"></span>');
            }

            this.node = wrapper;
        },

        getLoader: function () {
            return this;
        }
    });

    return $.mage.amInstLoader;
});