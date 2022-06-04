define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    'Amasty_InstagramFeed/js/am-loader',
    'Amasty_InstagramFeed/js/post/popup',
], function ($, modal, Loader) {
    'use strict';

    $.widget('mage.amInstPostScroll', {
        selectors: {
            'button': '[data-aminst-js="load_button"]',
            'post_item' : '[data-aminst-js="post-item"]',
            'post_items' : '[data-aminst-js="post-items"]'
        },
        current_page: 1,

        _create: function () {
            $(this.element).find(this.selectors.button).on('click', this.loadMore.bind(this));
        },

        loadMore: function (event) {
            var button = $(event.target),
                self = this,
                data = this.getNextPageData(),
                parent = this.element.find(this.selectors.post_items),
                blockData =  this.options.block_data,
                loader = new Loader(5);

            if (!button.is('button')) {
                button = button.parent();
            }

            if (data.length) {
                blockData['load_page'] = this.current_page + 1;
                $.ajax({
                    url: self.options.ajaxUrl,
                    data: {'data' : data, 'block_data' : blockData},
                    type: 'post',
                    dataType: 'html',
                    beforeSend: function () {
                        $(button).addClass('-progress');
                        $(button).attr('disabled', 'disabled');
                        $(button).append(loader.node);
                    },

                    success: function (response) {
                        $(button).removeClass('-progress');
                        $(button).removeAttr('disabled');
                        $(loader.node).remove();

                        if (response) {
                            var tmp = $(response),
                                isPopupEnabled = response.indexOf('Amasty_InstagramFeed/js/post/popup') > 0;

                            tmp.find(self.selectors.post_item).each(function (index, element) {
                                parent.append(element);
                                if (isPopupEnabled) {
                                    $.mage.amInstPostPopup({
                                        'loaderUrl': self.options.loaderUrl,
                                        'element' : $(element)
                                    });

                                }
                            });
                        }

                        self.current_page++;
                        if (!self.getNextPageData().length) {
                            button.hide();
                        }
                    },

                    error: function () {
                        $(button).removeClass('-progress');
                        $(loader.node).remove();
                    }
                });
            }
        },

        getNextPageData: function () {
            var data = this.options.all_posts,
                perPage = this.options.per_page;

            return data.slice(perPage * this.current_page, perPage * (this.current_page + 1));
        }
    });

    return $.mage.amInstPostScroll;
});
