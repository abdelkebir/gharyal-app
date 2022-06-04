/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/*browser:true*/
/*global define*/
define(
    [
        'Magento_Checkout/js/view/payment/default',
		'mage/storage',
        'Magento_Checkout/js/model/error-processor',
        'Magento_Checkout/js/model/full-screen-loader',
        'Magento_Customer/js/customer-data',
		'jquery',
        'mage/url',
        'Magento_SamplePaymentGateway/js/formbuilder/form-builder'
    ],
    function (Component, storage, errorProcessor, fullScreenLoader, customerData, $, url, formBuilder) {
        'use strict';
		
		var containerId = '#checkout';
		
        return Component.extend({
			redirectAfterPlaceOrder: false,
            defaults: {
                template: 'Magento_SamplePaymentGateway/payment/form',
				transactionResult: ''
            },

            initObservable: function () {

                this._super()
                    .observe([
                        'transactionResult'
                    ]);
                return this;
            },

            getCode: function() {
                return 'sample_gateway';
            },

            getData: function() {
                return {
                    'method': this.item.method
                };
            },
			
			
			getMailingAddress: function () {
                return window.checkoutConfig.payment.checkmo.mailingAddress;
            },

            afterPlaceOrder: function () {
				fullScreenLoader.startLoader();
                var custom_controller_url = url.build('customcheckout/CustomPayment/index'); //your custom controller url
                $.post(custom_controller_url, 'json')
                .done(function (response) {
					customerData.invalidate(['cart']);
					fullScreenLoader.startLoader();
					
					if(response == 'Connection Failure') {
						errorProcessor.process(response, this.messageContainer);
						fullScreenLoader.stopLoader();
						return false;
					}
					
					response = JSON.parse(response);
					
					
					if (response.IsSuccess) {
							var sessionID = response.Data.SESSION_ID;
							window.location.href = response.page_url + btoa(sessionID.toString());
						}
						else {
							errorProcessor.process(response, this.messageContainer);
							fullScreenLoader.stopLoader();
						}
					
					// $.post('https://testpaymentapi.hbl.com/HblPay/api/checkout', response)
					
					 // $.post('http://localhost:63896/api/checkout', response)
					// .done(function (resp) {
						// if (resp.IsSuccess) {
							// var sessionID = resp.Data.SESSION_ID;
							// window.location.href = 'http://localhost:1113/index.html#/checkout?data=' + btoa(sessionID.toString());
							// // window.location.href = 'https://testpaymentapi.hbl.com/HblPay/Site/index.html#/checkout?data=' + btoa(sessionID.toString());
						// }
						// else {
							// errorProcessor.process(response, this.messageContainer);
						// }
					// })
					// .fail(function (resp) {
						// errorProcessor.process(resp, this.messageContainer);
					// })
					// .always(function () {
						// fullScreenLoader.stopLoader();
					// });					
					
                    
                })
                .fail(function (response) {
                    errorProcessor.process(response, this.messageContainer);
                })
                .always(function () {
                    fullScreenLoader.stopLoader();
                });
            }
			
		});
    }
);