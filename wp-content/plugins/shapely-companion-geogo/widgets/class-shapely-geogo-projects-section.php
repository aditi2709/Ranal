<?php

/**
 * Homepage Geogo projects section
 */

 class Geogo_Projects_Section extends WP_Widget {

   private $defaults  = array();

   function __construct() {

     $widget_ops = array(
       'classname'                   => 'geogo_projects_section',
       'description'                 => esc_html__( 'Displays a section with geogo projects', 'shapely-companion-geogo' ),
       'customize_selective_refresh' => true,
     );

     parent::__construct( 'geogo_projects_section', esc_html__( '[Geogo] Projects Section', 'shapely-companion-geogo' ), $widget_ops );

     $this->defaults = array(
      'section_heading' => '',
      'title'           => '',
      'body_content'    => '',
      'button1'       => '',
      'button1_link'  => ''
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
     // Display the widget
     echo $before_widget;
    ?>
      <style>
       @media screen and (min-width: 768px) {
         .container-fluid-full {
           padding-left: 15px;
           padding-right: 15px;
           margin-right: auto;
           margin-left: auto;
         }
         .lg-no-padding {
           padding-left: 0px;
           padding-right: 0px;
         }
       }
      </style>
     <div class="widget ptb50 pt100" id="geogo-projects-widget">
       <div class="container">
         <div class="row">
           <!-- <div class="col-md-5 col-sm-5 mb-xs-24"> -->
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
       </div>
       <div class="container-fluid-full">
         <div class="row mtb30">
           <?php
             $args = array(
               'numberposts' => 4,
               'post_type'   => 'ranal_products',
               'meta_key'=>'featured_product',
               'meta_value'=>true
             );

             $latest_posts = get_posts( $args );
             foreach($latest_posts as $post) {
               $title = isset( $post->post_title ) ? $post->post_title : '';
           ?>
           <div class = "">
             <div class="col-md-3 col-sm-12 lg-no-padding">
               <div class="hovereffect">
                 <?php if (has_post_thumbnail( $post->ID ) ): ?>
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                    <img src="<?php echo $image[0]; ?>" class="img-responsive" />
                 <?php endif; ?>
                 <div class="overlay">

                   <div class="image-box__overlay"><h2 ><?php echo $title ?></h2>
           				<p>
           					<a class="info" href="<?php echo get_post_permalink( $post->ID ); ?>">MORE DETAILS</a>
           				</p>
                  </div>
                </div>
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
       <p class="shapely-editor-container">
         <label for="<?php echo esc_attr( $this->get_field_id( 'body_content' ) ); ?>">
           <?php echo esc_html__( 'Content ', 'shapely-companion' ); ?>
         </label>
         <textarea name="<?php echo esc_attr( $this->get_field_name( 'body_content' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'body_content' ) ); ?>" class="widefat">
           <?php echo wp_kses( nl2br( $instance['body_content'] ), $allowed_tags ); ?>
         </textarea>
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
    $instance['body_content']  = ( ! empty( $new_instance['body_content'] ) ) ? wp_kses( $new_instance['body_content'], $allowed_tags ) : '';
    $instance['button1']       = ( ! empty( $new_instance['button1'] ) ) ? esc_html( $new_instance['button1'] ) : '';
    $instance['button1_link']  = ( ! empty( $new_instance['button1_link'] ) ) ? esc_url_raw( $new_instance['button1_link'] ) : '';
    return $instance;
  }
 }


  // register widget
  add_action('widgets_init', create_function('', 'return register_widget("Geogo_Projects_Section");'));
?>
