jQuery(document).ready(function(){
// single-portfolio
 	var owl = jQuery('.portfolio-slider .owl-carousel');
      owl.owlCarousel({
      	items: 1,
        margin:0,
        loop: true,
        dots: true,
        smartSpeed: 1600, 
      })
//	ISOTOPE FILTERS
//  Init Isotope
var $portfolio_type = jQuery('#ptype').val();
var $grid_area = jQuery('.thunk-masonry .grid-area').isotope({
  itemSelector: '.th-grid-item',
  //percentPosition: true,
  layoutMode: $portfolio_type,
  masonry: {
    gutter: '.gutter-sizer',
  }
});
// layout Isotope after each image loads this is to sortout images loading
//issue in masonry layout.
(function ($){
$(window).load(function (){
$grid_area.imagesLoaded().progress( function(){
$grid_area.isotope('layout');
});  
});  
    });  
// filter functions
// bind filter button click
jQuery('.filters-button-group').on( 'click', 'button', function(){
  var filterValue = jQuery( this ).attr('data-filter');
  // use filterFn if matches value
  $grid_area.isotope({ filter: filterValue });
});
// change is-checked class on buttons
jQuery('.button-group').each( function( i, buttonGroup ) {
  var $buttonGroup = jQuery( buttonGroup );
  $buttonGroup.on( 'click', 'button', function() {
    $buttonGroup.find('.is-checked').removeClass('is-checked');
    jQuery( this ).addClass('is-checked');
  });
  var isHorizontal = false;
var $window = jQuery( window );
jQuery('.layout-mode-button-group').on( 'click', 'button', function() {
  // adjust container sizing if layout mode is changing from vertical or horizontal
  var $this = jQuery(this);
  var isHorizontalMode = !!$this.attr('data-is-horizontal');
  if ( isHorizontal !== isHorizontalMode ) {
    // change container size if horiz/vert change
    var containerStyle = isHorizontalMode ? {
      height: $window.height() * 0.7
    } : {
      width: 'auto'
    };
    $grid.css( containerStyle );
    isHorizontal = isHorizontalMode;
  }
  // change layout mode
  var layoutModeValue = $this.attr('data-layout-mode');
  $grid.isotope({ layoutMode: layoutModeValue });
});  
}); //masonry end  
/**************************************load more 2*******************/
(function(jquery) {
         function portfilo_show_gallery($input){
             jquery('.lfb-load-more').css("display", "none");
             var $pl_totalcat = jquery('.filters-button-group').attr('pfl_perpage');
             var data_filter = $input.attr("data-filter");
             var class_filter = $input.attr("class");
             var $cate_slug = data_filter.replace(".","");
             var $total_post = jquery(data_filter).attr("totalpost");
             var $pagi = Math.round(parseFloat($total_post / $pl_totalcat));
             var $lfb_page = jquery(data_filter).attr('lfb-page');
             if ($pl_totalcat < $total_post || $pagi >= $lfb_page){
                 jquery('.lfb-load-more').css("display", "block");
                 jquery(".lfb-load-more").attr("cate-slug", $cate_slug);
             }
             return data_filter;
         }
    jquery(window).load(function(){
        if (jQuery(".th-portfolio-cat").length){
             var $input = jquery(".th-portfolio-cat");
             var data_filter = $input.attr("data-filter");
             jquery('.lfb-load-more').css("display", "none");
             var jquerygrid = jquery('.grid-area').isotope({
                 filter: data_filter
             });
             portfilo_show_gallery($input);
        }
            jquery(".button").click(function(){
                 jquery(".is-checked").removeClass('active');
             });

             jquery(".is-checked").click(function(){
                 var $grid = jquery('.grid-area').isotope({
                     filter: data_filter
                 });
             });
             
             jquery(".button").click(function(){
                 var $input = jquery(this);
                 data_filter = portfilo_show_gallery($input);
                 var jquerygrid = jquery(".grid-area").isotope({
                     filter: data_filter
                 });

             });
             jquery(".lfb-load-more").click(function(){
                 var $cateSlug = jquery('.lfb-load-more').attr('cate-slug');
                 var $lfb_page = jquery('.' + $cateSlug).attr('lfb-page');
                 var $total_post = jquery('.' + $cateSlug).attr('totalpost');
                 var $data_max_pages = jquery('.' + $cateSlug).attr('data-max-pages');
                 var $plf_data = "post_page=" + $lfb_page + "&cate_slug=" + $cateSlug + "&action=hunk_companion_portfolio_ajax";
                 jquery.ajax({
                     url: frontendajax.ajaxurl,
                     type: 'POST',
                     data: $plf_data,
                     cache: false
                 }).success(function(response){
                     if (response!=''){
                         var $lfb_page_new = parseInt($lfb_page) + 1;
                         jquery('.' + $cateSlug).attr("lfb-page", $lfb_page_new);
                         var $newItems = jquery(response);
                         $newItems.imagesLoaded(function(){
                         $newItems.css({ opacity: 1 });
                         jquery('.grid-area').append($newItems).isotope( 'appended', $newItems );
                         });
                         if($lfb_page==$data_max_pages){
                            jquery('.lfb-load-more').css("display", "none");
                        }     
                     }else{
                         jquery('.lfb-load-more').css("display", "none");
                     }
                 });

             });

         });
    })(jQuery);
/**************************************load more 2 END*******************/        
// //SERVICES
var owl = jQuery('.thunk-service .owl-carousel');
      owl.owlCarousel({
        items: 1,
        nav: false,
        navText: ["<i class='fa fa-chevron-left'></i>", 
        "<i class='fa fa-chevron-right'></i>"],
        loop: false,
        dots: true,
        smartSpeed: 1800, 
        autoHeight: false,
        margin: 30,
        responsive:{
        0:{
            items:1,
        },
        490:{
            items:2,
        },
        768:{
            items:3,
        }
    }
        
      })
//PRICING
var owl = jQuery('.thunk-pricing .owl-carousel');
      owl.owlCarousel({
        items: 1,
        nav: false,
        navText: ["<i class='fa fa-chevron-left'></i>", 
        "<i class='fa fa-chevron-right'></i>"],
        loop: false,
        dots: true,
        smartSpeed: 1800, 
        autoHeight: false,
        margin: 30,
        responsive:{
        0:{
            items:1,
        },
        490:{
            items:2,
        },
        768:{
            items:3,
        }
    }
      } )
//TEAM
var owl = jQuery('.thunk-team .owl-carousel');
      owl.owlCarousel({
        items: 1,
        nav: false,
        navText: ["<i class='fa fa-chevron-left'></i>", 
        "<i class='fa fa-chevron-right'></i>"],
        loop: false,
        dots: true,
        smartSpeed: 1800, 
        autoHeight: false,
        margin: 30,
         responsive:{
        0:{
            items:1,
        },
        490:{
            items:2,
        },
        768:{
            items:3,
        }
    }
      })

//TESTIMONIALS
var owl = jQuery('.testimonials .owl-carousel');
      owl.owlCarousel({
        items: 1,
        nav: true,
        navText: ["<i class='fa fa-chevron-left'></i>", 
        "<i class='fa fa-chevron-right'></i>"],
        loop: false,
        dots: true,
        smartSpeed: 1800, 
        autoHeight: false,
        margin: 0,
      })
//CLIENTS
var owl = jQuery('.clients-list .owl-carousel');
      owl.owlCarousel({
        items: 1,
        loop: false,
        smartSpeed: 1600, 
        autoplay: true,
        dots: false,
        margin: 0,
      })
//BLOG
var owl = jQuery('.thunk-blog .owl-carousel');
      owl.owlCarousel({
        items: 1,
        nav: false,
        navText: ["<i class='fa fa-chevron-left'></i>", 
        "<i class='fa fa-chevron-right'></i>"],
        loop: false,
        dots: true,
        smartSpeed: 1800, 
        autoHeight: false,
        margin: 30,
        lazyLoad: true,
        responsive:{
        0:{
            items:1,
        },
        490:{
            items:2,
        },
        768:{
            items:3,
        }
    }
      } )
//IZIMODAL VIDEO RIBBON
jQuery(function(){
  jQuery("#video-modal").iziModal({
    history: false,
    iframe : true,
    fullscreen: true,
    openFullscreen: false,
    headerColor: '#000000',
    group: 'group1',
    loop: true,
    autoOpen: 0,
    closeButton: true,
    overlayClose: true,
    overlayColor: 'rgba(0, 0, 0, 0.4)',
    borderBottom: true,
    background: '#000',
    focusInput: true,
  }); 
})
//BACKGROUND SLIDERS
if ( jQuery('.fadein-slider .slide-item').length > 1 ) {
       jQuery('.fadein-slider .slide-item:gt(0)').hide();
       setInterval(function(){
           jQuery('.fadein-slider :first-child').fadeOut(1700).next('.slide-item').fadeIn(1700).end().appendTo('.fadein-slider');
       },4000);
   }  
// Condiition to Show Vertical Navigation on scroll for slider section
 // jQuery('.thunk-vertival-pagination-wrapper').hide();
 // jQuery('.fadein-slider>div:not(:first-child)').css({"height":"100%","visibility": "visible"});
 jQuery(window).scroll(function() {

    if (jQuery(this).scrollTop()<108)
    {
       jQuery('#cd-vertical-nav').css({"opacity":"0","right": "-40px"});
       jQuery('.mhdrrightpan .thunk-vertival-pagination-wrapper #cd-vertical-nav').css({"opacity":"0","left": "-85px"});
    }
   else if(jQuery('.active-frame #cd-vertical-nav').length!=1)
    {
     jQuery('#cd-vertical-nav').css({"opacity":"1","transition": "all 0.2s linear","right": "0px"});
     jQuery('.mhdrrightpan .thunk-vertival-pagination-wrapper #cd-vertical-nav').css({"opacity":"1","transition": "all 0.2s linear","left": "-50px"});
    }
   else
   {
     jQuery('#cd-vertical-nav').css({"opacity":"1","transition": "all 0.2s linear","right": "15px"});
     jQuery('.mhdrrightpan .thunk-vertival-pagination-wrapper #cd-vertical-nav').css({"opacity":"1","transition": "all 0.2s linear","left": "-35px"});
   }
 });

//Wow Animation CSS
 new WOW().init();
})


