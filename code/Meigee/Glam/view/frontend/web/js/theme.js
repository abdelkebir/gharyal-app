function customHomeSlider() {
    slider = jQuery("#home-slider");
    navigation = slider.data("navigation");
    pagination = slider.data("pagination");
    items = slider.data("items");    
    autoplay = slider.data('autoplay');
    autoplayTimeout = slider.data('autoplay-timeout');
	stop_on_hover = slider.data('stoponhover');    
    itemsMobile = slider.data("itemsMobile");
    stagePadding = slider.data("stagePadding");
    slideSpeed = slider.data("speed");
    navigation ? navigation = true : navigation = false;
    pagination ? pagination = true : pagination = false;    
    autoplay ? autoplay = true : autoplay = false;
    autoplayTimeout && autoplay ? autoplayTimeout = autoplayTimeout : autoplayTimeout = 5000;
	stop_on_hover ? stop_on_hover = true : stop_on_hover = false;    
    items ? items = items : items = 1;
    itemsMobile ? itemsMobile = itemsMobile : itemsMobile = 1;
    stagePadding ? stagePadding = stagePadding : stagePadding = 0;
    slider.owlCarousel({
        items: items,
        responsive: {
            0: {
                items: itemsMobile
            },
            767: {
                items: (items > 1 ? items = 2 : items = 1),
                margin: 0,
                stagePadding: 0,
                loop: true,
                center: true,
            },
            1331: {
                items: slider.data("items"),
                margin: 20,
                stagePadding: stagePadding,
                loop: true,
                center: true,
            },
        },
        nav: navigation,
        navSpeed: slideSpeed,        
        loop: true,
		autoplayTimeout : autoplayTimeout,
		autoplay : autoplay,
		autoplayHoverPause : stop_on_hover,        
        dots: pagination,
        dotsSpeed: 400,
        navText: ['<span><i class="meigee-arrow-left"></i><i class="meigee-arrow-left"></i></span>',
        '<span><i class="meigee-arrow-right"></i><i class="meigee-arrow-right"></i></span>']
    })
}

function menuCategorySlider() {
    if (jQuery(document.body).width() >= 1008) {
        isRtl = false;
        if(jQuery('body').hasClass('rtl')){
            isRtl = true;
        }
        jQuery(".menu-category-slider").each(function() {
            if (!jQuery(this).closest('.mobile-menu-inner').length || !jQuery(this).hasClass('owl-loaded')) {
                slider = jQuery(this);
                navigation = slider.data("navigation");
                pagination = slider.data("pagination");
                items = slider.data("items");
                itemsMobile = slider.data("itemsMobile");
                stagePadding = slider.data("stagePadding");
                slideSpeed = slider.data("speed");
                navigation ? navigation = true : navigation = false;
                pagination ? pagination = true : pagination = false;
                items ? items = items : items = 1;
                itemsMobile ? itemsMobile = itemsMobile : itemsMobile = 1;
                stagePadding ? stagePadding = stagePadding : stagePadding = 0;
                slider.owlCarousel({
                    items: items,
                    responsive: {
                        0: {
                            items: itemsMobile
                        },
                        767: {
                            items: (items > 1 ? items = 2 : items = 1),
                            margin: 0,
                            stagePadding: 0,
                            loop: true,
                            center: true,
                        },
                        1331: {
                            items: slider.data("items"),
                            margin: 0,
                            stagePadding: 0,
                            loop: true,
                            center: true,
                        },
                    },
                    nav: navigation,
                    navSpeed: slideSpeed,
                    dots: pagination,
                    dotsSpeed: 400,
                    navText: ['<span><i class="meigee-arrow-left"></i><i class="meigee-arrow-left"></i></span>', '<span><i class="meigee-arrow-right"></i><i class="meigee-arrow-right"></i></span>'],
                    rtl:isRtl
                })
            }
        });
    }
}

function headerSliderBanner() {
   if (jQuery(document.body).width() < 768) {
        if (jQuery("#header-banner-slider").length) {
            slider = jQuery("#header-banner-slider");
            if (!slider.hasClass('owl-carousel')) {
                slider.addClass('owl-carousel');
            }
            navigation = slider.data("navigation");
            pagination = slider.data("pagination");
            items = slider.data("items");
            itemsMobile = slider.data("itemsMobile");
            stagePadding = slider.data("stagePadding");
            slideSpeed = slider.data("speed");
            navigation ? navigation = true : navigation = false;
            pagination ? pagination = true : pagination = false;
            items ? items = items : items = 1;
            itemsMobile ? itemsMobile = itemsMobile : itemsMobile = 1;
            stagePadding ? stagePadding = stagePadding : stagePadding = 0;
            slider.owlCarousel({
                items: items,
                responsive: {
                    0: {
                        items: itemsMobile
                    },
                    767: {
                        items: (items > 1 ? items = 2 : items = 1),
                        margin: 0,
                        stagePadding: 0,
                        loop: true,
                        center: true,
                    },
                    1331: {
                        items: slider.data("items"),
                        margin: 20,
                        stagePadding: stagePadding,
                        loop: true,
                        center: true,
                    },
                },
                nav: navigation,
                navSpeed: slideSpeed,
                dots: pagination,
                autoplay: true,
                autoplayTimeout: 7000,
                loop: true,
                dotsSpeed: 400,
                navText: ['<i class="meigee-arrow-left"></i>', '<i class="meigee-arrow-right"></i>']
            })
        }
    } else {
        if (jQuery("#header-banner-slider").length) {
            jQuery("#header-banner-slider").trigger('destroy.owl.carousel').removeClass('owl-carousel','owl-loaded');
        }
    }
}

