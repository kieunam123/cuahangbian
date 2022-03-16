<?php 
$wp_customize->add_setting( 'top_store_disable_banner_sec', array(
                'default'               => false,
                'sanitize_callback'     => 'top_store_sanitize_checkbox',
            ) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_store_disable_banner_sec', array(
                'label'                 => esc_html__('Disable Section', 'top-store'),
                'type'                  => 'checkbox',
                'section'               => 'top_store_banner',
                'settings'              => 'top_store_disable_banner_sec',
            ) ) );
// choose col layout
if(class_exists('Top_Store_WP_Customize_Control_Radio_Image')){
        $wp_customize->add_setting(
            'top_store_banner_layout', array(
                'default'           => 'bnr-two',
                'sanitize_callback' => 'top_store_sanitize_radio',
            )
        );
$wp_customize->add_control(
            new Top_Store_WP_Customize_Control_Radio_Image(
                $wp_customize, 'top_store_banner_layout', array(
                    'label'    => esc_html__( 'Layout', 'top-store' ),
                    'section'  => 'top_store_banner',
                    'choices'  => array(
                        'bnr-one'   => array(
                            'url'  => TOP_STORE_BANNER_IMG_LAYOUT_1,
                        ),
                        'bnr-two'   => array(
                            'url'   => TOP_STORE_BANNER_IMG_LAYOUT_2,
                        ),
                        'bnr-three' => array(
                            'url'   => TOP_STORE_BANNER_IMG_LAYOUT_3,
                        ),
                        'bnr-four' => array(
                            'url'  => TOP_STORE_BANNER_IMG_LAYOUT_4,
                        ),
                        'bnr-five' => array(
                            'url'  => TOP_STORE_BANNER_IMG_LAYOUT_5,
                        ),
                        
                    ),
                )
            )
        );
    } 
// first image
$wp_customize->add_setting('top_store_bnr_1_img', array(
        'default'       => '',
        'capability'    => 'edit_theme_options',
        'sanitize_callback' => 'top_store_sanitize_upload',
    ));
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'top_store_bnr_1_img', array(
        'label'          => __('Image 1', 'top-store'),
        'section'        => 'top_store_banner',
        'settings'       => 'top_store_bnr_1_img',
 )));

// first url
$wp_customize->add_setting('top_store_bnr_1_url', array(
        'default' =>'',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'top_store_sanitize_text',
));
$wp_customize->add_control( 'top_store_bnr_1_url', array(
        'label'    => __('url', 'top-store'),
        'section'  => 'top_store_banner',
         'type'    => 'text',
));
// second image
$wp_customize->add_setting('top_store_bnr_2_img', array(
        'default'       => '',
        'capability'    => 'edit_theme_options',
        'sanitize_callback' => 'top_store_sanitize_upload',
    ));
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'top_store_bnr_2_img', array(
        'label'          => __('Image 2', 'top-store'),
        'section'        => 'top_store_banner',
        'settings'       => 'top_store_bnr_2_img',
 )));

// second url
$wp_customize->add_setting('top_store_bnr_2_url', array(
        'default' =>'',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'top_store_sanitize_text',
));
$wp_customize->add_control( 'top_store_bnr_2_url', array(
        'label'    => __('url', 'top-store'),
        'section'  => 'top_store_banner',
         'type'    => 'text',
));

// third image
$wp_customize->add_setting('top_store_bnr_3_img', array(
        'default'       => '',
        'capability'    => 'edit_theme_options',
        'sanitize_callback' => 'top_store_sanitize_upload',
    ));
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'top_store_bnr_3_img', array(
        'label'          => __('Image 3', 'top-store'),
        'section'        => 'top_store_banner',
        'settings'       => 'top_store_bnr_3_img',
 )));

// third url
$wp_customize->add_setting('top_store_bnr_3_url', array(
        'default' =>'',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'top_store_sanitize_text',
));
$wp_customize->add_control( 'top_store_bnr_3_url', array(
        'label'    => __('url', 'top-store'),
        'section'  => 'top_store_banner',
         'type'    => 'text',
));


// fourth image
$wp_customize->add_setting('top_store_bnr_4_img', array(
        'default'       => '',
        'capability'    => 'edit_theme_options',
        'sanitize_callback' => 'top_store_sanitize_upload',
    ));
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'top_store_bnr_4_img', array(
        'label'          => __('Image 4', 'top-store'),
        'section'        => 'top_store_banner',
        'settings'       => 'top_store_bnr_4_img',
 )));
$wp_customize->add_setting('top_store_bnr_4_url', array(
        'default' =>'',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'top_store_sanitize_text',
));
$wp_customize->add_control( 'top_store_bnr_4_url', array(
        'label'    => __('url', 'top-store'),
        'section'  => 'top_store_banner',
         'type'    => 'text',
));

// fifth image
$wp_customize->add_setting('top_store_bnr_5_img', array(
        'default'       => '',
        'capability'    => 'edit_theme_options',
        'sanitize_callback' => 'top_store_sanitize_upload',
    ));
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'top_store_bnr_5_img', array(
        'label'          => __('Image 5', 'top-store'),
        'section'        => 'top_store_banner',
        'settings'       => 'top_store_bnr_5_img',
 )));
$wp_customize->add_setting('top_store_bnr_5_url', array(
        'default' =>'',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'top_store_sanitize_text',
));
$wp_customize->add_control( 'top_store_bnr_5_url', array(
        'label'    => __('url', 'top-store'),
        'section'  => 'top_store_banner',
         'type'    => 'text',
));

$wp_customize->add_setting('top_store_bnr_doc', array(
    'sanitize_callback' => 'top_store_sanitize_text',
    ));
$wp_customize->add_control(new top_store_Misc_Control( $wp_customize, 'top_store_bnr_doc',
            array(
        'section'     => 'top_store_banner',
        'type'        => 'doc-link',
        'url'         => 'https://themehunk.com/docs/top-store/#banner-section',
        'description' => esc_html__( 'To know more go with this', 'top-store' ),
        'priority'   =>100,
    )));