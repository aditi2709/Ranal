<?php
/**
 * The template for displaying archive pages.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shapely
 */
get_header('ranal-category'); ?>

<?php $layout_class = shapely_get_layout_class(); ?>
	<div class="row">
		<!-- <?php echo do_shortcode('[searchandfilter fields="search,category"]'); ?> -->
		<!-- <?php echo do_shortcode('[searchandfilter headings="Select categories:" types="checkbox" fields="category"]'); ?> -->
		<?php
		if ( 'sidebar-left' == $layout_class ) :
			get_sidebar();
		endif;
		?>
		<div id="primary" class="col-md-8 mb-xs-24 ">
												<?php
																if ( have_posts() ) :

																	if ( is_home() && ! is_front_page() ) :
																	?>
																			<header>
																				<h1 class="page-title screen-reader-text"><?php esc_html( single_post_title() ); ?></h1>
																			</header>

					<?php
																		endif;

																	$layout_type = get_theme_mod( 'blog_layout_view', 'grid' );
																	$layout_type = str_replace( '_', '-', $layout_type );

																	get_template_part( 'template-parts/layouts/blog', $layout_type );

																	shapely_pagination();
			else :
				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

		</div><!-- #primary -->
		<!-- <aside id="secondary" class="widget-area col-md-4 " role="complementary">
		<?php
		if ( 'sidebar-right' == $layout_class ) :
			dynamic_sidebar( 'category_right_1' );
		  echo do_shortcode('[searchandfilter fields="search,category"]');
		 echo do_shortcode('[searchandfilter headings="Select categories:" types="radio" fields="category"]');
		endif;
		?>
		</aside> -->

	</div>
<?php
get_footer();
