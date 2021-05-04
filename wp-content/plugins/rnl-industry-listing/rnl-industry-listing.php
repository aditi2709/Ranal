<?php
/*
Plugin Name: RNL Industry Listing
Description: Display Industries
Version: 1.0.0
Author: Geogo Technologies Pvt
Author URI: http://traversymedia.com
*/
// Exit if accessed directly
if(!class_exists('RNLIndustryListingWidget')){
  class RNLIndustryListingWidget extends WP_Widget{
    public function __construct(){
      parent::WP_Widget(false, "RNL Industry Listing");
    }

    public function form($instance){
      if(!empty($instance)){
        $title=$instance['title'];
      }else{
        $title='';
      }
?>
      <p>
        <label for="<?php echo $this->get_field_id('title');?>">Title:</label>
        <input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $title;?>"/>
      </p>
<?php
    }

    public function update($new_instance,$old_instance){
      $instance = $old_instance;
      $instance['title'] = $new_instance['title'];
      return $instance;
    }
    public function widget($args,$instance){
      extract($args);
      echo $before_widget;
      echo "<div class ='rl-sidebar-product'><h4>".$instance['title']."</h4>";
      $this->render_related_products();
      echo $after_widget;

    }
    function render_related_products(){
      $current_object = get_queried_object();

      if(!is_single($current_object)){
        $term_id = get_queried_object_id();
      }else{
        $term_id = get_the_terms($current_object,'ranal_solutions')[0]->term_id;
      }
      $industries = get_posts(array(
        'post_type' => 'industries',
        'numberposts' => -1,
        'order' =>'ASC'
      ));
      foreach($industries as $industry){
?>

      <a href="<?php echo esc_url( get_the_permalink($industry) ); ?>" >
        <div class = "rl-product rl-padding", style ="display: flex; justify-content: space-between;">

          <div class = " fl-1"><img src="<?php echo get_field('avatar',$industry->ID)['url']; ?>" class="rl-industry-img"></div>
          <div class = " fl-2">
            <div class=" rl-title"><?php echo $industry->post_title; ?></div>
            <!-- <div class="row"><?php echo wp_trim_words(get_field('description',$industry->ID),7); ?></div> -->
          </div>
        </div>
			</a>

<?php


      }
    }
  }
  function register_rnl_industry_listing(){
    register_widget("RNLIndustryListingWidget");
  }


  add_action("widgets_init","register_rnl_industry_listing");
}
