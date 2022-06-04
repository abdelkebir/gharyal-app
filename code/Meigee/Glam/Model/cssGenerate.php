<?php 
namespace Meigee\Glam\Model;

class cssGenerate
{
	
	public function __construct(
		\Meigee\Glam\Block\Frontend\CustomDesign $customDesign
    ) {
		$this->_customDesign = $customDesign;
    }

	public function getDesignValues($sectionId) {
		
    $general_bg = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_bg');
	$general_bg_body = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_bg_body');
	$general_border = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_border');
	$general_text_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_text_color');
	$general_page_title_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_page_title_color');
	$general_links_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_links_color_d');
	$general_links_color_h = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_links_color_h');
	$general_links_color_a = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_links_color_a');
	$general_links_color_f = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_links_color_f');

	$general_regular_price_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_regular_price_color');
	$general_special_price_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_special_price_color');
	$general_old_price_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_old_price_color');
	$general_sold_price_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_sold_price_color');

	$general_breadcrumbs_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_breadcrumbs_color_d');
	$general_breadcrumbs_color_h = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_breadcrumbs_color_h');
	$general_breadcrumbs_color_a = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_breadcrumbs_color_a');
	$general_breadcrumbs_color_f = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_breadcrumbs_color_f');
	$general_breadcrumbs_withbg_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_breadcrumbs_withbg_color_d');
	$general_breadcrumbs_withbg_color_h = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_breadcrumbs_withbg_color_h');
	$general_breadcrumbs_withbg_color_a = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_breadcrumbs_withbg_color_a');
	$general_breadcrumbs_withbg_color_f = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_breadcrumbs_withbg_color_f');

	$general_input_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_input_color');
	$general_input_bg = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_input_bg');
	$general_input_border = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_input_border');

	$general_select_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_select_color');
	$general_select_bg = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_select_bg');
	$general_select_border = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_select_border');

	$general_reviews_rating_general_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_reviews_rating_general_color');
	$general_reviews_rating_active_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_reviews_rating_active_color');
	$general_reviews_rating_links_color_hover = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_reviews_rating_links_color_hover');

	$general_btn1_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn1_color_d');
	$general_btn1_color_h = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn1_color_h');
	$general_btn1_color_a = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn1_color_a');
	$general_btn1_color_f = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn1_color_f');
	$general_btn1_bg = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn1_bg_d');
	$general_btn1_bg_h = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn1_bg_h');
	$general_btn1_bg_a = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn1_bg_a');
	$general_btn1_bg_f = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn1_bg_f');
	
	$general_btn2_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn2_color_d');
	$general_btn2_color_h = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn2_color_h');
	$general_btn2_color_a = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn2_color_a');
	$general_btn2_color_f = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn2_color_f');
	$general_btn2_bg = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn2_bg_d');
	$general_btn2_bg_h = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn2_bg_h');
	$general_btn2_bg_a = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn2_bg_a');
	$general_btn2_bg_f = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn2_bg_f');
	
	$general_btn3_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn3_color_d');
	$general_btn3_color_h = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn3_color_h');
	$general_btn3_color_a = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn3_color_a');
	$general_btn3_color_f = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn3_color_f');
	$general_btn3_bg = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn3_bg_d');
	$general_btn3_bg_h = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn3_bg_h');
	$general_btn3_bg_a = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn3_bg_a');
	$general_btn3_bg_f = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_btn3_bg_f');
	
	$general_slider_btns_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_slider_btns_color_d');
	$general_slider_btns_color_h = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_slider_btns_color_h');
	$general_slider_btns_color_a = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_slider_btns_color_a');
	$general_slider_btns_color_f = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_slider_btns_color_f');
	$general_slider_btns_bg = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_slider_btns_bg_d');
	$general_slider_btns_bg_h = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_slider_btns_bg_h');
	$general_slider_btns_bg_a = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_slider_btns_bg_a');
	$general_slider_btns_bg_f = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_slider_btns_bg_f');
	$general_slider_btns_border = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_slider_btns_border_d');
	$general_slider_btns_border_h = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_slider_btns_border_h');
	$general_slider_btns_border_a = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_slider_btns_border_a');
	$general_slider_btns_border_f = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_slider_btns_border_f');

	$general_home_subscribe_bg = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_subscribe_bg');
	$general_home_subscribe_title_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_subscribe_title_color');
	$general_home_subscribe_text_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_subscribe_text_color');
	$general_home_subscribe_input_bg = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_subscribe_input_bg');
	$general_home_subscribe_input_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_subscribe_input_color');
	$general_home_subscribe_input_border = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_subscribe_input_border');
	$general_home_subscribe_btn_bg = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_subscribe_btn_bg_d');
	$general_home_subscribe_btn_bg_h = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_subscribe_btn_bg_h');
	$general_home_subscribe_btn_bg_a = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_subscribe_btn_bg_a');
	$general_home_subscribe_btn_bg_f = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_subscribe_btn_bg_f');
	$general_home_subscribe_btn_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_subscribe_btn_color_d');
	$general_home_subscribe_btn_color_h = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_subscribe_btn_color_h');
	$general_home_subscribe_btn_color_a = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_subscribe_btn_color_a');
	$general_home_subscribe_btn_color_f = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_subscribe_btn_color_f');
	
	$general_home_slider_btns_color = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_slider_btns_color_d');
	$general_home_slider_btns_color_h = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_slider_btns_color_h');
	$general_home_slider_btns_color_a = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_slider_btns_color_a');
	$general_home_slider_btns_color_f = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_slider_btns_color_f');
	$general_home_slider_btns_bg = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_slider_btns_bg_d');
	$general_home_slider_btns_bg_h = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_slider_btns_bg_h');
	$general_home_slider_btns_bg_a = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_slider_btns_bg_a');
	$general_home_slider_btns_bg_f = $this->_customDesign->getConfigData($sectionId, 'general_options', 'general_home_slider_btns_bg_f');

	$header_bg = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_bg');
	$header_bottom_bg = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_bottom_bg');
	$header_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_color');
	$header_border = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_border');

	$header_search_menu_btn_bg = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_menu_btn_bg_d');
	$header_search_menu_btn_bg_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_menu_btn_bg_h');
	$header_search_menu_btn_bg_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_menu_btn_bg_a');
	$header_search_menu_btn_bg_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_menu_btn_bg_f');
	$header_search_menu_btn_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_menu_btn_color_d');
	$header_search_menu_btn_color_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_menu_btn_color_h');
	$header_search_menu_btn_color_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_menu_btn_color_a');
	$header_search_menu_btn_color_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_menu_btn_color_f');
	$header_search_bg = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_bg');
	$header_search_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_color');
	$header_search_border = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_border');
	$header_search_btn_bg = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_btn_bg_d');
	$header_search_btn_bg_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_btn_bg_h');
	$header_search_btn_bg_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_btn_bg_a');
	$header_search_btn_bg_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_btn_bg_f');
	$header_search_btn_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_btn_color_d');
	$header_search_btn_color_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_btn_color_h');
	$header_search_btn_color_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_btn_color_a');
	$header_search_btn_color_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_search_btn_color_f');

	$header_account_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_account_color_d');
	$header_account_color_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_account_color_h');
	$header_account_color_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_account_color_a');
	$header_account_color_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_account_color_f');
	$header_account_bg = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_account_bg_d');
	$header_account_bg_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_account_bg_h');
	$header_account_bg_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_account_bg_a');
	$header_account_bg_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_account_bg_f');

	$header_account_dropdown_bg = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_account_dropdown_bg');
	$header_account_dropdown_links_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_account_dropdown_links_color_d');
	$header_account_dropdown_links_color_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_account_dropdown_links_color_h');
	$header_account_dropdown_links_color_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_account_dropdown_links_color_a');
	$header_account_dropdown_links_color_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_account_dropdown_links_color_f');
	$header_account_dropdown_links_border = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_account_dropdown_links_border');
	$header_account_dropdown_select_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_account_dropdown_select_color');
	$header_account_dropdown_select_bg = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_account_dropdown_select_bg');
	$header_account_dropdown_select_border = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_account_dropdown_select_border');

	$header_cart_bg = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_bg_d');
	$header_cart_bg_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_bg_h');
	$header_cart_bg_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_bg_a');
	$header_cart_bg_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_bg_f');
	$header_cart_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_color_d');
	$header_cart_color_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_color_h');
	$header_cart_color_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_color_a');
	$header_cart_color_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_color_f');

	$header_cart_mobile_bg = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_mobile_bg_d');
	$header_cart_mobile_bg_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_mobile_bg_h');
	$header_cart_mobile_bg_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_mobile_bg_a');
	$header_cart_mobile_bg_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_mobile_bg_f');
	$header_cart_mobile_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_mobile_color_d');
	$header_cart_mobile_color_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_mobile_color_h');
	$header_cart_mobile_color_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_mobile_color_a');
	$header_cart_mobile_color_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_mobile_color_f');

	$header_cart_dropdown_bg = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_bg');
	$header_cart_dropdown_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_color');
	$header_cart_dropdown_title_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_title_color');
	$header_cart_dropdown_border = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_border');
	$header_cart_dropdown_actions_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_actions_color_d');
	$header_cart_dropdown_actions_color_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_actions_color_h');
	$header_cart_dropdown_actions_color_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_actions_color_a');
	$header_cart_dropdown_actions_color_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_actions_color_f');
	$header_cart_dropdown_product_price_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_product_price_color');
	$header_cart_dropdown_product_qty_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_product_qty_color');
	$header_cart_dropdown_total_price_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_total_price_color');

	$header_cart_dropdown_cart_btn_bg = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_cart_btn_bg_d');
	$header_cart_dropdown_cart_btn_bg_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_cart_btn_bg_h');
	$header_cart_dropdown_cart_btn_bg_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_cart_btn_bg_a');
	$header_cart_dropdown_cart_btn_bg_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_cart_btn_bg_f');
	$header_cart_dropdown_cart_btn_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_cart_btn_color_d');
	$header_cart_dropdown_cart_btn_color_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_cart_btn_color_h');
	$header_cart_dropdown_cart_btn_color_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_cart_btn_color_a');
	$header_cart_dropdown_cart_btn_color_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_cart_btn_color_f');

	$header_cart_dropdown_checkout_btn_bg = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_checkout_btn_bg_d');
	$header_cart_dropdown_checkout_btn_bg_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_checkout_btn_bg_h');
	$header_cart_dropdown_checkout_btn_bg_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_checkout_btn_bg_a');
	$header_cart_dropdown_checkout_btn_bg_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_checkout_btn_bg_f');
	$header_cart_dropdown_checkout_btn_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_checkout_btn_color_d');
	$header_cart_dropdown_checkout_btn_color_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_checkout_btn_color_h');
	$header_cart_dropdown_checkout_btn_color_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_checkout_btn_color_a');
	$header_cart_dropdown_checkout_btn_color_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_cart_dropdown_checkout_btn_color_f');

	$header_socials_bg = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_socials_bg_d');
	$header_socials_bg_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_socials_bg_h');
	$header_socials_bg_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_socials_bg_a');
	$header_socials_bg_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_socials_bg_f');
	$header_socials_color = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_socials_color_d');
	$header_socials_color_h = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_socials_color_h');
	$header_socials_color_a = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_socials_color_a');
	$header_socials_color_f = $this->_customDesign->getConfigData($sectionId, 'header_tabs', 'header_socials_color_f');

	$header_menu_item_bg = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_menu_item_bg_d');
	$header_menu_item_bg_h = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_menu_item_bg_h');
	$header_menu_item_bg_a = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_menu_item_bg_a');
	$header_menu_item_bg_f = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_menu_item_bg_f');
	$header_menu_item_color = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_menu_item_color_d');
	$header_menu_item_color_h = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_menu_item_color_h');
	$header_menu_item_color_a = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_menu_item_color_a');
	$header_menu_item_color_f = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_menu_item_color_f');
	$header_menu_active_item_underline = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_menu_active_item_underline');
	$header_menu_toggle_mobile = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_menu_toggle_mobile');


	$header_megamenu_topcat_bg = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_topcat_bg_d');
	$header_megamenu_topcat_bg_h = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_topcat_bg_h');
	$header_megamenu_topcat_bg_a = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_topcat_bg_a');
	$header_megamenu_topcat_bg_f = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_topcat_bg_f');
	$header_megamenu_topcat_color = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_topcat_color_d');
	$header_megamenu_topcat_color_h = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_topcat_color_h');
	$header_megamenu_topcat_color_a = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_topcat_color_a');
	$header_megamenu_topcat_color_f = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_topcat_color_f');

	$header_megamenu_subcat_bg = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_subcat_bg_d');
	$header_megamenu_subcat_bg_h = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_subcat_bg_h');
	$header_megamenu_subcat_bg_a = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_subcat_bg_a');
	$header_megamenu_subcat_bg_f = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_subcat_bg_f');
	$header_megamenu_subcat_color = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_subcat_color_d');
	$header_megamenu_subcat_color_h = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_subcat_color_h');
	$header_megamenu_subcat_color_a = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_subcat_color_a');
	$header_megamenu_subcat_color_f = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_subcat_color_f');

	$header_megamenu_dropdown_bg = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_dropdown_bg_d');
	$header_megamenu_dropdown_bg_h = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_dropdown_bg_h');
	$header_megamenu_dropdown_bg_a = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_dropdown_bg_a');
	$header_megamenu_dropdown_bg_f = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_dropdown_bg_f');
	$header_megamenu_dropdown_color = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_dropdown_color_d');
	$header_megamenu_dropdown_color_h = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_dropdown_color_h');
	$header_megamenu_dropdown_color_a = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_dropdown_color_a');
	$header_megamenu_dropdown_color_f = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_dropdown_color_f');

	$header_megamenu_vtab_bg = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_vtab_bg_d');
	$header_megamenu_vtab_bg_h = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_vtab_bg_h');
	$header_megamenu_vtab_bg_a = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_vtab_bg_a');
	$header_megamenu_vtab_bg_f = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_vtab_bg_f');
	$header_megamenu_vtab_color = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_vtab_color_d');
	$header_megamenu_vtab_color_h = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_vtab_color_h');
	$header_megamenu_vtab_color_a = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_vtab_color_a');
	$header_megamenu_vtab_color_f = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_vtab_color_f');
	$header_megamenu_vtab_border = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_vtab_border');

	$header_megamenu_htab_bg = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_htab_bg_d');
	$header_megamenu_htab_bg_h = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_htab_bg_h');
	$header_megamenu_htab_bg_a = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_htab_bg_a');
	$header_megamenu_htab_bg_f = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_htab_bg_f');
	$header_megamenu_htab_color = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_htab_color_d');
	$header_megamenu_htab_color_h = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_htab_color_h');
	$header_megamenu_htab_color_a = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_htab_color_a');
	$header_megamenu_htab_color_f = $this->_customDesign->getConfigData($sectionId, 'mega_menu_tabs', 'header_megamenu_htab_color_f');

	$footer_bg = $this->_customDesign->getConfigData($sectionId, 'footer_tabs', 'footer_bg');
	$footer_color = $this->_customDesign->getConfigData($sectionId, 'footer_tabs', 'footer_color');
	$footer_border = $this->_customDesign->getConfigData($sectionId, 'footer_tabs', 'footer_border');

	$footer_title_color = $this->_customDesign->getConfigData($sectionId, 'footer_tabs', 'footer_title_color');
	$footer_links_color_hover = $this->_customDesign->getConfigData($sectionId, 'footer_tabs', 'footer_links_color_hover');

	$footer_socials_color = $this->_customDesign->getConfigData($sectionId, 'footer_tabs', 'footer_socials_color_d');
	$footer_socials_color_h = $this->_customDesign->getConfigData($sectionId, 'footer_tabs', 'footer_socials_color_h');
	$footer_socials_color_a = $this->_customDesign->getConfigData($sectionId, 'footer_tabs', 'footer_socials_color_a');
	$footer_socials_color_f = $this->_customDesign->getConfigData($sectionId, 'footer_tabs', 'footer_socials_color_f');
	$footer_socials_bg = $this->_customDesign->getConfigData($sectionId, 'footer_tabs', 'footer_socials_bg_d');
	$footer_socials_bg_h = $this->_customDesign->getConfigData($sectionId, 'footer_tabs', 'footer_socials_bg_h');
	$footer_socials_bg_a = $this->_customDesign->getConfigData($sectionId, 'footer_tabs', 'footer_socials_bg_a');
	$footer_socials_bg_f = $this->_customDesign->getConfigData($sectionId, 'footer_tabs', 'footer_socials_bg_f');

	$general_product_name_color = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_name_color');
	$general_product_type1_cart_color = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type1_cart_color_d');
	$general_product_type1_cart_color_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type1_cart_color_h');
	$general_product_type1_cart_color_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type1_cart_color_a');
	$general_product_type1_cart_color_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type1_cart_color_f');
	$general_product_type1_cart_bg = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type1_cart_bg_d');
	$general_product_type1_cart_bg_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type1_cart_bg_h');
	$general_product_type1_cart_bg_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type1_cart_bg_a');
	$general_product_type1_cart_bg_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type1_cart_bg_f');
	$general_product_type1_addlinks_color = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type1_addlinks_color_d');
	$general_product_type1_addlinks_color_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type1_addlinks_color_h');
	$general_product_type1_addlinks_color_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type1_addlinks_color_a');
	$general_product_type1_addlinks_color_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type1_addlinks_color_f');
	$general_product_type1_addlinks_bg = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type1_addlinks_bg_d');
	$general_product_type1_addlinks_bg_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type1_addlinks_bg_h');
	$general_product_type1_addlinks_bg_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type1_addlinks_bg_a');
	$general_product_type1_addlinks_bg_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type1_addlinks_bg_f');
	$general_product_type2_cart_color = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type2_cart_color_d');
	$general_product_type2_cart_color_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type2_cart_color_h');
	$general_product_type2_cart_color_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type2_cart_color_a');
	$general_product_type2_cart_color_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type2_cart_color_f');
	$general_product_type2_cart_bg = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type2_cart_bg_d');
	$general_product_type2_cart_bg_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type2_cart_bg_h');
	$general_product_type2_cart_bg_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type2_cart_bg_a');
	$general_product_type2_cart_bg_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type2_cart_bg_f');
	$general_product_type2_addlinks_color = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type2_addlinks_color_d');
	$general_product_type2_addlinks_color_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type2_addlinks_color_h');
	$general_product_type2_addlinks_color_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type2_addlinks_color_a');
	$general_product_type2_addlinks_color_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type2_addlinks_color_f');
	$general_product_type2_addlinks_bg = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type2_addlinks_bg_d');
	$general_product_type2_addlinks_bg_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type2_addlinks_bg_h');
	$general_product_type2_addlinks_bg_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type2_addlinks_bg_a');
	$general_product_type2_addlinks_bg_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type2_addlinks_bg_f');
	$general_product_type3_cart_color = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type3_cart_color_d');
	$general_product_type3_cart_color_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type3_cart_color_h');
	$general_product_type3_cart_color_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type3_cart_color_a');
	$general_product_type3_cart_color_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type3_cart_color_f');
	$general_product_type3_cart_bg = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type3_cart_bg_d');
	$general_product_type3_cart_bg_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type3_cart_bg_h');
	$general_product_type3_cart_bg_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type3_cart_bg_a');
	$general_product_type3_cart_bg_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type3_cart_bg_f');
	$general_product_type3_addlinks_color = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type3_addlinks_color_d');
	$general_product_type3_addlinks_color_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type3_addlinks_color_h');
	$general_product_type3_addlinks_color_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type3_addlinks_color_a');
	$general_product_type3_addlinks_color_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type3_addlinks_color_f');
	$general_product_type3_addlinks_bg = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type3_addlinks_bg_d');
	$general_product_type3_addlinks_bg_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type3_addlinks_bg_h');
	$general_product_type3_addlinks_bg_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type3_addlinks_bg_a');
	$general_product_type3_addlinks_bg_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type3_addlinks_bg_f');
	$general_product_type4_cart_color = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type4_cart_color_d');
	$general_product_type4_cart_color_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type4_cart_color_h');
	$general_product_type4_cart_color_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type4_cart_color_a');
	$general_product_type4_cart_color_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type4_cart_color_f');
	$general_product_type4_cart_bg = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type4_cart_bg_d');
	$general_product_type4_cart_bg_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type4_cart_bg_h');
	$general_product_type4_cart_bg_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type4_cart_bg_a');
	$general_product_type4_cart_bg_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type4_cart_bg_f');
	$general_product_type4_addlinks_color = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type4_addlinks_color_d');
	$general_product_type4_addlinks_color_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type4_addlinks_color_h');
	$general_product_type4_addlinks_color_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type4_addlinks_color_a');
	$general_product_type4_addlinks_color_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type4_addlinks_color_f');
	$general_product_type4_addlinks_bg = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type4_addlinks_bg_d');
	$general_product_type4_addlinks_bg_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type4_addlinks_bg_h');
	$general_product_type4_addlinks_bg_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type4_addlinks_bg_a');
	$general_product_type4_addlinks_bg_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type4_addlinks_bg_f');
	$general_product_type5_cart_color = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type5_cart_color_d');
	$general_product_type5_cart_color_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type5_cart_color_h');
	$general_product_type5_cart_color_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type5_cart_color_a');
	$general_product_type5_cart_color_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type5_cart_color_f');
	$general_product_type5_cart_bg = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type5_cart_bg_d');
	$general_product_type5_cart_bg_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type5_cart_bg_h');
	$general_product_type5_cart_bg_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type5_cart_bg_a');
	$general_product_type5_cart_bg_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type5_cart_bg_f');
	$general_product_type5_addlinks_color = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type5_addlinks_color_d');
	$general_product_type5_addlinks_color_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type5_addlinks_color_h');
	$general_product_type5_addlinks_color_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type5_addlinks_color_a');
	$general_product_type5_addlinks_color_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type5_addlinks_color_f');
	$general_product_type5_addlinks_bg = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type5_addlinks_bg_d');
	$general_product_type5_addlinks_bg_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type5_addlinks_bg_h');
	$general_product_type5_addlinks_bg_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type5_addlinks_bg_a');
	$general_product_type5_addlinks_bg_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_product_type5_addlinks_bg_f');

	$general_pagination_item_color = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_pagination_item_color_d');
	$general_pagination_item_color_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_pagination_item_color_h');
	$general_pagination_item_color_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_pagination_item_color_a');
	$general_pagination_item_color_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_pagination_item_color_f');
	$general_pagination_item_bg = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_pagination_item_bg_d');
	$general_pagination_item_bg_h = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_pagination_item_bg_h');
	$general_pagination_item_bg_a = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_pagination_item_bg_a');
	$general_pagination_item_bg_f = $this->_customDesign->getConfigData($sectionId, 'category_tabs', 'general_pagination_item_bg_f');

	$cat_sidebar_border = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_border');
	$cat_sidebar_color = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_color');
	$cat_sidebar_links_color_hover = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_links_color_hover');
	$cat_sidebar_title_color = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_title_color');
	$cat_sidebar_subtitle_color = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_subtitle_color');
	$cat_sidebar_product_color = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_product_color_d');
	$cat_sidebar_product_color_h = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_product_color_h');
	$cat_sidebar_product_color_a = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_product_color_a');
	$cat_sidebar_product_color_f = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_product_color_f');

	$cat_sidebar_swatches_color = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_swatches_color_d');
	$cat_sidebar_swatches_color_h = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_swatches_color_h');
	$cat_sidebar_swatches_color_a = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_swatches_color_a');
	$cat_sidebar_swatches_color_f = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_swatches_color_f');
	$cat_sidebar_swatches_bg = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_swatches_bg_d');
	$cat_sidebar_swatches_bg_h = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_swatches_bg_h');
	$cat_sidebar_swatches_bg_a = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_swatches_bg_a');
	$cat_sidebar_swatches_bg_f = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_swatches_bg_f');
	$cat_sidebar_swatches_border = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_swatches_border_d');
	$cat_sidebar_swatches_border_h = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_swatches_border_h');
	$cat_sidebar_swatches_border_a = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_swatches_border_a');
	$cat_sidebar_swatches_border_f = $this->_customDesign->getConfigData($sectionId, 'sidebar_tabs', 'cat_sidebar_swatches_border_f');

	$productpage_info_name_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_name_color');

	$productpage_info_add_links_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_add_links_color_d');
	$productpage_info_add_links_color_h = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_add_links_color_h');
	$productpage_info_add_links_color_a = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_add_links_color_a');
	$productpage_info_add_links_color_f = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_add_links_color_f');
	$productpage_info_add_links_bg = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_add_links_bg_d');
	$productpage_info_add_links_bg_h = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_add_links_bg_h');
	$productpage_info_add_links_bg_a = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_add_links_bg_a');
	$productpage_info_add_links_bg_f = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_add_links_bg_f');
	$productpage_info_price = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_price');

	$general_product_label_sale_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'general_product_label_sale_color');
	$general_product_label_sale_bg = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'general_product_label_sale_bg');
	$general_product_label_new_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'general_product_label_new_color');
	$general_product_label_new_bg = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'general_product_label_new_bg');

	$productpage_info_cart_btn_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_cart_btn_color_d');
	$productpage_info_cart_btn_color_h = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_cart_btn_color_h');
	$productpage_info_cart_btn_color_a = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_cart_btn_color_a');
	$productpage_info_cart_btn_color_f = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_cart_btn_color_f');
	$productpage_info_cart_btn_bg = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_cart_btn_bg_d');
	$productpage_info_cart_btn_bg_h = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_cart_btn_bg_h');
	$productpage_info_cart_btn_bg_a = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_cart_btn_bg_a');
	$productpage_info_cart_btn_bg_f = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_cart_btn_bg_f');
	
	$productpage_options_label_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_options_label_color');
	$productpage_options_label_selected_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_options_label_selected_color');

	$general_product_instock_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'general_product_instock_color');
	$general_product_outofstock_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'general_product_outofstock_color');
	$general_product_availability_only_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'general_product_availability_only_color');

	$productpage_info_qty_input_bg = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_qty_input_bg');
	$productpage_info_qty_input_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_qty_input_color');
	$productpage_info_qty_input_border = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_qty_input_border');
	$productpage_info_qty_input_btns_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_qty_input_btns_color_d');
	$productpage_info_qty_input_btns_color_h = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_qty_input_btns_color_h');
	$productpage_info_qty_input_btns_color_a = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_qty_input_btns_color_a');
	$productpage_info_qty_input_btns_color_f = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_qty_input_btns_color_f');
	$productpage_info_qty_input_btns_bg = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_qty_input_btns_bg_d');
	$productpage_info_qty_input_btns_bg_h = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_qty_input_btns_bg_h');
	$productpage_info_qty_input_btns_bg_a = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_qty_input_btns_bg_a');
	$productpage_info_qty_input_btns_bg_f = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_qty_input_btns_bg_f');

	$productpage_tabs_border = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_tabs_border');
	$productpage_tabs_head_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_tabs_head_color_d');
	$productpage_tabs_head_color_h = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_tabs_head_color_h');
	$productpage_tabs_head_color_a = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_tabs_head_color_a');
	$productpage_tabs_head_color_f = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_tabs_head_color_f');
	$productpage_tabs_head_bg = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_tabs_head_bg_d');
	$productpage_tabs_head_bg_h = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_tabs_head_bg_h');
	$productpage_tabs_head_bg_a = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_tabs_head_bg_a');
	$productpage_tabs_head_bg_f = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_tabs_head_bg_f');
	$productpage_tabs_content_table_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_tabs_content_table_color');
	$productpage_tabs_content_table_bg = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_tabs_content_table_bg');

	$productpage_info_collateral_accordion_head_text_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_collateral_accordion_head_text_color');
	$productpage_info_collateral_accordion_item_bg = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_collateral_accordion_item_bg');
	$productpage_info_collateral_accordion_item_border = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_collateral_accordion_item_border');
	$productpage_info_collateral_accordion_item_shadow = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_collateral_accordion_item_shadow');
	$productpage_info_collateral_accordion_divider_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_collateral_accordion_divider_color');
	$productpage_info_collateral_accordion_content_text_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_info_collateral_accordion_content_text_color');
	$productpage_accordion_content_table_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_accordion_content_table_color');
	$productpage_accordion_content_table_bg = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_accordion_content_table_bg');

	$productpage_reviews_rating_label_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_reviews_rating_label_color');
	$productpage_reviews_title_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_reviews_title_color');
	$productpage_reviews_author_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_reviews_author_color');
	$productpage_reviews_date_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_reviews_date_color');
	$productpage_reviews_content_color = $this->_customDesign->getConfigData($sectionId, 'product_tabs', 'productpage_reviews_content_color');


			
