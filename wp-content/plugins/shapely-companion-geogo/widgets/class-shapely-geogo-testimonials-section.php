<?php

/**
 * Homepage Geogo testimonials section
 */

 class Geogo_Testimonials_Section extends WP_Widget {

   private $defaults  = array();

   function __construct() {

     $widget_ops = array(
       'classname'                   => 'geogo_testimonials_section',
       'description'                 => esc_html__( 'Displays a section with geogo testimonials', 'shapely-companion-geogo' ),
       'customize_selective_refresh' => true,
     );

     parent::__construct( 'geogo_testimonials_section', esc_html__( '[Geogo] Testimonials Section', 'shapely-companion-geogo' ), $widget_ops );

     $this->defaults = array(
      'section_heading' => '',
      'title'           => '',
      'back_image_src'  => '',
      'button1'         => '',
      'button1_link'    => ''
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
     $back_image_src = $instance['back_image_src'];
     // Display the widget
     echo $before_widget;
    ?>
      <style>
       @media screen and (min-width: 768px) {
         .container-fluid {
           padding-left: 50px;
           padding-right: 50px;
         }
       }
       .new-section-back {
         background-image: url(<?php echo $back_image_src ?>);
       }
      </style>
     <div class="widget ptb50 new-section-back" id="geogo-testimonials-widget">
       <div class="container">
         <div class="row">
           <div class="col-lg-4 col-lg-offset-4 col-md-8 col-sm-12">
             <center>
               <span class="go-widget-blue-text"><?php echo $sec_heading ?></span>
               <?php if ( $title ) { ?>
                 <h3 class="go-section-title"><?php echo $title ?></h3>
               <?php } ?>
             </center>
           </div>
         </div>
       </div>
       <div class="container-fluid">
         <div class="row mtb30">
           <?php
             $args = array(
               'numberposts' => 3,
               'post_type'   => 'testimonials'
             );

             $latest_posts = get_posts( $args );
             foreach($latest_posts as $post) {
               $title = isset( $post->post_title ) ? $post->post_title : '';
               $author_name = get_post_meta( $post->ID, 'author_name', true );
               $designation = get_post_meta( $post->ID, 'designation', true );

           ?>
             <div class="col-md-4 col-sm-12">
               <div class="matCard">
                 <div class="matCardFooter">
                   <div class="matCardFooter-avatar">
                     <?php if (has_post_thumbnail( $post->ID ) ): ?>
                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                        <img src="<?php echo $image[0]; ?>" />
                     <?php endif; ?>
                   </div>
                   <div class="matCardFooter-content">
                     <span class="matCardFooter-title"><?php echo $author_name ?></span>
                     <span class="matCardFooter-subtitle"><?php echo $designation ?></span>
                   </div>
                 </div>
                 <div class="matCardContent">
                   <span class="go-card-text"><?php echo $post->post_content; ?></span>
                 </div>
               </div>
             </div>

          <?php } ?>
         </div>
       </div>
       <?php
          echo ( '' != $instance['button1'] && '' != $instance['button1_link'] ) ? '<center><a class="btn btn-lg btn-filled" href="' . esc_url( $instance['button1_link'] ) . '">' . wp_kses_post( $instance['button1'] ) . '</a></center>' : '';
       ?>
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
       <p class="shapely-media-control" data-delegate-container="<?php echo esc_attr( $this->get_field_id( 'back_image_src' ) ); ?>">
         <label
           for="<?php echo esc_attr( $this->get_field_id( 'back_image_src' ) ); ?>">
           <?php
           echo esc_html__( 'Background Image', 'shapely-companion-geogo' );
           ?>
           :</label>

         <img data-default="<?php echo $placeholder_url; ?>" src="<?php echo '' != $instance['back_image_src'] ? esc_url( $instance['back_image_src'] ) : $placeholder_url; ?>" />

         <input type="hidden" name="<?php echo esc_attr( $this->get_field_name( 'back_image_src' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'back_image_src' ) ); ?>" value="<?php echo esc_url( $instance['back_image_src'] ); ?>" class="image-id blazersix-media-control-target">

         <button type="button" class="button upload-button"><?php echo esc_html__( 'Choose Image', 'shapely-companion-geogo' ); ?></button>
         <button type="button" class="button remove-button"><?php echo esc_html__( 'Remove Image', 'shapely-companion-geogo' ); ?></button>
       </p>
       <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'button1' ) ); ?>">
         <?php echo esc_html__( 'Button 1 Text ', 'shapely-companion-geogo' ); ?>
        </label>
         <input type="text" value="<?php echo esc_attr( $instance['button1'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button1' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'button1' ) ); ?>" class="widefat" />
        </p>

        <p>
         <label for="<?php echo esc_attr( $this->get_field_id( 'button1_link' ) ); ?>">
           <?php echo esc_html__( 'Button 1 Link ', 'shapely-companion-geogo' ); ?>
         </label>
         <input type="text" value="<?php echo esc_url( $instance['button1_link'] ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button1_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'button1_link' ) ); ?>" class="widefat" />
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
    $instance['back_image_src']= ( ! empty( $new_instance['back_image_src'] ) ) ? esc_url_raw( $new_instance['back_image_src'] ) : '';
    $instance['button1']       = ( ! empty( $new_instance['button1'] ) ) ? esc_html( $new_instance['button1'] ) : '';
    $instance['button1_link']  = ( ! empty( $new_instance['button1_link'] ) ) ? esc_url_raw( $new_instance['button1_link'] ) : '';
    return $instance;
  }
 }


  // register widget
  add_action('widgets_init', create_function('', 'return register_widget("Geogo_Testimonials_Section");'));
?>
