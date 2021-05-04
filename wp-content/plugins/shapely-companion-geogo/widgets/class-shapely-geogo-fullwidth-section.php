<?php

/**
 * Homepage full width section container
 */

 class Geogo_Fullwidth_Section extends WP_Widget {

   private $defaults  = array();

   function __construct() {

     $widget_ops = array(
       'classname'                   => 'geogo_fullwidth_section',
       'description'                 => esc_html__( 'Displays a full width section', 'shapely-companion-geogo' ),
       'customize_selective_refresh' => true,
     );

     parent::__construct( 'geogo_fullwidth_section', esc_html__( '[Geogo] Fullwidth Section', 'shapely-companion-geogo' ), $widget_ops );

     $this->defaults = array(
      'title'         => '',
      'image_src'     => '',
      'back_image_src'=> '',
      'body_content'  => '',
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
     $title = apply_filters('widget_title', $instance['title']);
     $image_src = $instance['image_src'];
     $body_content = $instance['body_content'];
     $button1 = $instance['button1'];
     $button1_link = $instance['button1_link'];
     $back_image_src = $instance['back_image_src'];
     // Display the widget
     echo $before_widget;
     ?>
     <style>
      @media screen and (min-width: 768px) {
        .section-back {
          background: url(<?php echo $image_src ?>);
          background-size: auto 550px;
          background-position: 100% 95%;
          background-repeat: no-repeat;
        }
      }
     </style>
     <div class="widget shapely_home_parallax" id="geogo-fullwidth-widget" style="background-image: url(<?php echo $back_image_src ?>);">
       <section class="section-back">
         <div class="container">
           <div class="row">
             <div class="col-md-6 col-sm-6 mb-xs-24 go-take-full-height">
               <?php if ( $title ) { ?>
                 <h3 class="go-title"><?php echo $title ?></h3>
               <?php } ?>
               <?php if ( '' != $body_content ) { ?>
                 <div class="mb32 go-subtitle"><?php echo $body_content ?></div>
               <?php
                  }

                  echo ( '' != $instance['button1'] && '' != $instance['button1_link'] ) ? '<div><a class="btn btn-lg btn-filled" href="' . esc_url( $instance['button1_link'] ) . '">' . wp_kses_post( $instance['button1'] ) . '<i class="fa fa-angle-double-right btn-icon"></i></a></div>' : '';
               ?>

             </div>
           </div>
         </div>
       </section>
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
       <p class="shapely-media-control" data-delegate-container="<?php echo esc_attr( $this->get_field_id( 'image_src' ) ); ?>">
         <label
           for="<?php echo esc_attr( $this->get_field_id( 'image_src' ) ); ?>">
           <?php
           echo esc_html__( 'Primary Image', 'shapely-companion-geogo' );
           ?>
           :</label>

         <img data-default="<?php echo $placeholder_url; ?>" src="<?php echo '' != $instance['image_src'] ? esc_url( $instance['image_src'] ) : $placeholder_url; ?>" />

         <input type="hidden" name="<?php echo esc_attr( $this->get_field_name( 'image_src' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'image_src' ) ); ?>" value="<?php echo esc_url( $instance['image_src'] ); ?>" class="image-id blazersix-media-control-target">

         <button type="button" class="button upload-button"><?php echo esc_html__( 'Choose Image', 'shapely-companion-geogo' ); ?></button>
         <button type="button" class="button remove-button"><?php echo esc_html__( 'Remove Image', 'shapely-companion-geogo' ); ?></button>
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
     $instance['body_content']  = ( ! empty( $new_instance['body_content'] ) ) ? wp_kses( $new_instance['body_content'], $allowed_tags ) : '';
     $instance['image_src']     = ( ! empty( $new_instance['image_src'] ) ) ? esc_url_raw( $new_instance['image_src'] ) : '';
     $instance['back_image_src']= ( ! empty( $new_instance['back_image_src'] ) ) ? esc_url_raw( $new_instance['back_image_src'] ) : '';
     $instance['button1']       = ( ! empty( $new_instance['button1'] ) ) ? esc_html( $new_instance['button1'] ) : '';
     $instance['button1_link']  = ( ! empty( $new_instance['button1_link'] ) ) ? esc_url_raw( $new_instance['button1_link'] ) : '';
     return $instance;
   }
 }

 // register widget
 add_action('widgets_init', create_function('', 'return register_widget("Geogo_Fullwidth_Section");'));
 ?>
