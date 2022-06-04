define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    'mage/translate'
], function ($) {
    'use strict';

    $.widget('mage.access_token', {
        options: {
            authorize_url: '',
            window: {
                title: $.mage.__('Instagram'),
                params: 'width=700,height=620,left=1862,top=326'
            },
            alertPopup: {
                content: $.mage.__('Something went wrong while token generation')
            },
            activeClass: 'aminst-token-icon',
            accessToken: '.aminst-token-after'
        },

        _create: function () {
            this.alert = require('Magento_Ui/js/modal/alert');
            this.options.accessToken = $(this.options.accessToken);

            this._on({
                'click': $.proxy(this._access, this)
            });
        },

        _access: function () {
            var self = this;

            this.child = window.open(
              self._getUrl(),
              self.options.window.title,
              self.options.window.params
            );

            this._checkChild();
        },

        _checkChild: function () {
            var self = this,
                timer;

            timer = setInterval(function () {
                if (self.child.closed) {
                    if (document.isTokenGenerated) {
                        self._showIcon();
                    } else {
                        self._showAlert();
                    }

                    clearInterval(timer);
                }
            }, 1000);
        },

        _showAlert: function () {
            var options = this.options;

            this.alert({
                content: options.alertPopup.content,
            });
        },

        _showIcon: function () {
            this.options.accessToken.addClass(this.options.activeClass);
        },

        _getUrl: function () {
            return this.options.authorize_url;
        }
    });

    return $.mage.access_token;
});
