<?php 
if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * all customizer setting includeed
 *
 * @param  
 * @return mixed|string
 */
function top_store_front_customize_register( $wp_customize ){
//Front Page
require HUNK_COMPANION_DIR_PATH . '/top-store/customizer/frontpage/top-slider.php';
require HUNK_COMPANION_DIR_PATH . '/top-store/customizer/frontpage/category-tab.php';
require HUNK_COMPANION_DIR_PATH . '/top-store/customizer/frontpage/product-slide.php';
require HUNK_COMPANION_DIR_PATH . '/top-store/customizer/frontpage/category-slider.php';
require HUNK_COMPANION_DIR_PATH . '/top-store/customizer/frontpage/product-list.php';
require HUNK_COMPANION_DIR_PATH . '/top-store/customizer/frontpage/ribbon.php';
require HUNK_COMPANION_DIR_PATH . '/top-store/customizer/frontpage/banner.php';
require HUNK_COMPANION_DIR_PATH . '/top-store/customizer/frontpage/brand.php';
}
add_action('customize_register','top_store_front_customize_register');