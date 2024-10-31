<?php 


//include( plugin_dir_path( __FILE__ ) . 'ipn/paypal-ipn.php');

/*----------------------------------------------------------------------------*
 * MOBILE
 *
 *
 *
 * MOBILE
 * Mobile (landscape)
 * iPhone 5 or iPod Touch 5th generation 
 * PHABLET Sized Devices
 * Tablet (standard) ---- MAY NEED TO BE OMITED!!!
 * Tablet (portrait)
 * Tablet (landscape)
 * iPad Portrait
 * iPad Landscape
 * Nexus Tablets
 * Kindle Tablets
 * Surface Tablet
 * Nook Tablet
 * Playstation Tablet (Vita)
 * Desktop 
 * Large Monitor
 * Print only
 *
 *----------------------------------------------------------------------------*/




require_once( plugin_dir_path( __FILE__ )."/mobile-detect/Mobile_Detect.php" );




/*----------------------------------------------------------------------------*
 * MOBILE
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "load_mobile_only_widget");
function load_mobile_only_widget(){
register_widget( 'mobile_text_unwrapped' );
}

class mobile_text_unwrapped extends WP_Widget {
  function mobile_text_unwrapped() {
    /* Widget settings. */
    $widget_ops = array( 'classname' => 'Mobile Only Content', 'description' => __( 'Base mobile device screens','bones') );
    /* Widget control settings. */
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'mobile_text_unwrapped' );
    /* Create the widget. */
    $this->WP_Widget( 'mobile_text_unwrapped', 'Mobile', $widget_ops, $control_ops );
  } 


  function widget( $args, $instance ) {

    // All devices are wrapped in this Mobile_Detect conditional
    $detect = new Mobile_Detect;
    if(! $detect->isiPhone()){
      extract( $args );
      $text = $instance['text']; 

      // if checked hide iphone5 widget content with display: none; See public.css
      if ($instance['disable-iphone5'] == 'on'){ echo "<style>.scientifik-iphone5-portrait{ display:none; }</style>"; }
      elseif ($instance['windows-phone'] == 'on') { echo "<style>.scientifik-windows-phone{ display:none; }</style>"; }

      /* show the widget content without any headers or wrappers */
      echo '<div class="unwrapped mobile-only">'.do_shortcode($text).'</div>'; 
    }
  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    /* Strip tags (if needed) and update the widget settings. */
      // Create instances of each checkbox to be saved
      $instance['text'] = $new_instance['text'];
      $instance['disable-iphone5-portrait'] = $new_instance['disable-iphone5-portrait'];
      $instance['windows-phone'] = $new_instance['windows-phone'];
    return $instance;
  }
  function form( $instance ) {
    /* Set up some default widget settings. */
    $defaults = array( 'text' => 'This will display on standard mobile devices.' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'windows-phone' ); ?>"><?php _e( 'Disable Windows Phone widget when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'windows-phone' ); ?>" name="<?php echo $this->get_field_name( 'windows-phone' ); ?> " <?php if ($instance['windows-phone'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-iphone5-portrait' ); ?>"><?php _e( 'Disable iPhone 5 widget when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-iphone5-portrait' ); ?>" name="<?php echo $this->get_field_name( 'disable-iphone5-portrait' ); ?> " <?php if ($instance['disable-iphone5-portrait'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
      <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
    </p>
    <?php
  }
}


/*----------------------------------------------------------------------------*
 * Mobile (landscape)
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "load_mobile_landscape_only_widget");
function load_mobile_landscape_only_widget(){
register_widget( 'mobile_landscape_text_unwrapped' );
}
class mobile_landscape_text_unwrapped extends WP_Widget {
  function mobile_landscape_text_unwrapped() {
    $widget_ops = array( 'classname' => 'Mobile Landscape Only Content', 'description' => __( 'Displays for base mobile device screens while in landscape','bones') );
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'mobile_landscape_text_unwrapped' );
    $this->WP_Widget( 'mobile_landscape_text_unwrapped', 'Mobile (landscape)', $widget_ops, $control_ops );
  } 
  function widget( $args, $instance ) {
    $detect = new Mobile_Detect;
    if(! $detect->isiPhone()){
      extract( $args );
      $text = $instance['text'];  
        if ($instance['disable-mobile'] == 'on'){ echo "<style>.mobile-only{ display:none; }</style>"; }
        elseif ($instance['disable-iphone5-portrait'] == 'on'){ echo "<style>.scientifik-iphone5-portrait{ display:none; }</style>"; }
        elseif ($instance['disable-iphone5-landscape'] == 'on'){ echo "<style>.scientifik-iphone5-landscape{ display:none; }</style>"; }
      echo '<div class="unwrapped mobile-landscape-only">'.do_shortcode($text).'</div>';
    }
  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
      $instance['text'] = $new_instance['text'];
      $instance['disable-iphone5-portrait'] = $new_instance['disable-iphone5-portrait'];
      $instance['disable-iphone5-landscape'] = $new_instance['disable-iphone5-landscape'];
      $instance['disable-mobile'] = $new_instance['disable-mobile'];
    return $instance;
  }
  function form( $instance ) {
    $defaults = array( 'text' => 'This will display on standard mobile devices in landscape orientation' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-mobile' ); ?>"><?php _e( 'Disable the base Mobile widget when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-mobile' ); ?>" name="<?php echo $this->get_field_name( 'disable-mobile' ); ?> " <?php if ($instance['disable-mobile'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-iphone5-portrait' ); ?>"><?php _e( 'Disable iPhone 5 (portrait) widget when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-iphone5-portrait' ); ?>" name="<?php echo $this->get_field_name( 'disable-iphone5-portrait' ); ?> " <?php if ($instance['disable-iphone5-portrait'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-iphone5-landscape' ); ?>"><?php _e( 'Disable iPhone 5 (landscape) widget when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-iphone5-landscape' ); ?>" name="<?php echo $this->get_field_name( 'disable-iphone5-landscape' ); ?> " <?php if ($instance['disable-iphone5-landscape'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
      <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
    </p>
    <?php
  }
}



/*----------------------------------------------------------------------------*
 * iPhone 5 (portrait)
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "load_iphone5_portrait_widget");
function load_iphone5_portrait_widget(){
register_widget( 'iphone5_portrait_unwrapped' );
}
class iphone5_portrait_unwrapped extends WP_Widget {
  function iphone5_portrait_unwrapped() {
    $widget_ops = array( 'classname' => 'Mobile Landscape Only Content', 'description' => __( 'iPhone 5 or iPod Touch 5th generation','bones') );
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'iphone5_portrait_unwrapped' );
    $this->WP_Widget( 'iphone5_portrait_unwrapped', 'iPhone 5 (portrait)', $widget_ops, $control_ops );
  } 
  function widget( $args, $instance ) {
    $detect = new Mobile_Detect;
    if($detect->isiPhone()){
      extract( $args );
      $text = $instance['text'];  
        if ($instance['disable-mobile'] == 'on'){ echo "<style>.mobile-only{ display:none; }</style>"; }
        elseif ($instance['disable-mobile-landscape'] == 'on'){ echo "<style>.mobile-landscape-only{ display:none; }</style>"; }
      echo '<div class="unwrapped scientifik-iphone5-portrait">'.do_shortcode($text).'</div>';  
    }
  }
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
      $instance['text'] = $new_instance['text'];
      $instance['disable-mobile'] = $new_instance['disable-mobile'];
      $instance['disable-mobile-landscape'] = $new_instance['disable-mobile-landscape'];
      $instance['retina'] = $new_instance['retina'];
    return $instance;
  }
  function form( $instance ) {
    $defaults = array( 'text' => 'This will display on iPhone 5, 5s and 5c\'s in portrait orientation' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-mobile' ); ?>"><?php _e( 'Disable the Mobile widget when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-mobile' ); ?>" name="<?php echo $this->get_field_name( 'disable-mobile' ); ?> " <?php if ($instance['disable-mobile'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-mobile-landscape' ); ?>"><?php _e( 'Disable Mobile (landscape) widget when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-mobile-landscape' ); ?>" name="<?php echo $this->get_field_name( 'disable-mobile-landscape' ); ?> " <?php if ($instance['disable-mobile-landscape'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
      <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
    </p>
    <?php
  }
}

/*----------------------------------------------------------------------------*
 * iPhone 5 (landscape)
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "load_iphone5_landscape_widget");
function load_iphone5_landscape_widget(){
register_widget( 'iphone5_landscape_unwrapped' );
}
class iphone5_landscape_unwrapped extends WP_Widget {
  function iphone5_landscape_unwrapped() {
    $widget_ops = array( 'classname' => 'iPhone Landscape', 'description' => __( 'iPhone 5 or iPod Touch 5th generation landscape','bones') );
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'iphone5_landscape_unwrapped' );
    $this->WP_Widget( 'iphone5_landscape_unwrapped', 'iPhone 5 (landscape)', $widget_ops, $control_ops );
  } 
  function widget( $args, $instance ) {
    $detect = new Mobile_Detect;
    if($detect->isiPhone()){
      extract( $args );
      $text = $instance['text'];  
        if ($instance['disable-mobile'] == 'on'){ echo "<style>.mobile-only{ display:none; }</style>"; }
        elseif ($instance['disable-mobile-landscape'] == 'on'){ echo "<style>.mobile-landscape-only{ display:none; }</style>"; }
      echo '<div class="unwrapped scientifik-iphone5-landscape">'.do_shortcode($text).'</div>';  
    }
  }
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
      $instance['text'] = $new_instance['text'];
      $instance['disable-mobile'] = $new_instance['disable-mobile'];
      $instance['disable-mobile-landscape'] = $new_instance['disable-mobile-landscape'];
    return $instance;
  }
  function form( $instance ) {
    $defaults = array( 'text' => 'This will display on iPhone 5, 5s and 5c\'s in landscape orientation' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-mobile' ); ?>"><?php _e( 'Disable the Mobile widget when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-mobile' ); ?>" name="<?php echo $this->get_field_name( 'disable-mobile' ); ?> " <?php if ($instance['disable-mobile'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-mobile-landscape' ); ?>"><?php _e( 'Disable Mobile (landscape) widget when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-mobile-landscape' ); ?>" name="<?php echo $this->get_field_name( 'disable-mobile-landscape' ); ?> " <?php if ($instance['disable-mobile-landscape'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
      <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
    </p>
    <?php
  }
}


/*----------------------------------------------------------------------------*
 * Windows Phone
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "windows_phone_widget");
function windows_phone_widget(){
register_widget( 'windows_phone_os_unwrapped' );
}
class windows_phone_os_unwrapped extends WP_Widget {
  function windows_phone_os_unwrapped() {
    $widget_ops = array( 'classname' => 'iPhone Landscape', 'description' => __( 'Displays on Windows phone operating systems','bones') );
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'windows_phone_os_unwrapped' );
    $this->WP_Widget( 'windows_phone_os_unwrapped', 'Windows Phone (OS)', $widget_ops, $control_ops );
  } 
  function widget( $args, $instance ) {
    $detect = new Mobile_Detect;
    if($detect->isWindowsPhoneOS()){
      extract( $args );
      $text = $instance['text'];  
        if ($instance['disable-mobile'] == 'on'){ echo "<style>.mobile-only{ display:none; }</style>"; }
        elseif ($instance['disable-mobile-landscape'] == 'on'){ echo "<style>.mobile-landscape-only{ display:none; }</style>"; }
      echo '<div class="unwrapped scientifik-windows-phone">'.do_shortcode($text).'</div>';  
    }
  }
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
      $instance['text'] = $new_instance['text'];
      $instance['disable-mobile'] = $new_instance['disable-mobile'];
      $instance['disable-mobile-landscape'] = $new_instance['disable-mobile-landscape'];
    return $instance;
  }
  function form( $instance ) {
    $defaults = array( 'text' => 'This will display on Windows phone operating systems only.' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-mobile' ); ?>"><?php _e( 'Disable the Mobile widget when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-mobile' ); ?>" name="<?php echo $this->get_field_name( 'disable-mobile' ); ?> " <?php if ($instance['disable-mobile'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-mobile-landscape' ); ?>"><?php _e( 'Disable Mobile (landscape) widget when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-mobile-landscape' ); ?>" name="<?php echo $this->get_field_name( 'disable-mobile-landscape' ); ?> " <?php if ($instance['disable-mobile-landscape'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
      <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
    </p>
    <?php
  }
}
/*----------------------------------------------------------------------------*
 * Phablet Sized Devices
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "load_phablet_only_widget");
function load_phablet_only_widget(){
register_widget( 'phablet_text_unwrapped' );
}
class phablet_text_unwrapped extends WP_Widget {
  function phablet_text_unwrapped() {
    $widget_ops = array( 'classname' => '\"Phablet\" Only Content', 'description' => __( 'For large mobile device screens 481px+','bones') );
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'phablet_text_unwrapped' );
    $this->WP_Widget( 'phablet_text_unwrapped', 'Phablet Sized Devices', $widget_ops, $control_ops );
  } 
  function widget( $args, $instance ) {
    extract( $args );
    $text = $instance['text'];  
    echo '<div class="unwrapped phablet">'.do_shortcode($text).'</div>';  
  }
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['text'] = $new_instance['text'];
    return $instance;
  }
  function form( $instance ) {
    $defaults = array( 'text' => 'This will display on screen sizes larger than average phones but smaller than tablet standard screens.' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
	    <p>
	      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
	      <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
	    </p>
    <?php
  }
}


/*----------------------------------------------------------------------------*
 * Tablet (portrait) screens 768px wide - max 1023px
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "tablet_portrait_only_widget");
function tablet_portrait_only_widget(){
register_widget( 'tablet_portrait_text_unwrapped' );
}
class tablet_portrait_text_unwrapped extends WP_Widget {
  function tablet_portrait_text_unwrapped() {
    $widget_ops = array( 'classname' => 'Tablet (Landscape)', 'description' => __( 'Displays on 768px to max 1023px screens in portrait orientation','bones') );
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'tablet_portrait_text_unwrapped' );
    $this->WP_Widget( 'tablet_portrait_text_unwrapped', 'Tablet (portrait)', $widget_ops, $control_ops );
  } 
  function widget( $args, $instance ) {
    $detect = new Mobile_Detect;
    if($detect->isTablet() && ! $detect->isiPad()){    
      extract( $args );
      $text = $instance['text']; 
        if ($instance['disable-ipad-portrait'] == 'on'){ echo "<style>.scientifik-ipad-portrait-widget{ display:none; }</style>"; } 
      echo '<div class="unwrapped tablet-portrait">'.do_shortcode($text).'</div>';
    }
  }
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
      $instance['text'] = $new_instance['text'];
      $instance['retina'] = $new_instance['retina'];
      $instance['disable-ipad-portrait'] = $new_instance['disable-ipad-portrait'];
    return $instance;
  }
  function form( $instance ) {
    $defaults = array( 'text' => 'This will display on standard tablet screen sizes in portrait orientation only.' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-ipad-portrait' ); ?>"><?php _e( 'Disable iPad in portrait widget when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-ipad-portrait' ); ?>" name="<?php echo $this->get_field_name( 'disable-ipad-portrait' ); ?> " <?php if ($instance['disable-ipad-portrait'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'retina' ); ?>"><?php _e( 'disable Retina (2x) when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'retina' ); ?>" name="<?php echo $this->get_field_name( 'retina' ); ?> " <?php if ($instance['retina'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
      <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
    </p>
    <?php
  }
}


/*----------------------------------------------------------------------------*
 * Tablet (landscape) screens 768px wide - max 1024px
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "tablet_landscape_only_widget");
function tablet_landscape_only_widget(){
register_widget( 'tablet_landscape_text_unwrapped' );
}
class tablet_landscape_text_unwrapped extends WP_Widget {
  function tablet_landscape_text_unwrapped() {
    $widget_ops = array( 'classname' => 'Tablet (landscape)', 'description' => __( 'Displays on 768px to max 1024px screens in landscape orientation','bones') );
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'tablet_landscape_text_unwrapped' );
    $this->WP_Widget( 'tablet_landscape_text_unwrapped', 'Tablet (landscape)', $widget_ops, $control_ops );
  }
  function widget( $args, $instance ) {
    $detect = new Mobile_Detect;
    if($detect->isTablet() && ! $detect->isiPad()){
      extract( $args );
      $text = $instance['text'];  
        if ($instance['disable-ipad-landscape'] == 'on'){ echo "<style>.scientifik-ipad-landscape-widget{ display:none; }</style>"; } 
        elseif ($instance['retina'] == 'on') { echo "<style>.retina-only{ display:none; }</style>"; }
      echo '<div class="unwrapped tablet-landscape">'.do_shortcode($text).'</div>';  
    }
  }
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
      $instance['text'] = $new_instance['text'];
    return $instance;
  }
  function form( $instance ) {
    $defaults = array( 'text' => 'This will display on standard tablet screen sizes in landscape orientation only.' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-ipad-landscape' ); ?>"><?php _e( 'Disable iPad (landscape) widget when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-ipad-landscape' ); ?>" name="<?php echo $this->get_field_name( 'disable-ipad-landscape' ); ?> " <?php if ($instance['disable-ipad-landscape'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'retina' ); ?>"><?php _e( 'Disable Retina (2x) when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'retina' ); ?>" name="<?php echo $this->get_field_name( 'retina' ); ?> " <?php if ($instance['retina'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
      <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
    </p>
    <?php
  }
}


/*----------------------------------------------------------------------------*
 * iPad (portrait)
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "ipad_portrait_widget");
function ipad_portrait_widget(){
register_widget( 'ipad_portrait_text_unwrapped' );
}
class ipad_portrait_text_unwrapped extends WP_Widget {
  function ipad_portrait_text_unwrapped() {
    $widget_ops = array( 'classname' => 'iPad (portrait)', 'description' => __( 'Specifically targets retina iPads in portrait orientation','bones') );
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'ipad_portrait_text_unwrapped' );
    $this->WP_Widget( 'ipad_portrait_text_unwrapped', 'iPad (portrait)', $widget_ops, $control_ops );
  }
  function widget( $args, $instance ) {
    $detect = new Mobile_Detect;
    if($detect->isTablet() && $detect->isiOS()){
      extract( $args );
      $text = $instance['text'];  
        if ($instance['disable-tablet-portrait'] == 'on'){ echo "<style>.tablet-portrait{ display:none; }</style>"; } 
      echo '<div class="unwrapped scientifik-ipad-portrait-widget">'.do_shortcode($text).'</div>';  
    }
  }
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
	    $instance['text'] = $new_instance['text'];
      $instance['disable-tablet-portrait'] = $new_instance['disable-tablet-portrait'];
      $instance['retina'] = $new_instance['retina'];
    return $instance;
  }
  function form( $instance ) {
    $defaults = array( 'text' => 'This will display on iPads in portrait orientation only.');
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-tablet-portrait' ); ?>"><?php _e( 'Disable Tablet (portrait) when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-tablet-portrait' ); ?>" name="<?php echo $this->get_field_name( 'disable-tablet-portrait' ); ?> " <?php if ($instance['disable-tablet-portrait'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'retina' ); ?>"><?php _e( 'Disable Retina (2x) when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'retina' ); ?>" name="<?php echo $this->get_field_name( 'retina' ); ?> " <?php if ($instance['retina'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
    	<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
      <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
  	</p>
  <?php
  }
}

/*----------------------------------------------------------------------------*
 * iPad (landscape)
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "ipad_landscape_widget");
function ipad_landscape_widget(){
  register_widget( 'ipad_landscape_text_unwrapped' );
}
class ipad_landscape_text_unwrapped extends WP_Widget {
  function ipad_landscape_text_unwrapped() {
    $widget_ops = array( 'classname' => 'iPad in Landscape', 'description' => __( 'Specifically targets retina iPads in landscape orientation','bones') );
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'ipad_landscape_text_unwrapped' );
    $this->WP_Widget( 'ipad_landscape_text_unwrapped', 'iPad (landscape)', $widget_ops, $control_ops );
  } 
  function widget( $args, $instance ) {
    $detect = new Mobile_Detect;
    if($detect->isiPad()){
      extract( $args );
      $text = $instance['text'];  
      if ($instance['disable-tablet-landscape'] == 'on'){ echo "<style>.tablet-landscape{ display:none; }</style>"; }
      echo '<div class="unwrapped scientifik-ipad-landscape-widget">'.do_shortcode($text).'</div>';  
    }
  }
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
	    $instance['text'] = $new_instance['text'];
      $instance['retina'] = $new_instance['retina'];
      $instance['disable-tablet-landscape'] = $new_instance['disable-tablet-landscape'];
    return $instance;
  }
  function form( $instance ) {
    $defaults = array( 'text' => 'This will display on iPads in landscape orientation only.' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'retina' ); ?>"><?php _e( 'Disable Retina (2x) widget when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'retina' ); ?>" name="<?php echo $this->get_field_name( 'retina' ); ?> " <?php if ($instance['retina'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-tablet-landscape' ); ?>"><?php _e( 'Disable standard Tablet (landscape) widget when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-tablet-landscape' ); ?>" name="<?php echo $this->get_field_name( 'disable-tablet-landscape' ); ?> " <?php if ($instance['disable-tablet-landscape'] == 'on'){ echo 'checked'; }?> ></input>
    </p>
    <p>
    	<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
      <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
  	</p>
    <?php
  }
}



/*----------------------------------------------------------------------------*
 * Nexus Tablets
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "nexus_tablet_only_widget");
function nexus_tablet_only_widget(){
register_widget( 'nexus_tablet_text_unwrapped' );
}
class nexus_tablet_text_unwrapped extends WP_Widget {
  function nexus_tablet_text_unwrapped() {
    $widget_ops = array( 'classname' => 'Nexus Tablet', 'description' => __( 'Displays on Nexus tablets','bones') );
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'nexus_tablet_text_unwrapped' );
    $this->WP_Widget( 'nexus_tablet_text_unwrapped', 'Nexus Tablets', $widget_ops, $control_ops );
  } 
  function widget( $args, $instance ) {
    $detect = new Mobile_Detect;
    if($detect->isNexusTablet()){    
      extract( $args );
      $text = $instance['text']; 
        if ($instance['disable-tablet-widgets'] == 'on') { echo "<style>.tablet-landscape,.tablet-portrait{ display:none; }</style>"; }
      echo '<div class="unwrapped scientifik-generic-tablet">'.do_shortcode($text).'</div>';
    }
  }
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
      $instance['disable-tablet-widgets'] = $new_instance['disable-tablet-widgets'];
      $instance['text'] = $new_instance['text'];
    return $instance;
  }
  function form( $instance ) {
    $defaults = array( 'text' => 'This will display on Nexus tablets only.' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-tablet-widgets' ); ?>"><?php _e( 'Disable Tablet (portrait) & Tablet (landscape) widgets when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-tablet-widgets' ); ?>" name="<?php echo $this->get_field_name( 'disable-tablet-widgets' ); ?> " <?php if ($instance['disable-tablet-widgets'] == 'on'){ echo 'checked'; }?> ></input>
    </p>  
    <p>
      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
      <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
    </p>
    <?php
  }
}


/*----------------------------------------------------------------------------*
 * Samsung Tablets
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "samsung_tablet_widget");
function samsung_tablet_widget(){
register_widget( 'samsung_text_unwrapped' );
}
class samsung_text_unwrapped extends WP_Widget {
  function samsung_text_unwrapped() {
    $widget_ops = array( 'classname' => 'Samsung', 'description' => __( 'Displays on Samsung tablets','bones') );
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'samsung_text_unwrapped' );
    $this->WP_Widget( 'samsung_text_unwrapped', 'Samsung Tablets', $widget_ops, $control_ops );
  } 
  function widget( $args, $instance ) {
    $detect = new Mobile_Detect;
    if($detect->isSamsung()){
      extract( $args );
      $text = $instance['text']; 
        if ($instance['disable-tablet-widgets'] == 'on') { echo "<style>.tablet-landscape,.tablet-portrait{ display:none; }</style>"; }
      echo '<div class="unwrapped scientifik-generic-tablet">'.do_shortcode($text).'</div>';
    }
  }
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
      $instance['disable-tablet-widgets'] = $new_instance['disable-tablet-widgets'];
      $instance['text'] = $new_instance['text'];
    return $instance;
  }
  function form( $instance ) {
    $defaults = array( 'text' => 'This will display on Samsung tablets only.' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-tablet-widgets' ); ?>"><?php _e( 'Disable Tablet (portrait) & Tablet (landscape) widgets when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-tablet-widgets' ); ?>" name="<?php echo $this->get_field_name( 'disable-tablet-widgets' ); ?> " <?php if ($instance['disable-tablet-widgets'] == 'on'){ echo 'checked'; }?> ></input>
    </p>  
    <p>
      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
      <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
    </p>
    <?php
  }
}

/*----------------------------------------------------------------------------*
 * Kindle Tablets
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "kindle_tablet_widget");
function kindle_tablet_widget(){
register_widget( 'kindle_text_unwrapped' );
}
class kindle_text_unwrapped extends WP_Widget {
  function kindle_text_unwrapped() {
    $widget_ops = array( 'classname' => 'Kindle', 'description' => __( 'Displays on Kindle tablets','bones') );
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'kindle_text_unwrapped' );
    $this->WP_Widget( 'kindle_text_unwrapped', 'Kindle Tablets', $widget_ops, $control_ops );
  } 
  function widget( $args, $instance ) {
    $detect = new Mobile_Detect;
    if($detect->isKindle()){    
      extract( $args );
      $text = $instance['text']; 
        if ($instance['disable-tablet-widgets'] == 'on') { echo "<style>.tablet-landscape,.tablet-portrait{ display:none; }</style>"; }
      echo '<div class="unwrapped scientifik-generic-tablet">'.do_shortcode($text).'</div>';
    }
  }
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
      $instance['disable-tablet-widgets'] = $new_instance['disable-tablet-widgets'];
      $instance['text'] = $new_instance['text'];
    return $instance;
  }
  function form( $instance ) {
    /* Set up some default widget settings. */
    $defaults = array( 'text' => 'This will display on Kindle tablets only.' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-tablet-widgets' ); ?>"><?php _e( 'Disable Tablet (portrait) & Tablet (landscape) widgets when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-tablet-widgets' ); ?>" name="<?php echo $this->get_field_name( 'disable-tablet-widgets' ); ?> " <?php if ($instance['disable-tablet-widgets'] == 'on'){ echo 'checked'; }?> ></input>
    </p>  
    <p>
      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
      <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
    </p>

    <?php
  }
}