function alignWidgetSliderButtons() {
    if (jQuery(document.body).width() >= 1332) {
        clearTimeout(resizeTimer);
        var resizeTimer = setTimeout(function() {
            if(jQuery('.widget-product-grid .owl-carousel').length){
                jQuery('body').find('.widget-product-grid .owl-carousel').each(function(){
                    var maxHeight = Math.max.apply(null, jQuery(this).find(".owl-item .image-wrapper").map(function ()
                    {
                        return jQuery(this).height();
                    }).get());
                    if (jQuery(this).find('.owl-nav').length) {
                        var elHeight = jQuery(this).find('.owl-nav div').height();
                        jQuery(this).find('.owl-nav').css({'top' : maxHeight/2 - elHeight/2 + parseInt(jQuery(this).find(".owl-item").css('padding-top')) + 'px', 'transform' :  'translateY(0)'});
                    }
                });
            }
        }, 700);
    }
}

function pageNotFound() {
    if(jQuery('.not-found-bg').data('bgimg')){
        var bgImg = jQuery('.not-found-bg').data('bgimg');
        jQuery('.not-found-bg').attr('style', bgImg);
    }
}

function accordionNav(){
    if(jQuery('.block.filter').length){
        jQuery('.filter-options-title').off().on('click', function(){
            jQuery(this).parents('.filter-options-item').toggleClass('active').children('.filter-options-content').slideToggle();
        });
        if(jQuery(document.body).width() < 767 && jQuery('body').hasClass('page-layout-1column')){
            jQuery('#layered-filter-block .filter-title').on('click', function(){
                if(!jQuery('#layered-filter-block').hasClass('active')) {
                    jQuery('#layered-filter-block').addClass('active');
                } else {
                    jQuery('#layered-filter-block').removeClass('active');
                }
            });

        }
    }
}


function custom_top_menu_button_listener(){
    if (window.innerWidth > 1007){
        jQuery('header .custom-menu-button').show();
        jQuery('div.topmenu.custom-top-menu').show();
    } else {
        jQuery('.mobile-menu-wrapper div.topmenu').removeClass('custom-top-menu');
        jQuery('header .custom-menu-button').hide();
        jQuery('div.topmenu.custom-top-menu').hide();
        jQuery('.mobile-menu-wrapper div.topmenu ul li').attr('style', '');
        jQuery('.mobile-menu-wrapper div.topmenu ul li a').attr('style', '');
    }
}

function productOptions() {
    if (jQuery(".options-block").length) {
        jQuery(document).on('mouseenter', '.hover-buttons', function(event){
            event.stopPropagation();
            event.preventDefault();
            jQuery(this).closest('.hover-buttons').addClass('open');
        });
        jQuery(document).on('mouseleave', '.hover-buttons', function(event){
            event.stopPropagation();
            event.preventDefault();
            jQuery(this).closest('.hover-buttons').removeClass('open');
        });
        jQuery(document).on('touchstart', function(event){
            if(jQuery(event.target).parents('.hover-buttons').length == 0){
                if (jQuery(this).closest('.hover-buttons').hasClass('open')) {
                    jQuery(this).closest('.hover-buttons').removeClass('open');
                } else {
                    jQuery(this).closest('.hover-buttons').addClass('open');
                }
            }
        });
    }
}

function custom_top_menu(mode){
    jQuery('header.page-header').each(function(){
        switch(mode)
         {
         case 'animate':
           if(!jQuery('div.topmenu').hasClass('custom-top-menu')){
                var isMenuAnimation = false;
                jQuery("div.topmenu").addClass('custom-top-menu');
                jQuery(".mobile-menu-wrapper div.topmenu").removeClass('custom-top-menu');
                menuButton = jQuery('.custom-menu-button');
                if(menuButton.length){
                    menuButton.removeClass('active').children('.custom-menu-button').removeClass('close');
                    var isActiveMenu = false;
                    var isTouch = false;
                    if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i)) || (navigator.userAgent.match(/Android/i))){
                        var isTouch = true;
                    }
                    function callEvent(event){
                        event.stopPropagation();
                        if(isActiveMenu == false && !isMenuAnimation){
                            isMenuAnimation = true;
                            menuButton.addClass('active').children('.custom-menu-button').addClass('close');
                            jQuery(this).addClass('active');
                            menuWidth = jQuery('header .topmenu.navbar-collapse').css('width');
                            jQuery('header div.topmenu.custom-top-menu').addClass('in');
                            jQuery('header ul.topmenu').css('visibility', 'visible');
                            jQuery('header ul.topmenu li.level0').css('height', 'auto');
                            jQuery(jQuery('header div.topmenu.custom-top-menu > ul > li.level0 > a').get().reverse()).each(function(i) {
                                i ++;
                                jQuery(this).addClass('animation-progress').animate({'top' : '0' , 'opacity' : '1'}, i*50, function(){
                                    jQuery(this).removeClass('animation-progress');
                                    isMenuAnimation = false;
                                });
                            });

                            isActiveMenu = true;
                            if(isTouch){
                                document.addEventListener('touchstart', mobMenuListener, false);
                            }else{
                                jQuery(document).on('click.mobMenuEvent', function(e){
                                    if(jQuery(e.target).parents('header div.topmenu.custom-top-menu').length == 0){
                                        closeMenu();
                                        document.removeEventListener('touchstart', mobMenuListener, false);
                                        jQuery(document).off('click.mobMenuEvent');
                                    }
                                });
                            }
                        }else if(!isMenuAnimation){
                            closeMenu();
                        }
                    }

                    if(!isTouch){
                        menuButton.on('click.menu', function(event){
                            callEvent(event);
                        });
                    }else{
                        document.getElementsByClassName('custom-menu-button')[0].addEventListener('touchstart', callEvent, false);
                    }

                    function closeMenu(eventSet){
                        menuButton.removeClass('active').children('.custom-menu-button').removeClass('close');
                        isMenuAnimation = true;
                        jQuery('header div.topmenu.custom-top-menu').removeClass('in');
                        var count = jQuery("header div.topmenu.custom-top-menu > ul > .level0").size();
                        jQuery(jQuery('header div.topmenu.custom-top-menu > ul > li.level0 > a').get().reverse()).each(function(i) {
                            i ++;
                            jQuery(this).addClass('animation-progress').animate({'top' : '-50px' , 'opacity' : '0'}, i*50, function(){
                                jQuery(this).removeClass('animation-progress');
                            });
                            isMenuAnimation = false;
                            isActiveMenu = false;
                            if(i === count) {
                                function hideMenu (){
                                    jQuery('header div.topmenu.custom-top-menu > ul > li.level0').each(function() {
                                        jQuery(this).css('height', 0);
                                    });
                                }
                                setTimeout(hideMenu, i*30);
                            }
                        });

                        document.removeEventListener('touchstart', mobMenuListener, false);
                    }
                    function mobMenuListener(e){
                        var touch = e.touches[0];
                        if(jQuery(touch.target).parents('div.topmenu.custom-top-menu').length == 0 && jQuery(touch.target).parents('.custom-menu-button').length == 0 && !jQuery(touch.target).hasClass('custom-menu-button')){
                            closeMenu();
                        }
                    }
                }
           }
           break;
           default:
           jQuery('.mobile-menu-wrapper div.topmenu').removeClass('custom-top-menu');
           jQuery('div.topmenu ul').attr('style', '');
           jQuery('div.topmenu ul li').attr('style', '');
           jQuery('div.topmenu ul li a').attr('style', '');
           jQuery('.custom-menu-button').off();
           jQuery('.lines-button').on('click', function(){
            jQuery(this).toggleClass('close');
            jQuery('.menu-block').toggleClass('open');
            if(!jQuery('.menu-block').hasClass('open')){
                setTimeout(function(){
                    jQuery('.menu-block').attr('style', '').find('row').css('width', '1200px');
                }, 500);
            } else {
                setTimeout(function(){
                    jQuery('.menu-block').css('overflow', 'visible').find('row').css('width', 'auto');
                }, 500);
            }
           });
       }
    });
}

