<?php
global $post;
/**
 * Shortcode attributes
 * @var $atts
 * @var $cats
 * @var $offers
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Section_Autos_Cat
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$figure = '';

if( $cats == '' ):
	$out = '<p>'.esc_html__('No Body Types selected. To fix this, please login to your WP Admin area and set the body types you want to show by editing this shortcode and setting one or more body types in the multi checkbox field "Body Types".', 'autozone');
else:

$out = $css_animation != '' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '<div>';
$out .= '
			<ul class="list-type">
		';

	$args = array( 'taxonomy' => 'auto-body', 'hide_empty' => '0', 'include' => $cats);
	$autos_categories = get_categories ($args);
	if( $autos_categories ):
			foreach($autos_categories as $auto_cat) :
				$auto_t_id = $auto_cat->term_id;
				$auto_cat_meta = get_option("auto_body_$auto_t_id");
				$auto_cat_thumb_url = get_option("pixad_body_thumb$auto_t_id");
				$auto_link = get_term_link( $auto_cat );
				if($auto_cat_thumb_url){
					$img_src = wp_get_attachment_image_src( autozone_get_image_id( $auto_cat_thumb_url ), 'autozone-body-thumb' );
					$figure = '<img src="'.esc_url($img_src[0]).'" alt="'.esc_attr($auto_cat->name).'">';
				} elseif(isset($auto_cat_meta['pixad_body_icon'])){
					$figure = '<i class="icon '. esc_attr($auto_cat_meta['pixad_body_icon']) .'"></i>';
				}
	$out .= '
				<li class="list-type__item">
					<a class="list-type__link" href="'.esc_url($auto_link).'">
						<div class="list-type__inner">
							'.wp_kses_post($figure).'
							<div class="decor-1 center-block"></div>
							<div class="list-type__name">'.wp_kses_post($auto_cat->name).'</div>
							<div class="list-type__info">'.wp_kses_post($auto_cat->count).' '.esc_html__('Vehicle(s)', 'autozone').'</div>
						</div>
					</a>
				</li>
	';
			 endforeach;
	endif;

$out .= '
			</ul>
	';

$out .= '</div>';
endif;
echo $out;
