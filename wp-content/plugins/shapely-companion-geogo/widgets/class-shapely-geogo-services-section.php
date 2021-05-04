<?php

/**
 * Homepage Geogo services section
 */

 class Geogo_Services_Section extends WP_Widget {

   private $defaults  = array();

   function __construct() {

     $widget_ops = array(
       'classname'                   => 'geogo_services_section',
       'description'                 => esc_html__( 'Displays a section with geogo services', 'shapely-companion-geogo' ),
       'customize_selective_refresh' => true,
     );

     parent::__construct( 'geogo_services_section', esc_html__( '[Geogo] Services Section', 'shapely-companion-geogo' ), $widget_ops );

     $this->defaults = array(
       'section_heading' => '',
       'title'           => '',
       'body_content'    => '',
       'parent_category_slug'=> ''
     );
   }

   /**
   * @param array $args
   * @param array $instance
   */
   // display widget
    function widget($args, $instance) {
      extract( $args );
      $allowed_tags           = wp_kses_allowed_html( 'post' );
      $allowed_tags['iframe'] = array(
        'width'           => array(),
        'height'          => array(),
        'src'             => array(),
        'frameborder'     => array(),
        'allowfullscreen' => array(),
      );
     // these are the widget options
     $sec_heading = $instance['section_heading'];
     $title = apply_filters('widget_title', $instance['title']);
     $body_content = $instance['body_content'];
     //$parent_category = get_category_by_slug($instance['parent_category_slug']);
     $industries = get_posts(array('post_type' => 'industries', 'numberposts' => -1));
     // Display the widget
     echo $before_widget;
    ?>
     <div class="widget" id="geogo-services-widget" style="background: url('<?php echo $instance['background_image_src'] ?>;'); background-repeat: no-repeat;  background-position: <?php echo $instance['background_position'] ?>">
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



       <div class="container ptb50 pt100">
         <div class="row">
           <div class="col-md-12 col-sm-12 mb-xs-12 rl_center">
             <!-- <span class="go-widget-blue-text"><?php echo $sec_heading ?></span> -->
             <?php if ( $title ) { ?>
               <h3 class="go-section-title"><?php echo $title ?></h3>
             <?php } ?>
             <?php if ( '' != $body_content ) { ?>
               <div class="mb32 go-subtitle"><?php echo $body_content ?></div>
             <?php } ?>
           </div>
         </div>
         <div class="row mtb30">
           <?php
             foreach($industries as $industry) {
               $title = isset( $industry->post_title ) ? $industry->post_title : '';
               //print_r();
               $image = get_field('background',$industry->ID)['url'];

           ?>
             <div class="col-md-4 col-md-4 col-sm-12">
               <a class="go-card-action" href="<?php echo esc_url( get_the_permalink($industry) ); ?>" >
               <div class="go-card with-hover-effect" style="background-image: linear-gradient(0deg,rgba(58,66,109,0.75),rgba(58,66,109,0.75)), url('<?php echo $image ?>'); background-repeat: no-repeat">
                    <?php $image = get_field('avatar',$industry->ID)['url']; ?>
                    <div class=" rl_center">
                      <img src="<?php echo $image; ?>" class="imgwrap" />
                      <div class = "" tabindex="0" data-descr="<?php echo $title ?>"></div>
                    </div>
                 <div class="go-card-title rl_center">
                   <?php echo $title ?>
                 </div>
                 <center><button class="go-card-roundbtn show-on-hover" href="<?php echo esc_url( get_the_permalink($industry) ); ?>">View</button></center>
               </div>
               </a>
             </div>
          <?php } ?>
         </div>
       </div>
     </div>
     <?php
     echo $after_widget;
   }

   /**
   * @param array $instance
   *
   * @return string|void
   */
   function form($instance) {
     $instance = wp_parse_args( $instance, $this->defaults );
     ?>
       <p>
         <label for="<?php echo $this->get_field_id('section_heading'); ?>"><?php _e('Section Heading', 'wp_widget_plugin'); ?></label>
         <input class="widefat" id="<?php echo $this->get_field_id('section_heading'); ?>" name="<?php echo $this->get_field_name('section_heading'); ?>" type="text" value="<?php echo $instance['section_heading']; ?>" />
       </p>
       <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
         <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
       </p>
       <p class="shapely-editor-container">
         <label for="<?php echo esc_attr( $this->get_field_id( 'body_content' ) ); ?>">
           <?php echo esc_html__( 'Content ', 'shapely-companion' ); ?>
         </label>
         <textarea name="<?php echo esc_attr( $this->get_field_name( 'body_content' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'body_content' ) ); ?>" class="widefat">
           <?php echo wp_kses( nl2br( $instance['body_content'] ), $allowed_tags ); ?>
         </textarea>
       </p>
       <p class="shapely-media-control" data-delegate-container="<?php echo esc_attr( $this->get_field_id( 'background_image_src' ) ); ?>">
         <label
           for="<?php echo esc_attr( $this->get_field_id( 'background_image_src' ) ); ?>">
           <?php
           echo esc_html__( 'Background Image', 'shapely-companion-geogo' );
           ?>
           :</label>

         <img data-default="<?php echo $placeholder_url; ?>" src="<?php echo '' != $instance['background_image_src'] ? esc_url( $instance['background_image_src'] ) : $placeholder_url; ?>" />

         <input type="hidden" name="<?php echo esc_attr( $this->get_field_name( 'background_image_src' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'background_image_src' ) ); ?>" value="<?php echo esc_url( $instance['background_image_src'] ); ?>" class="image-id blazersix-media-control-target">

         <button type="button" class="button upload-button"><?php echo esc_html__( 'Choose Image', 'shapely-companion-geogo' ); ?></button>
         <button type="button" class="button remove-button"><?php echo esc_html__( 'Remove Image', 'shapely-companion-geogo' ); ?></button>
       </p>
       <p>
         <label for="<?php echo $this->get_field_id('background_position'); ?>"><?php _e('Background position', 'wp_widget_plugin'); ?></label>
         <input class="widefat" placeholder="Ex. top right" id="<?php echo $this->get_field_id('background_position'); ?>" name="<?php echo $this->get_field_name('background_position'); ?>" type="text" value="<?php echo $instance['background_position']; ?>" />
       </p>
       <p>
         <label for="<?php echo $this->get_field_id('parent_category_slug'); ?>"><?php _e('Parent category slug', 'wp_widget_plugin'); ?></label>
         <input class="widefat" id="<?php echo $this->get_field_id('parent_category_slug'); ?>" name="<?php echo $this->get_field_name('parent_category_slug'); ?>" type="text" value="<?php echo $instance['parent_category_slug']; ?>" />
       </p>
     <?php
   }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $allowed_tags              = wp_kses_allowed_html( 'post' );
    $allowed_tags['iframe']    = array(
      'width'           => array(),
      'height'          => array(),
      'src'             => array(),
      'frameborder'     => array(),
      'allowfullscreen' => array(),
    );
    // Fields
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['section_heading'] = strip_tags($new_instance['section_heading']);
    $instance['body_content']  = ( ! empty( $new_instance['body_content'] ) ) ? wp_kses( $new_instance['body_content'], $allowed_tags ) : '';
    $instance['background_image_src']= ( ! empty( $new_instance['background_image_src'] ) ) ? esc_url_raw( $new_instance['background_image_src'] ) : '';
    $instance['background_position']= ( ! empty( $new_instance['background_position'] ) ) ? $new_instance['background_position'] : '';
    $instance['parent_category_slug'] = strip_tags($new_instance['parent_category_slug']);
    return $instance;
  }
 }


  // register widget
  add_action('widgets_init', create_function('', 'return register_widget("Geogo_Services_Section");'));
?>
