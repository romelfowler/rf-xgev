<?php
 
add_action( 'init', 'autozone_integrateWithVC', 200 );

function autozone_integrateWithVC() {

	if (!function_exists('vc_map'))
		return FALSE;

	global $theme_name;


	$theme_name = 'autozone';

	vc_remove_element( "vc_gallery" );
	vc_remove_element( "vc_images_carousel" );
	vc_remove_element( "vc_posts_slider" );

	$args = array( 'taxonomy' => 'portfolio_category', 'hide_empty' => '0');
	$categories = get_categories($args);
	$cats = array();
	$i = 0;
	foreach($categories as $category){
		if(is_object($category)){
			if($i==0){
				$default = $category->slug;
				$i++;
			}
			$cats[$category->name] = $category->term_id;
		}
	}
	
	if ( class_exists( 'WooCommerce' ) ) {
		$args = array( 'taxonomy' => 'product_cat', 'hide_empty' => '0');
		$categories_woo = get_categories($args);
		$cats_woo = array();
		$i = 0;
		foreach($categories_woo as $category){
			if($i==0){
				$default = $category->slug;
				$i++;
			}
			$cats_woo[$category->name] = $category->term_id;
		}
	}
		
	/** Fonts Icon Loader */

	$vc_icons_data = autozone_init_vc_icons();
	
	$add_css_animation = array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'CSS Animation', 'autozone' ),
		'param_name' => 'css_animation',
		'admin_label' => true,
		'value' => array(
			esc_html__( 'No', 'autozone' ) => '',
			esc_html__( 'bounce', 'autozone' ) => 'bounce',
			esc_html__( 'flash', 'autozone' ) => 'flash',
			esc_html__( 'pulse', 'autozone' ) => 'pulse',
			esc_html__( 'rubberBand', 'autozone' ) => 'rubberBand',
			esc_html__( 'shake', 'autozone' ) => 'shake',
			esc_html__( 'swing', 'autozone' ) => 'swing',
			esc_html__( 'tada', 'autozone' ) => 'tada',
			esc_html__( 'wobble', 'autozone' ) => 'wobble',
			esc_html__( 'jello', 'autozone' ) => 'jello',
			
			esc_html__( 'bounceIn', 'autozone' ) => 'bounceIn',
			esc_html__( 'bounceInDown', 'autozone' ) => 'bounceInDown',
			esc_html__( 'bounceInLeft', 'autozone' ) => 'bounceInLeft',
			esc_html__( 'bounceInRight', 'autozone' ) => 'bounceInRight',
			esc_html__( 'bounceInUp', 'autozone' ) => 'bounceInUp',
			esc_html__( 'bounceOut', 'autozone' ) => 'bounceOut',
			esc_html__( 'bounceOutDown', 'autozone' ) => 'bounceOutDown',
			esc_html__( 'bounceOutLeft', 'autozone' ) => 'bounceOutLeft',
			esc_html__( 'bounceOutRight', 'autozone' ) => 'bounceOutRight',
			esc_html__( 'bounceOutUp', 'autozone' ) => 'bounceOutUp',
			
			esc_html__( 'fadeIn', 'autozone' ) => 'fadeIn',
			esc_html__( 'fadeInDown', 'autozone' ) => 'fadeInDown',
			esc_html__( 'fadeInDownBig', 'autozone' ) => 'fadeInDownBig',
			esc_html__( 'fadeInLeft', 'autozone' ) => 'fadeInLeft',
			esc_html__( 'fadeInLeftBig', 'autozone' ) => 'fadeInLeftBig',
			esc_html__( 'fadeInRight', 'autozone' ) => 'fadeInRight',
			esc_html__( 'fadeInRightBig', 'autozone' ) => 'fadeInRightBig',
			esc_html__( 'fadeInUp', 'autozone' ) => 'fadeInUp',
			esc_html__( 'fadeInUpBig', 'autozone' ) => 'fadeInUpBig',			
			esc_html__( 'fadeOut', 'autozone' ) => 'fadeOut',
			esc_html__( 'fadeOutDown', 'autozone' ) => 'fadeOutDown',
			esc_html__( 'fadeOutDownBig', 'autozone' ) => 'fadeOutDownBig',
			esc_html__( 'fadeOutLeft', 'autozone' ) => 'fadeOutLeft',
			esc_html__( 'fadeOutLeftBig', 'autozone' ) => 'fadeOutLeftBig',
			esc_html__( 'fadeOutRight', 'autozone' ) => 'fadeOutRight',
			esc_html__( 'fadeOutRightBig', 'autozone' ) => 'fadeOutRightBig',
			esc_html__( 'fadeOutUp', 'autozone' ) => 'fadeOutUp',
			esc_html__( 'fadeOutUpBig', 'autozone' ) => 'fadeOutUpBig',
			
			esc_html__( 'flip', 'autozone' ) => 'flip',
			esc_html__( 'flipInX', 'autozone' ) => 'flipInX',
			esc_html__( 'flipInY', 'autozone' ) => 'flipInY',
			esc_html__( 'flipOutX', 'autozone' ) => 'flipOutX',
			esc_html__( 'flipOutY', 'autozone' ) => 'flipOutY',
			
			esc_html__( 'lightSpeedIn', 'autozone' ) => 'lightSpeedIn',
			esc_html__( 'lightSpeedOut', 'autozone' ) => 'lightSpeedOut',
			
			esc_html__( 'rotateIn', 'autozone' ) => 'rotateIn',
			esc_html__( 'rotateInDownLeft', 'autozone' ) => 'rotateInDownLeft',
			esc_html__( 'rotateInDownRight', 'autozone' ) => 'rotateInDownRight',
			esc_html__( 'rotateInUpLeft', 'autozone' ) => 'rotateInUpLeft',
			esc_html__( 'rotateInUpRight', 'autozone' ) => 'rotateInUpRight',			
			esc_html__( 'rotateOut', 'autozone' ) => 'rotateOut',
			esc_html__( 'rotateOutDownLeft', 'autozone' ) => 'rotateOutDownLeft',
			esc_html__( 'rotateOutDownRight', 'autozone' ) => 'rotateOutDownRight',
			esc_html__( 'rotateOutUpLeft', 'autozone' ) => 'rotateOutUpLeft',
			esc_html__( 'rotateOutUpRight', 'autozone' ) => 'rotateOutUpRight',
			
			esc_html__( 'slideInUp', 'autozone' ) => 'slideInUp',
			esc_html__( 'slideInDown', 'autozone' ) => 'slideInDown',
			esc_html__( 'slideInLeft', 'autozone' ) => 'slideInLeft',
			esc_html__( 'slideInRight', 'autozone' ) => 'slideInRight',
			esc_html__( 'slideOutUp', 'autozone' ) => 'slideOutUp',			
			esc_html__( 'slideOutDown', 'autozone' ) => 'slideOutDown',
			esc_html__( 'slideOutLeft', 'autozone' ) => 'slideOutLeft',
			esc_html__( 'slideOutRight', 'autozone' ) => 'slideOutRight',
			
			esc_html__( 'zoomIn', 'autozone' ) => 'zoomIn',
			esc_html__( 'zoomInDown', 'autozone' ) => 'zoomInDown',
			esc_html__( 'zoomInLeft', 'autozone' ) => 'zoomInLeft',
			esc_html__( 'zoomInRight', 'autozone' ) => 'zoomInRight',
			esc_html__( 'zoomInUp', 'autozone' ) => 'zoomInUp',			
			esc_html__( 'zoomOut', 'autozone' ) => 'zoomOut',
			esc_html__( 'zoomOutDown', 'autozone' ) => 'zoomOutDown',
			esc_html__( 'zoomOutLeft', 'autozone' ) => 'zoomOutLeft',
			esc_html__( 'zoomOutRight', 'autozone' ) => 'zoomOutRight',
			esc_html__( 'zoomOutUp', 'autozone' ) => 'zoomOutUp',
			
			esc_html__( 'hinge', 'autozone' ) => 'hinge',			
			esc_html__( 'rollIn', 'autozone' ) => 'rollIn',
			esc_html__( 'rollOut', 'autozone' ) => 'rollOut',
			
		),
		'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'autozone' )
	);



	$jarallax = array(
		array(
			'type' => 'attach_image',
			'heading' => "Background Image",
			'param_name' => 'bgimage',
			'value' => '',
			'description' => esc_html__( "Background image ", 'autozone' ),
			'group' => esc_html__( 'Theme Options', 'autozone' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => "Background Style",
			'param_name' => 'bgstyle',
			'value' => array(
				esc_html__( "Default", 'autozone' ) => '',
				esc_html__( "Parallax", 'autozone' ) => 'jarallax',
				esc_html__( "Fixed", 'autozone' ) => 'attachment',
			),
			'description' => esc_html__( "Image background style", 'autozone' ),
			'group' => esc_html__( 'Theme Options', 'autozone' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Stretch Content", 'autozone' ),
			'param_name' => 'jarstretch',
			'value' => array('No', 'Yes'),
			'description' => esc_html__( 'Select stretching options for content.', 'autozone' ),
			'dependency' => array(
				'element' => 'bgstyle',
				'value' => 'jarallax',
			),
			'group' => esc_html__( 'Theme Options', 'autozone' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( "Type", 'autozone' ),
			'param_name' => 'jartype',
			'value' => array('Default', 'scale', 'opacity', 'scroll-opacity', 'scale-opacity'),
			'description' => '',
			'dependency' => array(
				'element' => 'bgstyle',
				'value' => 'jarallax',
			),
			'group' => esc_html__( 'Theme Options', 'autozone' ),
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Speed", 'autozone' ),
			"param_name" => "jarspeed",
			"value" => '',
			"description" => esc_html__( "Provide numbers from -1.0 to 2.0", 'autozone' ),
			'dependency' => array(
				'element' => 'bgstyle',
				'value' => 'jarallax',
			),
			'group' => esc_html__( 'Theme Options', 'autozone' ),
		),

		array(
			'type' => 'dropdown',
			'heading' => "Text Color",
			'param_name' => 'ptextcolor',
			'value' => array("Default" , "White" , "Black"),
			'description' => esc_html__( "Text Color", 'autozone' ),
			'group' => esc_html__( 'Theme Options', 'autozone' ),
		),

	);

	$attributes1 = array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Padding', 'autozone' ),
			'param_name' => 'ppadding',
			'value' => array(
				esc_html__( "No Padding", 'autozone' ) => 'vc_row-no-padding',
				esc_html__( "Both", 'autozone' ) => 'vc_row-padding-both',
				esc_html__( "Top", 'autozone' ) => 'vc_row-padding-top',
				esc_html__( "Bottom", 'autozone' ) => 'vc_row-padding-bottom',
			),
			'description' => esc_html__( 'Top, bottom, both', 'autozone' ),
			'group' => esc_html__( 'Theme Options', 'autozone' ),
		),
	);

	$attributes2 = array(
		array(
			'type' => 'dropdown',
			'heading' => "Show Section Decor",
			'param_name' => 'pdecor',
			'value' => array(
				esc_html__( "No", 'autozone' ) => 'no',
				esc_html__( "Both", 'autozone' ) => 'both',
				esc_html__( "Top", 'autozone' ) => 'top',
				esc_html__( "Bottom", 'autozone' ) => 'bottom',
				esc_html__( "Bottom V Decor", 'autozone' ) => 'main-slider',
			),
			'description' => esc_html__( "Show decor for section.", 'autozone' ),
			'group' => esc_html__( 'Theme Options', 'autozone' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => "Section Decor Color",
			'param_name' => 'pdecor_color',
			'value' => array(
				esc_html__( "Default", 'autozone' ) => 'default',
				esc_html__( "Color", 'autozone' ) => 'colorize',
			),
			'dependency' => array(
				'element' => 'pdecor',
				'value' => array('both', 'top'),
			),
			'description' => esc_html__( "Decor color. Default Black.", 'autozone' ),
			'group' => esc_html__( 'Theme Options', 'autozone' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => "Text Color",
			'param_name' => 'ptextcolor',
			'value' => array("Default" , "White" , "Black"),
			'description' => esc_html__( "Text Color", 'autozone' ),
			'group' => esc_html__( 'Theme Options', 'autozone' ),
		),
	);

	$attributes = array_merge($attributes1, $jarallax, $attributes2);
	vc_add_params( 'vc_row', $attributes );
	vc_add_params( 'vc_row_inner', $jarallax );
	vc_add_params( 'vc_column', $jarallax );
	
	
	vc_map(
		array(
			'name' => esc_html__( 'Title', 'autozone' ),
			'base' => 'block_title',
			'class' => 'pix-theme-icon',
			'category' => esc_html__( 'Autozone', 'autozone'),
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Title', 'autozone' ),
					'param_name' => 'title',
					'value' => esc_html__( 'I am Title', 'autozone' ),
					'description' => esc_html__( 'Title param.', 'autozone' )
				),	
				 
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Title Position', 'autozone' ),
					'param_name' => 'titlepos',
					'value' => array(
						esc_html__( 'Center', 'autozone' ) => 'text-center',
						esc_html__( 'Left', 'autozone' ) => 'text-left',
						esc_html__( 'Right', 'autozone' ) => 'text-right',
					),
					'description' => esc_html__( 'Center, left or right', 'autozone' ),
				),
				$add_css_animation,
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Content', 'autozone' ),
					'param_name' => 'content',
					'value' => wp_kses_post(__( '<p>I am test text block. Click edit button to change this text.</p>', 'autozone' ) ),
					'description' => esc_html__( 'Enter your content.', 'autozone' )
				)
			)
		) 
	);
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Block_Title extends WPBakeryShortCode {
			
		}
	}
	

	//////// Services  ////////
	vc_map( array(
		'name' => esc_html__( 'Amount Section', 'autozone' ),
		'base' => 'section_amounts',
		'class' => 'pix-theme-icon',
		'as_parent' => array('only' => 'section_amount'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		'content_element' => true,
		'show_settings_on_create' => false,
		'category' => esc_html__( 'Autozone', 'autozone'),
		'params' => array(
			$add_css_animation,
		),
		'js_view' => 'VcColumnView',

	) );
	$params1 = array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Title', 'autozone' ),
					'param_name' => 'title',
					'value' => esc_html__( 'Project', 'autozone' ),
					'description' => esc_html__( 'Title.', 'autozone' )
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Amount', 'autozone' ),
					'param_name' => 'amount',
					'value' => esc_html__( '999', 'autozone' ),
					'description' => esc_html__( 'Amount.', 'autozone' )
				),
			);
	if(!function_exists('fil_init')){
		$params = $params1;
	}else{
		$params = array_merge($params1, autozone_get_vc_icons($vc_icons_data));
	}
	vc_map(
		array(
			'name' => esc_html__( 'Amount Box', 'autozone' ),
			'base' => 'section_amount',
			'class' => 'pix-theme-icon',
			'as_child' => array('only' => 'section_amounts'),
			'content_element' => true,
			'params' => $params,
		)
	);
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Section_Amounts extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Amount extends WPBakeryShortCode {
		}
	}
	/////////////////////////////////

	/// section_banner
	vc_map(
		array(
			'name' => esc_html__( 'Welcome Banner', 'autozone' ),
			'base' => 'section_banner',
			'class' => 'pix-theme-icon',
			'category' => esc_html__( 'Autozone', 'autozone'),
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Title', 'autozone' ),
					'param_name' => 'title',
					'value' => esc_html__( 'AUTOZONE', 'autozone' ),
					'description' => esc_html__( 'Button Title', 'autozone' )
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Advanced Title', 'autozone' ),
					'param_name' => 'adv_title',
					'value' => esc_html__( 'WELCOME TO', 'autozone' ),
					'description' => esc_html__( 'Text before main title', 'autozone' )
				),
				array(
					'type' => 'checkbox',
					'class' => '',
					'heading' => esc_html__( 'Use Decor', 'autozone' ),
					'param_name' => 'use_decor',
					'value' => 'true',
					'description' => esc_html__( 'Marked if checked.', 'autozone' )
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image 1', 'autozone' ),
					'param_name' => 'image1',
					'value' => '',
					'description' => esc_html__( 'Select image from media library.', 'autozone' )
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Image Text 1', 'autozone' ),
					'param_name' => 'img_text1',
					'value' => '',
					'description' => esc_html__( 'Text on image', 'autozone' )
				),
				array(
					'type' => 'vc_link',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Link 1', 'autozone' ),
					'param_name' => 'link1',
					'value' => esc_html__( 'https:/autozone.com', 'autozone' ),
					'description' => esc_html__( 'Button link', 'autozone' ),
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image 2', 'autozone' ),
					'param_name' => 'image2',
					'value' => '',
					'description' => esc_html__( 'Select image from media library.', 'autozone' )
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Image Text 2', 'autozone' ),
					'param_name' => 'img_text2',
					'value' => '',
					'description' => esc_html__( 'Button description', 'autozone' )
				),
				array(
					'type' => 'vc_link',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Link 2', 'autozone' ),
					'param_name' => 'link2',
					'value' => esc_html__( 'https:/autozone.com', 'autozone' ),
					'description' => esc_html__( 'Button link', 'autozone' ),
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image 3', 'autozone' ),
					'param_name' => 'image3',
					'value' => '',
					'description' => esc_html__( 'Select image from media library.', 'autozone' )
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Image Text 3', 'autozone' ),
					'param_name' => 'img_text3',
					'value' => '',
					'description' => esc_html__( 'Button description', 'autozone' )
				),
				array(
					'type' => 'vc_link',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Link 3', 'autozone' ),
					'param_name' => 'link3',
					'value' => esc_html__( 'https:/autozone.com', 'autozone' ),
					'description' => esc_html__( 'Button link', 'autozone' ),
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image 4', 'autozone' ),
					'param_name' => 'image4',
					'value' => '',
					'description' => esc_html__( 'Select image from media library.', 'autozone' )
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Image Text 4', 'autozone' ),
					'param_name' => 'img_text4',
					'value' => '',
					'description' => esc_html__( 'Button description', 'autozone' )
				),
				array(
					'type' => 'vc_link',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Link 4', 'autozone' ),
					'param_name' => 'link4',
					'value' => esc_html__( 'https:/autozone.com', 'autozone' ),
					'description' => esc_html__( 'Button link', 'autozone' ),
				),
				$add_css_animation,
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Content', 'autozone' ),
					'param_name' => 'content',
					'value' => esc_html__( 'THE ONLINE AUTOS WORLD', 'autozone' ),
					'description' => esc_html__( 'Banner Text', 'autozone' ),
				),
			)
		) 
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Banner extends WPBakeryShortCode {
			
		}
	}
	


	//////// Services  ////////
	vc_map( array(
		'name' => esc_html__( 'Services', 'autozone' ),
		'base' => 'section_services',
		'class' => 'pix-theme-icon',
		'as_parent' => array('only' => 'section_service'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		'content_element' => true,
		'show_settings_on_create' => false,
		'category' => esc_html__( 'Autozone', 'autozone'),
		'params' => array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Carousel', 'autozone' ),
				'param_name' => 'disable_carousel',
				'value' => array(
					esc_html__('Enable', 'autozone') => 1,
					esc_html__('Disable', 'autozone') => 0,
				),
				'description' => esc_html__( 'On/off carousel', 'autozone' )
			),
			$add_css_animation,
		),
		'js_view' => 'VcColumnView',

	) );
	$params1 = array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'autozone' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Title info.', 'autozone' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Strong Title', 'autozone' ),
					'param_name' => 'title_strong',
					'description' => esc_html__( 'Strong part of title text.', 'autozone' )
				),
			);
	$params2 = array(
				array(
					'type' => 'vc_link',
					'heading' => esc_html__( 'Link', 'autozone' ),
					'param_name' => 'link',
					'description' => esc_html__( 'Service page link.', 'autozone' )
				),
				$add_css_animation,
				array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => esc_html__( "Info", 'autozone' ),
					"param_name" => "content",
					"value" => esc_html__( 'I am test text block. Click edit button to change this text.', 'autozone' ),
					"description" => esc_html__( "Enter information.", 'autozone' ),
				),
			);
	if(!function_exists('fil_init')){
		$params = array_merge($params1, $params2);
	}else{
		$params = array_merge($params1, autozone_get_vc_icons($vc_icons_data), $params2);
	}
	vc_map( 
		array(
			'name' => esc_html__( 'Service Box', 'autozone' ),
			'base' => 'section_service',
			'class' => 'pix-theme-icon',
			'as_child' => array('only' => 'section_services'),
			'content_element' => true,
			'params' => $params,
		) 
	);
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Section_Services extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Service extends WPBakeryShortCode {
		}
	}
	/////////////////////////////////
	
	
	/// section_imagescarousel
	vc_map(
		array(
			"name" => esc_html__( "Images Carousel", 'autozone' ),
			"base" => "section_imagescarousel",
			"class" => "pix-theme-icon",
			"category" => esc_html__( "Autozone", 'autozone'),
			"params" => array(
				array(
					'type' => 'attach_images',
					'heading' => esc_html__( 'Images', 'autozone' ),
					'param_name' => 'images',
					'value' => '',
					'description' => esc_html__( 'Select images from media library.', 'autozone' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Image size', 'autozone' ),
					'param_name' => 'img_size',
					'value' => 'thumbnail',
					'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size. If used slides per view, this will be used to define carousel wrapper size.', 'autozone' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Auto Play', 'autozone' ),
					'param_name' => 'autoplay',
					'value' => '4000',
					'description' => esc_html__( 'Enter autoplay speed in milliseconds. 0 is turn off autoplay.', 'autozone' ),
				),
				$add_css_animation,
			)
		) 
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Imagescarousel extends WPBakeryShortCode {
			
		}
	}
	
	

	
	//////////////////////////////////////////////////////////////////////
	
		
	/// block_posts
	vc_map(
		array(
			"name" => esc_html__( "News Block", 'autozone' ),
			"base" => "block_posts",
			"class" => "pix-theme-icon3",
			"category" => esc_html__( "Autozone", 'autozone'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Title", 'autozone' ),
					"param_name" => "title",
					"value" => esc_html__( "Latest News", 'autozone' ),
					"description" => esc_html__( "", 'autozone' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Text', 'autozone' ),
					'param_name' => 'btn_text',
					'value' => esc_html__( 'READ BLOG', 'autozone' ),
					'description' => esc_html__( 'Leave empty to hide bytton.', 'autozone' ),
				),
				array(
					'type' => 'vc_link',
					'heading' => esc_html__( 'Link For All News', 'autozone' ),
					'param_name' => 'link',
					'value' => '',
					'description' => '',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Color scheme', 'autozone' ),
					'param_name' => 'skin',
					'value' => array(
						esc_html__( "Light", 'autozone' ) => 'pix-lastnews-light',
						esc_html__( "Dark", 'autozone' ) => 'pix-lastnews-dark',
					),
					'description' => '',
				),
				array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => esc_html__( "Title Content", 'autozone' ),
					"param_name" => "content",
					"value" => esc_html__( "READ our latest blog news", 'autozone' ),
					"description" => esc_html__( "Enter your title content.", 'autozone' ),
				),
				$add_css_animation,
			)
		)
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Block_Posts extends WPBakeryShortCode {

		}
	}
	//////////////////////////////////////////////////////////////////////



	/// section_3d
	vc_map(
		array(
			"name" => esc_html__( "3D Viewer", 'autozone' ),
			"base" => "section_3d",
			"class" => "pix-theme-icon1",
			"category" => esc_html__( 'Autozone', 'autozone'),
			"params" => array(
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image', 'autozone' ),
					'param_name' => 'image',
					'value' => '',
					'description' => esc_html__( 'Select image from media library.', 'autozone' )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => esc_html__( "Number of frames", 'autozone' ),
					"param_name" => "number",
					"value" => '16',
					"description" => esc_html__( "Default 16", 'autozone' )
				),
			)
		)
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_3d extends WPBakeryShortCode {

		}
	}



	/// section_map
	vc_map(
		array(
			"name" => esc_html__( "Google Map", 'autozone' ),
			"base" => "section_map",
			"class" => "pix-theme-icon",
			"category" => esc_html__( 'Autozone', 'autozone'),
			"params" => array(
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Marker Image', 'autozone' ),
					'param_name' => 'image',
					'value' => '',
					'description' => esc_html__( 'Select image from media library.', 'autozone' )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"heading" => esc_html__( "Address", 'autozone' ),
					"param_name" => "address",
					"value" => '',
					"description" => esc_html__( "Example: San Diego, CA", 'autozone' )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"heading" => esc_html__( "Map Width", 'autozone' ),
					"param_name" => "width",
					"value" => '',
					"description" => esc_html__( "Default 90%", 'autozone' )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"heading" => esc_html__( "Map Height", 'autozone' ),
					"param_name" => "height",
					"value" => '',
					"description" => esc_html__( "Default 500px", 'autozone' )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"heading" => esc_html__( "Zoom", 'autozone' ),
					"param_name" => "zoom",
					"value" => '',
					"description" => esc_html__( "Zoom 0-20. Default 8.", 'autozone' )
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__( "Scroll Wheel", 'autozone' ),
					"param_name" => "scrollwheel",
					'value' => array(
						esc_html__( "Off", 'autozone' ) => 'false',
						esc_html__( "On", 'autozone' ) => 'true',
					),
					"description" => esc_html__( "Zoom map with scroll", 'autozone' )
				),
			)
		)
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Map extends WPBakeryShortCode {

		}
	}


			
	//////// Carousel Reviews ////////
	vc_map( array(
		'name' => esc_html__( 'Reviews', 'autozone' ),
		'base' => 'section_reviews',
		'class' => 'pix-theme-icon', 
		'as_parent' => array('only' => 'section_review'),
		'content_element' => true,
		'show_settings_on_create' => true,
		'category' => esc_html__( 'Autozone', 'autozone'),
		
		'params' => array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Reviews per page', 'autozone' ),
				'param_name' => 'reviews_per_page',
				'value' => array(
					esc_html__( "3", 'autozone' ) => 3,
					esc_html__( "2", 'autozone' ) => 2,
					esc_html__( "1", 'autozone' ) => 1,
				),
				'description' => esc_html__( 'Select number of columns.', 'autozone' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Carousel', 'autozone' ),
				'param_name' => 'disable_carousel',
				'value' => array(
					esc_html__('Enable', 'autozone') => 1,
					esc_html__('Disable', 'autozone') => 0,
				),
				'description' => esc_html__( 'On/off carousel', 'autozone' )
			),
		),
		
		
		'js_view' => 'VcColumnView',
		
	) );
	vc_map( array(
		'name' => esc_html__( 'Review', 'autozone' ),
		'base' => 'section_review',
		'class' => 'pix-theme-icon', 
		'as_child' => array('only' => 'section_reviews'),
		'content_element' => true,
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'autozone' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Review title.', 'autozone' )
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'autozone' ),
				'param_name' => 'image',
				'description' => esc_html__( 'Select image.', 'autozone' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Name', 'autozone' ),
				'param_name' => 'name',
				'description' => esc_html__( 'Person name.', 'autozone' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Position', 'autozone' ),
				'param_name' => 'position',
				'description' => esc_html__( 'Text under the name.', 'autozone' )
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Review Text", 'autozone' ),
				"param_name" => "content",
				"value" => wp_kses_post(__( "<p>I am test text block. Click edit button to change this text.</p>", 'autozone' )),
				"description" => esc_html__( "Enter text.", 'autozone' )
			),
		)
	) );
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Section_Reviews extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Review extends WPBakeryShortCode {
		}
	}
	/////////////////////////////////	



	/// section_team
	//////// Our Team ////////
	vc_map( array(
		'name' => esc_html__( 'Team slider', 'autozone' ),
		'base' => 'section_team',
		'class' => 'pix-theme-icon', 
		'as_parent' => array('only' => 'section_team_member'),
		'content_element' => true,
		'show_settings_on_create' => true,
		'category' => esc_html__( 'Autozone', 'autozone'),
		'params' => array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Carousel', 'autozone' ),
				'param_name' => 'carousel',
				'value' => array(
					esc_html__( "Disable", 'autozone' ) => 'disable-owl-carousel',
					esc_html__( "Enable", 'autozone' ) => 'owl-carousel enable-owl-carousel',
				),
				'description' => esc_html__( 'On/off carousel', 'autozone' )
			),
			
			$add_css_animation,
		),
		'js_view' => 'VcColumnView',
		
	) );
	vc_map( array(
		'name' => esc_html__( 'Team Member', 'autozone' ),
		'base' => 'section_team_member',
		'class' => 'pix-theme-icon', 
		'as_child' => array('only' => 'section_team'),
		'content_element' => true,
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'autozone' ),
				'param_name' => 'image',
				'description' => esc_html__( 'Select image.', 'autozone' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Name', 'autozone' ),
				'param_name' => 'name',
				'description' => esc_html__( 'Team member name.', 'autozone' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Position', 'autozone' ),
				'param_name' => 'position',
				'description' => esc_html__( 'Member position.', 'autozone' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Skill Level', 'autozone' ),
				'param_name' => 'skill',
				'description' => esc_html__( 'From 0 to 100%', 'autozone' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 1', 'autozone' ),
				'param_name' => 'scn1',
				'description' => esc_html__( 'https://www.facebook.com/', 'autozone' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 1', 'autozone' ),
				'param_name' => 'scn_icon1',
				'description' => wp_kses_post(__( 'Add icon social_facebook_circle <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'autozone' )),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 2', 'autozone' ),
				'param_name' => 'scn2',
				'description' => esc_html__( 'https://twitter.com/', 'autozone' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 2', 'autozone' ),
				'param_name' => 'scn_icon2',
				'description' => wp_kses_post(__( 'Add icon social_twitter_circle <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'autozone' )),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 3', 'autozone' ),
				'param_name' => 'scn3',
				'description' => esc_html__( 'https://www.pinterest.com/', 'autozone' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 3', 'autozone' ),
				'param_name' => 'scn_icon3',
				'description' => wp_kses_post(__( 'Add icon social_pinterest_circle <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'autozone' )),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Link 4', 'autozone' ),
				'param_name' => 'scn4',
				'description' => esc_html__( 'https://plus.google.com/', 'autozone' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Social Network Icon 4', 'autozone' ),
				'param_name' => 'scn_icon4',
				'description' => wp_kses_post(__( 'Add icon social_googleplus_circle <a href="//fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'autozone' )),
			),
			$add_css_animation,
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Info", 'autozone' ),
				"param_name" => "content", 
				"value" => wp_kses_post(__( "<p>I am test text block. Click edit button to change this text.</p>", 'autozone' )),
				"description" => esc_html__( "Enter information.", 'autozone' )
			),
		)
	) );
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Section_Team extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Team_Member extends WPBakeryShortCode {
		}
	}
	////////////////////////
	
	
	/// section_brands
	vc_map( array(
		'name' => esc_html__( 'Brands Section', 'autozone' ),
		'base' => 'section_brands',
		'class' => 'pix-theme-icon1',
		'as_parent' => array('only' => 'section_brand'),
		'content_element' => true,
		'show_settings_on_create' => true,
		'category' => esc_html__( 'Autozone', 'autozone'),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Brands per page', 'autozone' ),
				'param_name' => 'brands_per_page',
				'description' => esc_html__( 'Select number of columns. Default 5.', 'autozone' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Carousel', 'autozone' ),
				'param_name' => 'disable_carousel',
				'value' => array(
					esc_html__('Enable', 'autozone') => 1,
					esc_html__('Disable', 'autozone') => 0,
				),
				'description' => esc_html__( 'On/off carousel', 'autozone' )
			),
		),
		'js_view' => 'VcColumnView',

	) );
	vc_map( array(
		'name' => esc_html__( 'Brand', 'autozone' ),
		'base' => 'section_brand',
		'class' => 'pix-theme-icon1',
		'as_child' => array('only' => 'section_brands'),
		'content_element' => true,
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'autozone' ),
				'param_name' => 'image',
				'value' => '',
				'description' => esc_html__( 'Select image from media library.', 'autozone' )
			),
			array(
				"type" => "vc_link",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "url", 'autozone' ),
				"param_name" => "url",
				"value" => esc_html__( "https://wordpress.com", 'autozone' ),
				"description" => '',
			),
		)
	) );
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Section_Brands extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Section_Brand extends WPBakeryShortCode {
		}
	}
	////////////////////////
	
	
	//////// Social Buttons ////////
	vc_map( array(
		'name' => esc_html__( 'Social Buttons', 'autozone' ),
		'base' => 'socialbuts',
		'class' => 'pix-theme-icon', 
		'as_parent' => array('only' => 'socialbut'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		'content_element' => true,
		'show_settings_on_create' => false,
		'category' => esc_html__( 'Autozone', 'autozone'),	
		'js_view' => 'VcColumnView',
		'params' => array(),
		
	) );
	$params1 = array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'autozone' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Social title.', 'autozone' )
				),
			);
	$params2 = array(
				array(
					'type' => 'vc_link',
					'holder' => 'div',
					'heading' => esc_html__( 'Link', 'autozone' ),
					'param_name' => 'link',
					'description' => esc_html__( 'Social link.', 'autozone' )
				),
			);
	if(!function_exists('fil_init')){
		$params = array_merge($params1, $params2);
	}else{
		$params = array_merge($params1, autozone_get_vc_icons($vc_icons_data), $params2);
	}
	vc_map( array(
		'name' => esc_html__( 'Social Button', 'autozone' ),
		'base' => 'socialbut',
		'class' => 'pix-theme-icon', 
		'as_child' => array('only' => 'socialbuts'),
		'content_element' => true,
		'params' => $params,
	) );
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Socialbuts extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Socialbut extends WPBakeryShortCode {
		}
	}
	////////////////////////



	if ( class_exists( 'WooCommerce' ) ) {
		/// section_woocommerce
		//////// Woocommerce Products ////////
		vc_map(
			array(
				"name" => esc_html__( "Woocommerce Products", 'autozone' ),
				"base" => "section_woocommerce",
				"class" => "pix-theme-icon",
				"category" => esc_html__( 'Autozone', 'autozone'),
				"params" => array(
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Categories', 'autozone' ),
						'param_name' => 'cats',
						'value' => $cats_woo,
						'description' => esc_html__( 'Select categories to show', 'autozone' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Items Count', 'autozone' ),
						'param_name' => 'count',
						'description' => esc_html__( 'Select number products.', 'autozone' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Carousel', 'autozone' ),
						'param_name' => 'carousel',
						'value' => array(
							esc_html__( "Enable", 'autozone' ) => 'owl-carousel enable-owl-carousel',
							esc_html__( "Disable", 'autozone' ) => 'disable-owl-carousel',
						),
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Slider Controls', 'autozone' ),
						'param_name' => 'controls',
						'value' => array(
							esc_html__( "Default", 'autozone' ) => '',
							esc_html__( "Controls Right", 'autozone' ) => 'full-width-slider-controls-right',
							esc_html__( "Controls Left", 'autozone' ) => 'full-width-slider-controls-left',
						),
						'description' => esc_html__( 'Select controls position.', 'autozone' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Min slides', 'autozone' ),
						'param_name' => 'min_slides',
						'description' => esc_html__( 'Min slides on page. Default 4.', 'autozone' )
					),
					$add_css_animation,
				)
			)
		);
		if ( class_exists( 'WPBakeryShortCode' ) ) {
			class WPBakeryShortCode_Section_Woocommerce extends WPBakeryShortCode {

			}
		}



		vc_map(
			array(
				"name" => esc_html__( "Woocommerce Category", 'autozone' ),
				"base" => "section_woocommerce_cat",
				"class" => "pix-theme-icon",
				"category" => esc_html__( 'Autozone', 'autozone'),
				"params" => array(
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Categories', 'autozone' ),
						'param_name' => 'cats',
						'value' => $cats_woo,
						'description' => esc_html__( 'Select categories to show', 'autozone' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Items Count', 'autozone' ),
						'param_name' => 'count',
						'description' => esc_html__( 'Select number products.', 'autozone' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Carousel', 'autozone' ),
						'param_name' => 'carousel',
						'value' => array(
							esc_html__( "Enable", 'autozone' ) => 'owl-carousel enable-owl-carousel',
							esc_html__( "Disable", 'autozone' ) => 'disable-owl-carousel',
						),
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Slider Controls', 'autozone' ),
						'param_name' => 'controls',
						'value' => array(
							esc_html__( "Default", 'autozone' ) => '',
							esc_html__( "Controls Right", 'autozone' ) => 'full-width-slider-controls-right',
							esc_html__( "Controls Left", 'autozone' ) => 'full-width-slider-controls-left',
						),
						'description' => esc_html__( 'Select controls position.', 'autozone' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Min slides', 'autozone' ),
						'param_name' => 'min_slides',
						'description' => esc_html__( 'Min slides on page. Default 4.', 'autozone' )
					),
					$add_css_animation,
				)
			)
		);
		if ( class_exists( 'WPBakeryShortCode' ) ) {
			class WPBakeryShortCode_Section_Woocommerce_Cat extends WPBakeryShortCode {

			}
		}
	}
	//} ////// <= End vc_inline


	if ( class_exists( 'Pix_Autos' ) ) {

		$args = array( 'taxonomy' => 'auto-model', 'hide_empty' => '0');
		$auto_model_categories = get_categories($args);
		$auto_models = array();
		$i = 0;
		foreach($auto_model_categories as $category){
			if(is_object($category)){
				if($i==0){
					$default = $category->slug;
					$i++;
				}
				$auto_models[$category->name] = $category->term_id;
			}
		}
		//////// Pixad_Autos Latest Offers ////////

		vc_map( array(
			'name' => esc_html__( 'Latest Autos (8 or 4)', 'autozone' ),
			'base' => 'section_autos_even',
			'class' => 'pix-theme-icon',
			'category' => esc_html__( 'Autozone', 'autozone'),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Items Per Page', 'autozone' ),
					'param_name' => 'per_page',
					'value' => array(
						esc_html__('8 in two rows', 'autozone') => '8',
						esc_html__('4 in one row', 'autozone') => '4',
					),
					'description' => esc_html__( 'Select items number to show', 'autozone' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Items Count', 'autozone' ),
					'param_name' => 'count',
					'value' => '',
					'description' => esc_html__( 'Select items number to show', 'autozone' ),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Auto Models', 'autozone' ),
					'param_name' => 'models',
					'value' => $auto_models,
					'description' => esc_html__( 'Select auto models to show', 'autozone' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Carousel', 'autozone' ),
					'param_name' => 'carousel',
					'value' => array(
						esc_html__('Enable', 'autozone') => 1,
						esc_html__('Disable', 'autozone') => 0,
					),
					'description' => esc_html__( 'On/off carousel', 'autozone' )
				),
			),

		) );
		if ( class_exists( 'WPBakeryShortCode' ) ) {
			class WPBakeryShortCode_Section_Autos_Even extends WPBakeryShortCode {
			}
		}

		vc_map( array(
			'name' => esc_html__( 'Latest Autos (5 with 1 large)', 'autozone' ),
			'base' => 'section_autos',
			'class' => 'pix-theme-icon',
			'as_parent' => array('only' => 'section_autos_slide'),
			'content_element' => true,
			'show_settings_on_create' => true,
			'category' => esc_html__( 'Autozone', 'autozone'),
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Slide Type', 'autozone' ),
					'param_name' => 'slide_type',
					'value' => array(
						esc_html__('Items by ID', 'autozone') => 'ids',
						esc_html__('Items by Date', 'autozone') => 'idate',
					),
					'description' => esc_html__( 'Select items by IDs or latest by date', 'autozone' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Items Count', 'autozone' ),
					'param_name' => 'count',
					'value' => array(5, 10, 15, 20, 25),
					'dependency' => array(
						'element' => 'slide_type',
						'value' => array('idate'),
					),
					'description' => esc_html__( 'Select items number to show', 'autozone' ),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Auto Models', 'autozone' ),
					'param_name' => 'models',
					'value' => $auto_models,
					'description' => esc_html__( 'Select auto models to show', 'autozone' ),
					'dependency' => array(
						'element' => 'slide_type',
						'value' => array('idate'),
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Carousel', 'autozone' ),
					'param_name' => 'carousel',
					'value' => array(
						esc_html__('Enable', 'autozone') => 1,
						esc_html__('Disable', 'autozone') => 0,
					),
					'description' => esc_html__( 'On/off carousel', 'autozone' )
				),
			),

		) );
		vc_map( array(
			'name' => esc_html__( 'Autos Slide', 'autozone' ),
			'base' => 'section_autos_slide',
			'class' => 'pix-theme-icon',
			'as_child' => array('only' => 'section_autos'),
			'content_element' => true,
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Main Item ID', 'autozone' ),
					'param_name' => 'item_1',
					'description' => esc_html__( 'Item with large image. Input item ID', 'autozone' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Second Item ID', 'autozone' ),
					'param_name' => 'item_2',
					'description' => esc_html__( 'Input item ID', 'autozone' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Third Item ID', 'autozone' ),
					'param_name' => 'item_3',
					'description' => esc_html__( 'Input item ID', 'autozone' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Fourth Item ID', 'autozone' ),
					'param_name' => 'item_4',
					'description' => esc_html__( 'Input item ID', 'autozone' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Fifth Item ID', 'autozone' ),
					'param_name' => 'item_5',
					'description' => esc_html__( 'Input item ID', 'autozone' ),
				),
			)
		) );
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
			class WPBakeryShortCode_Section_Autos extends WPBakeryShortCodesContainer {
			}
		}
		if ( class_exists( 'WPBakeryShortCode' ) ) {
			class WPBakeryShortCode_Section_Autos_Slide extends WPBakeryShortCode {
			}
		}


		$args = array( 'taxonomy' => 'auto-body', 'hide_empty' => '0');
		$auto_categories = get_categories($args);
		$auto_cats = array();
		$i = 0;
		foreach($auto_categories as $category){
			if(is_object($category)){
				if($i==0){
					$default = $category->slug;
					$i++;
				}
				$auto_cats[$category->name] = $category->term_id;
			}
		}
		//////// Pixad_Autos Body Types ////////
		vc_map(
			array(
				"name" => esc_html__( "Auto Body Types", 'autozone' ),
				"base" => "section_autos_cat",
				"class" => "pix-theme-icon",
				"category" => esc_html__( 'Autozone', 'autozone'),
				"params" => array(
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Body Types', 'autozone' ),
						'param_name' => 'cats',
						'value' => $auto_cats,
						'description' => esc_html__( 'Select body types to show', 'autozone' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Offer Text', 'autozone' ),
						'param_name' => 'offers',
						'value' => esc_html__( 'Offers', 'autozone' ),
						'description' => esc_html__( 'Offers number text', 'autozone' ),
					),
					$add_css_animation,
				)
			)
		);
		if ( class_exists( 'WPBakeryShortCode' ) ) {
			class WPBakeryShortCode_Section_Autos_Cat extends WPBakeryShortCode {

			}
		}
	}
	//} ////// <= End vc_inline


///////////////////////////////////// Standart Templines Widgets /////////////////////////////////////

	/// box_icon
	$params1 = array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => esc_html__( "Title", 'autozone' ),
					"param_name" => "title",
					"value" => esc_html__( "I am title", 'autozone' ),
					"description" => esc_html__( "Add Title ", 'autozone' )
				),
			);
	$params2 = array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon Position', 'autozone' ),
					'param_name' => 'position',
					'value' => array(
						esc_html__( "Left", 'autozone' ) => 'icon-left',
						esc_html__( "Right", 'autozone' ) => 'icon-right',
						esc_html__( "Center", 'autozone' ) => 'icon-center',
					),
					'description' => '',
				),
				array(
					'type' => 'vc_link',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Link', 'autozone' ),
					'param_name' => 'link',
					'value' => esc_html__( 'https:/autozone.com', 'autozone' ),
					'description' => esc_html__( 'Button link', 'autozone' )
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Button Text', 'autozone' ),
					'param_name' => 'btn_text',
					'value' => '',
					'description' => '',
				),
				$add_css_animation,
				array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => esc_html__( "Content", 'autozone' ),
					"param_name" => "content",
					"value" => wp_kses_post(__( "<p>I am test text block. Click edit button to change this text.</p>", 'autozone' )),
					"description" => esc_html__( "Enter your content.", 'autozone' )
				)
			);
	if(!function_exists('fil_init')){
		$params = array_merge($params1, $params2);
	}else{
		$params = array_merge($params1, autozone_get_vc_icons($vc_icons_data), $params2);
	}
	


	if(isset($_GET['vc_action']) && $_GET['vc_action'] == 'vc_inline'){
		wp_enqueue_style('autozone-theme', get_stylesheet_directory_uri() . '/css/editor_styles.css');
	}

	return true;
	
}


?>