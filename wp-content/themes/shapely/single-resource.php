<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Shapely
 */

get_header('ranal'); ?>
<?php $layout_class = shapely_get_layout_class(); ?>
	<div class="row rl-top">
		<?php
		if ( 'sidebar-left' == $layout_class ) :
			get_sidebar();
		endif;
		?>

		<div id="primary" class="col-md-8 mb-xs-24 <?php echo esc_attr( $layout_class ); ?>">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content' );
			endwhile; // End of the loop.
			?>
			<p>
				<?php if(get_field('downloadable')){
						// echo do_shortcode( '[email-download-link namefield="YES" desc=""]' );
			}?>
			</p>
		</div><!-- #primary -->

		<?php
		if ( 'sidebar-right' == $layout_class ) :
			get_sidebar();
		endif;
		?>

	</div>
<?php
get_footer();
