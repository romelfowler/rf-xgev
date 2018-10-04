<?php

	$post_ID = isset ($wp_query) ? $wp_query->get_queried_object_id() : (isset($post->ID) && $post->ID>0 ? $post->ID : '');
    if( class_exists( 'WooCommerce' ) && autozone_is_woo_page() && autozone_get_option('woo_header_global','1') ){
		$post_ID = get_option( 'woocommerce_shop_page_id' ) ? get_option( 'woocommerce_shop_page_id' ) : $post_ID;
	}

	$autozone_header = apply_filters('autozone_header_settings', $post_ID);

    $footerStaticBlockID = false;

    if (isset($GLOBALS['autozone_footer_type_page']) && $GLOBALS['autozone_footer_type_page']){
        $pix_footer_type_page = $GLOBALS['autozone_footer_type_page'];
        if (is_array($pix_footer_type_page)){
            foreach($pix_footer_type_page as $key=>$pftp){
                if ($pftp == 'global')
                    unset($pix_footer_type_page[$key]);
            }
        }
        $footerStaticBlockID = $pix_footer_type_page;
    }

    $footerStaticBlockGlobalID = autozone_get_option('footer_block');


    $bottomBlock = html_entity_decode(autozone_get_option('footer_settings_copyright', esc_html__('Copyright 2017. Design by CIM', 'autozone') ));
	$footer_logo = autozone_get_option('footer_logo','');
	$autozone_decor_class = autozone_get_option('footer_decor', '1') ? 'border-section-top border-section-top_mod-b' : '';
?>

<?php if(isset($footerStaticBlockID[0]) && $footerStaticBlockID[0] == 'nofooter') : ?>
<?php else : ?>
<footer class="footer">

     <div class="container"> <div class="wrap-section-border"><div class="bg_inner <?php echo esc_attr($autozone_decor_class); ?>"></div></div></div>

    <div>
        <section class="section_mod-h section-bg section-bg_second">
            <div class="bg-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="<?php echo esc_url(home_url('/')) ?>" class="logo">
															<?php if($footer_logo):?>
																<img class="logo__img img-responsive" src="<?php echo esc_url($footer_logo) ?>" alt="<?php esc_attr_e('Footer Logo', 'autozone') ?>" />
															<?php else:?>
																<img class="logo__img img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/logo.jpg" alt="<?php esc_attr_e('Footer Logo', 'autozone') ?>" />
															<?php endif?>
														</a>
                            <div class="decor-1 decor-1_mod-b"></div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <?php if ($footerStaticBlockID) autozone_get_staticblock_content($footerStaticBlockID) ?>

					<?php if (!$footerStaticBlockID && $footerStaticBlockGlobalID):?>
					         <?php echo autozone_get_staticblock_content($footerStaticBlockGlobalID)?>
					<?php endif; ?>

                </div>
                <!-- end container -->
            </div>
            <!-- end bg-inner -->
        </section>
        <!-- end section_mod-b -->
    </div>
    <!-- end wrap-section-border -->
    <div class="footer__wrap-btn"> <a class="footer__btn" href="javascript:void(0);"><?php esc_html_e('top', 'autozone') ?></a> </div>
    <div class="copyright"><?php echo wp_kses_post( $bottomBlock ); ?></div> 
</footer>
<?php endif; ?>

</div></div>

<?php if($autozone_header['header_menu_animation'] == 'reveal') : ?>
<!-- ========================== -->
<!-- END CONTAINER SLIDE MENU -->
<!-- ========================== -->
</div>
<?php endif; ?>

<?php if($autozone_header['header_sidebar_view'] == 'fixed') : ?>
<!-- END FIXED SIDEBAR MENU  -->
</div>
<?php endif; ?>

<?php
    wp_footer();
?>


</body></html>
