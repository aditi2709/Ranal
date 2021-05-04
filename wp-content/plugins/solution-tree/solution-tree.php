<?php
/*
Plugin Name: Ranal Solution Tree
Description: Display Solution Tree
Version: 1.0.0
Author: Geogo Technologies Pvt
Author URI: http://traversymedia.com
*/
// Exit if accessed directly
if(!class_exists('SolutionTreeWidget')){
  class SolutionTreeWidget extends WP_Widget{
    public function __construct(){
      parent::WP_Widget(false, "RNL Solution Tree");
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
      echo "<div class ='rl-fullwidth'><h4>".$instance['title']."</h4>";
      $this->render_solution_tree();
      echo $after_widget;

    }
    function render_solution_tree(){
      $terms = get_terms( array(
        'taxonomy' => 'ranal_solutions',
      ) );
      foreach($terms as $solution){
        $sol_img_avatar = get_field('avatar',$solution);
        echo "<div class ='rl-internal-div' style='display:flex-inline;'>
        <a  href='".esc_url(get_term_link($solution))."'>
          <img src=".$sol_img_avatar." style='width:40px;'/>
          <span class = 'rl-solution' style=''>".$solution->name."</span></a>
        </div>";
        $products = get_posts(array(
          'post_type' => 'ranal_products',
          'numberposts' => -1,
          'tax_query' => array(
            array(
              'taxonomy' => 'ranal_solutions',
              'field' => 'id',
              'terms' => $solution->term_id, // Where term_id of Term 1 is "1".
              'include_children' => false
            )
          )
        ));
        // echo "<ul  style='list-style-type:none; '>";

        // foreach($products as $product){
        //   echo "<li class='rl-internal-li'><a href='".esc_url(get_the_permalink($product))."'>".$product->post_title."</a></li>";
        // }
        // echo "</ul>";
      }
    }
  }
  function register_rnl_solution_tree(){
    register_widget("SolutionTreeWidget");
  }


  add_action("widgets_init","register_rnl_solution_tree");
}