function accordionIcons() {
    if (jQuery(document.body).width() <= 1007) {
        if (!jQuery('.accordion-list .accordion-item .accordion-title .icon-more').length) {
            jQuery('.accordion-list .accordion-item .accordion-title').prepend('<span class="icon-more"><i class="icon-plus meigee-plus"></i><i class="icon-minus meigee-minus"></i></span>');
        }
        if (jQuery('#product-details-panel')) {
            if (!jQuery('#product-details-panel .item h4 .icon-more').length) {
                jQuery('#product-details-panel .item h4').prepend('<span class="icon-more"><i class="icon-plus meigee-plus"></i><i class="icon-minus meigee-minus"></i></span>');
            }
        }
        if (jQuery('body').hasClass('catalog-product-view')) {
            jQuery('body .main-container').addClass('accordion-list');
        }
    } else {
       jQuery('.accordion-list .accordion-item .accordion-title').find('.icon-more').remove();
       jQuery('.accordion-list').find('.accordion-item.open .accordion-content').removeClass('open');
       jQuery('.accordion-list .accordion-item .accordion-content').each(function() {
        jQuery(this).css('display','');
       });
       if (jQuery('body').hasClass('catalog-product-view')) {
            if (jQuery('.customer-reviews-wrapper').length) {
                reviewsBox();
            }
        }
        if (jQuery('.product-collateral').length) {
            if (jQuery('.panel-group .panel-heading .panel-title .icon-more').length) {
                jQuery('.panel-group .panel-heading .panel-title').find('.icon-more').remove();
            }
        }
        if (jQuery('#product-details-panel').length) {
            jQuery('#product-details-panel .item h4').find('.icon-more').remove();
            jQuery('#product-details-panel').find('.item.open').removeClass('open');
            jQuery('#product-details-panel .item .content').each(function() {
                jQuery(this).css('display','');
            });
        }
    }

    if (jQuery(document.body).width() < 768) {
        if (jQuery('#layered-filter-block').length) {
            jQuery('#layered-filter-block').addClass('mobile');
        }
    } else {
        if (jQuery('#layered-filter-block').length) {
            jQuery('#layered-filter-block').removeClass('mobile');
            jQuery('#layered-filter-block').css('right', '');
        }
    }
}
function accordionToggle() {
    jQuery('.accordion-list').each(function() {
        jQuery('.accordion-title').off().on('click', function(e) {
            if (jQuery(document.body).width() <= 1007) {
                e.preventDefault();
                var $this = jQuery(this);
                if ($this.parent().hasClass('open')) {
                    $this.parent().removeClass('open');
                    $this.next().slideUp(500);
                } else {
                    if (jQuery('body').hasClass('catalog-product-view') && jQuery('#product-details-panel').length) {
                        jQuery('#product-details-panel').find('.item.open .content').slideUp(350);
                        jQuery('#product-details-panel').find('.item.open').removeClass('open');
                    }
                    $this.closest('.accordion-list').find('.accordion-item.open .accordion-content').slideUp(350);
                    $this.closest('.accordion-list').find('.accordion-item.open').removeClass('open');
                    $this.parent().addClass('open');
                    $this.next().slideDown(500);
                    if ($this.parent().parent().hasClass('box-collateral')) {
                        reviewsBox();
                    }
                }
            }
        });
    });


    jQuery('#product-details-panel .item h4').off().on('click', function(e) {
        if (jQuery(document.body).width() < 768) {
            e.preventDefault();
            var $this = jQuery(this);

            if ($this.parent().hasClass('open')) {
                $this.parent().removeClass('open');
                $this.next().slideUp(500);
            } else {
                $this.closest('#product-details-panel').find('.item.open .content').slideUp(350);
                $this.closest('#product-details-panel').find('.item.open').removeClass('open');
                jQuery('.accordion-list').find('.accordion-item.open .accordion-content').slideUp(350);
                jQuery('.accordion-list').find('.accordion-item.open').removeClass('open');
                $this.parent().addClass('open');
                $this.next().slideDown(500);
            }
        }
    });
}

function shopByListener(a) {
    var b = a.touches[0];
    if (jQuery(b.target).parents("#layered-filter-block").length == 0 && jQuery(b.target).parents(".shop-by-button").length == 0 && !jQuery(b.target).hasClass("shop-by-button") && !jQuery(b.target).hasClass('block-layered-nav')) {
        jQuery("#layered-filter-block").removeClass("active");
        jQuery('.shop-by .shop-by-button').removeClass('active');
        jQuery('html body').animate({'margin-left' : '0', 'margin-right' : '0'},500);
        jQuery('#layered-filter-block').animate({'right' : '-300px'},500);
        document.removeEventListener("touchstart", shopByListener, false)
    }
}

