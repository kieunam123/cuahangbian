<?php 
if ( ! defined( 'ABSPATH' ) ) exit; 

/********************************/
//product slider loop
/********************************/
function open_shop_product_slide_list_loop($term_id, $prdct_optn){  
 // product filter 
if(empty($term_id[0])){   
 $taxquery = array(
  array(
                                'taxonomy'  => 'product_visibility',
                                'terms'     => array( 'exclude-from-catalog' ),
                                'field'     => 'name',
                                'operator'  => 'NOT IN',
                            )
);
}else{
 // category filter  
      $args1 = array(
            'orderby'    => 'menu_order',
            'order'      => 'ASC',
            'hide_empty' => 1,
            'slug'    => $term_id
        );
$product_categories = get_terms( 'product_cat', $args1);
$product_cat_slug =  $product_categories[0]->slug;
$taxquery = array(
  'relation' => 'AND',
                          array(
                              'taxonomy' => 'product_cat',
                              'field' => 'slug',
                              'terms' =>  $product_cat_slug
                          ),array(
                                'taxonomy'  => 'product_visibility',
                                'terms'     => array( 'exclude-from-catalog' ),
                                'field'     => 'name',
                                'operator'  => 'NOT IN',
                            )
);
}

  if($prdct_optn=='random'){  
     $args = array(
                      
                      'tax_query' => $taxquery,
                      'post_type' => 'product',
                      'orderby' => 'rand'
    );
}elseif($prdct_optn=='featured'){
    $args = array(
                      
                      'tax_query' => $taxquery,
                      'post_type' => 'product',
                      'post__in'  => wc_get_featured_product_ids(),
    );
}else{
    $args = array(
                      
                      'tax_query' => $taxquery,
                      'post_type' => 'product',
                      'orderby' => 'date'
    );
}
    $products = new WP_Query( $args );
    if ( $products->have_posts() ){
      while ( $products->have_posts() ) : $products->the_post();
      global $product;
      $pid =  $product->get_id();
      ?>
        <div <?php post_class(); ?>>
          <div class="thunk-list">
               <div class="thunk-product-image">
                <a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                 <?php the_post_thumbnail(); ?>
                  </a>
               </div>
               <div class="thunk-product-content">
                  <a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-title woocommerce-loop-product__link"><?php the_title(); ?></a>
                  <?php 
                        $rat_product = wc_get_product($pid);
                        $rating_count =  $rat_product->get_rating_count();
                        $average =  $rat_product->get_average_rating();
                        echo $rating_count = wc_get_rating_html( $average, $rating_count );
                       ?>
                  <div class="price"><?php echo $product->get_price_html(); ?></div>
               </div>
          </div>
        </div>
   <?php endwhile;
    } else {
      echo __( 'No products found','open-shop' );
    }
    wp_reset_postdata();
}


/**********************************************
//Funtion Category list show
 **********************************************/   
function open_shop_category_tab_list( $term_id ){
  if( taxonomy_exists( 'product_cat' ) && !empty($term_id) ){ 
      // category filter  
      $args = array(
            'orderby'    => 'menu_order',
            'order'      => 'ASC',
            'hide_empty' => 1,
            'slug'    => $term_id
        );
      $product_categories = get_terms( 'product_cat', $args );
      $count = count($product_categories);
      $cat_list = $cate_product = '';
      $cat_list_drop = '';
      $i=1;
      $dl=0;
?>
<?php
//Detect special conditions devices
$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");

//do something with this information
if( $iPod || $iPhone ){
  $device_cat =  '2';
    //browser reported as an iPhone/iPod touch -- do something here
}else if($iPad){
  $device_cat =  '2';
    //browser reported as an iPad -- do something here
}else if($Android){
  $device_cat =  '2';
    //browser reported as an Android device -- do something here
}else if($webOS){
   $device_cat =  '4';
    //browser reported as a webOS device -- do something here
}else{
    $device_cat =  '5';
}
     if ( $count > 0 ){
      foreach ( $product_categories as $product_category ){
              //global $product; 
              $category_product = array();
              $current_class = '';
              $cat_list .='
                  <li>
                  <a data-filter="' .esc_attr($product_category->slug) .'" data-animate="fadeInUp"  href="#"  data-term-id='.esc_attr($product_category->term_id) .' product_count="'.esc_attr($product_category->count).'">
                     '.esc_html($product_category->name).'</a>
                  </li>';
          if ($i++ == $device_cat) break;
          }
          if($count > $device_cat){
          foreach ( $product_categories as $product_category ){
              //global $product; 
              $dl++;
              if($dl <= $device_cat) continue;
              $category_product = array();
              $current_class = '';
              $cat_list_drop .='
                  <li>
                  <a data-filter="' .esc_attr($product_category->slug) .'" data-animate="fadeInUp"  href="#"  data-term-id='.esc_attr($product_category->term_id) .' product_count="'.esc_attr($product_category->count).'">
                     '.esc_html($product_category->name).'</a>
                  </li>';
          }
        }
          $return = '<div class="tab-head" catlist="'.esc_attr($i).'" >
          <div class="tab-link-wrap">
          <ul class="tab-link">';
 $return .=  $cat_list;
 $return .= '</ul>';
 if($count > $device_cat){
  $return .= '<div class="header__cat__item dropdown"><a href="#" class="more-cat" title="More categories...">•••</a><ul class="dropdown-link">';
 $return .=  $cat_list_drop;
 $return .= '</ul></div>';
}
  $return .= '</div></div>';

 echo $return;
       }
    } 
}


