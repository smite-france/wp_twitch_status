<?
/*
Plugin Name: Twitch status smfr
Description: Affiche 2 images si twitch en ligne ou pas !
Author: Tilican
Version: 0.1
*/

define( 'SMFR_TWITCH_URL', plugin_dir_url ( __FILE__ ) );
define( 'SMFR_TWITCH_URI', plugin_dir_path( __FILE__ ) );

function pr_smfr_twitch($o){
	echo "<pre>";
	print_r($o);
	echo "</pre>";
}

function smfr_twitch_status_fnc() {

	wp_register_style(
		'smfr_god_rotation',
		SMFR_GOD_ROTATION_URL.'style.css'
	);
	wp_enqueue_style('smfr_god_rotation');

	$html = "";
	$channel = "smitefrance_tv";

	$json_file = @file_get_contents("https://api.twitch.tv/kraken/streams/{$channel}", 0, null, null);
	$json_array = json_decode($json_file, true);

//	pr_smfr_twitch($json_array);

	if (!empty($json_array['stream'])) {
		$html .= "<p><a href='stream/'><img src='".SMFR_TWITCH_URL."/img/en_ligne.jpg'></a></p>";
		//$html .= "<p>Viewers : ".$json_array['stream']['viewers']."</p>";
	}
	else {
		$html .= "<p><a href='stream/'><img src='".SMFR_TWITCH_URL."/img/hors_ligne.jpg'></a></p>";
	}

	return $html;
}

add_shortcode('smfr_twitch_status', 'smfr_twitch_status_fnc');

?>