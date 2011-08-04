<?php
/*
Plugin Name: Mobile Helper
Plugin URI: http://www.tinyplugins.com
Description: mobile theme switching, mobile device targetting (iphone,ipad,blackberry,android,etc) and mobile video linking
Author: Chris McCoy
Version: 1.0
Author URI: http://www.tinyplugins.com
*/

include('mobiledetect.php');

$mymobile = new MobileDetect();

if($mymobile->IsMobile() == true){
   	add_filter('stylesheet', 'mobile_theme');
	add_filter('template', 'mobile_theme');
}
  
function mobile_theme(){
	$mobiletheme =  get_option('mobiletheme');
    	$themes = get_themes();
	foreach ($themes as $theme) {
	  if ($theme['Name'] == $mobiletheme) {
	      return $theme['Stylesheet'];
	  }
	}	
}

function mobile_helper_admin_menu() { 
	if (current_user_can('activate_plugins')) { 
		add_theme_page("Mobile Helper", "Mobile Helper", 8, "mobile_helper", "mobile_helper_admin");
	}
} 

add_action('admin_menu', 'mobile_helper_admin_menu'); 

function mobile_helper_admin(){

if($_POST['form_hidden'] == 'Y') {
	$mobiletheme = $_POST['mobiletheme'];
	update_option('mobiletheme', $mobiletheme);
	?>
	<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
	<?php
} else {
	$mobiletheme = get_option('mobiletheme');
}	
?>

<div class="wrap">
<?php echo "<h2>" . __( 'Mobile Helper', 'my_mobiletheme' ) . "</h2>"; ?>
<br />

<form name="mobiletheme_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">

<?php
  $themes = get_themes();
  $default_theme = get_current_theme();
  if (count($themes) > 1) {
      $theme_names = array_keys($themes);
      natcasesort($theme_names); 
      $html = 'Select mobile theme: <select name="mobiletheme">' . "\n";
      foreach ($theme_names as $theme_name) {              
          if (($mobiletheme == $theme_name) || (($mobiletheme == '') && ($theme_name == $default_theme))) {
              $html .= '<option value="' . $theme_name . '" selected="selected">' . htmlspecialchars($theme_name) . '</option>' . "\n";
          } else {
              $html .= '<option value="' . $theme_name . '">' . htmlspecialchars($theme_name) . '</option>' . "\n";
          }
      }
      $html .= '</select>' . "\n\n";
  }
  echo $html;
?>

<input type="hidden" name="form_hidden" value="Y">
<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'my_mobiletheme' ) ?>" />
</p>
</form>
</div>

<?php }


function is_iphone($atts,$content=null) {
	global $mymobile;
	if($mymobile->IsIphone()){
		return do_shortcode($content);
	}
}

function is_ipod($atts,$content=null) {
	global $mymobile;
	if($mymobile->IsIphone()){
		return do_shortcode($content);
	}
}

function is_ipad($atts,$content=null) {
	global $mymobile;
	if($mymobile->IsIpad()){
		return do_shortcode($content);
	}
}

function is_android($atts,$content=null) {
	global $mymobile;
	if($mymobile->IsAndroid()){
		return do_shortcode($content);
	}
}

function is_kindle($atts,$content=null) {
	global $mymobile;
	if($mymobile->IsKindle()){
		return do_shortcode($content);
	}
}

function is_blackberry($atts,$content=null) {
	global $mymobile;
	if($mymobile->IsBlackBerry()){
		return do_shortcode($content);
	}
}

function is_palm($atts,$content=null) {
	global $mymobile;
	if($mymobile->IsPalm()){
		return do_shortcode($content);
	}
}

function is_windows($atts,$content=null) {
	global $mymobile;
	if($mymobile->IsWindows()){
		return do_shortcode($content);
	}
}

function is_mobile($atts,$content=null) {
	global $mymobile;
	if($mymobile->IsMobile()){
		return do_shortcode($content);
	}
}

function is_opera($atts,$content=null) {
	global $mymobile;
	if($mymobile->IsOpera()){
		return do_shortcode($content);
	}
}

function is_normal($atts,$content=null) {
	global $mymobile;
	if(!$mymobile->IsMobile()){
		return do_shortcode($content);
	}
}

function mobile_video_shortcode($atts,$content=null) {
	extract(shortcode_atts(array(
	'video' => '',
	'image' => '',
	'width' => '480',
	'height' => '320',
	),$atts));
	$output = '<a href="' . $video . '"><img width="'.$width.'" height="'.$height.'" src="' . $image . '" /></a>';
	return $output;
}

add_shortcode('mobilevideo','mobile_video_shortcode');

add_shortcode('is_iphone','is_iphone');
add_shortcode('is_ipod','is_ipod');
add_shortcode('is_ipad','is_ipad');
add_shortcode('is_android','is_android');
add_shortcode('is_kindle','is_kindle');
add_shortcode('is_blackberry','is_blackberry');
add_shortcode('is_palm','is_palm');
add_shortcode('is_opera','is_opera');
add_shortcode('is_windows','is_windows');
add_shortcode('is_mobile','is_mobile');
add_shortcode('is_normal','is_normal');

?>
