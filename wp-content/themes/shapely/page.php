<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
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

																	get_template_part( 'template-parts/content', 'page' );

																	// If comments are open or we have at least one comment, load up the comment template.
																	if ( comments_open() || get_comments_number() ) :
																		comments_template();
																		endif;

			endwhile; // End of the loop.
			?>
		</div>
		<aside id="secondary" class="widget-area col-md-4 " role="complementary">
		<?php

			if ( is_active_sidebar( 'page_right_1' ) ) : ?>
    	<div id="header-widget-area" class="chw-widget-area widget-area" role="complementary">
    	<?php dynamic_sidebar( 'page_right_1' ); ?>
    	</div>

		<?php endif; ?>
		</aside>

	</div>
<?php
get_footer();
