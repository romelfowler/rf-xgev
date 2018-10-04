<?php
/***
Template Name: Autos
The template for displaying all pages.
***/
global $post, $PIXAD_Autos;
$Query = false;
$orderby_arr = array('date', 'title');
$data = array_map( 'esc_attr', $_REQUEST );
$args = array();

foreach($data as $key=>$val){
    if( property_exists('PIXAD_Autos', $key) && $key == 'order' ){
        $temp = explode('-', $val);

        if(isset($temp[0]) && in_array($temp[0], $orderby_arr)){
            $PIXAD_Autos->orderby = $temp[0];
            $PIXAD_Autos->order = strtoupper($temp[1]);
            $PIXAD_Autos->metakey = '';
        }
        elseif(isset($temp[0]) && !in_array($temp[0], $orderby_arr)){
            $PIXAD_Autos->orderby = !in_array($temp[0], array('_auto_price','_auto_year')) ? 'meta_value' : 'meta_value_num';
            $PIXAD_Autos->order = strtoupper($temp[1]);
            $PIXAD_Autos->metakey = $temp[0];
        }
    } elseif( property_exists('PIXAD_Autos', $key) && $key == 'per_page' ) {
        $args[$key] = $val;
    } elseif( $key != 'action' && $key != 'nonce'){
        $args[$key] = $val;
    }
}

$autos_purpose = (get_post_meta(get_the_ID(), 'pix_page_purpose', true) == "") ? '' : get_post_meta(get_the_ID(), 'pix_page_purpose', true);
$args['purpose'] = $autos_purpose;

$Query = $args;

$custom = isset ($wp_query) ? get_post_custom($wp_query->get_queried_object_id()) : '';
$layout = isset ($custom['pix_page_layout']) ? $custom['pix_page_layout'][0] : '2';
$sidebar = isset ($custom['pix_selected_sidebar'][0]) ? $custom['pix_selected_sidebar'][0] : 'sidebar-1';
if (!is_active_sidebar($sidebar)) $layout = '1';

?>

<?php get_header();?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <!-- GSA -->
      <div class="gsa">
        <a href="https://www.gsaadvantage.gov/advantage/s/search.do?db=0&q=28%3A5XTREME+GREEN+ELECTRIC+VEHICLES&q=17%3A5YY&searchType=0&s=9" alt="gsa-link">
        <img src="https://xgev.com/wp-content/uploads/2018/02/gsa_color_logo.jpg" width="200" alt="gsa-button"></a>
      </div>
    </div>
  </div>
</div>
<div class="spacer" style="margin:25px auto"></div>
<div class="container">

    <div class="row">

        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <div class="rtd"> <?php the_content(); ?></div>
        <?php endwhile; ?>

        <?php autozone_show_sidebar('left', $custom, 1) ?>

        <div class="<?php if ($layout == 1):?>col-md-12<?php else:?>col-md-9<?php endif;?>">
            <main class="main-content">

                <?php get_template_part( 'autos', 'sorting' ); ?>

                <div class="pix-dynamic-content">

                    <?php get_template_part( 'autos', 'loader' ); ?>

                    <div id="pixad-listing">

                    <?php
                    $wp_query = new WP_Query( $PIXAD_Autos->Query_Args( $Query ) );
                    get_template_part( 'loop', 'autos' );

                    echo pixad_wp_pagenavi()
                    ?>

                    </div>

                </div>

            </main><!-- end main-content -->
        </div><!-- end col -->

        <?php autozone_show_sidebar('right', $custom, 1) ?>

    </div><!-- end row -->
</div>

<?php get_footer();?>
