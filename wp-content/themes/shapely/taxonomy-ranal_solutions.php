<?php
/**
 * The template for displaying archive pages.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shapely
 */
get_header('ranal-full');
	?>
<?php


 ?>


<?php $layout_class = shapely_get_layout_class(); ?>

	<div class="row">
		<?php
		if ( 'sidebar-left' == $layout_class ) :
			get_sidebar();
		endif;

		?>

		<div id="primary" class="col-md-12 mb-xs-24 <?php echo esc_attr( $layout_class ); ?>">
    <?php
      $term_image_id = get_term_meta( get_queried_object_id(), 'banner_image', true);
      $image = wp_get_attachment_image_src($term_image_id,'full' );
	?>
	<!-- <h3><?php echo get_term( get_queried_object_id())->name;?></h3> -->

    <!-- <img src="<?php echo $image[0]; ?>" class="rl-curve" /> -->
		<br>
		<br>

	<div class ="rl-desc">
	<?php echo get_term_meta(get_queried_object_id(),'solution_description',true); ?>


	</div>
</div><!-- #primary -->

			<!-- <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary"> -->
				<?php //dynamic_sidebar( 'home_right_1' ); ?>
			<!-- </div> -->
		<?php //endif;
//endif;
?>
</div>
<div class ="row" style="margin: 0px;">
	<br>
	<br>
	<h3 class="rl-center">
		Products
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

																	get_template_part( 'template-parts/layouts/product', 'grid' );

																	shapely_pagination();
			else :
				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</div>

<?php
get_footer();
?>