$cssData = '
	/***** New Css styles *****/
	
	body.boxed-layout .content-wrapper > .container,
	body .content-wrapper > .container,
	body.wide-layout .breadcrumbs-wrapper.type-2 .container,
	body.boxed-layout .breadcrumbs-wrapper.type-2 .container,
	body:not(.cms-index-index) .breadcrumbs-wrapper + #maincontent .container,
	html body.cms-no-route .container {
		background-color: '.$general_bg.';
	}
	html body {
		background-color: '.$general_bg_body.';
	}
	.products-list li.item + li.item,
	.block-dashboard-orders .block-title,
	.block-dashboard-addresses .block-title,
	.block-dashboard-info .block-title,
	.block-reviews-dashboard .block-title,
	.block-dashboard-info .block-content .box.box-information,
	.block-dashboard-info .block-content .box.box-newsletter,
	.block-dashboard-addresses .block-content .box.box-billing-address,
	.block-dashboard-addresses .block-content .box.box-shipping-address,
	.box .box-title,
	.table > thead > tr > th,
	.table > tbody > tr > th,
	.table > tfoot > tr > th,
	.table > thead > tr > td,
	.table > tbody > tr > td,
	.table > tfoot > tr > td,
	.products-grid.wishlist li.product-item .product-item-actions a.btn-remove,
	#review-form,
	.bordered-wrapper,
	.products-grid .product-item-info,
	.widget-title,
	.products-grid li.item,
	body.wide-layout .footer .footer-top,
	body.boxed-layout .footer .footer-top .container,
	.products-grid .price-action-block.two-items > .price-box,
	.products-list .price-action-block.two-items > .price-box,
	.catalogsearch-advanced-result .page-title,
	.catalogsearch-result-index .page-title,
	.catalog-category-view .page-title,
	.toolbar .modes .modes-mode + .modes-mode,
	fieldset.fieldset.with-border,
	fieldset.fieldset .legend,
	.product-info-main .top-block .product-reviews-summary,
	.product-info-main .title-wrapper .price-availability-block,
	.product-info-main .product-options-wrapper .field,
	.product-info-main .product-options-wrapper .swatch-attribute,
	.review-form-wrapper .block-title,
	.reviews-wrapper .block-title,
	table.table-bordered > thead > tr > th,
	table.table-bordered > tbody > tr > th,
	table.table-bordered > tfoot > tr > th,
	table.table-bordered > thead > tr > td,
	table.table-bordered > tbody > tr > td,
	table.table-bordered > tfoot > tr > td,
	.reviews-wrapper .toolbar.review-toolbar,
	.toolbar,
	.box .box-inner,
	.review-field-rating,
	.reviews-wrapper .review-item,
	.reviews-wrapper .review-ratings,
	.reviews-wrapper .review-box,
	.reviews-wrapper .review-item .customer-info {
		border-color: '.$general_border.';
	}
	html body,
	.reviews-actions a,
	.toolbar label,
	.toolbar .label,
	.toolbar .modes i,
	.block.review-add .review-field-ratings .label,
	.review-field-rating .rating-values,
	.product-info-main .title-wrapper .add-review,
	.block-title strong,
	.block-collapsible-nav-title strong,
	.block-dashboard-orders .block-title strong,
	.block-dashboard-addresses .block-title strong,
	.block-dashboard-info .block-title strong,
	.block-reviews-dashboard .block-title strong,
	.box .box-title,
	.review-form-wrapper #review-form .review-legend,
	body .widget-title h2,
	body .widget-title h3,
	body .widget .widget-title h2,
	body .widget .widget-title h3,
	body h1,
	body h2,
	body h3,
	body h4,
	body h5,
	body h6,
	body .h1,
	body .h2,
	body .h3,
	body .h4,
	body .h5,
	body .h6 {
		color: '.$general_text_color.';
	}
	.product-info-main .sku {color: '.$general_text_color.'; opacity:0.7;}
	.page-title,
	.page-title h1,
	.catalogsearch-advanced-result .page-title,
	.catalogsearch-result-index .page-title,
	.catalog-category-view .page-title,
	.breadcrumbs-wrapper.type-2 .page-title h1,
	.breadcrumbs-wrapper.type-2 .page-title h2 {
		color: '.$general_page_title_color.';
	}
	body a,
	.v-ellipsis .read-more-link,
	#my-orders-table a,
	.account .content-inner a,
	body .review-form-wrapper #review-form .review-legend strong {
		color: '.$general_links_color.';
	}
	body a:hover,
	.v-ellipsis .read-more-link:hover,
	#my-orders-table a:hover,
	.account .content-inner a:hover,
	.reviews-wrapper .review-author strong,
	.toolbar .modes strong i {
		color: '.$general_links_color_h.';
	}
	body a:active,
	.v-ellipsis .read-more-link:active,
	#my-orders-table a:active,
	.account .content-inner a:active {
		color: '.$general_links_color_a.';
	}
	body a:focus,
	.v-ellipsis .read-more-link:focus,
	#my-orders-table a:focus,
	.account .content-inner a:focus {
		color: '.$general_links_color_f.';
	}
	.price-wrapper .price,
	.price,
	.price-wrapper .price-pennie,
	.price-wrapper .price-currency {
		color: '.$general_regular_price_color.';
	}
	.price-box .special-price .price,
	.special-price,
	.special-price .price {
		color: '.$general_special_price_color.';
	}
	.old-price .price {
		color: '.$general_old_price_color.';
	}
	.sold-out-item .price-wrapper .price, 
	.sold-out-item .price-wrapper .price-pennie,
	.sold-out-item .price-wrapper .price-currency,
	.sold-out-item .price-wrapper .old-price .price {
		color: '.$general_sold_price_color.';
	}
	ul.breadcrumb li a,
	body .breadcrumbs > .items li a,
	.breadcrumbs-wrapper .breadcrumb > li + li::before,
	body .breadcrumbs-wrapper .breadcrumbs > .items > li + li::before{
		color: '.$general_breadcrumbs_color.';
	}
	.breadcrumbs-wrapper .breadcrumb > li + li:last-of-type:before,
	body .breadcrumbs-wrapper .breadcrumbs > .items > li + li:last-of-type:before{
		color: '.$general_breadcrumbs_color.';
	}
	ul.breadcrumb li a:hover,
	body .breadcrumbs > .items li a:hover,{
		color: '.$general_breadcrumbs_color_h.';
	}
	ul.breadcrumb li a:active,
	body .breadcrumbs > .items li a:active,
	ul.breadcrumb li strong,
	body .breadcrumbs > .items li strong{
		color: '.$general_breadcrumbs_color_a.';
	}
	ul.breadcrumb li a:focus,
	body .breadcrumbs > .items li a:focus{
		color: '.$general_breadcrumbs_color_f.';
	}
	body input[type="text"],
	body input,
	body input[type="email"],
	body input[type="password"],
	body input.form-control,
	body input,
	body textarea.form-control,
	body textarea,
	.block.review-add .field.required .form-control,
	.block.review-add .form-control {
		color: '.$general_input_color.';
		background-color: '.$general_input_bg.';
		border-color: '.$general_input_border.';
	}
	body select.form-control,
	body select,
	.toolbar select.form-control,
	.toolbar select {
		color: '.$general_select_color.';
		background-color: '.$general_select_bg.';
		border-color: '.$general_select_border.';
	}
	.rating-result,
	.review-control-vote::before {
		color: '.$general_reviews_rating_general_color.';
	}
	.rating-result span,
	.review-control-vote label::before {
		color: '.$general_reviews_rating_active_color.';
	}
	.reviews-actions a:hover {
		color: '.$general_reviews_rating_links_color_hover.';
	}
	body .btn,
	body button.action,
	.actions-toolbar a.primary,
	.sidebar .block.block-compare .actions-toolbar .action,
	.sidebar .block.block-wishlist .actions-toolbar a.action.details,
	.sidebar .block.block-reorder .actions-toolbar .secondary a.action.view,
	.sidebar .block.block-reorder .actions-toolbar .primary button.action.tocart,
	.cart-container .cart.actions a.action.continue,
	body .weltpixel-quickview, button.action-primary,
	button.action-secondary, body.checkout-index-index button[type="submit"],
	.product-info-main #product-addtocart-button,
	.modal-popup button.action {
		color: '.$general_btn1_color.';
		background-color: '.$general_btn1_bg.';
	}
	body .btn:hover,
	body button.action:hover,
	.actions-toolbar a.primary:hover,
	.sidebar .block.block-compare .actions-toolbar .action:hover,
	.sidebar .block.block-wishlist .actions-toolbar a.action.details:hover,
	.sidebar .block.block-reorder .actions-toolbar .secondary a.action.view:hover,
	.sidebar .block.block-reorder .actions-toolbar .primary button.action.tocart:hover,
	.cart-container .cart.actions a.action.continue:hover,
	body .weltpixel-quickview:hover, button.action-primary:hover,
	button.action-secondary:hover, body.checkout-index-index button[type="submit"]:hover,
	.product-info-main #product-addtocart-button:hover,
	.modal-popup button.action:hover {
		color: '.$general_btn1_color_h.';
		background-color: '.$general_btn1_bg_h.';
	}
	body .btn:active,
	body button.action:active,
	.actions-toolbar a.primary:active,
	.sidebar .block.block-compare .actions-toolbar .action:active,
	.sidebar .block.block-wishlist .actions-toolbar a.action.details:active,
	.sidebar .block.block-reorder .actions-toolbar .secondary a.action.view:active,
	.sidebar .block.block-reorder .actions-toolbar .primary button.action.tocart:active,
	.cart-container .cart.actions a.action.continue:active,
	body .weltpixel-quickview:active, button.action-primary:active,
	button.action-secondary:active, body.checkout-index-index button[type="submit"]:active,
	.product-info-main #product-addtocart-button:active,
	.modal-popup button.action:active {
		color: '.$general_btn1_color_a.';
		background-color: '.$general_btn1_bg_a.';
	}
	body .btn:focus,
	body button.action:focus,
	.actions-toolbar a.primary:focus,
	.sidebar .block.block-compare .actions-toolbar .action:focus,
	.sidebar .block.block-wishlist .actions-toolbar a.action.details:focus,
	.sidebar .block.block-reorder .actions-toolbar .secondary a.action.view:focus,
	.sidebar .block.block-reorder .actions-toolbar .primary button.action.tocart:focus,
	.cart-container .cart.actions a.action.continue:focus,
	body .weltpixel-quickview:focus, button.action-primary:focus,
	button.action-secondary:focus, body.checkout-index-index button[type="submit"]:focus,
	.product-info-main #product-addtocart-button:focus,
	.modal-popup button.action:focus {
		color: '.$general_btn1_color_f.';
		background-color: '.$general_btn1_bg_f.';
	}
	.cart-container .cart.actions .action {
		color: '.$general_btn2_color.';
		background-color: '.$general_btn2_bg.';
	}
	.cart-container .cart.actions .action:hover {
		color: '.$general_btn2_color_h.';
		background-color: '.$general_btn2_bg_h.';
	}  
	.cart-container .cart.actions .action:active {
		color: '.$general_btn2_color_a.';
		background-color: '.$general_btn2_bg_a.';
	}
	.cart-container .cart.actions .action:focus {
		color: '.$general_btn2_color_f.';
		background-color: '.$general_btn2_bg_f.';
	}
	body .btn.btn-primary,
	.sidebar .block.block-reorder .actions-toolbar .primary button.action.tocart {
		color: '.$general_btn3_color.';
		background-color: '.$general_btn3_bg.';
	}
	body .btn.btn-primary:hover,
	.sidebar .block.block-reorder .actions-toolbar .primary button.action.tocart:hover {
		color: '.$general_btn3_color_h.';
		background-color: '.$general_btn3_bg_h.';
	}
	body .btn.btn-primary:active,
	.sidebar .block.block-reorder .actions-toolbar .primary button.action.tocart:active,
	body .btn.btn-primary.active,
	.sidebar .block.block-reorder .actions-toolbar .primary button.action.tocart.active {
		color: '.$general_btn3_color_a.';
		background-color: '.$general_btn3_bg_a.';
	}
	body .btn.btn-primary:focus,
	.sidebar .block.block-reorder .actions-toolbar .primary button.action.tocart:focus,
	body .btn.btn-primary.focus,
	.sidebar .block.block-reorder .actions-toolbar .primary button.action.tocart.focus {
		color: '.$general_btn3_color_f.';
		background-color: '.$general_btn3_bg_f.';
	}
	.widget-slider .products-grid .owl-nav div,
	.owl-carousel .owl-nav div {
		color: '.$general_slider_btns_color.';
		background-color: '.$general_slider_btns_bg.';
	}
	.widget-slider .products-grid .owl-nav div:hover,
	.owl-carousel .owl-nav div:hover {
		color: '.$general_slider_btns_color_h.';
		background-color: '.$general_slider_btns_bg_h.';
	}
	.widget-slider .products-grid .owl-nav div:active,
	.owl-carousel .owl-nav div:active {
		color: '.$general_slider_btns_color_a.';
		background-color: '.$general_slider_btns_bg_a.';
	}
	.widget-slider .products-grid .owl-nav div:focus,
	.owl-carousel .owl-nav div:focus {
		color: '.$general_slider_btns_color_f.';
		background-color: '.$general_slider_btns_bg_f.';
	}

	body .subscribe-block h2,
	body .subscribe-block h3 {
		color: '.$general_home_subscribe_title_color.';
	}
	body .subscribe-block .form-subscribe-header label {
		color: '.$general_home_subscribe_text_color.';
	}
	body .subscribe-block .form.subscribe input {
		background-color: '.$general_home_subscribe_input_bg.';
		border-color: '.$general_home_subscribe_input_border.';
		color: '.$general_home_subscribe_input_color.';
	}
	body .subscribe-block .form.subscribe input::-webkit-input-placeholder {
	  color: '.$general_home_subscribe_input_color.';
	}
	body .subscribe-block .form.subscribe input::-moz-placeholder {
	  color: '.$general_home_subscribe_input_color.';
	}
	body .subscribe-block .form.subscribe input:-ms-input-placeholder {
	  color: '.$general_home_subscribe_input_color.';
	}
	body .subscribe-block .form.subscribe input:-moz-placeholder {
	  color: '.$general_home_subscribe_input_color.';
	}
	body .subscribe-block .form.subscribe button {
		color: '.$general_home_subscribe_btn_color.';
		background-color: '.$general_home_subscribe_btn_bg.';
		border-color: '.$general_home_subscribe_btn_bg.';
	}
	body .subscribe-block .form.subscribe button:hover,
	body .subscribe-block .form.subscribe button.hover {
		color: '.$general_home_subscribe_btn_color_h.';
		background-color: '.$general_home_subscribe_btn_bg_h.';
	}
	body .subscribe-block .form.subscribe button:active,
	body .subscribe-block .form.subscribe button.active {
		color: '.$general_home_subscribe_btn_color_a.';
		background-color: '.$general_home_subscribe_btn_bg_a.';
	}
	body .subscribe-block .form.subscribe button:focus,
	body .subscribe-block .form.subscribe button.focus {
		color: '.$general_home_subscribe_btn_color_f.';
		background-color: '.$general_home_subscribe_btn_bg_f.';
	}
	
	#home-slider .owl-nav div {
		background-color: '.$general_home_slider_btns_bg.';
		color: '.$general_home_slider_btns_color.';
	}
	#home-slider .owl-nav div:hover {
		background-color: '.$general_home_slider_btns_bg_h.';
		color: '.$general_home_slider_btns_color_h.';
	}
	#home-slider .owl-nav div:active {
		background-color: '.$general_home_slider_btns_bg_a.';
		color: '.$general_home_slider_btns_color_a.';
	}
	#home-slider .owl-nav div:focus {
		background-color: '.$general_home_slider_btns_bg_f.';
		color: '.$general_home_slider_btns_color_f.';
	}
	
	.page-header.header-1 .top-block .container > .row:before,
	.wide-layout.cms-index-index .page-header.header-2:not(.transparent-header) .top-block,
	.boxed-layout.cms-index-index .page-header.header-2:not(.transparent-header) .top-block .container,
	.boxed-layout:not(.cms-index-index) .page-header.header-2 .top-block .container,
	.wide-layout:not(.cms-index-index) .page-header.header-2 .top-block,
	.wide-layout .page-header.header-3 .top-block,
	.boxed-layout .page-header.header-3 .top-block .container,
	.page-header.header-4 .top-block .container .row:before,
	.wide-layout .page-header.header-5 .top-block,
	.boxed-layout .page-header.header-5 .top-block .container,
	.wide-layout .page-header.header-6 .top-block,
	.boxed-layout .page-header.header-6 .top-block .container,
	.wide-layout .page-header.header-7 .top-block,
	.boxed-layout .page-header.header-7 .top-block .container,
	.wide-layout .page-header.header-8 .top-block,
	.boxed-layout .page-header.header-8 .top-block .container,
	.wide-layout .page-header.header-9 .top-block,
	.boxed-layout .page-header.header-9 .top-block,
	.boxed-layout .page-header.header-9 .top-block .container,
	body.cms-index-index .content-wrapper .container:before,
	.wide-layout.cms-index-index .page-header.header-10:not(.transparent-header) .top-block,
	.boxed-layout.cms-index-index .page-header.header-10:not(.transparent-header) .top-block .container,
	.wide-layout:not(.cms-index-index) .page-header.header-10 .top-block,
	.boxed-layout:not(.cms-index-index) .page-header.header-10 .top-block .container {
		background-color: '.$header_bg.';
	}
	.wide-layout .page-header.header-3 .middle-block,
	.boxed-layout .page-header.header-3 .middle-block .container,
	.header-wrapper .page-header.header-4 .toggle-nav {background-color: '.$header_bottom_bg.';}
	.page-header .welcome,
	body .page-header {
		color: '.$header_color.';
	}
	.page-header .action.nav-toggle {
		color: '.$header_color.';
	}
	body:not(.cms-index-index).wide-layout .page-header .top-block,
	body:not(.cms-index-index).boxed-layout .page-header .top-block .container {
		border-color: '.$header_border.';
	}
	.header-wrapper .block-search .search-button {
		background-color: '.$header_search_menu_btn_bg.';
		color: '.$header_search_menu_btn_color.';
	}
	.header-wrapper .block-search .search-button:hover {
		background-color: '.$header_search_menu_btn_bg_h.';
		color: '.$header_search_menu_btn_color_h.';
	}
	.header-wrapper .block-search .search-button:active {
		background-color: '.$header_search_menu_btn_bg_a.';
		color: '.$header_search_menu_btn_color_a.';
	}
	.header-wrapper .block-search .search-button:focus {
		background-color: '.$header_search_menu_btn_bg_f.';
		color: '.$header_search_menu_btn_color_f.';
	}
	.header-wrapper .block-search .input-group {
		background-color: '.$header_search_bg.';
		border-color: '.$header_search_border.';
	}
	.header-wrapper .page-header .block-search input {
		color: '.$header_search_color.';
	}
	.header-wrapper .page-header .block-search input::-webkit-input-placeholder {
	  color: '.$header_search_color.';
	}
	.header-wrapper .page-header .block-search input::-moz-placeholder {
	  color: '.$header_search_color.';
	}
	.header-wrapper .page-header .block-search input:-ms-input-placeholder {
	  color: '.$header_search_color.';
	}
	.header-wrapper .page-header .block-search input:-moz-placeholder {
	  color: '.$header_search_color.';
	}
	.header-wrapper .page-header .block-search .btn {
		color: '.$header_search_btn_color.';
		background-color: '.$header_search_btn_bg.';
	}
	.header-wrapper .page-header .block-search .btn:hover,
	.header-wrapper .page-header .block-search .btn.hover {
		color: '.$header_search_btn_color_h.';
		background-color: '.$header_search_btn_bg_h.';
	}
	.header-wrapper .page-header .block-search .btn:active,
	.header-wrapper .page-header .block-search .btn.active {
		color: '.$header_search_btn_color_a.';
		background-color: '.$header_search_btn_bg_a.';
	}
	.header-wrapper .page-header .block-search .btn:focus,
	.header-wrapper .page-header .block-search .btn.focus {
		color: '.$header_search_btn_color_f.';
		background-color: '.$header_search_btn_bg_f.';
	}
	
	.header-wrapper .options-wrapper .options-block {
		color: '.$header_account_color.';
		background-color: '.$header_account_bg.';
	}
	.header-wrapper .options-wrapper .options-block:hover {
		color: '.$header_account_color_h.';
		background-color: '.$header_account_bg_h.';
	}
	.header-wrapper .options-wrapper .options-block:active,
	.header-wrapper .options-wrapper .options-block.open {
		color: '.$header_account_color_a.';
		background-color: '.$header_account_bg_a.';
	}
	.header-wrapper .options-wrapper .options-block:focus {
		color: '.$header_account_color_f.';
		background-color: '.$header_account_bg_f.';
	}
	.header-wrapper .options-wrapper .options-dropdown {
		background-color: '.$header_account_dropdown_bg.';
	}
	.header-wrapper .options-wrapper .options-dropdown .links li a,
	.page-header .options-wrapper .header-switcher ul li a {
		color: '.$header_account_dropdown_links_color.';
	}
	.header-wrapper .options-wrapper .options-dropdown .links li a:hover,
	.page-header .options-wrapper .header-switcher ul li a:hover,
	.page-header .options-wrapper .header-switcher ul li span {
		color: '.$header_account_dropdown_links_color_h.';
	}
	.header-wrapper .options-wrapper .options-dropdown .links li a:active {
		color: '.$header_account_dropdown_links_color_a.';
	}
	.header-wrapper .options-wrapper .options-dropdown .links li a:focus {
		color: '.$header_account_dropdown_links_color_f.';
	}
	.header-wrapper .options-wrapper .options-dropdown .links li:not(.authorization-link) a {
		border-color: '.$header_account_dropdown_links_border.';
	}
	.page-header .header-switcher ul li a {color: '.$header_account_dropdown_select_color.'; opacity: 0.8;}
	.page-header .header-switcher ul li a:hover {opacity: 1;}
	.header-wrapper .options-wrapper .options-dropdown .header-switcher .switcher-options .action.toggle,
	.page-header .header-switcher .options .action.toggle {
		background-color: '.$header_account_dropdown_select_bg.';
		color: '.$header_account_dropdown_select_color.';
		border-color: '.$header_account_dropdown_select_border.';
	}

	.minicart-wrapper .title-cart,
	.minicart-wrapper .action.showcart {
		color: '.$header_cart_color.';
		background-color: '.$header_cart_bg.';
	}
	.minicart-wrapper .action.showcart:hover,
	.minicart-wrapper .title-cart:hover {
		color: '.$header_cart_color_h.';
		background-color: '.$header_cart_bg_h.';
	}
	.minicart-wrapper .action.showcart.active,
	.minicart-wrapper .title-cart:active {
		color: '.$header_cart_color_a.';
		background-color: '.$header_cart_bg_a.';
	}
	.minicart-wrapper .title-cart:focus {
		color: '.$header_cart_color_f.';
		background-color: '.$header_cart_bg_f.';
	}
	
	.page-header .minicart-wrapper .block-minicart {
		background-color: '.$header_cart_dropdown_bg.';
		color: '.$header_cart_dropdown_color.';
	}
	.minicart-items .product .toggle:after {color: '.$header_cart_dropdown_color.'; opacity: 0.7;}
	.block-minicart .subtotal .price-container .price-wrapper {
		background-color: '.$header_cart_dropdown_bg.';
	}
	.block-minicart .subtotal .label,
	.minicart-wrapper .product-item-name a {
		color: '.$header_cart_dropdown_color.';
	}
	.block-minicart .subtitle {
		color: '.$header_cart_dropdown_title_color.';
	}
	.page-header .block-minicart .subtotal {
		border-color: '.$header_cart_dropdown_border.';
	}
	.block-minicart .subtotal .price-container:before {
		background-color: '.$header_cart_dropdown_border.';
	}
	.page-header .minicart-items .action.edit,
	.page-header .minicart-items .action.delete {
		color: '.$header_cart_dropdown_actions_color.';
	}
	.page-header .minicart-items .action.edit:hover,
	.page-header .minicart-items .action.delete:hover {
		color: '.$header_cart_dropdown_actions_color_h.';
	}
	.page-header .minicart-items .action.edit:active,
	.page-header .minicart-items .action.delete:active {
		color: '.$header_cart_dropdown_actions_color_a.';
	}
	.page-header .minicart-items .action.edit:focus,
	.page-header .minicart-items .action.delete:focus {
		color: '.$header_cart_dropdown_actions_color_f.';
	}
	.page-header .minicart-price .price {
		color: '.$header_cart_dropdown_product_price_color.';
	}
	.page-header .minicart-items .item-qty {
		color: '.$header_cart_dropdown_product_qty_color.';
	}
	.page-header .block-minicart .subtotal .price-container .price {
		color: '.$header_cart_dropdown_total_price_color.';
	}
	.page-header .minicart-wrapper .actions div.secondary .btn {
		color: '.$header_cart_dropdown_cart_btn_color.';
		background-color: '.$header_cart_dropdown_cart_btn_bg.';
	}
	.page-header .minicart-wrapper .actions div.secondary .btn:hover, 
	.page-header .minicart-wrapper .actions div.secondary .btn.hover {
		color: '.$header_cart_dropdown_cart_btn_color_h.';
		background-color: '.$header_cart_dropdown_cart_btn_bg_h.';
	}
	.page-header .minicart-wrapper .actions div.secondary .btn:active, 
	.page-header .minicart-wrapper .actions div.secondary .btn.active {
		color: '.$header_cart_dropdown_cart_btn_color_a.';
		background-color: '.$header_cart_dropdown_cart_btn_bg_a.';
	}
	.page-header .minicart-wrapper .actions div.secondary .btn:focus, 
	.page-header .minicart-wrapper .actions div.secondary .btn.focus {
		color: '.$header_cart_dropdown_cart_btn_color_f.';
		background-color: '.$header_cart_dropdown_cart_btn_bg_a.';
	}
	.page-header .minicart-wrapper .actions div.primary .btn {
		color: '.$header_cart_dropdown_checkout_btn_color.';
		background-color: '.$header_cart_dropdown_checkout_btn_bg.';
	}
	.page-header .minicart-wrapper .actions div.primary .btn:hover,
	.page-header .minicart-wrapper .actions div.primary .btn.hover {
		color: '.$header_cart_dropdown_checkout_btn_color_h.';
		background-color: '.$header_cart_dropdown_checkout_btn_bg_h.';
	}
	.page-header .minicart-wrapper .actions div.primary .btn:active,
	.page-header .minicart-wrapper .actions div.primary .btn.active {
		color: '.$header_cart_dropdown_checkout_btn_color_a.';
		background-color: '.$header_cart_dropdown_checkout_btn_bg_a.';
	}
	.page-header .minicart-wrapper .actions div.primary .btn:focus,
	.page-header .minicart-wrapper .actions div.primary .btn.focus {
		color: '.$header_cart_dropdown_checkout_btn_color_f.';
		background-color: '.$header_cart_dropdown_checkout_btn_bg_f.';
	}
	.header-wrapper .page-header ul.social-links li a {
		color: '.$header_socials_color.';
		background-color: '.$header_socials_bg.';
	}
	.header-wrapper .page-header ul.social-links li a:hover {
		color: '.$header_socials_color_h.';
		background-color: '.$header_socials_bg_h.';
	}
	.header-wrapper .page-header ul.social-links li a:active {
		color: '.$header_socials_color_a.';
		background-color: '.$header_socials_bg_a.';
	}
	.header-wrapper .page-header ul.social-links li a:focus {
		color: '.$header_socials_color_f.';
		background-color: '.$header_socials_bg_f.';
	}

	@media only screen and (min-width: 1008px) {
		.header-wrapper .page-header .navbar-collapse.collapse a.level-top {
			background-color: '.$header_menu_item_bg.';
			color: '.$header_menu_item_color.';
		}
		.header-wrapper .page-header .navbar-collapse.collapse a.level-top .ui-menu-icon:after,
		.navigation .level0 .submenu li.parent > a:after, 
		.navbar-collapse.collapse a.level-top .ui-menu-icon:after {color: inherit; opacity: 0.6;}
		.header-wrapper .page-header .navbar-collapse.collapse a.level-top:hover,
		.header-wrapper .page-header .navbar-collapse.collapse a.level-top.ui-state-focus,
		.header-wrapper .page-header .navbar-collapse.collapse li:not(.active) > a.level-top:hover,
		.header-wrapper .page-header .navbar-collapse.collapse li:not(.active) > a.level-top.ui-state-focus {
			background-color: '.$header_menu_item_bg_h.';
			color: '.$header_menu_item_color_h.';
		}
		.header-wrapper .page-header .navigation .level0 .submenu li.parent > a:after {color: inherit; opacity: 0.6;}
		.header-wrapper .page-header .navbar-collapse.collapse a.level-top:active,
		.header-wrapper .page-header .navbar-collapse.collapse a.level-top.ui-state-active,
		.header-wrapper .page-header .navbar-collapse.collapse li.active > a.level-top,
		.header-wrapper .page-header .navbar-collapse.collapse li.active > a.level-top.ui-state-active,
		.header-wrapper .page-header .navbar-collapse.collapse li.active > a.level-top.ui-state-focus,
		.header-wrapper .page-header .navbar-collapse.collapse li:not(.active) > a.level-top.ui-state-active {
			color: '.$header_menu_item_color_a.';
		}
		.header-wrapper .page-header .navbar-collapse.collapse a.level-top:focus {
			background-color: '.$header_menu_item_bg_f.';
			color: '.$header_menu_item_color_f.';
		}
		.header-wrapper .page-header .navbar-collapse.collapse li.active a.level-top:before {
			background-color: '.$header_menu_active_item_underline.';
		}
		#sticky-megamenu .topmenu .megamenu-wrapper:not(.tabs-menu):not(.default-menu) ul.level0 li.level1 > a,
		#megamenu .topmenu .megamenu-wrapper:not(.tabs-menu):not(.default-menu) ul.level0 li.level1 > a,
		#sticky-megamenu .topmenu .megamenu-wrapper.tabs-menu ul.level0 li.level2 > a,
		#megamenu .topmenu .megamenu-wrapper.tabs-menu ul.level0 li.level2 > a {
			background-color: '.$header_megamenu_topcat_bg.';
			color: '.$header_megamenu_topcat_color.' !important;
		}
		#sticky-megamenu .topmenu .megamenu-wrapper:not(.tabs-menu):not(.default-menu) ul.level0 li.level1 > a:hover,
		#megamenu .topmenu .megamenu-wrapper:not(.tabs-menu):not(.default-menu) ul.level0 li.level1 > a:hover,
		#sticky-megamenu .topmenu .megamenu-wrapper.tabs-menu ul.level0 li.level2 > a:hover,
		#megamenu .topmenu .megamenu-wrapper.tabs-menu ul.level0 li.level2 > a:hover {
			background-color: '.$header_megamenu_topcat_bg_h.';
			color: '.$header_megamenu_topcat_color_h.' !important;
		}
		#sticky-megamenu .topmenu .megamenu-wrapper:not(.tabs-menu):not(.default-menu) ul.level0 li.level1 > a:active,
		#megamenu .topmenu .megamenu-wrapper:not(.tabs-menu):not(.default-menu) ul.level0 li.level1 > a:active,
		#sticky-megamenu .topmenu .megamenu-wrapper.tabs-menu ul.level0 li.level2 > a:active,
		#megamenu .topmenu .megamenu-wrapper.tabs-menu ul.level0 li.level2 > a:active {
			background-color: '.$header_megamenu_topcat_bg_a.';
			color: '.$header_megamenu_topcat_color_a.' !important;
		}
		#sticky-megamenu .topmenu .megamenu-wrapper:not(.tabs-menu):not(.default-menu) ul.level0 li.level1 > a:focus,
		#megamenu .topmenu .megamenu-wrapper:not(.tabs-menu):not(.default-menu) ul.level0 li.level1 > a:focus,
		#sticky-megamenu .topmenu .megamenu-wrapper.tabs-menu ul.level0 li.level2 > a:focus,
		#megamenu .topmenu .megamenu-wrapper.tabs-menu ul.level0 li.level2 > a:focus {
			background-color: '.$header_megamenu_topcat_bg_f.';
			color: '.$header_megamenu_topcat_color_f.' !important;
		}
		#sticky-megamenu .topmenu .megamenu-wrapper:not(.default-menu):not(.tabs-menu) ul.level0 li.level2 a,
		#megamenu .topmenu .megamenu-wrapper:not(.default-menu):not(.tabs-menu) ul.level0 li.level2 a,
		#sticky-megamenu .topmenu .megamenu-wrapper.tabs-menu:not(.default-menu) ul.level0 li.level3 a,
		#megamenu .topmenu .megamenu-wrapper.tabs-menu:not(.default-menu) ul.level0 li.level3 a {
			background-color: '.$header_megamenu_subcat_bg.';
			color: '.$header_megamenu_subcat_color.';
		}
		#sticky-megamenu .topmenu .megamenu-wrapper:not(.default-menu):not(.tabs-menu) ul.level0 li.level2 a:hover,
		#megamenu .topmenu .megamenu-wrapper:not(.default-menu):not(.tabs-menu) ul.level0 li.level2 a:hover,
		#sticky-megamenu .topmenu .megamenu-wrapper.tabs-menu:not(.default-menu) ul.level0 li.level3 a:hover,
		#megamenu .topmenu .megamenu-wrapper.tabs-menu:not(.default-menu) ul.level0 li.level3 a:hover {
			background-color: '.$header_megamenu_subcat_bg_h.';
			color: '.$header_megamenu_subcat_color_h.';
		}
		#sticky-megamenu .topmenu .megamenu-wrapper:not(.default-menu):not(.tabs-menu) ul.level0 li.level2 a:active,
		#megamenu .topmenu .megamenu-wrapper:not(.default-menu):not(.tabs-menu) ul.level0 li.level2 a:active,
		#sticky-megamenu .topmenu .megamenu-wrapper.tabs-menu:not(.default-menu) ul.level0 li.level3 a:active,
		#megamenu .topmenu .megamenu-wrapper.tabs-menu:not(.default-menu) ul.level0 li.level3 a:active  {
			background-color: '.$header_megamenu_subcat_bg_a.';
			color: '.$header_megamenu_subcat_color_a.';
		}
		#sticky-megamenu .topmenu .megamenu-wrapper:not(.default-menu):not(.tabs-menu) ul.level0 li.level2 a:focus,
		#megamenu .topmenu .megamenu-wrapper:not(.default-menu):not(.tabs-menu) ul.level0 li.level2 a:focus,
		#sticky-megamenu .topmenu .megamenu-wrapper.tabs-menu:not(.default-menu) ul.level0 li.level3 a:focus,
		#megamenu .topmenu .megamenu-wrapper.tabs-menu:not(.default-menu) ul.level0 li.level3 a:focus {
			background-color: '.$header_megamenu_subcat_bg_f.';
			color: '.$header_megamenu_subcat_color_f.';
		}
		.navigation .level0 .submenu {
			background-color: '.$header_megamenu_dropdown_bg.';
		}
		.navigation .level0 .submenu a {
			color: '.$header_megamenu_dropdown_color.';
		}
		.navigation .level0 .submenu a:hover,
		.navigation .level0 .submenu a.ui-state-focus {
			color: '.$header_megamenu_dropdown_color_h.';
			background-color: '.$header_megamenu_dropdown_bg_h.';
		}
		.navigation .level0 .submenu a:active,
		.navigation .level0 .submenu a.ui-state-active {
			color: '.$header_megamenu_dropdown_color_a.';
			background-color: '.$header_megamenu_dropdown_bg_a.';
		}
		.navigation .level0 .submenu a:focus {
			color: '.$header_megamenu_dropdown_color_f.';
			background-color: '.$header_megamenu_dropdown_bg_f.';
		}
		#sticky-megamenu .topmenu ul.level0:not(.default-menu) li.level1 > a span,
		#megamenu .topmenu ul.level0:not(.default-menu) li.level1 > a span {color: inherit;}
		.megamenu .megamenu-wrapper.tabs-menu.vertical:before {
			background-color: '.$header_megamenu_vtab_bg.';
		}
		#megamenu .megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0 li.level1:hover,
		#sticky-megamenu .megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0 li.level1:hover {
			background-color: '.$header_megamenu_vtab_bg_h.';
		}
		#megamenu .megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0 li.level1:active,
		#sticky-megamenu .megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0 li.level1:active {
			background-color: '.$header_megamenu_vtab_bg_a.';
		}
		#megamenu .megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0 li.level1:focus,
		#sticky-megamenu .megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0 li.level1:focus {
			background-color: '.$header_megamenu_vtab_bg_f.';
		}
		#megamenu .megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0 li.level1 > a,
		#sticky-megamenu .megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0 li.level1 > a {
			color: '.$header_megamenu_vtab_color.' !important;
		}
		.megamenu .megamenu-wrapper.tabs-menu.vertical li.level1.parent > a:after {
			border-left-color: '.$header_megamenu_vtab_color.';
			opacity: 0.7;
		}
		#megamenu .megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0 li.level1:hover > a,
		#sticky-megamenu .megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0 li.level1:hover > a,
		#megamenu .megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0 li.level1 > a:hover,
		#sticky-megamenu .megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0 li.level1 > a:hover {
			color: '.$header_megamenu_vtab_color_h.' !important;
		}
		.megamenu .megamenu-wrapper.tabs-menu.vertical li.level1.parent:hover > a:after {
			border-left-color: '.$header_megamenu_vtab_color_h.';
		}
		#megamenu .megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0 li.level1 > a:active,
		#sticky-megamenu .megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0 li.level1 > a:active {
			color: '.$header_megamenu_vtab_color_a.' !important;
		}
		.megamenu .megamenu-wrapper.tabs-menu.vertical li.level1.parent:active > a:after {
			border-left-color: '.$header_megamenu_vtab_color_a.';
		}
		#megamenu .megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0 li.level1 > a:focus,
		#sticky-megamenu .megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0 li.level1 > a:focus {
			color: '.$header_megamenu_vtab_color_f.' !important;
		}
		.megamenu .megamenu-wrapper.tabs-menu.vertical li.level1.parent:focus > a:after {
			border-left-color: '.$header_megamenu_vtab_color_f.';
		}
		#sticky-megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0:not(.default-menu) li.level1:not(.last) > a,
		#megamenu .megamenu-wrapper.tabs-menu.vertical ul.level0:not(.default-menu) li.level1:not(.last) > a {
			border-color: '.$header_megamenu_vtab_border.';
		}
		.megamenu .megamenu-wrapper.tabs-menu:not(.vertical):before {
			background-color: '.$header_megamenu_htab_bg.';
		}
		#megamenu .megamenu .megamenu-wrapper.tabs-menu ul.level0 li.level1:hover,
		#sticky-megamenu .megamenu .megamenu-wrapper.tabs-menu ul.level0 li.level1:hover {
			background-color: '.$header_megamenu_htab_bg_h.';
		}
		#megamenu .megamenu .megamenu-wrapper.tabs-menu ul.level0 li.level1:active,
		#sticky-megamenu .megamenu .megamenu-wrapper.tabs-menu ul.level0 li.level1:active {
			background-color: '.$header_megamenu_htab_bg_a.';
		}
		#megamenu .megamenu .megamenu-wrapper.tabs-menu ul.level0 li.level1:focus,
		#sticky-megamenu .megamenu .megamenu-wrapper.tabs-menu ul.level0 li.level1:focus {
			background-color: '.$header_megamenu_htab_bg_f.';
		}
		#megamenu .megamenu .megamenu-wrapper.tabs-menu ul.level0 li.level1 > a,
		#sticky-megamenu .megamenu .megamenu-wrapper.tabs-menu ul.level0 li.level1 > a {
			color: '.$header_megamenu_htab_color.' !important;
			background-color: transparent
		}
		#megamenu .megamenu .megamenu-wrapper.tabs-menu ul.level0 li.level1:hover > a,
		#sticky-megamenu .megamenu .megamenu-wrapper.tabs-menu ul.level0 li.level1:hover > a,
		#megamenu .megamenu .megamenu-wrapper.tabs-menu ul.level0 li.level1 > a:hover,
		#sticky-megamenu .megamenu .megamenu-wrapper.tabs-menu ul.level0 li.level1 > a:hover {
			color: '.$header_megamenu_htab_color_h.' !important;
		}
		#megamenu .megamenu .megamenu-wrapper.tabs-menu ul.level0 li.level1:active > a,
		#sticky-megamenu .megamenu .megamenu-wrapper.tabs-menu ul.level0 li.level1:active > a {
			color: '.$header_megamenu_htab_color_a.' !important;
		}
		#megamenu .megamenu .megamenu-wrapper.tabs-menu ul.level0 li.level1:focus > a,
		#sticky-megamenu .megamenu .megamenu-wrapper.tabs-menu ul.level0 li.level1:focus > a {
			color: '.$header_megamenu_htab_color_f.' !important;
		}
	}
	@media only screen and (min-width: 768px) and (max-width: 1007px) {
		.page-header.header-3 .action.nav-toggle,
		.page-header.header-4 .action.nav-toggle {
			background-color: '.$header_menu_item_bg.';
			color: '.$header_menu_item_color.';
		}
	}
	@media only screen and (max-width: 767px) {
		.wide-layout .page-header.header-3 .middle-block,
		.boxed-layout .page-header.header-3 .middle-block .container,
		.header-wrapper .page-header.header-4 .toggle-nav {background-color: '.$header_bg.';}
		.page-header[class*="header-"] .action.nav-toggle {color: '.$header_menu_toggle_mobile.';}
		.minicart-wrapper .title-cart,
		.minicart-wrapper .action.showcart {
			color: '.$header_cart_mobile_color.';
			background-color: '.$header_cart_mobile_bg.';
		}
		.minicart-wrapper .action.showcart:hover,
		.minicart-wrapper .title-cart:hover {
			color: '.$header_cart_mobile_color_h.';
			background-color: '.$header_cart_mobile_bg_h.';
		}
		.minicart-wrapper .action.showcart.active,
		.minicart-wrapper .title-cart:active {
			color: '.$header_cart_mobile_color_a.';
			background-color: '.$header_cart_mobile_bg_a.';
		}
		.minicart-wrapper .title-cart:focus {
			color: '.$header_cart_mobile_color_f.';
			background-color: '.$header_cart_mobile_bg_f.';
		}
	}

	body.wide-layout .footer .footer-top,
	body.boxed-layout .footer .footer-top .container,
	body.wide-layout .footer .footer-middle,
	body.boxed-layout .footer .footer-middle .container,
	body.wide-layout .footer .footer-bottom,
	body.boxed-layout .footer .footer-bottom .container,
	body.boxed-layout .footer .container {
		background: '.$footer_bg.';
	}
	.footer,
	.page-footer .switcher .options strong {
		color: '.$footer_color.';
	}
	.footer .horizontal-links li:not(:first-of-type) a:before {
		background-color: '.$footer_color.';
	}
	.page-footer .switcher .options .action.toggle:after,
	.page-header .header-switcher .options .action.toggle:hover:after,
	.page-footer .switcher .options .action.toggle:hover:after {color: '.$footer_color.'; opacity: 0.7;}
	.footer hr.solid,
	.footer hr.dotted,
	.footer hr.dashed,
	.page-footer .switcher .options .action.toggle {
		border-color: '.$footer_border.';
	}
	body.wide-layout .footer .footer-bottom,
	body.boxed-layout .footer .footer-bottom .container,
	body.wide-layout .footer .footer-middle .container,
	body.boxed-layout .footer .footer-middle .container,
	body.wide-layout:not(.cms-index-index) .footer .footer-top,
	body.boxed-layout:not(.cms-index-index) .footer .footer-top .container {
		border-color: '.$footer_border.';
	}
	.footer .footer-block-title,
	.footer .copyright,
	.footer .switcher .label,
	.footer .form-language .label,
	.footer .form-currency .label {
		color: '.$footer_title_color.';
	}
	.footer a:hover,
	.footer a:focus,
	.footer a:active,
	.footer .links a:hover,
	.footer .horizontal-links li a:hover {
		color: '.$footer_links_color_hover.';
	}
	.footer .links a:hover:before,
	.footer .links a:active:before,
	.footer .horizontal-links li a:hover:after,
	.footer .horizontal-links li a:active:after {
		background-color: '.$footer_links_color_hover.';
		opacity: 0.7;
	}
	body .footer ul.social-links li a {
		color: '.$footer_socials_color.';
		background-color: '.$footer_socials_bg.';
	}
	body .footer ul.social-links li a:hover {
		color: '.$footer_socials_color_h.';
		background-color: '.$footer_socials_bg_h.';
	}
	body .footer ul.social-links li a:active {
		color: '.$footer_socials_color_a.';
		background-color: '.$footer_socials_bg_a.';
	}
	body .footer ul.social-links li a:focus {
		color: '.$footer_socials_color_f.';
		background-color: '.$footer_socials_bg_f.';
	}
	
	.products-grid .product-item-name a,
	.products-list .product-item-name a,
	.products-grid .product-item-name a:hover,
	.products-list .product-item-name a:hover {
		color: '.$general_product_name_color.';
	}
	.products-grid.product-hover-1 .btn,
	.products-list.product-hover-1 .btn {
		background-color: '.$general_product_type1_cart_bg.';
		color: '.$general_product_type1_cart_color.';
	}
	.product-hover-1 .product-items .btn.btn-default:hover {
		background-color: '.$general_product_type1_cart_bg_h.';
		color: '.$general_product_type1_cart_color_h.';
	}
	body .hover-buttons .add-to-links i,
	body .hover-buttons .weltpixel-quickview i,
	.hover-buttons .lightbox-button i {
		color: inherit;
	}
	.product-hover-1 .product-items .btn.btn-default:active,
	.product-hover-1 .product-items .btn.btn-default.active{
		background-color: '.$general_product_type1_cart_bg_a.';
		color: '.$general_product_type1_cart_color_a.';
	}
	.product-hover-1 .product-items .btn.btn-default:focus,
	.product-hover-1 .product-items .btn.btn-default.focus {
		background-color: '.$general_product_type1_cart_bg_f.';
		color: '.$general_product_type1_cart_color_f.';
	}
	body .product-hover-1 .hover-buttons .add-to-links a,
	body .product-hover-1 .hover-buttons .weltpixel-quickview,
	.product-hover-1 .hover-buttons .lightbox-button {
		background-color: '.$general_product_type1_addlinks_bg.';
		color: '.$general_product_type1_addlinks_color.';
	}
	body .product-hover-1 .hover-buttons .add-to-links a:hover,
	body .product-hover-1 .hover-buttons .weltpixel-quickview:hover,
	.product-hover-1 .hover-buttons .lightbox-button:hover {
		background-color: '.$general_product_type1_addlinks_bg_h.';
		color: '.$general_product_type1_addlinks_color_h.';
	}
	body .product-hover-1 .hover-buttons .add-to-links a:active,
	body .product-hover-1 .hover-buttons .weltpixel-quickview:active,
	.product-hover-1 .hover-buttons .lightbox-button:active {
		background-color: '.$general_product_type1_addlinks_bg_a.';
		color: '.$general_product_type1_addlinks_color_a.';
	}
	body .product-hover-1 .hover-buttons .add-to-links a:focus,
	body .product-hover-1 .hover-buttons .weltpixel-quickview:focus,
	.product-hover-1 .hover-buttons .lightbox-button:focus {
		background-color: '.$general_product_type1_addlinks_bg_f.';
		color: '.$general_product_type1_addlinks_color_f.';
	}
	.product-hover-2 .hover-buttons .btn {
		background-color: '.$general_product_type2_cart_bg.';
		color: '.$general_product_type2_cart_color.';
	}
	.product-hover-2 .hover-buttons .btn:hover {
		background-color: '.$general_product_type2_cart_bg_h.';
		color: '.$general_product_type2_cart_color_h.';
	}
	.product-hover-2 .hover-buttons .btn:active {
		background-color: '.$general_product_type2_cart_bg_a.';
		color: '.$general_product_type2_cart_color_a.';
	}
	.product-hover-2 .hover-buttons .btn:focus {
		background-color: '.$general_product_type2_cart_bg_f.';
		color: '.$general_product_type2_cart_color_f.';
	}
	.product-hover-2 .hover-buttons .lightbox-button,
	.product-hover-2 .hover-buttons .weltpixel-quickview,
	.product-hover-2 .hover-buttons .add-to-links a,
	.products-grid:not(.product-items-grid).product-hover-2 .add-to-links a:not(.btn-default),
	.products-list.product-hover-2 .add-to-links a:not(.btn-default),
	.footer-products-list .product-hover-2 .add-to-links a:not(.btn-default) {
		background-color: '.$general_product_type2_addlinks_bg.';
		color: '.$general_product_type2_addlinks_color.';
	}
	.product-hover-2 .hover-buttons .lightbox-button:hover,
	.product-hover-2 .hover-buttons .weltpixel-quickview:hover,
	.product-hover-2 .hover-buttons .add-to-links a:hover,
	.products-grid:not(.product-items-grid).product-hover-2 .add-to-links a:not(.btn-default):hover,
	.products-list.product-hover-2 .add-to-links a:not(.btn-default):hover,
	.footer-products-list .product-hover-2 .add-to-links a:not(.btn-default):hover {
		background-color: '.$general_product_type2_addlinks_bg_h.';
		color: '.$general_product_type2_addlinks_color_h.';
	}
	.product-hover-2 .hover-buttons .lightbox-button:active,
	.product-hover-2 .hover-buttons .weltpixel-quickview:active,
	.product-hover-2 .hover-buttons .add-to-links a:active,
	.products-grid:not(.product-items-grid).product-hover-2 .add-to-links a:not(.btn-default):active,
	.products-list.product-hover-2 .add-to-links a:not(.btn-default):active,
	.footer-products-list .product-hover-2 .add-to-links a:not(.btn-default):active {
		background-color: '.$general_product_type2_addlinks_bg_a.';
		color: '.$general_product_type2_addlinks_color_a.';
	}
	.product-hover-2 .hover-buttons .lightbox-button:focus,
	.product-hover-2 .hover-buttons .weltpixel-quickview:focus,
	.product-hover-2 .hover-buttons .add-to-links a:focus,
	.products-grid:not(.product-items-grid).product-hover-2 .add-to-links a:not(.btn-default):focus,
	.products-list.product-hover-2 .add-to-links a:not(.btn-default):focus,
	.footer-products-list .product-hover-2 .add-to-links a:not(.btn-default):focus {
		background-color: '.$general_product_type2_addlinks_bg_f.';
		color: '.$general_product_type2_addlinks_color_f.';
	}
	.product-hover-3 .btn {
		background-color: '.$general_product_type3_cart_bg.';
		color: '.$general_product_type3_cart_color.';
	}
	.product-hover-3 .btn:hover {
		background-color: '.$general_product_type3_cart_bg_h.';
		color: '.$general_product_type3_cart_color_h.';
	}
	.product-hover-3 .btn:active {
		background-color: '.$general_product_type3_cart_bg_a.';
		color: '.$general_product_type3_cart_color_a.';
	}
	.product-hover-3 .btn:focus {
		background-color: '.$general_product_type3_cart_bg_f.';
		color: '.$general_product_type3_cart_color_f.';
	}
	body .product-hover-3 .hover-buttons .add-to-links a,
	body .product-hover-3 .hover-buttons .weltpixel-quickview,
	.product-hover-3 .hover-buttons .lightbox-button,
	.products-grid:not(.product-items-grid).product-hover-3 .add-to-links a:not(.btn-default),
	.products-list.product-hover-3 .add-to-links a:not(.btn-default),
	.footer-products-list .product-hover-3 .add-to-links a:not(.btn-default) {
		background-color: '.$general_product_type3_addlinks_bg.';
		color: '.$general_product_type3_addlinks_color.';
	}
	body .product-hover-3 .hover-buttons .add-to-links a:hover,
	body .product-hover-3 .hover-buttons .weltpixel-quickview:hover,
	.product-hover-3 .hover-buttons .lightbox-button:hover,
	.products-grid:not(.product-items-grid).product-hover-3 .add-to-links a:not(.btn-default):hover,
	.products-list.product-hover-3 .add-to-links a:not(.btn-default):hover,
	.footer-products-list .product-hover-3 .add-to-links a:not(.btn-default):hover {
		background-color: '.$general_product_type3_addlinks_bg_h.';
		color: '.$general_product_type3_addlinks_color_h.';
	}
	body .product-hover-3 .hover-buttons .add-to-links a:active,
	body .product-hover-3 .hover-buttons .weltpixel-quickview:active,
	.product-hover-3 .hover-buttons .lightbox-button:active,
	.products-grid:not(.product-items-grid).product-hover-3 .add-to-links a:not(.btn-default):active,
	.products-list.product-hover-3 .add-to-links a:not(.btn-default):active,
	.footer-products-list .product-hover-3 .add-to-links a:not(.btn-default):active {
		background-color: '.$general_product_type3_addlinks_bg_a.';
		color: '.$general_product_type3_addlinks_color_a.';
	}
	body .product-hover-3 .hover-buttons .add-to-links a:focus,
	body .product-hover-3 .hover-buttons .weltpixel-quickview:focus,
	.product-hover-3 .hover-buttons .lightbox-button:focus,
	.products-grid:not(.product-items-grid).product-hover-3 .add-to-links a:not(.btn-default):focus,
	.products-list.product-hover-3 .add-to-links a:not(.btn-default):focus,
	.footer-products-list .product-hover-3 .add-to-links a:not(.btn-default):focus {
		background-color: '.$general_product_type3_addlinks_bg_f.';
		color: '.$general_product_type3_addlinks_color_f.';
	}
	.product-hover-4 .btn {
		background-color: '.$general_product_type4_cart_bg.';
		color: '.$general_product_type4_cart_color.';
	}
	.product-hover-4 .btn:hover {
		background-color: '.$general_product_type4_cart_bg_h.';
		color: '.$general_product_type4_cart_color_h.';
	}
	.product-hover-4 .btn:active {
		background-color: '.$general_product_type4_cart_bg_a.';
		color: '.$general_product_type4_cart_color_a.';
	}
	.product-hover-4 .btn:focus {
		background-color: '.$general_product_type4_cart_bg_f.';
		color: '.$general_product_type4_cart_color_f.';
	}
	.product-hover-4 .hover-buttons {
		background-color: '.$general_product_type4_addlinks_bg.';
	}
	body .product-hover-4 .hover-buttons .add-to-links a,
	body .product-hover-4 .hover-buttons .weltpixel-quickview,
	.product-hover-4 .hover-buttons .lightbox-button,
	.products-grid:not(.product-items-grid).product-hover-4 .add-to-links a:not(.btn-default),
	.products-list.product-hover-4 .add-to-links a:not(.btn-default),
	.footer-products-list .product-hover-4.add-to-links a:not(.btn-default) {
		background-color: transparent;
		color: '.$general_product_type4_addlinks_color.';
	}
	body .product-hover-4 .hover-buttons .add-to-links a:hover,
	body .product-hover-4 .hover-buttons .weltpixel-quickview:hover,
	.product-hover-4 .hover-buttons .lightbox-button:hover,
	.products-grid:not(.product-items-grid).product-hover-4 .add-to-links a:not(.btn-default):hover,
	.products-list.product-hover-4 .add-to-links a:not(.btn-default):hover,
	.footer-products-list .product-hover-4.add-to-links a:not(.btn-default):hover {
		background-color: '.$general_product_type4_addlinks_bg_h.';
		color: '.$general_product_type4_addlinks_color_h.';
	}
	body .product-hover-4 .hover-buttons .add-to-links a:active,
	body .product-hover-4 .hover-buttons .weltpixel-quickview:active,
	.product-hover-4 .hover-buttons .lightbox-button:active,
	.products-grid:not(.product-items-grid).product-hover-4 .add-to-links a:not(.btn-default):active,
	.products-list.product-hover-4 .add-to-links a:not(.btn-default):active,
	.footer-products-list .product-hover-4.add-to-links a:not(.btn-default):active {
		background-color: '.$general_product_type4_addlinks_bg_a.';
		color: '.$general_product_type4_addlinks_color_a.';
	}
	body .product-hover-4 .hover-buttons .add-to-links a:focus,
	body .product-hover-4 .hover-buttons .weltpixel-quickview:focus,
	.product-hover-4 .hover-buttons .lightbox-button:focus,
	.products-grid:not(.product-items-grid).product-hover-4 .add-to-links a:not(.btn-default):focus,
	.products-list.product-hover-4 .add-to-links a:not(.btn-default):focus,
	.footer-products-list .product-hover-4.add-to-links a:not(.btn-default):focus {
		background-color: '.$general_product_type4_addlinks_bg_f.';
		color: '.$general_product_type4_addlinks_color_f.';
	}

	.product-hover-5 .btn {
		background-color: '.$general_product_type5_cart_bg.';
		color: '.$general_product_type5_cart_color.';
	}
	.product-hover-5 .btn:hover {
		background-color: '.$general_product_type5_cart_bg_h.';
		color: '.$general_product_type5_cart_color_h.';
	}
	.product-hover-5 .btn:active {
		background-color: '.$general_product_type5_cart_bg_a.';
		color: '.$general_product_type5_cart_color_a.';
	}
	.product-hover-5 .btn:focus {
		background-color: '.$general_product_type5_cart_bg_f.';
		color: '.$general_product_type5_cart_color_f.';
	}
	body .product-hover-5 .hover-buttons .add-to-links a,
	body .product-hover-5 .hover-buttons .weltpixel-quickview,
	.product-hover-5 .hover-buttons .lightbox-button,
	.products-grid:not(.product-items-grid).product-hover-5 .add-to-links a:not(.btn-default),
	.products-list.product-hover-5 .add-to-links a:not(.btn-default),
	.footer-products-list .product-hover-5 .add-to-links a:not(.btn-default) {
		background-color: '.$general_product_type5_addlinks_bg.';
		color: '.$general_product_type5_addlinks_color.';
	}
	body .product-hover-5 .hover-buttons .add-to-links a:hover,
	body .product-hover-5 .hover-buttons .weltpixel-quickview:hover,
	.product-hover-5 .hover-buttons .lightbox-button:hover,
	.products-grid:not(.product-items-grid).product-hover-5 .add-to-links a:not(.btn-default):hover,
	.products-list.product-hover-5 .add-to-links a:not(.btn-default):hover,
	.footer-products-list .product-hover-5 .add-to-links a:not(.btn-default):hover {
		background-color: '.$general_product_type5_addlinks_bg_h.';
		color: '.$general_product_type5_addlinks_color_h.';
	}
	body .product-hover-5 .hover-buttons .add-to-links a:active,
	body .product-hover-5 .hover-buttons .weltpixel-quickview:active,
	.product-hover-5 .hover-buttons .lightbox-button:active,
	.products-grid:not(.product-items-grid).product-hover-5 .add-to-links a:not(.btn-default):active,
	.products-list.product-hover-5 .add-to-links a:not(.btn-default):active,
	.footer-products-list .product-hover-5 .add-to-links a:not(.btn-default):active {
		background-color: '.$general_product_type5_addlinks_bg_a.';
		color: '.$general_product_type5_addlinks_color_a.';
	}
	body .product-hover-5 .hover-buttons .add-to-links a:focus,
	body .product-hover-5 .hover-buttons .weltpixel-quickview:focus,
	.product-hover-5 .hover-buttons .lightbox-button:focus,
	.products-grid:not(.product-items-grid).product-hover-5 .add-to-links a:not(.btn-default):focus,
	.products-list.product-hover-5 .add-to-links a:not(.btn-default):focus,
	.footer-products-list .product-hover-5 .add-to-links a:not(.btn-default):focus {
		background-color: '.$general_product_type5_addlinks_bg_f.';
		color: '.$general_product_type5_addlinks_color_f.';
	}

	.toolbar .pagination > li > a,
	.toolbar .pagination > li > span {
		color: '.$general_pagination_item_color.';
		background-color: '.$general_pagination_item_bg.';
	}
	.toolbar .pagination > li > a:hover,
	.toolbar .pagination > li > span:hover {
		color: '.$general_pagination_item_color_h.';
		background-color: '.$general_pagination_item_bg_h.';
	}
	.toolbar .pagination > .active > a,
	.toolbar .pagination > .active > span {
		color: '.$general_pagination_item_color_a.';
		background-color: '.$general_pagination_item_bg_a.';
	}
	.toolbar .pagination > li > a:focus,
	.toolbar .pagination > li > span:focus {
		color: '.$general_pagination_item_color_f.';
		background-color: '.$general_pagination_item_bg_f.';
	}

	/*Sidebar*/
	.sidebar .meigee-instagram-widget,
	.sidebar .block li + li,
	.sidebar .block .actions-toolbar {
		border-color: '.$cat_sidebar_border.';
	}
	.sidebar .block {
		color: '.$cat_sidebar_color.';
	}
	.sidebar .block.filter ol li a,
	.sidebar .block li a {
		color: '.$cat_sidebar_color.';
	}
	.sidebar .block li a:hover,
	.sidebar .block.filter ol li a:hover,
	.sidebar .block.account-nav li strong,
	.sidebar .block.account-nav li a:hover,
	.sidebar .block li a.delete:hover,
	.sidebar .block.block-wishlist .product-item-details .product-item-actions .action.tocart:hover::before,
	.sidebar .block.block-compare .action.delete:hover,
	.sidebar .block.block-wishlist .product-item-details .product-item-actions a.btn-remove:hover::before,
	.sidebar .block.block-wishlist .product-item-details .product-item-actions .action.tocart:hover::before {
		color: '.$cat_sidebar_links_color_hover.';
	}
	.sidebar .block .block-title strong,
	#layered-filter-block.block .block-title strong,
	.block-collapsible-nav-title strong,
	.sidebar .block.filter .block-title,
	.sidebar .block .block-title,
	.block-collapsible-nav-title {
		color: '.$cat_sidebar_title_color.';
	}
	.sidebar .block.filter .filter-options-title,
	.sidebar .subtitle {
		color: '.$cat_sidebar_subtitle_color.';
	}
	.sidebar .block.block-wishlist .product-item-details .product-item-name a,
	.sidebar .product-item-name a {
		color: '.$cat_sidebar_product_color.';	
	}
	.sidebar .block.block-wishlist .product-item-details .product-item-name a:hover,
	.sidebar .product-item-name a:hover {
		color: '.$cat_sidebar_product_color_h.';	
	}
	.sidebar .block.block-wishlist .product-item-details .product-item-name a:active,
	.sidebar .product-item-name a:active {
		color: '.$cat_sidebar_product_color_a.';	
	}
	.sidebar .block.block-wishlist .product-item-details .product-item-name a:focus,
	.sidebar .product-item-name a:focus {
		color: '.$cat_sidebar_product_color_f.';	
	}

	.sidebar .block.filter .swatch-attribute-options .swatch-option.text,
	body .swatch-attribute .swatch-option.text {
		color: '.$cat_sidebar_swatches_color.';
		border-color: '.$cat_sidebar_swatches_border.';
		background-color: '.$cat_sidebar_swatches_bg.';
	}
	.sidebar .block.filter .swatch-attribute-options .swatch-option.text:hover,
	body .swatch-attribute .swatch-option.text:hover {
		color: '.$cat_sidebar_swatches_color_h.';
		border-color: '.$cat_sidebar_swatches_border_h.';
		background-color: '.$cat_sidebar_swatches_bg_h.';
	}
	.sidebar .block.filter .swatch-attribute-options .swatch-option.text:active,
	body .swatch-attribute .swatch-option.text:active {
		color: '.$cat_sidebar_swatches_color_a.';
		border-color: '.$cat_sidebar_swatches_border_a.';
		background-color: '.$cat_sidebar_swatches_bg_a.';
	}
	.sidebar .block.filter .swatch-attribute-options .swatch-option.text:focus,
	body .swatch-attribute .swatch-option.text:focus {
		color: '.$cat_sidebar_swatches_color_f.';
		border-color: '.$cat_sidebar_swatches_border_f.';
		background-color: '.$cat_sidebar_swatches_bg_f.';
	}

	.product-info-main .page-title {
		color: '.$productpage_info_name_color.';
	}
	.product-info-main .product-social-links a.mailto,
	.bundle-options-container .product-add-form .product-addto-links a,
	.product-info-main .product-addto-links a {
		color: '.$productpage_info_add_links_color.';
		background-color: '.$productpage_info_add_links_bg.';
	}
	.product-info-main .product-mail-to a:hover,
	.bundle-options-container .product-add-form .product-addto-links a:hover,
	.product-info-main .product-social-links a:hover {
		color: '.$productpage_info_add_links_color_h.';
		background-color: '.$productpage_info_add_links_bg_h.';
	}
	.product-info-main .product-mail-to a:active,
	.bundle-options-container .product-add-form .product-addto-links a:active,
	.product-info-main .product-social-links a:active {
		color: '.$productpage_info_add_links_color_a.';
		background-color: '.$productpage_info_add_links_bg_a.';
	}
	.product-info-main .product-mail-to a:focus,
	.bundle-options-container .product-add-form .product-addto-links a:focus,
	.product-info-main .product-social-links a:focus {
		color: '.$productpage_info_add_links_color_f.';
		background-color: '.$productpage_info_add_links_bg_f.';
	}
	.product-info-main .title-wrapper .price-box .special-price .price {
		color: '.$productpage_info_price.';
	}

	.product-labels span.label-sale {
		color: '.$general_product_label_sale_color.';
		background-color: '.$general_product_label_sale_bg.';
	}
	.label-type-4 .label-sale:before {
		border-top-color: '.$general_product_label_sale_bg.';
	}
	.label-type-4 .label-sale:after {
		border-bottom-color: '.$general_product_label_sale_bg.';
	}
	.product-labels span {
		color: '.$general_product_label_new_color.';
		background-color: '.$general_product_label_new_bg.';
	}
	.label-type-4 .label-new:before {
		border-top-color: '.$general_product_label_new_bg.';
	}
	.label-type-4 .label-new:after {
		border-bottom-color: '.$general_product_label_new_bg.';
	}
	.catalog-product-view .product-info-main #product-addtocart-button,
	.catalog-product-view .product-info-main #product-updatecart-button {
		color: '.$productpage_info_cart_btn_color.';
		background-color: '.$productpage_info_cart_btn_bg.';
	}
	.catalog-product-view .product-info-main #product-addtocart-button:hover,
	.catalog-product-view .product-info-main #product-addtocart-button.hover,
	.catalog-product-view .product-info-main #product-updatecart-button:hover,
	.catalog-product-view .product-info-main #product-updatecart-button.hover {
		color: '.$productpage_info_cart_btn_color_h.';
		background-color: '.$productpage_info_cart_btn_bg_h.';
	}
	.catalog-product-view .product-info-main #product-addtocart-button:active,
	.catalog-product-view .product-info-main #product-addtocart-button.active,
	.catalog-product-view .product-info-main #product-updatecart-button:active,
	.catalog-product-view .product-info-main #product-updatecart-button.active {
		color: '.$productpage_info_cart_btn_color_a.';
		background-color: '.$productpage_info_cart_btn_bg_a.';
	}
	.catalog-product-view .product-info-main #product-addtocart-button:focus,
	.catalog-product-view .product-info-main #product-addtocart-button.focus,
	.catalog-product-view .product-info-main #product-updatecart-button:focus,
	.catalog-product-view .product-info-main #product-updatecart-button.focus {
		color: '.$productpage_info_cart_btn_color_f.';
		background-color: '.$productpage_info_cart_btn_bg_f.';
	}
	.product-info-main .product-options-wrapper .label,
	.product-info-main .product-options-wrapper .swatch-attribute-label {
		color: '.$productpage_options_label_color.';
	}
	.product-info-main .product-options-wrapper .swatch-attribute-selected-option {
		color: '.$productpage_options_label_selected_color.';
	}
	.stock.available {
		color: '.$general_product_instock_color.';
	}
	.stock {
		color: '.$general_product_outofstock_color.';
	}
	.product-info-main .availability.only {
		color: '.$general_product_availability_only_color.';
	}
	.catalog-product-view .product-info-main .box-tocart .field.qty .control {
		background-color: '.$productpage_info_qty_input_bg.';
		border-color: '.$productpage_info_qty_input_border.';
	}
	.catalog-product-view .product-info-main .box-tocart .field.qty input.qty {
		color: '.$productpage_info_qty_input_color.';
		background-color: transparent;
	}
	.catalog-product-view .product-info-main .box-tocart .field.qty div.quantity-decrease i,
	.catalog-product-view .product-info-main .box-tocart .field.qty div.quantity-increase i {
		color: '.$productpage_info_qty_input_btns_color.';
		background-color: '.$productpage_info_qty_input_btns_bg.';
	}
	.catalog-product-view .product-info-main .box-tocart .field.qty div.quantity-decrease i:hover,
	.catalog-product-view .product-info-main .box-tocart .field.qty div.quantity-increase i:hover {
		color: '.$productpage_info_qty_input_btns_color_h.';
		background-color: '.$productpage_info_qty_input_btns_bg_h.';
	}
	.catalog-product-view .product-info-main .box-tocart .field.qty div.quantity-decrease i:active,
	.catalog-product-view .product-info-main .box-tocart .field.qty div.quantity-increase i:active {
		color: '.$productpage_info_qty_input_btns_color_a.';
		background-color: '.$productpage_info_qty_input_btns_bg_a.';
	}
	.catalog-product-view .product-info-main .box-tocart .field.qty div.quantity-decrease i:focus,
	.catalog-product-view .product-info-main .box-tocart .field.qty div.quantity-increase i:focus {
		color: '.$productpage_info_qty_input_btns_color_f.';
		background-color: '.$productpage_info_qty_input_btns_bg_f.';
	}
	#product-details-panel .item h4 {
		color: '.$productpage_info_collateral_accordion_head_text_color.';
		border-color: '.$productpage_info_collateral_accordion_divider_color.';
	}
	#product-details-panel .item {
		background-color: '.$productpage_info_collateral_accordion_item_bg.';
		border-color: '.$productpage_info_collateral_accordion_item_border.';
		box-shadow: 0px 1px 5px '.$productpage_info_collateral_accordion_item_shadow.';
	}
	#product-details-panel .item .content,
	#product-details-panel .item .table-caption {
		color: '.$productpage_info_collateral_accordion_content_text_color.';
	}

	#product-review-container .rating-summary .label {
		color: '.$productpage_reviews_rating_label_color.';
	}
	.reviews-wrapper .review-item .customer-info .review-title {
		color: '.$productpage_reviews_title_color.';
	}
	.reviews-wrapper .review-item .customer-info .review-author strong,
	.reviews-wrapper .review-item .customer-info .review-author {
		color: '.$productpage_reviews_author_color.';
	}
	.reviews-wrapper .review-item .customer-info .date {
		color: '.$productpage_reviews_date_color.';
	}
	.reviews-wrapper .review-item .review-content {
		color: '.$productpage_reviews_content_color.';
	}

	/*Blog Design*/
	.post-list-wrapper li.post-holder .post-top .post-category,
	.post-list-wrapper li.post-holder .post-top .post-date,
	.post-list-wrapper li.post-holder .postBookmarks,
	.post-list-wrapper li.post-holder .tags-wrapper h4,
	.post-list-wrapper li.post-holder .tags-wrapper .tags li a,
	.post-list-wrapper li.post-holder .actions .comments a,
	.post-list-wrapper.blog-widget-recent .post-holder .post-description,
	.sidebar .block.block-archive .block-title,
	.sidebar .block.block-categories .block-title,
	.sidebar .block.block-custom .block-title,
	.sidebar .block.block-recent-posts .block-title,
	.sidebar .block.block-block-rss .block-title,
	.sidebar .block.block-tagclaud .block-title,
	.sidebar .block.block-archive a,
	.sidebar .block.block-categories a,
	.sidebar .block.block-custom a,
	.sidebar .block.block-recent-posts a,
	.sidebar .block.block-block-rss a,
	.sidebar .block.block-tagclaud a,
	.blog-post-view .page-title,
	.post-view .postTitle .pull-right,
	.post-view .postBookmarks,
	.post-view .tags-wrapper,
	#post-comments .c-comments *,
	#post-comments .c-reply *:not(.btn):not(.mage-error),
	#post-comments .block-title strong {
		color: '.$general_text_color.';
	}
	.post-list-wrapper:not(.blog-widget-recent)) li.post-holder + li.post-holder,
	.post-list-wrapper li.post-holder .post-top .post-author,
	.post-list-wrapper.blog-widget-recent .post-holder .post-categories + .post-author {
		border-color: '.$general_border.';
	}
	.sidebar .block.block-archive,
	.sidebar .block.block-categories,
	.sidebar .block.block-custom,
	.sidebar .block.block-recent-posts,
	.sidebar .block.block-block-rss,
	.sidebar .block.block-tagclaud {
		border-color: '.$cat_sidebar_border.';
	}
	#post-comments .c-reply .form-group.aw-blog-comment-area textarea,
	#post-comments .c-reply input:not(.btn):not(.mage-error) {
		border-color: '.$general_input_border.';
		background-color: '.$general_input_bg.';
		color: '.$general_input_color.';
	}
	#post-comments .c-reply .form-group.aw-blog-comment-area textarea::-webkit-input-placeholder {color: '.$general_input_color.';}
	#post-comments .c-reply .form-group.aw-blog-comment-area textarea:-moz-placeholder {color: '.$general_input_color.';}
	#post-comments .c-reply .form-group.aw-blog-comment-area textarea::-moz-placeholder {color: '.$general_input_color.';}
	#post-comments .c-reply .form-group.aw-blog-comment-area textarea:-ms-input-placeholder {color: '.$general_input_color.';}
	#post-comments .c-reply .form-group.aw-blog-comment-area textarea::placeholder {color: '.$general_input_color.';}

	#post-comments .c-reply input:not(.btn):not(.mage-error)::-webkit-input-placeholder {color: '.$general_input_color.';}
	#post-comments .c-reply input:not(.btn):not(.mage-error):-moz-placeholder {color: '.$general_input_color.';}
	#post-comments .c-reply input:not(.btn):not(.mage-error)::-moz-placeholder {color: '.$general_input_color.';}
	#post-comments .c-reply input:not(.btn):not(.mage-error):-ms-input-placeholder {color: '.$general_input_color.';}
	#post-comments .c-reply input:not(.btn):not(.mage-error)::placeholder {color: '.$general_input_color.';}

	.post-list-wrapper li.post-holder .actions .comments a:hover,
	.post-view .post-nextprev-hld a:hover {
		color: '.$general_links_color_h.';
	}
	.post-list-wrapper li.post-holder .actions .comments a:active,
	.post-view .post-nextprev-hld a:active {
		color: '.$general_links_color_a.';
	}
	.post-list-wrapper li.post-holder .actions .comments a:focus,
	.post-view .post-nextprev-hld a:focus {
		color: '.$general_links_color_f.';
	}
	.sidebar .block.block-archive a:hover,
	.sidebar .block.block-categories a:hover,
	.sidebar .block.block-custom a:hover,
	.sidebar .block.block-recent-posts a:hover,
	.sidebar .block.block-block-rss a:hover,
	.sidebar .block.block-tagclaud a:hover {
		color: '.$cat_sidebar_links_color_hover.';
	}
	.post-list-wrapper li.post-holder .post-top .post-category a,
	.post-list-wrapper li.post-holder .post-top .post-author span,
	.post-list-wrapper li.post-holder .tags-wrapper .tags li a:hover,
	.post-list-wrapper.blog-widget-recent .post-holder .post-categories a,
	.post-view .postDetails a,
	.post-view .postDetails .poster,
	.post-view .tags-wrapper a:hover,
	.post-view .tags-wrapper a:active,
	.post-view .tags-wrapper a:focus,
	.post-view .post-nextprev-hld a,
	#post-comments .c-comments .commentWrapper .username {
		color: '.$general_product_type1_cart_color.';
	}
	.post-list-wrapper li.post-holder .post-title a {
		color: '.$general_page_title_color.';
	}
	.widget.blog-search input {
		background-color: '.$header_search_bg.';
		color: '.$header_search_color.';
		border-color: '.$header_search_border.';
	}
	
	.widget.blog-search input::-webkit-input-placeholder {color: '.$header_search_color.';}
	.widget.blog-search input:-moz-placeholder {color: '.$header_search_color.';}
	.widget.blog-search input::-moz-placeholder {color: '.$header_search_color.';}
	.widget.blog-search input:-ms-input-placeholder {color: '.$header_search_color.';}
	.widget.blog-search input::placeholder {color: '.$header_search_color.';}
	.widget.blog-search .action.search {
		background-color: '.$header_search_btn_bg.';
		color: '.$header_search_btn_color.';
	}
	.widget.blog-search .action.search:hover {
		background-color: '.$header_search_btn_bg_h.';
		color: '.$header_search_btn_color_h.';
	}
	.widget.blog-search .action.search:active {
		background-color: '.$header_search_btn_bg_a.';
		color: '.$header_search_btn_color_a.';
	}
	.widget.blog-search .action.search:focus {
		background-color: '.$header_search_btn_bg_f.';
		color: '.$header_search_btn_color_f.';
	}

	';

		if (stristr($general_home_subscribe_bg, 'rgba') === FALSE) {
            $cssData .= '.cms-index-index .subscribe-block {
            background: '.$general_home_subscribe_bg.';
            }';
        } else {
            $colors = explode("," , $general_home_subscribe_bg);

            $opacity = substr($colors[3], 0, -1);
            if ($opacity != 0) {
             $cssData .= '.cms-index-index .subscribe-block {
                  background: '.$general_home_subscribe_bg.';
                  }';
            }
            
        }

		return $cssData;	
	}
}