function shopByClick() {
    jQuery('.shop-by .shop-by-button').off().on('click', function(e) {
        if (!jQuery('#layered-filter-block').hasClass('active')) {
            jQuery('#layered-filter-block').addClass('active');
            shopButton = jQuery('.shop-by .shop-by-button');
            shopButton.addClass('active');
            shopBlockWidth = jQuery('#layered-filter-block').width();
            jQuery('html body').animate({'margin-left' : '-300px', 'margin-right' : '300px'},500);
            jQuery('#layered-filter-block').animate({'right' : '0'},500);
            if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i)) || (navigator.userAgent.match(/Android/i))){
                document.addEventListener("touchstart", shopByListener, false);
            } else {
                jQuery(document).on("click", function(f) {
                    if (jQuery(f.target).parents("#layered-filter-block").length == 0 && jQuery(f.target).parents(".shop-by-button").length == 0 && !jQuery(f.target).hasClass(".shop-by-button") && !jQuery(b.target).hasClass('block-layered-nav')) {
                        jQuery("#layered-filter-block").removeClass("active");
                        jQuery('.shop-by .shop-by-button').removeClass('active');
                        jQuery('html body').animate({'margin-left' : '0', 'margin-right' : '0'},500);
                        jQuery('#layered-filter-block').animate({'right' : '-300px'},500);
                        jQuery(document).off("click");
                    }
                })
            }


        } else {
            e.stopPropagation();
            jQuery('#layered-filter-block').removeClass('active');
            shopButton = jQuery('.shop-by .shop-by-button');
            shopButton.removeClass('active');
            jQuery('html body').animate({'margin-left' : '0', 'margin-right' : '0'},500);
            jQuery('#layered-filter-block').animate({'right' : '-300px'},500);
        }
    })
}

/* Header Customer Block */
function headerCustomer() {
    if(jQuery('header.page-header .customer-block').length){
        jQuery('.customer-block').prepend('<div class="customer-name-wrapper"><span class="customer-name"><span class="user-icon"><i class="fa fa-navicon"></i></span></span></div>') ;
        var custName = jQuery('header.page-header .customer-name-wrapper');
        jQuery('header.page-header .links').hide();
        jQuery('header.page-header .customer-name').removeClass('open');
        jQuery('header.page-header .customer-name + .links').slideUp(500);
        jQuery('header.page-header .links li').each(function(){
            jQuery(this).find('a').prepend('<i class="fa fa-circle" />').append('<span class="hover-divider" />');
        });
        function headerCustomerListener(e){
            var touch = e.touches[0];
            if(jQuery(touch.target).parents('header.page-header .customer-name + .links').length == 0 && !jQuery(touch.target).hasClass('customer-name') && !jQuery(touch.target).parents('.customer-name').length){
                jQuery('header.page-header .customer-name').removeClass('open');
                jQuery('header.page-header .customer-name + .links').slideUp(500);
                document.removeEventListener('touchstart', headerCustomerListener, false);
            }
        }
        custName.parent().off().on('mouseenter', function(event){
            event.stopPropagation();
            jQuery(this).children().addClass('hover');
        });
        custName.parent().on('mouseleave', function(event){
            event.stopPropagation();
            jQuery(this).children().removeClass('hover');
        });
        custName.off().on('click', function(event){
            event.stopPropagation();
            jQuery(this).toggleClass('open');
            var linksTop = custName.position().top + custName.outerHeight(true);
            jQuery('header.page-header .links').slideToggle().css('top', linksTop);
            document.addEventListener('touchstart', headerCustomerListener, false);
            jQuery(document).on('click.headerCustomerEvent', function(e) {
                if (jQuery(e.target).parents('header.page-header ul.links').length == 0) {
                    jQuery('header.page-header .customer-name').removeClass('open');
                    jQuery('header.page-header .customer-name + .links').slideUp(500);
                    jQuery(document).off('click.headerCustomerEvent');
                }
            });
        });
    }
}
/*
dividePrice = {
    init: function(){
        var self = this;
        self.start();
        self.observe();
    },
    start: function(){
        jQuery('.item .price-box .price-wrapper, .block-minicart .subtotal .price-wrapper').each(function() {
            if(!jQuery(this).find('.price-pennie').length){
                var price = jQuery(this).find('.price').html();
                price = price.replace(new RegExp('/ |&nbsp;','ig'), '');
                
                if(price.indexOf(".") != -1){
                    var divider = '.';
                }else{
                    var divider = ',';
                }
                
                var pos = price.indexOf(divider);
                var pennie = price.substr(pos+1, 2);
                var wholePricePart = price.replace(divider + pennie, '');
                var myCurrency = wholePricePart.replace(/\d+/g, '');
                if (jQuery(this).data("priceType") === 'finalPrice' || jQuery(this).parents('block-minicart').length !== 0) {
                    jQuery(this).find('.price').text(wholePricePart.replace(/\W/g,''));
                    jQuery(this).append(' <span class="price-pennie">' + pennie + '</span>');
                    jQuery(this).prepend('<span class="price-currency">' + myCurrency + '</span> ');
                } else if (jQuery(this).data("priceType") === 'oldPrice') {
                    jQuery(this).find('.price').text(price.replace(myCurrency, ''));
                }
            }
        })        
    },
    observe: function(){
        var self = this;
        var targetNode = jQuery('.item .price-box .price-wrapper');
        var config = { attributes: false, childList: true, subtree: true };
        var callback = function(mutationsList, observer) {
            for(var mutation of mutationsList) {
                if (mutation.type == 'childList') {
                    setTimeout(function(){
                        self.start();
                    }, 500);
                }
            }
        };
        var observer = new MutationObserver(callback);
        targetNode.each(function(){
            observer.observe(jQuery(this)[0], config);
        });        
    }
}
*/
function backgroundWrapper(){
    if(jQuery('.background-wrapper').length){
        jQuery('.background-wrapper').each(function(){
            var thisBg = jQuery(this);
            if(jQuery(document.body).width() < 768){
                thisBg.attr('style', '');
                if(thisBg.parent().hasClass('text-banner') || thisBg.find('.text-banner').length || thisBg.find('.fullwidth-text-banners').length){
                    bgHeight = thisBg.parent().outerHeight();
                    thisBg.parent().css('height', bgHeight - 2);
                }
                if(jQuery('body').hasClass('boxed-layout')){
                    bodyWidth = thisBg.parents('.container').outerWidth();
                    bgLeft = (bodyWidth - thisBg.parents('.container').width())/2;
                } else {
                    bgLeft = thisBg.parent().offset().left;
                    bodyWidth = jQuery(document.body).width();
                }
                if(thisBg.data('bgColor')){
                    bgColor = thisBg.data('bgColor');
                    thisBg.css('background-color', bgColor);
                }
                setTimeout(function(){
                    thisBg.css({
                        'position' : 'absolute',
                        'left' : -bgLeft,
                        'width' : bodyWidth
                    }).parent().css('position', 'relative');
                }, 300);
            } else {
                thisBg.attr('style', '');
                if(jQuery('body').hasClass('boxed-layout')){
                    bodyWidth = thisBg.parents('.container').outerWidth();
                    bgLeft = (bodyWidth - thisBg.parents('.container').width())/2;
                } else {
                    bgLeft = thisBg.parent().offset().left;
                    bodyWidth = jQuery(document.body).width();
                }
                thisBg.css({
                    'position' : 'absolute',
                    'left' : -bgLeft,
                    'width' : bodyWidth
                }).parent().css('position', 'relative');
                if(thisBg.data('bgColor')){
                    bgColor = thisBg.data('bgColor');
                    thisBg.css('background-color', bgColor);
                }
                if(thisBg.parent().hasClass('text-banner') || thisBg.find('.text-banner').length || thisBg.find('.fullwidth-text-banners').length){
                    bgHeight = thisBg.children().innerHeight();
                    thisBg.parent().css('height', bgHeight - 2);
                }
            }
            thisBg.animate({'opacity': 1}, 200)
        });
    }
}

