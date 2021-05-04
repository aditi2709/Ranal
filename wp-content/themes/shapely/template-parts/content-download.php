<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shapely
 */

?>
<!-- <script type="text/javascript">
jQuery(document).ready(function($) {
	if($(window).width() < 768) {
			$('.show-on-hover').show();
		}
else{
	$('.show-on-hover').hide();
	$( ".with-hover-effect" ).hover(function() {
		// console.log($(this));
		$(this).find(".show-on-hover").toggle(1000);
	});
}
});
</script> -->
<div class ="col-md-3">

	<article id="post-<?php the_ID(); ?>"<?php post_class( 'post-content go-resource l go-category rl-content' ); ?> >

		<header class="entry-header nolist">
			<?php
			$category      = get_the_category();
			$show_category = true;
			if ( is_category() ) {
				$show_category = get_theme_mod( 'show_category_on_category_page', 1 );
			}
			$image = '<img class="wp-post-image" alt="" src="' . get_template_directory_uri() . '/assets/images/placeholder.jpg" />';
			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( get_the_ID(), 'shapely-grid' );
			}
			$allowed_tags = array(
				'img'      => array(
					'data-srcset' => true,
					'data-src'    => true,
					'srcset'      => true,
					'sizes'       => true,
					'src'         => true,
					'class'       => true,
					'alt'         => true,
					'width'       => true,
					'height'      => true,
				),
				'noscript' => array(),
			);
			?>

				<a class="go-card-action" href="<?php echo esc_url( get_the_permalink() ); ?>" >
					<div class="with-hover-effect">
						<div class ="rl-image"><?php echo wp_kses( $image, $allowed_tags ); ?></div>

						<div class="rl-name"><?php echo wp_trim_words( get_the_title(), 9 ); ?></div>

						<p class="rl-category-text">
							<?php  echo wp_trim_words(get_field('description'),12);  ?>
						</p>
            
						<div>
						<center><button class="go-card-btn show-on-hover" href="<?php echo esc_url( get_the_permalink($industry) ); ?>">Download</button></center>

          </div>
					</div>
			</a>


			<?php if ( isset( $category[0] ) && $show_category ) : ?>
				<!-- <span class="shapely-category">
					<a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) ); ?>">
						<?php echo esc_html( $category[0]->name ); ?>
					</a>
				</span> -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<!-- <div class="entry-content">


			<?php
			the_content(
				sprintf(
					/* translators: %s: Name of current post. */
							wp_kses(
								__( 'Read more %s <span class="meta-nav">&rarr;</span>', 'shapely' ), array(
									'span' => array(
										'class' => array(),
									),
								)
							),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'shapely' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
	</article><!-- #post-## -->
</div>
<?php
