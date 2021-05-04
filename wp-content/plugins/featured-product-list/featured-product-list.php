<?php
/*
Plugin Name: Ranal Featured Product List
Description: Display Ranal Featured Product List
Version: 1.0.0
Author: Geogo Technologies Pvt
Author URI: http://traversymedia.com
*/
// Exit if accessed directly
if(!class_exists('FeaturedProductList')){
  class FeaturedProductList extends WP_Widget{
    public function __construct(){
      parent::WP_Widget(false, "Ranal Featured Product List");
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
      echo "<h4>".$instance['title']."</h4>";
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
      echo "<ul style='list-style-type:none'>";
      foreach($products as $product){
        echo "<li ><a href='".esc_url(get_the_permalink($product))."'>".$product->post_title."</a></li>";
      }
      echo "</ul>";
    }
  }
  function register_rnl_featured_product_list(){
    register_widget("FeaturedProductList");
  }


  add_action("widgets_init","register_rnl_featured_product_list");
}
