<?php

/*
Plugin Name: Ranal Menu Featured Product List
Description: Ranal Menu Featured Product List
Version: 1.0.0
Author: Geogo Technologies Pvt
Author URI: http://traversymedia.com
*/
// Exit if accessed directly
if(!class_exists('MenuFeaturedProductList')){
  class MenuFeaturedProductList extends WP_Widget{
    public function __construct(){
      parent::WP_Widget(false, "Ranal Menu Featured Product List");
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
      echo "<h6 class='rl-head'>".$instance['title']."</h6>";
      $this->render_product_list();
      echo $after_widget;

    }
    function render_product_list(){
      $products = get_posts(array(
        'post_type' => 'ranal_products',
        'numberposts' => 6,
        'meta_key'=>'featured_product',
        'meta_value'=>true
      ));
      foreach($products as $product){
?>
      <a href="<?php echo esc_url( get_the_permalink($product) ); ?>" >
        <div class = "menu-rl-product menu-rl-padding menu-rl-display">
          <div class = "menu-fl-1">
            <div class = "menu-rl-rounded-img" >
            <img src="<?php echo get_the_post_thumbnail_url($product); ?>" >
            </div>
          </div>
          <div class = "menu-fl-2">
            <div class="row menu-rl-title"><?php echo $product->post_title; ?></div>
          </div>
        </div>
      </a>
<?php


      }
    }
  }
  function register_rnl_menu_eatured_product_list(){
    register_widget("MenuFeaturedProductList");
  }
  add_action("widgets_init","register_rnl_menu_eatured_product_list");
}