function blockShippingToggle(){
    if (jQuery('.cart-summary #block-shipping .title').length) {
        jQuery('.cart-summary #block-shipping .title').off().on('click', function (event) {
            event.preventDefault();
            if (jQuery(this).hasClass('open')) {
                jQuery(this).removeClass('open');
                jQuery(this).next().slideUp();
            } else {
                jQuery(this).addClass('open');
                jQuery(this).next().slideDown();
            }
        });
    }
}
function hoverImage(){
	jQuery('.product-image-photo').each(function(){
		if(jQuery(this).data('hoverImage')){
			hover_img = jQuery('<img />');
			hover_img.addClass('hover-image');
			hover_img.attr('src', jQuery(this).data('hoverImage'));
			hover_img.appendTo(jQuery(this).parent());
			jQuery(this).parents('.image-wrapper').addClass('hover-image');
		}
	});
}

var bsModal;
require(['jquery'], function ($)
{
    require(["wow_animation"], function() {
        wow = new WOW({
          boxClass:     'wow',
          animateClass: 'animated',
          offset:       0,
          mobile:       false,
          live:         true
        });
        wow.init();
    });
    /* Product Timer */
    // productTimer = {
    //  init: function(secondsDiff, id){
    //      daysHolder = jQuery('.timer-'+id+' .days span');
    //      hoursHolder = jQuery('.timer-'+id+' .hours span');
    //      minutesHolder = jQuery('.timer-'+id+' .minutes span');
    //      secondsHolder = jQuery('.timer-'+id+' .seconds span');
    //      var firstLoad = true;
    //      productTimer.timer(secondsDiff, daysHolder, hoursHolder, minutesHolder, secondsHolder, firstLoad);
    //      setTimeout(function(){
    //          jQuery('.timer-box').css('display', 'block');
    //      }, 1100);
    //  },
    //  timer: function(secondsDiff, daysHolder, hoursHolder, minutesHolder, secondsHolder, firstLoad){
    //      setTimeout(function(){
    //          days = Math.floor(secondsDiff/86400);
    //          hours = Math.floor((secondsDiff/3600)%24);
    //          minutes = Math.floor((secondsDiff/60)%60);
    //          seconds = secondsDiff%60;
    //          secondsHolder.html(seconds);
    //          if(secondsHolder.text().length == 1){
    //              secondsHolder.html('0'+seconds);
    //          } else if (secondsHolder.text()[0] != 0) {
    //              secondsHolder.html(seconds);
    //          }
    //          if(firstLoad == true){
    //              daysHolder.html(days);
    //              hoursHolder.html(hours);
    //              minutesHolder.html(minutes);
    //              if(minutesHolder.text().length == 1){
    //                  minutesHolder.html('0'+minutes);
    //              }
    //              if(hoursHolder.text().length == 1){
    //                  hoursHolder.html('0'+hours);
    //              }
    //              if(daysHolder.text().length == 1){
    //                  daysHolder.html('0'+days);
    //              }
    //              firstLoad = false;
    //          }
    //          if(seconds >= 59){
    //              if(minutesHolder.text().length == 1 || minutesHolder.text()[0] == 0 && minutesHolder.text() != 00){
    //                  minutesHolder.html('0'+minutes);
    //              } else {
    //                  minutesHolder.html(minutes);
    //              }
    //              if(hoursHolder.text().length == 1 || hoursHolder.text()[0] == 0 && hoursHolder.text() != 00){
    //                  hoursHolder.html('0'+hours);
    //              } else {
    //                  hoursHolder.html(hours);
    //              }
    //              if(daysHolder.text().length == 1 || daysHolder.text()[0] == 0 && daysHolder.text() != 00){
    //                  daysHolder.html('0'+days);
    //              } else {
    //                  daysHolder.html(days);
    //              }
    //          }

    //          secondsDiff--;
    //          productTimer.timer(secondsDiff, daysHolder, hoursHolder, minutesHolder, secondsHolder, firstLoad);
    //      }, 1000);
    //  }
    // }

    productTimer = {
        init: function(secondsDiff, id){
            daysHolder = jQuery('.timer-'+id+' .days');
            hoursHolder = jQuery('.timer-'+id+' .hours');
            minutesHolder = jQuery('.timer-'+id+' .minutes');
            secondsHolder = jQuery('.timer-'+id+' .seconds');
            timerId = jQuery('.timer-'+id);
            var firstLoad = true;
            productTimer.timer(secondsDiff, daysHolder, hoursHolder, minutesHolder, secondsHolder, timerId, firstLoad);
            setTimeout(function(){
                jQuery('.timer-box').css('display', 'block');
            }, 1100);
        },
        timer: function(secondsDiff, daysHolder, hoursHolder, minutesHolder, secondsHolder, timerId, firstLoad){
            setTimeout(function(){
                days = Math.floor(secondsDiff/86400);
                hours = Math.floor((secondsDiff/3600)%24);
                minutes = Math.floor((secondsDiff/60)%60);
                seconds = secondsDiff%60;

                jQuery(timerId).each(function(){
                   /* if (jQuery(this).closest('.product-items.owl-carousel').length == 1 && jQuery(this).closest('.owl-item.active').length == 1) {
                        currentTimer = jQuery(this);
                        secondsHolder = jQuery(currentTimer).closest('.owl-item.active').find('.timer-box .seconds');
                        secondsActive =  jQuery(secondsHolder).find('.flip-item.active');
                        secondsBefore = jQuery(secondsHolder).find('.flip-item.before');
                        if (seconds > 9) {
                            jQuery(secondsBefore).find('.flip-text').html(seconds);
                        } else {
                            jQuery(secondsBefore).find('.flip-text').html('0'+seconds);
                        }
                        secondsBefore.removeClass('before').addClass('active');
                        secondsActive.removeClass('active').addClass('before');
                    } else if(timerId.closest('.product-items.owl-carousel').length == 0) {
                        secondsHolder = jQuery(this).find('.seconds');
                        secondsActive =  jQuery(secondsHolder).find('.flip-item.active');
                        secondsBefore = jQuery(secondsHolder).find('.flip-item.before');
                        if (seconds > 9) {
                            jQuery(secondsBefore).find('.flip-text').html(seconds);
                        } else {
                            jQuery(secondsBefore).find('.flip-text').html('0'+seconds);
                        }
                        secondsBefore.removeClass('before').addClass('active');
                        secondsActive.removeClass('active').addClass('before');
                    }*/

                    secondsHolder = jQuery(this).find('.seconds');
                    secondsActive =  jQuery(secondsHolder).find('.flip-item.active');
                    secondsBefore = jQuery(secondsHolder).find('.flip-item.before');
                    if (seconds > 9) {
                        jQuery(secondsBefore).find('.flip-text').html(seconds);
                    } else {
                        jQuery(secondsBefore).find('.flip-text').html('0'+seconds);
                    }
                    secondsBefore.off().removeClass('before').addClass('active');
                    secondsActive.off().removeClass('active').addClass('before');
                });

                if(firstLoad == true){
                    if (seconds > 9) {
                        secondsHolder.find('.flip-text').html(seconds);
                    } else {
                        secondsHolder.find('.flip-text').html('0'+seconds);
                    }
                    if (days > 9) {
                        daysHolder.find('.flip-text').html(days);
                    } else {
                        daysHolder.find('.flip-text').html('0'+days);
                    }
                    if (hours > 9) {
                        hoursHolder.find('.flip-text').html(hours);
                    } else {
                        hoursHolder.find('.flip-text').html('0'+hours);
                    }
                    if (minutes > 9) {
                        minutesHolder.find('.flip-text').html(minutes);
                    } else {
                        minutesHolder.find('.flip-text').html('0'+minutes);
                    }
                    firstLoad = false;
                }
                if(seconds >= 59){
                    jQuery(timerId).each(function(){
                        currentTimer = jQuery(this);
                        minutesHolder = currentTimer.find('.minutes');
                        hoursHolder = currentTimer.find('.hours');
                        daysHolder = currentTimer.find('.days');
                        if (parseInt(minutesHolder.find('.flip-item.before .flip-up .flip-text').text()) != minutes) {
                            if (minutes > 9) {
                                minutesHolder.find('.flip-item.before .flip-text').html(minutes);
                            } else {
                                minutesHolder.find('.flip-item.before .flip-text').html('0'+minutes);
                            }
                            minutesActive =  jQuery(minutesHolder).find('.flip-item.active');
                            minutesBefore = jQuery(minutesHolder).find('.flip-item.before');
                            minutesBefore.removeClass('before').addClass('active');
                            minutesActive.removeClass('active').addClass('before');
                        }
                        if (parseInt(hoursHolder.find('.flip-item.before .flip-up .flip-text').text()) != hours) {
                            if (hours > 9) {
                                hoursHolder.find('.flip-item.before .flip-text').html(hours);
                            } else {
                                hoursHolder.find('.flip-item.before .flip-text').html('0'+hours);
                            }
                            hoursActive =  jQuery(hoursHolder).find('.flip-item.active');
                            hoursBefore = jQuery(hoursHolder).find('.flip-item.before');
                            hoursBefore.removeClass('before').addClass('active');
                            hoursActive.removeClass('active').addClass('before');
                        }
                        if (parseInt(daysHolder.find('.flip-item.before .flip-up .flip-text').text()) != days) {
                            if (days > 9) {
                                daysHolder.find('.flip-item.before .flip-text').html(days);
                            } else {
                                daysHolder.find('.flip-item.before .flip-text').html('0'+days);
                            }
                            daysHolder.find('.flip-item.before .flip-text').html(days);
                            daysActive =  jQuery(daysHolder).find('.flip-item.active');
                            daysBefore = jQuery(daysHolder).find('.flip-item.before');
                            daysBefore.removeClass('before').addClass('active');
                            daysActive.removeClass('active').addClass('before');
                        }
                    });
                }

                secondsDiff--;
                productTimer.timer(secondsDiff, daysHolder, hoursHolder, minutesHolder, secondsHolder, timerId, firstLoad);
            }, 1000);
        }
    }

    require(["MeigeeBootstrap", "meigeeCookies"], function(modal, cookie)
    {
        if(jQuery('#popup-block').length){
            // "use strict";
            function popupBlock() {
                jQuery('#popup-block').modal({
                    show: true
                });
                jQuery('html body .modal-backdrop').addClass('popup-backdrop');
                jQuery(document).on('click', '.popup-backdrop', function(){
                    jQuery('#popup-block').hide();
                    jQuery('html body .popup-backdrop').remove();
                });
            }
            subscribeFlag = jQuery.cookie('glamPopupFlag');


            jQuery('#popup-block .action.subscribe').on('click', function(){
                if(jQuery('#popup-block').find('.mage-error').length == 0 && !jQuery('#subscribecheck').attr('aria-invalid')) {
                    jQuery.cookie('glamPopupFlag2', 'true', {
                        expires: 30,
                        path: '/'
                    });
                } else {
                    jQuery.removeCookie('glamPopupFlag2');
                }
            });

            expires = jQuery('#popup-block').data('expires');
            function subsSetcookie(){
                jQuery.cookie('glamPopup', 'true', {
                    expires: ''+expires+'',
                    path: '/'
                });
            }
            if(!(subscribeFlag) && !jQuery.cookie('glamPopupFlag2')){
                popupBlock();
            }else{
                jQuery.removeCookie('glamPopupFlag', { path: '/' });
                subsSetcookie();
            }
            jQuery('#popup-block').parents('body').css({
                'padding' : 0,
                'overflow' : 'visible'
            });
            jQuery('#popup-block .popup-bottom input').on('click', function(){
                if(jQuery(this).parent().find('input:checked').length){
                    subsSetcookie();
                } else {
                    jQuery.removeCookie('glamPopup', { path: '/' });
                }
            });
            setTimeout(function(){
                jQuery('#popup-block button.close').on('click', function(){
                    jQuery.cookie('glamPopup', 'true');
                    jQuery('html body .popup-backdrop').remove();
                });
            }, 1000);
        }
    });

    require(['MeigeeBootstrap', 'MeigeeCarousel'], function(mb,mc)
    {
        bsModal = $.fn.modal.noConflict();
        jQuery(document).ready(function(){
            customHomeSlider();
            headerSliderBanner();
            accordionToggle();
            accordionIcons();
            shopByClick();
            headerCustomer();
 /*           dividePrice.init();*/
            custom_top_menu_button_listener();
            productOptions();
            alignWidgetSliderButtons();

            $(document).ajaxSuccess(function() {
              accordionToggle();
            });

            (function(n) {
                n.fn.UItoTop = function(q) {
                    var s = {
                        min: 200,
                        inDelay: 600,
                        outDelay: 400,
                        containerID: "toTop",
                        containerHoverID: "toTopHover",
                        scrollSpeed: 1200,
                        easingType: "easeInOutExpo"
                    };
                    var r = n.extend(s, q);
                    var p = "#" + r.containerID;
                    var o = "#" + r.containerHoverID;
                    n("body").append('<a href="#" id="' + r.containerID + '"></a>');
                    n(p).hide().click(function() {
                        n("html, body").animate({
                            scrollTop: 0
                        }, r.scrollSpeed, r.easingType);
                        n("#" + r.containerHoverID, this).stop().animate({
                            opacity: 0
                        }, r.inDelay, r.easingType);
                        return false
                    }).prepend('<span id="' + r.containerHoverID + '"><i class="meigee-arrow-up"></i></span>');
                    n(window).scroll(function() {
                        var t = n(window).scrollTop();
                        if (typeof document.body.style.maxHeight === "undefined") {
                            n(p).css({
                                position: "absolute",
                                top: n(window).scrollTop() + n(window).height() - 50
                            })
                        }
                        if (t > r.min) {
                            n(p).fadeIn(r.inDelay)
                        } else {
                            n(p).fadeOut(r.Outdelay)
                        }
                    })
                }
            })(jQuery);
            jQuery().UItoTop();
            /* Mobile Devices */
            if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))){
            /* Mobile Devices Class */
            jQuery('body').addClass('mobile-device');
                var mobileDevice = true;
            }else if(!navigator.userAgent.match(/Android/i)){
                var mobileDevice = false;
            }

            /* Responsive */
            var responsiveflag = false;
            var topSelectFlag = false;
            var menu_type = jQuery('#nav').attr('class');



            var isApple = false;
        /* apple position fixed fix */
        if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))){
            isApple = true;
            function stickyPosition(clear){
                items = jQuery('.header, .backstretch');
                if(clear == false){
                    topIndent = jQuery(window).scrollTop();
                    items.css({
                        'position': 'absolute',
                        'top': topIndent
                    });
                }else{
                    items.css({
                        'position': 'fixed',
                        'top': '0'
                    });
                }
            }
            jQuery('#sticky-header .form-search input').on('focusin focusout', function(){
                jQuery(this).toggleClass('focus');
                if(jQuery('header.header').hasClass('floating')){
                    if(jQuery(this).hasClass('focus')){
                        setTimeout(function(){
                            stickyPosition(false);
                        }, 500);
                    }else{
                        stickyPosition(true);
                    }
                }
            });
        }

        jQuery('.minicart-wrapper .title-cart').on('click', function(e) {
            e.preventDefault();
            if (jQuery('.header-wrapper .options-wrapper .options-block').hasClass('open')) {
                jQuery('.header-wrapper .options-wrapper .options-dropdown').slideUp(500).removeClass('open');
            }
            // jQuery('.minicart-wrapper .title-cart').trigger('click');
        });

        jQuery('.header-wrapper .block-search').each(function(){
            if(!jQuery(this).find('.indent').hasClass('visible')){
                jQuery(this).find('.indent').css({
                    'display' : 'none'
                });
                jQuery('.header-wrapper .block-search').off().on('click', function(f) {
                    jQuery('.header-wrapper .block-search').find('.indent').addClass('visible').slideDown(400);
                    jQuery(document).on("click", function(d) {
                        if (jQuery(document.body).width() > 767) {
                            if (jQuery(d.target).parents(".block-search").length == 0)
                            {
                                if (jQuery(this).find(".block-search .indent").hasClass("visible") ) {
                                    jQuery(this).find(".block-search .indent").slideUp(400).removeClass("visible");
                                }
                            }
                        }
                    })
                    jQuery(document).on("touchstart", function(d) {
                        if (jQuery(document.body).width() > 767) {
                            if (jQuery(d.target).parents(".block-search").length == 0) {
                                    if (jQuery(this).find(".block-search .indent").hasClass("visible") ) {
                                        jQuery(this).find(".block-search .indent").slideUp(400).removeClass("visible");
                                        jQuery(this).removeClass("active");
                                    }
                                }
                            }
                        })
                });
            }
        });

        jQuery(document).on('click', '.cms-customer-service .main-container a', function(event){
            event.preventDefault();
            if (jQuery("#sticky-header").length) {
                var a = jQuery("#sticky-header").height()+10;
            }
            jQuery('html, body').animate({
                scrollTop: jQuery( jQuery.attr(this, 'href') ).offset().top -a}, 500);
        });


        jQuery('.header-wrapper .options-wrapper').each(function(){
            if(!jQuery(this).find('.options-dropdown').hasClass('visible')){
                jQuery(this).find('.options-dropdown').css({
                    'display' : 'none'
                });
                jQuery('.header-wrapper .options-block').off().on('click', function(f) {
                    jQuery('.options-block').toggleClass('open');
                    jQuery('.header-wrapper').find('.options-dropdown').toggleClass('visible').slideToggle();
                    jQuery(document).on("click", function(d) {
                        if (jQuery(d.target).parents(".options-wrapper").length == 0) {
                            if (jQuery(this).find(".options-dropdown").hasClass("visible") ) {
                                jQuery('.options-block').removeClass('open');
                                jQuery(this).find(".options-dropdown").slideUp(500).removeClass("visible");
                            }
                        }
                    })
                });
            }
        });

        jQuery(".page-header .js-hamburger").on("click", function() {
            jQuery('.page-header .js-hamburger').each(function(){
                jQuery(this).toggleClass("is-active");
            });
            jQuery('.page-header .header-indent').toggleClass("is-active");
            jQuery('.page-header').toggleClass("active-header-indent");
        });


            /* sticky header */
            if(jQuery('#sticky-header').length){
                var headerHeight = jQuery('.page-header').height();
                sticky = jQuery('#sticky-header');
                jQuery(window).on('scroll', function(){
                    if(jQuery(document.body).width() > 977){
                        if(!isApple){
                            heightParam = headerHeight;
                        }else{
                            heightParam = headerHeight*2;
                        }
                        if(jQuery(this).scrollTop() >= heightParam){
                            sticky.stop().slideDown(250);
                        }
                        if(jQuery(this).scrollTop() < headerHeight ){
                            sticky.stop().hide();
                        }
                        //

                    } /* else {
                        jQuery('#sticky-header').appendTo('html');
                    } */
                });
            }
            pageNotFound();
            accordionNav();
            jQuery(window).load(function(){
                menuCategorySlider();
                accordionNav();
                backgroundWrapper();
                blockShippingToggle();
            });
			hoverImage();
            jQuery(window).resize(function(){
                pageNotFound();
                accordionNav();
                accordionToggle();
                accordionIcons();
                headerSliderBanner();
                backgroundWrapper();
                menuCategorySlider();
                alignWidgetSliderButtons();
            });

            /* Scroll To */

            function scrollToElem(elem, speed){
               jQuery("html, body").animate({ scrollTop: jQuery(elem).offset().top }, speed);
            }

            if (jQuery('.checkpoint-0').length && jQuery('#checkpoint-1').length && jQuery('.checkpoint-button').length ) {
                if(document.URL.indexOf('#customer-reviews') == -1 && !jQuery('body').hasClass('ajax-index-options')){
                    scrollToElem('.checkpoint-0', 600);
                }
                var scrollto_top = 0;
                jQuery('.checkpoint-button').click(function(){
                    if(scrollto_top == 0){
                        scrollToElem('#checkpoint-1', 500);
                        scrollto_top = 1;
                    }else{
                        scrollToElem('.checkpoint-0', 500);
                        scrollto_top = 0;
                    }
                });
            }
            function scrollAcc() {
                if (jQuery(document.body).width() <= 767 && jQuery('body').hasClass('account')) {
                    jQuery("html, body").animate({ scrollTop: jQuery(".content-inner").position().top}, 500);
                }
            }

            setTimeout(function(){
                scrollAcc();
            }, 1000);

            // Language & Currency dropdown
            $('.language-currency-block').off().on('click', function(){
                $(this).next('.language-currency-dropdown').slideToggle();
            });


            if(document.URL.indexOf("#product_tabs_reviews") != -1) {
                $('#tabs a[href="#product_tabs_reviews"]').tab('show')
            }

            jQuery.fn.scrollTo = function (target, speed) {
                if (typeof(speed) === 'undefined')
                    speed = 1000;
                jQuery('html, body').animate({
                    scrollTop: parseInt(jQuery(target).offset().top - 150)
                }, speed);
            };
            jQuery('.add-review').on('click', function(){
                jQuery(this).scrollTo('#review-form');
            });
            jQuery('.reviews-actions a').on('click', function(){
                jQuery(this).scrollTo('#product-review-container');
            });

        });
    });

    require(['jquery/ui', 'MeigeeBootstrap', 'lightBox'], function(ui, lb)
    {
        $('*[data-toggle="lightbox"]').off().on('click', function(event)
        {
            event.preventDefault();
            $(this).ekkoLightbox();
            return false;
        });
    });


});










