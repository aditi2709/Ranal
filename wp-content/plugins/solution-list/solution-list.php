<?php
/*
Plugin Name: Ranal Solution List
Description: Display Solution List
Version: 1.0.0
Author: Geogo Technologies Pvt
Author URI: http://traversymedia.com
*/
// Exit if accessed directly
if(!class_exists('SolutionListWidget')){
  class SolutionListWidget extends WP_Widget{
    public function __construct(){
      parent::WP_Widget(false, "RNL Solution List");
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
      $this->render_solution_tree();
      echo $after_widget;

    }
    function render_solution_tree(){
      $terms = get_terms( array(
        'taxonomy' => 'ranal_solutions',
      ) );
      echo "<ul style='list-style-type:none'>";
      foreach($terms as $solution){
        echo "<li ><a href='".esc_url(get_term_link($solution))."'>".$solution->name."</a></li>";
      }
      echo "</ul>";
    }
  }
  function register_rnl_solution_list(){
    register_widget("SolutionListWidget");
  }


  add_action("widgets_init","register_rnl_solution_list");
}
