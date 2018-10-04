<?php
/**
 * This template is for displaying part of blog.
 *
 * @package Pix-Theme
 * @since 1.0
 */
$autozone_format  = get_post_format();
$pix_options = get_option('pix_general_settings');
$custom =  get_post_custom($post->ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';

$autozone_format = !in_array($autozone_format, array("quote", "gallery", "video")) ? "standared" : $autozone_format;

?>

<div class="entry-main entry-main_mod-a">
	<div class="entry-main__inner">
		<h3 class="entry-title"><a href="<?php esc_url(the_permalink())?>"><?php wp_kses_post(the_title())?></a></h3>

		<div class="entry-meta">
		<?php if(autozone_get_option('blog_settings_author_name', 1)) : ?>
			<span class="entry-meta__item"><?php esc_html_e('By:: ', 'autozone')?> <span class="entry-meta__link"> <?php the_author_posts_link(); ?></span></span>
		<?php endif ?>
		<?php if( 'open' == $post->comment_status && autozone_get_option('blog_settings_comments', 1) ) : ?>
            <span class="entry-meta__item"><?php esc_html_e('COMMENTS:: ', 'autozone')?><?php comments_popup_link( '0', '1', '%', 'entry-meta__link'); ?></span>
        <?php endif ?>
		</div>
	</div>
	<div class="decor-1"></div>
	<?php if(autozone_get_option('blog_settings_date', 1)) : ?>
	<div class="entry-date"><span class="entry-date__inner"><span class="entry-date__number"><?php echo get_the_time('j'); ?></span><br><?php echo get_the_time('M'); ?></span></div>
	<?php endif ?>
	<div class="entry-content">
		<?php wp_link_pages();?>
        <?php
			if (get_option('rss_use_excerpt') == 0)
				the_content();
			else
				echo do_shortcode(get_the_excerpt());
		?>
	</div>
	<footer class="entry-footer">
		<div class="wrap-post-btn"><a class="post-btn btn-effect" href="<?php esc_url(the_permalink())?>"><span class="post-btn__inner"><?php echo autozone_post_read_more(); ?></span></a></div>
		<?php if( shortcode_exists( 'share' ) && autozone_get_option('blog_settings_share', 1) ) : ?>
		<div class="wrap-social-block wrap-social-block_mod-c">
			<?php echo do_shortcode('[share title="'.esc_html__('Share This', 'autozone').'"]'); ?>
		</div>
		<?php endif ?>
	</footer>
</div>