/*----------------------------------------------------------------------------*
 * Surface Tablet
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "surface_tablet_widget");
function surface_tablet_widget(){
register_widget( 'surface_tablet_text_unwrapped' );
}

class surface_tablet_text_unwrapped extends WP_Widget {
  function surface_tablet_text_unwrapped() {
    $widget_ops = array( 'classname' => 'Surface', 'description' => __( 'Displays on Microsoft Surface tablets','bones') );
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'surface_tablet_text_unwrapped' );
    $this->WP_Widget( 'surface_tablet_text_unwrapped', 'Surface Tablet', $widget_ops, $control_ops );
  } 
  function widget( $args, $instance ) {
    $detect = new Mobile_Detect;
    if($detect->isTablet() && ! $detect->isiPad()){    
      extract( $args );
      $text = $instance['text']; 
        if ($instance['disable-tablet-widgets'] == 'on') { echo "<style>.tablet-landscape,.tablet-portrait{ display:none; }</style>"; }
      echo '<div class="unwrapped scientifik-generic-tablet">'.do_shortcode($text).'</div>';
    }
  }
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
      $instance['disable-tablet-widgets'] = $new_instance['disable-tablet-widgets'];
      $instance['text'] = $new_instance['text'];
    return $instance;
  }
  function form( $instance ) {
    $defaults = array( 'text' => 'This will display on Microsoft Surface tablets only.' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-tablet-widgets' ); ?>"><?php _e( 'Disable Tablet (portrait) & Tablet (landscape) widgets when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-tablet-widgets' ); ?>" name="<?php echo $this->get_field_name( 'disable-tablet-widgets' ); ?> " <?php if ($instance['disable-tablet-widgets'] == 'on'){ echo 'checked'; }?> ></input>
    </p>  
    <p>
      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
      <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
    </p>
    <?php
  }
}


/*----------------------------------------------------------------------------*
 * Nook Tablet
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "nook_tablet_widget");
function nook_tablet_widget(){
register_widget( 'nook_tablet_text_unwrapped' );
}
class nook_tablet_text_unwrapped extends WP_Widget {
  function nook_tablet_text_unwrapped() {
    $widget_ops = array( 'classname' => 'Nook', 'description' => __( 'Displays on Nook tablets','bones') );
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'nook_tablet_text_unwrapped' );
    $this->WP_Widget( 'nook_tablet_text_unwrapped', 'Nook Tablet', $widget_ops, $control_ops );
  } 

    function widget( $args, $instance ) {
      $detect = new Mobile_Detect;
      if($detect->isNook()){    
        extract( $args );
        $text = $instance['text']; 
          if ($instance['disable-tablet-widgets'] == 'on') { echo "<style>.tablet-landscape,.tablet-portrait{ display:none; }</style>"; }
        echo '<div class="unwrapped scientifik-generic-tablet">'.do_shortcode($text).'</div>';
      }
    }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
      $instance['disable-tablet-widgets'] = $new_instance['disable-tablet-widgets'];
      $instance['text'] = $new_instance['text'];
    return $instance;
  }
  function form( $instance ) {
    /* Set up some default widget settings. */
    $defaults = array( 'text' => 'This will display on Nook tablets only.' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-tablet-widgets' ); ?>"><?php _e( 'Disable Tablet (portrait) & Tablet (landscape) widgets when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-tablet-widgets' ); ?>" name="<?php echo $this->get_field_name( 'disable-tablet-widgets' ); ?> " <?php if ($instance['disable-tablet-widgets'] == 'on'){ echo 'checked'; }?> ></input>
    </p>  
    <p>
      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
      <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
    </p>

    <?php
  }
}



