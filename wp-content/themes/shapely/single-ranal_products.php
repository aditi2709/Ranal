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

				get_template_part( 'template-parts/product-details' );

				// If comments are open or we have at least one comment, load up the comment template.
				// if ( comments_open() || get_comments_number() ) :
				// 	comments_template();
				// endif;

			endwhile; // End of the loop.
			?>
		</div><!-- #primary -->
		<aside id="secondary" class="widget-area col-md-4 " role="complementary">
		<?php
		if ( 'sidebar-right' == $layout_class ) :
			dynamic_sidebar( 'product_right_1' );
		endif;
		?>
		</aside>



	</div>
</div>


<div class ="row rl-slider-list">
	<br>
	<br>
	<h3>
		Other Products
	</h3>


																<?php
																if ( have_posts() ) :

																	if ( is_home() && ! is_front_page() ) :
																	?>
																			<header>
																				<h1 class="page-title screen-reader-text"><?php esc_html( single_post_title() ); ?></h1>
					</header>

					<?php
																		endif;

																	//$layout_type = get_theme_mod( 'blog_layout_view', 'grid' );
                                  //$layout_type = str_replace( '_', '-', $layout_type );

																	get_template_part( 'template-parts/layouts/product', 'slider' );

																	shapely_pagination();
			else :
				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</div>







<?php
get_footer();
