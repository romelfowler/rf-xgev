<?php
global $post, $PIXAD_Autos;
$Settings = new PIXAD_Settings();
$settings = $Settings->getSettings( 'WP_OPTIONS', '_pixad_autos_settings', true );

$validate = $Settings->getSettings( 'WP_OPTIONS', '_pixad_autos_validation', true ); // Get validation settings
$validate = pixad::validation( $validate ); // Fix undefined index notice

$auto_translate = unserialize( get_option( '_pixad_auto_translate' ) );

?>


    <?php while ( have_posts() ) : the_post(); ?>
        <article class="card clearfix" id="post-<?php the_ID(); ?>">
            <div class="card__img">
                <?php if( has_post_thumbnail() ): ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('autozone-auto-cat', array('class' => 'img-responsive')); ?>
                    </a>
                <?php else: ?>
                    <img class="no-image" src="<?php echo PIXAD_AUTO_URI .'assets/img/no_image.jpg'; ?>" alt="no-image">
                <?php endif; ?>
                <?php if( get_post_meta(get_the_ID(), 'pixad_auto_featured', true) ): ?>
                    <span class="card__wrap-label"><span class="card__label"><?php echo wp_kses_post($auto_translate[get_post_meta(get_the_ID(), 'pixad_auto_featured', true)]); ?></span></span>
                <?php endif; ?>
            </div>
            <div class="card__inner">
                <h2 class="card__title ui-title-inner"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="decor-1"></div>
                <div class="card__description">
                    <p><?php the_excerpt() ?></p>
                </div>
                <!-- Car Details -->
                <ul class="card__list list-unstyled">

                    <?php if( $validate['auto-fuel_show'] ): ?>
                    <li class="card-list__row">
                      <span class="card-list__title"><?php esc_html_e( 'Fuel:', 'autozone' ); ?></span>

                      <?php if( $PIXAD_Autos->get_meta('_auto_fuel') ): ?>
                        <span class="card-list__info"><?php echo wp_kses_post(( $auto_translate[$PIXAD_Autos->get_meta('_auto_fuel')] )) ?></span>
                      <?php endif; ?>
                    </li>
                    <?php endif; ?>

                    <?php if( $validate['auto-mileage_show'] ): ?>
                    <li class="card-list__row"><!-- Mileage -->
                      <span class="card-list__title"><?php esc_html_e( 'Mileage:', 'autozone' ); ?></span>

                      <?php if( $PIXAD_Autos->get_meta('_auto_mileage') ): ?>
                        <span class="card-list__info"><?php echo number_format($PIXAD_Autos->get_meta('_auto_mileage')); ?></span>
                      <?php endif; ?>
                    </li>
                    <?php endif; ?>

                    <?php if( $validate['auto-year_show'] ): ?>
                    <li class="card-list__row">
                      <span class="card-list__title"><?php esc_html_e( 'Year:', 'autozone' ); ?></span>

                      <?php if( $PIXAD_Autos->get_meta('_auto_year') ): ?>
                        <span class="card-list__info"><?php echo wp_kses_post($PIXAD_Autos->get_meta('_auto_year')) ?></span>
                      <?php endif; ?>
                    </li>
                    <?php endif; ?>

                    <?php /* if( $validate['seller-country_show'] ): ?>
                    <li class="card-list__row">
                      <span class="card-list__title"><?php esc_html_e( 'Location:', 'autozone' ); ?></span>
                      <?php $country = new PIXAD_Country(); ?>

                      <?php if( $PIXAD_Autos->get_meta('_seller_country') ): ?>
                        <span class="card-list__info"><?php $country->text_output( $PIXAD_Autos->get_meta('_seller_country') ); ?></span>
                      <?php endif; ?>
                    </li>
                    <?php endif; */ ?>

                    <?php if( $validate['auto-condition_show'] && $PIXAD_Autos->get_meta('_auto_condition') ): ?>
                        <li class="card-list__row">
                            <span class="card-list__title"><?php esc_html_e( 'Condition:', 'autozone' ); ?></span>
                        <?php if( $PIXAD_Autos->get_meta('_auto_condition') == 'used' ): ?>
                            <span class="card-list__info"><?php esc_html_e( 'Used', 'autozone' ); ?></span>
                        <?php else: ?>
                            <span class="card-list__info"><?php esc_html_e( 'New', 'autozone' ); ?></span>
                        <?php endif; ?>
                        </li>
                    <?php endif; ?>

                    <?php if( $validate['auto-drive_show'] && $PIXAD_Autos->get_meta('_auto_drive') ): ?>
                        <li class="card-list__row">
                            <span class="card-list__title"><?php esc_html_e( 'Drive:', 'autozone' ); ?></span>
                        <?php if( $PIXAD_Autos->get_meta('_auto_drive') == 'left' ): ?>
                            <span class="card-list__info"><?php esc_html_e( 'Left drive', 'autozone' ); ?></span>
                        <?php else: ?>
                            <span class="card-list__info"><?php esc_html_e( 'Right drive', 'autozone' ); ?></span>
                        <?php endif; ?>
                        </li>
                    <?php endif; ?>

                    <?php if( $validate['auto-engine_show'] && $PIXAD_Autos->get_meta('_autoesc_html_engine') ): ?>
                        <li class="card-list__row">
                            <span class="card-list__title"><?php esc_html_e( 'Engine:', 'autozone' ); ?></span>
                            <span class="card-list__info"><?php echo wp_kses_post($PIXAD_Autos->get_meta('_autoesc_html_engine')) ?> <?php esc_html_e( 'cm3', 'autozone' ); ?></span>
                        </li>
                    <?php endif; ?>

                    <?php if( $validate['auto-horsepower_show'] && $PIXAD_Autos->get_meta('_auto_horsepower') ): ?>
                        <li class="card-list__row">
                            <span class="card-list__title"><?php esc_html_e( 'Horsepower:', 'autozone' ); ?></span>
                            <span class="card-list__info"><?php echo wp_kses_post($PIXAD_Autos->get_meta('_auto_horsepower')).' '.esc_html__( 'hp', 'autozone' ); ?></span>
                        </li>
                    <?php endif; ?>

                    <?php if( $validate['auto-doors_show'] && $PIXAD_Autos->get_meta('_auto_doors') ): ?>
                        <li class="card-list__row">
                            <span class="card-list__title"><?php esc_html_e( 'Doors :', 'autozone' ); ?></span>
                            <span class="card-list__info"><?php echo wp_kses_post($PIXAD_Autos->get_meta('_auto_doors')).' '.esc_html__( 'doors', 'autozone' ); ?></span>
                        </li>
                    <?php endif; ?>

                    <?php if( get_the_date() ): ?>
                    <li><span><?php echo get_the_date(); ?></span></li>
                    <?php endif; ?>

                </ul><!-- / Car Details -->

                <?php if( $validate['auto-price_show'] ): ?>
                    <div class="card__price"><?php esc_html_e( 'PRICE:' , 'autozone') ?><span class="card__price-number"><?php echo wp_kses_post($PIXAD_Autos->get_price()); ?></span></div>
                <?php endif; ?>

            </div>

        </article>
    <?php endwhile; ?>