/*----------------------------------------------------------------------------*
 * Playstation Tablet (Vita)
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "playstation_tablets_only_widget");
function playstation_tablets_only_widget(){
register_widget( 'playstation_tablet_text_unwrapped' );
}

class playstation_tablet_text_unwrapped extends WP_Widget {
  function playstation_tablet_text_unwrapped() {
    $widget_ops = array( 'classname' => 'Playstation_tablet', 'description' => __( 'Displays on Playstation tablets','bones') );
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'playstation_tablet_text_unwrapped' );
    $this->WP_Widget( 'playstation_tablet_text_unwrapped', 'Playstation Vita', $widget_ops, $control_ops );
  } 
  function widget( $args, $instance ) {
    $detect = new Mobile_Detect;
    if($detect->isPlaystationTablet()){
      extract( $args );
      $text = $instance['text']; 
        if ($instance['disable-tablet-widgets'] == 'on') { echo "<style>.tablet-landscape,.tablet-portrait{ display:none; }</style>"; }
      echo '<div class="unwrapped scientifik-generic-tablet">'.do_shortcode($text).'</div>';
    }
  }
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
      $instance['disable-tablet-widgets'] = $new_instance['disable-tablet-widgets'];
      $instance['text'] = $new_instance['text'];
    return $instance;
  }
  function form( $instance ) {
    $defaults = array( 'text' => 'This will display on Playstation tablets only.' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'disable-tablet-widgets' ); ?>"><?php _e( 'Disable Tablet (portrait) & Tablet (landscape) widgets when being displayed','bones'); ?></label><br />
      <input class="widefat" rows="20" cols="75" type="checkbox" id="<?php echo $this->get_field_id( 'disable-tablet-widgets' ); ?>" name="<?php echo $this->get_field_name( 'disable-tablet-widgets' ); ?> " <?php if ($instance['disable-tablet-widgets'] == 'on'){ echo 'checked'; }?> ></input>
    </p>  
    <p>
      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
      <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
    </p>
    <?php
  }
}

/*----------------------------------------------------------------------------*
 * DESKTOP ONLY WIDGET
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "load_desktop_only_widget");
function load_desktop_only_widget(){
  register_widget( 'desktop_only_widget' );
}
class desktop_only_widget extends WP_Widget {
  function desktop_only_widget() {
    $widget_ops = array( 'classname' => 'Desktop Only Content', 'description' => __( 'Desktop (1030px+ wide monitors)','bones') );
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'desktop_only_widget' );
    $this->WP_Widget( 'desktop_only_widget', 'Desktop', $widget_ops, $control_ops );
  } 
  function widget( $args, $instance ) {
    extract( $args );
    $text = $instance['text'];  
    echo '<div class="unwrapped desktop-only">'.do_shortcode($text).'</div>';  
  }
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['text'] = $new_instance['text'];
    return $instance;
  }
  function form( $instance ) {
    $defaults = array( 'text' => '' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
      <p>
        <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
        <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
      </p>
    <?php
  }
}


/*----------------------------------------------------------------------------*
 * Large Monitor Widget 1240px / 77.500em
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "large_screen_only_widget");
function large_screen_only_widget(){
register_widget( 'large_screen_text_unwrapped' );
}

class large_screen_text_unwrapped extends WP_Widget {
  function large_screen_text_unwrapped() {
    $widget_ops = array( 'classname' => 'Large Screen Content', 'description' => __( 'Screens 1240px+ wide','bones') );
    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'large_screen_text_unwrapped' );
    $this->WP_Widget( 'large_screen_text_unwrapped', 'Large', $widget_ops, $control_ops );
  } 
  function widget( $args, $instance ) {
    extract( $args );
    $text = $instance['text'];  
    echo '<div class="unwrapped large-screen-widget">'.do_shortcode($text).'</div>';  
  }
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
	    $instance['text'] = $new_instance['text'];
    return $instance;
  }
  function form( $instance ) {
    $defaults = array( 'text' => '' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
      <p>
      	<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
        <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
    	</p>
    <?php
  }
}





/*----------------------------------------------------------------------------*
 * Displays for print only
 *----------------------------------------------------------------------------*/

add_action("widgets_init", "print_only_widget");
function print_only_widget(){
register_widget( 'print_text_unwrapped' );
}

class print_text_unwrapped extends WP_Widget {
  function print_text_unwrapped() {

    $widget_ops = array( 'classname' => 'Print Only', 'description' => __( 'Displays on printed page only','bones') );

    $control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'print_text_unwrapped' );
    $this->WP_Widget( 'print_text_unwrapped', 'Print only', $widget_ops, $control_ops );
  } 
  function widget( $args, $instance ) {
    extract( $args );
    $text = $instance['text'];  
    /* show the widget content without any headers or wrappers */
    echo '<div class="unwrapped print-query">'.do_shortcode($text).'</div>';
  }
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
	    $instance['text'] = $new_instance['text'];
    return $instance;
  }
  function form( $instance ) {
    /* Set up some default widget settings. */
    $defaults = array( 'text' => '' );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>
      <p>
      	<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text/HTML','bones'); ?></label><br />
        <textarea class="widefat" rows="20" cols="75" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $instance['text']; ?></textarea>
    	</p>
    <?php
  }
}