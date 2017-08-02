<?php /*/
Plugin Name: Media Share - Share Button On Image And Embed
Plugin URI: http://wordpress.org/plugins/mediashare-imageembedtext/
Description: A media share plugin for wordpress.
Version: 1.00
Author: Himanshu Dixit
/*/

// create custom plugin settings menu
add_action('admin_menu', 'media_share_create_menu');

function media_share_create_menu() {

	//create new top-level menu
	add_menu_page('Media Share Plugin Settings', 'Media Share Settings', 'administrator', __FILE__, 'media_share_settings_page',plugins_url('/images/icon.png', __FILE__));

	//call register settings function
	add_action( 'admin_init', 'register' );
}


function register() {
	//register our settings
	register_setting( 'media_share', 'facebook' );
	register_setting( 'media_share', 'twitter' );
	register_setting( 'media_share', 'linkedin' );
		register_setting( 'media_share', 'reddit' );
			register_setting( 'media_share', 'google' );
				register_setting( 'media_share', 'pinterest' );
	register_setting( 'media_share', 'Style' );
	
}

function media_share_settings_page() {

?>



<div class="wrap">
<h2>Media Share</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'media_share' ); ?>
    <?php do_settings_sections( 'media_share' ); ?>
    <table class="form-table">

        <tr valign="top">
        <th scope="row">Facebook</th>
        <td><input type="checkbox" class="share" name="facebook" value="1" <?php if(get_option('facebook')=="1"){ echo "checked";}?> /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Twitter</th>
        <td><input type="checkbox" class="share" name="twitter" value="1" <?php if(get_option('twitter')=="1"){ echo "checked";}?> /></td>
        </tr>
         <tr valign="top">
        <th scope="row">Pinterest</th>
        <td><input type="checkbox" class="share" name="pinterest" value="1" <?php if(get_option('pinterest')=="1"){ echo "checked";}?> /></td>
        </tr>

 <tr valign="top">
        <th scope="row">Reddit</th>
        <td><input type="checkbox" class="share" name="reddit" value="1" <?php if(get_option('reddit')=="1"){ echo "checked";}?> /></td>
        </tr>

 <tr valign="top">
        <th scope="row">Google Plus</th>
        <td><input type="checkbox" class="share" name="google" value="1" <?php if(get_option('google')=="1"){ echo "checked";}?> /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Linkedin</th>
        <td><input type="checkbox" class="share" name="linkedin" value="1" <?php if(get_option('linkedin')=="1"){ echo "checked";}?> /></td>
        </tr>
   <tr valign="top">
        <th scope="row">Style 1</th>
        <td><input type="radio" class="share" name="Style" value="1" <?php if(get_option('Style')=="1"){ echo "checked";}?> >Style 1</td>
        </tr>
 

</table>
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>
<?php
function mediasharecontent( $content ) {
$facebook = get_option('facebook');
$pinterest = get_option('pinterest');

if($facebook == 1)
{
$content1 = '"facebook"';
}
else
{
}


if($pinterest == 1)
{
$content1 = $content1.',"pinterest"';

}
else{

}


$style=get_option("Style");

    $custom_contente = '.sti({
     			primary_menu: ['.$content1.' ]
});
';
$custom_content1 = 'jQuery(".container img,iframe,blackquote")'.$custom_contente;



$custom_content .= '<script  type="text/javascript"> 
jQuery(window).load(function() {
'.$custom_content1.'
});
</script>';

    $custom_content .= $content;
    return $custom_content;
}
add_filter( 'the_content', 'mediasharecontent' );

add_action( 'wp_enqueue_scripts', 'mediasharejs' );
function mediasharejs() {
    wp_enqueue_script( 'media_share.js', plugins_url('mediashare.js', __FILE__) , array('jquery') );
}
$url = $style.'/this.css';
add_action( 'wp_enqueue_scripts', 'mediasharecss' );

$style=get_option("Style");

if($style=='1')
{

    function mediasharecss() {
        wp_enqueue_style( 'prefix-style', plugins_url('style5/this.css', __FILE__) );
    }
}


?>