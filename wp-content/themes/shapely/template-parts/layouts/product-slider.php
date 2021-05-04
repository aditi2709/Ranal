<?php
/* Start the Loop */
$current_object = get_queried_object();
$term_id = get_the_terms($current_object,'ranal_solutions')[0]->term_id;
$products = get_posts(array(
  'post_type' => 'ranal_products',
  'numberposts' => -1,
  'tax_query' => array(
    array(
      'taxonomy' => 'ranal_solutions',
      'field' => 'id',
      'terms' => $term_id, // Where term_id of Term 1 is "1".
      'include_children' => false
    )
  )
));
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
  if($(window).width() < 768) {
      $('.show-on-hover').show();
    }
else{
  $('.show-on-hover').hide();
  $( ".with-hover-effect" ).hover(function() {
    // console.log($(this));
    $(this).find(".show-on-hover").toggle(200);
  });
}
});

</script>
<div class="slider">
<div class="flexslider" style="height:250px;">
  <!-- <div class="flex-viewport" style="overflow: hidden; position: relative;"> -->
    <ul class="slides">
    <?php foreach($products as $product){ ?>
      <li class ="rl-product-li with-hover-effect">
				<a class="rl-slider-action" href="<?php echo esc_url( get_the_permalink($product) ); ?>" >
					<div class = "rl-product-slider-img" style="background-image: linear-gradient(0deg,rgba(58,66,109,0.75),rgba(58,66,109,0.75)),url('<?php echo get_the_post_thumbnail_url($product,'shapely-full'); ?>'); border-radius: 10px;">



                <div class="flex-caption"><p class="rl-slider-title"><?php echo $product->post_title; ?></p></div>
                <div class ="flex-caption"><p class="rl-slider-description"><?php echo wp_trim_words(get_field('description',$product->ID),7); ?></p></div>
                <center><button class="go-card-roundbtn show-on-hover" href="<?php echo esc_url( get_the_permalink($industry) ); ?>">View</button></center>

        <!-- <div class=" rl-slider-text">
				<div class = "rl-slider-title"><?php echo $product->post_title; ?></div>
				<div class="rl-slider-description"><?php echo wp_trim_words(get_field('description',$product->ID),7); ?></div>
				</div> -->
			</div>
			</a>



      </li>
    <?php }?>
    </ul>
<!-- </div> -->
</div>
</div>
<?php