/********************************/
//product cat filter loop
/********************************/
function open_shop_product_cat_filter_default_loop($term_id,$prdct_optn){
// product filter 
if(empty($term_id[0])){   
 $taxquery = array(
  array(
                                'taxonomy'  => 'product_visibility',
                                'terms'     => array( 'exclude-from-catalog' ),
                                'field'     => 'name',
                                'operator'  => 'NOT IN',
                            )
);
}else{
 // category filter  
      $args1 = array(
            'orderby'    => 'menu_order',
            'order'      => 'ASC',
            'hide_empty' => 1,
            'slug'    => $term_id
        );
$product_categories = get_terms( 'product_cat', $args1);
$product_cat_slug =  $product_categories[0]->slug;
$taxquery = array(
  'relation' => 'AND',
                          array(
                              'taxonomy' => 'product_cat',
                              'field' => 'slug',
                              'terms' =>  $product_cat_slug
                          ),array(
                                'taxonomy'  => 'product_visibility',
                                'terms'     => array( 'exclude-from-catalog' ),
                                'field'     => 'name',
                                'operator'  => 'NOT IN',
                            )
);
}

  if($prdct_optn=='random'){  
     $args = array(
                      
                      'tax_query' => $taxquery,
                      'post_type' => 'product',
                      'orderby' => 'rand'
    );
}elseif($prdct_optn=='featured'){
    $args = array(
                      
                      'tax_query' => $taxquery,
                      'post_type' => 'product',
                      'post__in'  => wc_get_featured_product_ids(),
    );
}else{
    $args = array(
                      
                      'tax_query' => $taxquery,
                      'post_type' => 'product',
                      'orderby' => 'date'
    );
}
    $products = new WP_Query( $args );
    if ( $products->have_posts() ){
      while ( $products->have_posts() ) : $products->the_post();
      global $product;
      $pid =  $product->get_id();
      ?>
        <div <?php post_class(); ?>>
          <div class="thunk-product-wrap">
          <div class="thunk-product">
               <div class="thunk-product-image">
                <a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                <?php $sale = get_post_meta( $pid, '_sale_price', true);
                    if( $sale) {
                      // Get product prices
                        $regular_price = (float) $product->get_regular_price(); // Regular price
                        $sale_price = (float) $product->get_price(); // Sale price
                        $saving_price = wc_price( $regular_price - $sale_price );
                        echo $sale = '<span class="onsale">-'.$saving_price.'</span>';
                    }?>
                 <?php 
                      the_post_thumbnail(); 
                      $hover_style = get_theme_mod( 'open_shop_woo_product_animation' );
                         // the_post_thumbnail();
                        if ( 'swap' === $hover_style ){
                                $attachment_ids = $product->get_gallery_image_ids($pid);
                               foreach( $attachment_ids as $attachment_id ) 
                             {
                                 $glr = wp_get_attachment_image($attachment_id, 'shop_catalog', false, array( 'class' => 'show-on-hover' ));
                                echo $category_product['glr'] = $glr;
                               }
                           }
                  ?>
                  </a>
                  <?php 
                    if(get_theme_mod( 'open_shop_woo_quickview_enable', true )){

                  ?>
                   <div class="thunk-quickview">
                               <span class="quik-view">
                                   <a href="#" class="opn-quick-view-text" data-product_id="<?php echo esc_attr($pid); ?>">
                                      <span><?php _e('Quick View','open-shop');?></span>
                                   </a>
                                </span>
                    </div>
                  <?php } ?>
               </div>
               <div class="thunk-product-content">
               
                  <h2 class="woocommerce-loop-product__title"><a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><?php the_title(); ?></a></h2>
                  <div class="price"><?php echo $product->get_price_html(); ?></div>
                  <?php 
                        $rat_product = wc_get_product($pid);
                        $rating_count =  $rat_product->get_rating_count();
                        $average =  $rat_product->get_average_rating();
                        echo $rating_count = wc_get_rating_html( $average, $rating_count );
                       ?>
               </div>
           
            <div class="thunk-product-hover">     
                    <?php 
                      echo open_shop_add_to_cart_url($product);
                      echo open_shop_whish_list();
                      echo open_shop_add_to_compare_fltr($pid);
                    ?>
            </div>
          </div>
        </div>
        </div>
   <?php endwhile;
    } else {
      echo __( 'No products found','open-shop' );
    }
    wp_reset_postdata();
}

