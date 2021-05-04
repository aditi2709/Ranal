<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Shapely
 */

get_header('ranal'); ?>
<img src="<?php echo wp_kses( $image, $allowed_tags );?>" />
<?php $layout_class = shapely_get_layout_class(); ?>

	<div class="row">
		<?php
		if ( 'sidebar-left' == $layout_class ) :
			get_sidebar();
		endif;
		?>
		<div id="primary" class="col-md-8 mb-xs-24 <?php echo esc_attr( $layout_class ); ?>">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/industry-details' );

				// If comments are open or we have at least one comment, load up the comment template.
				// if ( comments_open() || get_comments_number() ) :
				// 	comments_template();
				// endif;

			endwhile; // End of the loop.
			?>
		</div><!-- #primary -->

		<?php
		if ( 'sidebar-right' == $layout_class ) :
			//get_sidebar();
			if ( is_active_sidebar( 'industry_right_1' ) ) :
		?>

<aside id="secondary" class="widget-area col-md-4 rl-industry-margin" role="complementary">
	<?php dynamic_sidebar( 'industry_right_1' ); ?>
	
</aside>
		<?php
			endif;
		endif;
		?>

</div>
</div>
</section>
<section class="  rl-footer-filter" >

	<div class = "posts row">
	<?php $previous_post = get_previous_post();?>
		<?php if ( has_post_thumbnail($previous_post->ID) ) { ?>
		<div class = " col-md-6 col-xs-12 rl-filter-height" style="background-image: linear-gradient(0deg,rgba(58,66,109,0.75),rgba(58,66,109,0.75)),url('<?php echo wp_get_attachment_url(get_post_thumbnail_id($previous_post->ID)); ?>');background-repeat:no-repeat; background-size:cover;">
			<?php	} else {?>
		<div class = " col-md-6 col-xs-12 rl-filter-height" style="background-image:linear-gradient(0deg,rgba(58,66,109,0.75),rgba(58,66,109,0.75)),url('<?php echo get_template_directory_uri() . '/assets/images/prevdefault.jpg'?>'); background-repeat:no-repeat; background-size:cover;">
		<?php }?>

			<div class ="rl-filter-post-left"><?php previous_post_link(); ?></div>
		</div>

	<?php $next_post = get_next_post(); ?>
		<?php if ( has_post_thumbnail($next_post->ID) ) { ?>
			<div class = " col-md-6 col-xs-12 rl-filter-height" style="background-image: linear-gradient(0deg,rgba(58,66,109,0.75),rgba(58,66,109,0.75)),url('<?php echo wp_get_attachment_url(get_post_thumbnail_id($next_post->ID)); ?>');background-repeat:no-repeat; background-size:cover;">
		<?php	} else {?>
			<div class = " col-md-6 col-xs-12 rl-filter-height" style="background-image:linear-gradient(0deg,rgba(58,66,109,0.75),rgba(58,66,109,0.75)),url('<?php echo get_template_directory_uri() . '/assets/images/windenergy.jpg'?>'); background-repeat:no-repeat; background-size:cover;">
		<?php }?>

				<div class ="rl-filter-post-right"><?php next_post_link(); ?></div>
		</div>
</div>

</section>

<?php
get_footer();
