<?php 
if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * all customizer setting includeed
 *
 * @param  
 * @return mixed|string
 */
function almaira_shop_front_customize_register( $wp_customize ){
//Front Page
require HUNK_COMPANION_DIR_PATH . '/open-shop/customizer/frontpage/top-slider.php';
require HUNK_COMPANION_DIR_PATH . '/open-shop/customizer/frontpage/category-tab.php';
require HUNK_COMPANION_DIR_PATH . '/open-shop/customizer/frontpage/product-slide.php';
require HUNK_COMPANION_DIR_PATH . '/open-shop/customizer/frontpage/category-slider.php';
require HUNK_COMPANION_DIR_PATH . '/open-shop/customizer/frontpage/product-list.php';
require HUNK_COMPANION_DIR_PATH . '/open-shop/customizer/frontpage/ribbon.php';
require HUNK_COMPANION_DIR_PATH . '/open-shop/customizer/frontpage/banner.php';
require HUNK_COMPANION_DIR_PATH . '/open-shop/customizer/frontpage/higlight.php';

}
add_action('customize_register','almaira_shop_front_customize_register');