function open_shop_product_filter_loop($args){  
    $products = new WP_Query( $args );
    if ( $products->have_posts() ){
      while ( $products->have_posts() ) : $products->the_post();
      global $product;
      $pid =  $product->get_id();
      ?>
        <div <?php post_class(); ?>>
          <div class="thunk-product-wrap">
          <div class="thunk-product">
               <div class="thunk-product-image">
                <a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                <?php $sale = get_post_meta( $pid, '_sale_price', true);
                    if( $sale) {
                      // Get product prices
                        $regular_price = (float) $product->get_regular_price(); // Regular price
                        $sale_price = (float) $product->get_price(); // Sale price
                        $saving_price = wc_price( $regular_price - $sale_price );
                        echo $sale = '<span class="onsale">-'.$saving_price.'</span>';
                    }?>
                 <?php 
                      the_post_thumbnail(); 
                      $hover_style = get_theme_mod( 'open_shop_woo_product_animation' );
                         // the_post_thumbnail();
                        if ( 'swap' === $hover_style ){
                                $attachment_ids = $product->get_gallery_image_ids($pid);
                               foreach( $attachment_ids as $attachment_id ) 
                             {
                                 $glr = wp_get_attachment_image($attachment_id, 'shop_catalog', false, array( 'class' => 'show-on-hover' ));
                                echo $category_product['glr'] = $glr;
                               }
                           }
                  ?>
                  </a>
                  <?php 
                    if(get_theme_mod( 'open_shop_woo_quickview_enable', true )){

                  ?>
                   <div class="thunk-quickview">
                               <span class="quik-view">
                                   <a href="#" class="opn-quick-view-text" data-product_id="<?php echo esc_attr($pid); ?>">
                                      <span><?php _e('Quick View','open-shop');?></span>
                                   </a>
                                </span>
                      </div>
                    <?php } ?>
               </div>
               <div class="thunk-product-content">
               
                  <h2 class="woocommerce-loop-product__title"><a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><?php the_title(); ?></a></h2>
                  <div class="price"><?php echo $product->get_price_html(); ?></div>
                  <?php 
                        $rat_product = wc_get_product($pid);
                        $rating_count =  $rat_product->get_rating_count();
                        $average =  $rat_product->get_average_rating();
                        echo $rating_count = wc_get_rating_html( $average, $rating_count );
                       ?>
               </div>
            <div class="thunk-product-hover">     
                    <?php 
                      echo open_shop_add_to_cart_url($product);
                      echo open_shop_whish_list();
                      echo open_shop_add_to_compare_fltr($pid);
                    ?>
            </div>
          </div>
        </div>
      </div>
   <?php endwhile;
    } else {
      echo __( 'No products found','open-shop' );
    }
    wp_reset_postdata();
}
/*********************/
// Product for list view
/********************/
function open_shop_product_list_filter_loop($args){  
    $products = new WP_Query( $args );
    if ( $products->have_posts() ){
      while ( $products->have_posts() ) : $products->the_post();
      global $product;
      $pid =  $product->get_id();
      ?>
        <div <?php post_class(); ?>>
          <div class="thunk-list">
               <div class="thunk-product-image">
                <a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                 <?php the_post_thumbnail(); ?>
                  </a>
               </div>
               <div class="thunk-product-content">
                  <a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-title woocommerce-loop-product__link"><?php the_title(); ?></a>
                  <?php 
                        $rat_product = wc_get_product($pid);
                        $rating_count =  $rat_product->get_rating_count();
                        $average =  $rat_product->get_average_rating();
                        echo $rating_count = wc_get_rating_html( $average, $rating_count );
                       ?>
                  <div class="price"><?php echo $product->get_price_html(); ?></div>
               </div>
          </div>
       </div>
   <?php endwhile;
    } else {
      echo __( 'No products found','open-shop' );
    }
    wp_reset_postdata();
}
