<?php
/*
Plugin Name: Banner Upload
Plugin URI: http://buffercode.com/wordpress-banner-upload-plugin/
Description: Easy way to display the different size of banner advertisements in WordPress using widgets
Version: 1.1
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
if ( isset( $instance[ 'buffercode_BUpload_title' ]) ) {
			$buffercode_BUpload_title = $instance[ 'buffercode_BUpload_title' ];
		}
else {
	$buffercode_BUpload_title = 'Advertisement';
	} 
?>
<p>Custom Title <input maxlength="50" class="widefat" name="<?php echo $this->get_field_name('buffercode_BUpload_title') ?>" type="text" value="<?php echo esc_attr( $buffercode_BUpload_title ); ?>" /></p>
<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
$instance['buffercode_BUpload_title'] = ( ! empty( $new_instance['buffercode_BUpload_title'] ) ) ? strip_tags( $new_instance['buffercode_BUpload_title'] ) : '';
return $instance;
}

function widget($args, $instance) {
extract($args);
echo $before_widget;
$buffercode_BUpload_title = apply_filters( 'widget_title', $instance['buffercode_BUpload_title'] );

/* Buffercode.com wordpress Banner upload plugin */

if ( !empty( $name ) ) { echo $before_title . $buffercode_BUpload_title .
$after_title; }
$buffercode_BU_URL = get_option('buffercode_BU_URL');
$buffercode_BU_img_url = get_option('buffercode_BU_img_url');
$buffercode_BU_height = get_option('buffercode_BU_height');
$buffercode_BU_width = get_option('buffercode_BU_width');
echo '<!-- Buffercode.com Banner Upload Plugin --> <a href="'.$buffercode_BU_URL.'" alt="'.$buffercode_BU_URL.'" target="_blank">';
echo '<img src="'.$buffercode_BU_img_url.'" width="'.$buffercode_BU_width.'px" height="'.$buffercode_BU_height.'px" />';
echo '</a> <!-- Buffercode.com Banner Upload Plugin-->';

echo $after_widget;
}
}
// Adding Menu
add_action('admin_menu', 'buffercode_BUpload_menu');

function buffercode_BUpload_menu() {

	add_options_page( 'Banner Upload', 'Banner Upload', 'manage_options', __FILE__, 'buffercode_BUpload_menu_setting' );
	//call register settings function
	add_action( 'admin_init', 'buffercode_BUpload_settings' );
}


function buffercode_BUpload_settings() {
	register_setting( 'buffercode_BUpload_settings_group', 'buffercode_BU_img_url' );
	register_setting( 'buffercode_BUpload_settings_group', 'buffercode_BU_URL' );
	register_setting( 'buffercode_BUpload_settings_group', 'buffercode_BU_width' );
	register_setting( 'buffercode_BUpload_settings_group', 'buffercode_BU_height' );	
}

function buffercode_BUpload_menu_setting() {
?>
<div class="wrap">
<h2>Random Banner Setting Page</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'buffercode_BUpload_settings_group' ); ?>
    <?php do_settings_sections( 'buffercode_BUpload_settings_group' );?>
	 
    <table class="form-table">
        <tr valign="top">
            <td></td>
            <td>
                <label for="upload_image">
                    <input placeholder="banner1"  id="upload_image1" type="text" size="25" name="buffercode_BU_img_url" value="<?php echo get_option('buffercode_BU_img_url') ?>" />
                    <input class="upload_image_button" class="button" type="button" value="Upload Image" />
                    <br />Enter a URL (with http://) or upload an image<br /><br />
                    <input placeholder="Link for that image"  type="text" size="25" name="buffercode_BU_URL" value="<?php echo get_option('buffercode_BU_URL') ?>" />
                    <br />Enter a URL (with http://)<br /><br />
                     <input placeholder="300"  type="text" size="5" name="buffercode_BU_width" value="<?php echo get_option('buffercode_BU_width') ?>" /> px X <input placeholder="250"  type="text" size="5" name="buffercode_BU_height" value="<?php echo get_option('buffercode_BU_height') ?>" /> px
                 </label>
            </td>
       </tr>
	
        
       <tr valign="top">
            <td></td>
            <td>Designed by - <a href="http://buffercode.com">Buffercode</a></td>
            <td></td>
       </tr>

       <tr valign="top">
           <td></td>
           <td><?php submit_button();  ?></td>
           <td></td>
        </tr>
    </table>
</form>
</div>
<?php 
} 

function buffercode_BUpload_uploader_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload', plugins_url('js\upload-js.js',__FILE__), array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
}

function buffercode_BUpload_uploader_styles() {
wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'buffercode_BUpload_uploader_scripts');
add_action('admin_print_styles', 'buffercode_BUpload_uploader_styles'); 

register_deactivation_hook( __FILE__, 'buffercode_BUpload_deactive' );

function buffercode_BUpload_deactive() {
	delete_option( 'buffercode_BU_img_url' );
	delete_option( 'buffercode_BU_URL' );
	delete_option( 'buffercode_BU_width' );
	delete_option( 'buffercode_BU_height' );
}
?>