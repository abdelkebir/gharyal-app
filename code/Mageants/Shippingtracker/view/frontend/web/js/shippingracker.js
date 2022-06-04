/**
  * Mageants ShippingTracker Magento2 Extension                           
*/
require(["jquery","mage/url","shippingtracker"], function($,url) {
	$(document).ready(function(){
		$(document).on("submit", "#shipping-tracking", function($){
			jQuery(".block-content").css('opacity', 0.3);
			jQuery('.tracking_info').trigger('processStart');
			jQuery(".tracking-loader").show();
			var trackUrl = url.build('shippingtracker/index/trackingDetails');
			jQuery.ajax({
				url:trackUrl,
				data:jQuery(this).serialize(),
				type: 'POST',
				success:function(result){
					jQuery(".block-content").css('opacity', 1);
					jQuery(".tracking-loader").hide();
					if (result.shipping_method_disabled !== undefined) {
						jQuery(".show_if_carrier_disabled").show();
						jQuery(".disabled_carrier").empty();
						jQuery(".tracking_info").empty();
						jQuery(".disabled_carrier").text(result.carrier_message);
					} else {
						jQuery(".show_if_carrier_disabled").hide();
						if(result.tracking_error_message!==undefined){
							jQuery(".tracking_info").hide();	
							jQuery(".no-tracking-details").show();
							return;
						}
						jQuery(".no-tracking-details").hide();
						if(result.tracking_count){
							jQuery.ajax({
							url:result.shippingurl,
							type: 'POST',
							showLoader: true,
							success:function(result){
								jQuery(".tracking_info").html(jQuery(result).find('main#maincontent'));
							}
							});
						}
						else{
							jQuery(".no-tracking-details").show();
							jQuery(".tracking_info").hide();
						}
					}
					jQuery('.tracking_info').trigger('processStop');
				}
			});
		})
		$(document).on("submit", "#shipping-tracking-byid", function($){
			jQuery(".block-content").css('opacity', 0.3);
			jQuery(".tracking-loader").show();
			jQuery('.tracking_info').trigger('processStart');
			var trackUrl = url.build('shippingtracker/index/trackingDetails');
			jQuery.ajax({
				url:trackUrl,
				data:jQuery(this).serialize(),
				type: 'POST',
				success:function(result){
					jQuery(".block-content").css('opacity', 1);
					jQuery(".tracking-loader").hide();
					if (result.shipping_method_disabled !== undefined) {
						jQuery(".show_if_carrier_disabled").show();
						jQuery(".disabled_carrier").empty();
						jQuery(".tracking_info").empty();
						jQuery(".disabled_carrier").text(result.carrier_message);
					} else {
						jQuery(".show_if_carrier_disabled").hide();
						if(result.tracking_error_message!==undefined){
							jQuery(".tracking_info").hide();	
							jQuery(".no-tracking-details").show();
							return;	
						}
						jQuery(".no-tracking-details").hide();
						if(result.tracking_count){
							jQuery.ajax({
							url:result.shippingurl,
							type: 'POST',
							showLoader: true,
							success:function(result){
								jQuery(".tracking_info").html(jQuery(result).find('main#maincontent'));
							}
							});
						}
						else{
							jQuery(".no-tracking-details").show();
							jQuery(".tracking_info").hide();
						}
					}
					jQuery('.tracking_info').trigger('processStop');
				}
			});

		})
	});

});	
