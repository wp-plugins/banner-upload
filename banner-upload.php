<?php
/*
Plugin Name: Banner Upload
Plugin URI: http://buffercode.com/
Description: Easy way to display the different size of banner advertisements in WordPress using widgets
Version: 1.0
Author: vinoth06
Author URI: http://buffercode.com/
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Additing Action hook widgets_init
add_action( 'widgets_init', 'buffercode_banner_upload'); 

function buffercode_banner_upload() {
register_widget( 'buffercode_banner_upload_info' );
}

class buffercode_banner_upload_info extends WP_Widget {
function buffercode_banner_upload_info () {
		$this->WP_Widget('buffercode_banner_upload_info', 'Banner Upload','Select the category to display');	}

public function form( $instance ) { 
if ( isset( $instance[ 'buffercode_BU_img_url' ]) && isset ($instance[ 'buffercode_BU_width' ]) && isset ($instance[ 'buffercode_BU_height' ]) && isset ($instance[ 'buffercode_BU_title' ]) && isset ($instance[ 'buffercode_BU_URL' ])) {
			$buffercode_BU_img_url = $instance[ 'buffercode_BU_img_url' ];
			$buffercode_BU_width = $instance[ 'buffercode_BU_width' ];
			$buffercode_BU_height = $instance[ 'buffercode_BU_height' ];
			$buffercode_BU_title = $instance[ 'buffercode_BU_title' ];
			$buffercode_BU_URL = $instance[ 'buffercode_BU_URL' ];
		}
		else {//Setting Default Values
		$buffercode_BU_img_url = '';
		$buffercode_BU_width = 300;
		$buffercode_BU_height = 250;
		$buffercode_BU_title = 'Advertisement';
		$buffercode_BU_URL ='';
		} ?><!-- Buffercode.com wordpress banner upload plugin Options -->
		
		<p>Custom Title <input maxlength="50" class="widefat" name="<?php echo $this->get_field_name( 'buffercode_BU_title' ); ?>" type="text" value="<?php echo esc_attr( $buffercode_BU_title );?>" /></p>
		
		<p>
       <label for="<?php echo $this->get_field_id('buffercode_BU_img_url'); ?>">Image</label><br />
       <input type="text" class="img" name="<?php echo $this->get_field_name('buffercode_BU_img_url'); ?>" id="<?php echo $this->get_field_id('buffercode_BU_img_url'); ?>" value="<?php echo $buffercode_BU_img_url; ?>" />
       <input type="button" class="select-img" value="Image" />
     </p>
		
		<p>size <input maxlength="4" style="width:60px" class="widefat" name="<?php echo $this->get_field_name( 'buffercode_BU_width' ); ?>" type="text" value="<?php echo esc_attr( $buffercode_BU_width );?>" />px X <input maxlength="4" style="width:60px" class="widefat" name="<?php echo $this->get_field_name( 'buffercode_BU_height' ); ?>" type="text" value="<?php echo esc_attr( $buffercode_BU_height );?>" />px
		</p>
			
		<p>Image Click Link <input class="widefat urlfield" name="<?php echo $this->get_field_name( 'buffercode_BU_URL' ); ?>" type="text" value="<?php echo esc_attr( $buffercode_BU_URL );?>" /></p>
		
<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;

$instance['buffercode_BU_title'] = ( ! empty( $new_instance['buffercode_BU_title'] ) ) ? strip_tags( $new_instance['buffercode_BU_title'] ) : '';

$instance['buffercode_BU_img_url'] = ( ! empty( $new_instance['buffercode_BU_img_url'] ) ) ? strip_tags( $new_instance['buffercode_BU_img_url'] ) : '';

$instance['buffercode_BU_width'] = ( ! empty( $new_instance['buffercode_BU_width'] ) ) ? strip_tags( $new_instance['buffercode_BU_width'] ) : '';

$instance['buffercode_BU_height'] = ( ! empty( $new_instance['buffercode_BU_height'] ) ) ? strip_tags( $new_instance['buffercode_BU_height'] ) : '';

$instance['buffercode_BU_URL'] = ( ! empty( $new_instance['buffercode_BU_URL'] ) ) ? strip_tags( $new_instance['buffercode_BU_URL'] ) : '';

return $instance;
}

function widget($args, $instance) {
extract($args);
echo $before_widget;
$buffercode_BU_title = apply_filters( 'widget_title', $instance['buffercode_BU_title'] );
$buffercode_BU_img_url = empty( $instance['buffercode_BU_img_url'] ) ? '&nbsp;' :
$instance['buffercode_BU_img_url'];
$buffercode_BU_width = empty( $instance['buffercode_BU_width'] ) ? '&nbsp;' :
$instance['buffercode_BU_width'];
$buffercode_BU_height = empty( $instance['buffercode_BU_height'] ) ? '&nbsp;' :
$instance['buffercode_BU_height'];
$buffercode_BU_URL = empty( $instance['buffercode_BU_URL'] ) ? '&nbsp;' :
$instance['buffercode_BU_URL'];

/* Buffercode.com wordpress Banner upload plugin */

if ( !empty( $name ) ) { echo $before_title . $buffercode_BU_title .
$after_title; };
echo '<!-- Buffercode.com Banner Upload Plugin--> <a href="'.$buffercode_BU_URL.'" alt="'.$buffercode_BU_URL.'" target="_blank">';
echo '<img src="'.$buffercode_BU_img_url.'" width="'.$buffercode_BU_width.'px" height="'.$buffercode_BU_height.'px" />';
echo '</a> <!-- Buffercode.com Banner Upload Plugin-->';
/* Buffercode.com wordpress Banner upload plugin */
echo $after_widget;
}
}
?>

