<?php


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


/*
Plugin Name: OXSN Search Modal
Plugin URI: https://wordpress.org/plugins/oxsn-search-modal/
Description: This plugin adds helpful search modal shortcodes with quicktags!
Author: oxsn
Author URI: https://oxsn.com/
Version: 0.0.4
*/


define( 'oxsn_search_modal_plugin_basename', plugin_basename( __FILE__ ) );
define( 'oxsn_search_modal_plugin_dir_path', plugin_dir_path( __FILE__ ) );
define( 'oxsn_search_modal_plugin_dir_url', plugin_dir_url( __FILE__ ) );

if ( ! function_exists ( 'oxsn_search_modal_settings_link' ) ) {

	add_filter( 'plugin_action_links', 'oxsn_search_modal_settings_link', 10, 2 );
	function oxsn_search_modal_settings_link( $links, $file ) {

		if ( $file != oxsn_search_modal_plugin_basename )
		return $links;
		$settings_page = '<a href="' . menu_page_url( 'oxsn-search-modal', false ) . '">' . esc_html( __( 'Settings', 'oxsn-search-modal' ) ) . '</a>';
		array_unshift( $links, $settings_page );
		return $links;

	}

}


?><?php


/* OXSN Dashboard Tab */

if ( !function_exists('oxsn_dashboard_tab_nav_item') ) {

	add_action('admin_menu', 'oxsn_dashboard_tab_nav_item');
	function oxsn_dashboard_tab_nav_item() {

		add_menu_page('OXSN', 'OXSN', 'manage_options', 'oxsn-dashboard', 'oxsn_dashboard_tab' );

	}

}

if ( !function_exists('oxsn_dashboard_tab') ) {

	function oxsn_dashboard_tab() {

		if (!current_user_can('manage_options')) {

			wp_die( __('You do not have sufficient permissions to access this page.') );

		}

	?>

		<?php if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y') : ?>

			<div id="message" class="updated">

				<p><strong><?php _e('Settings saved.') ?></strong></p>

			</div>

		<?php endif; ?>
		
		<div class="wrap">
		
			<h2>OXSN / Digital Agency</h2>

			<div id="poststuff">

				<div id="post-body" class="metabox-holder columns-2">

					<div id="post-body-content" style="position: relative;">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Information</h3>

							<div class="inside">

								<p></p>

							</div>
							
						</div>

					</div>

					<div id="postbox-container-1" class="postbox-container">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Coming Soon</h3>

							<div class="inside">

								<p></p>

							</div>
							
						</div>

					</div>

				</div>

			</div>

		</div>

	<?php 

	}

}


?><?php


/* OXSN Plugin Tab */

if ( ! function_exists ( 'oxsn_search_modal_plugin_tab_nav_item' ) ) {

	add_action('admin_menu', 'oxsn_search_modal_plugin_tab_nav_item', 99);
	function oxsn_search_modal_plugin_tab_nav_item() {

		add_submenu_page('oxsn-dashboard', 'OXSN Search Modal', 'Search Modal', 'manage_options', 'oxsn-search-modal', 'oxsn_search_modal_plugin_tab');

	}

}

if ( !function_exists('oxsn_search_modal_plugin_tab') ) {

	function oxsn_search_modal_plugin_tab() {

		if (!current_user_can('manage_options')) {

			wp_die( __('You do not have sufficient permissions to access this page.') );

		}

	?>

		<?php if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y') : ?>

			<div id="message" class="updated">

				<p><strong><?php _e('Settings saved.') ?></strong></p>

			</div>

		<?php endif; ?>
		
		<div class="wrap oxsn_settings_page">
		
			<h2>OXSN / Search Modal Plugin</h2>

			<div id="poststuff">

				<div id="post-body" class="metabox-holder columns-2">

					<div id="post-body-content" style="position: relative;">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Information</h3>

							<div class="inside">

								<p>Coming soon.</p>

							</div>
							
						</div>

					</div>

					<div id="postbox-container-1" class="postbox-container">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Custom Project</h3>

							<div class="inside">

								<p>Want us to build you a custom project?</p>

								<p><a href="mailto:brief@oxsn.com?Subject=Custom%20Project%20Request%21&Body=Please%20answer%20the%20following%20questions%20to%20help%20us%20better%20understand%20your%20needs..%0A%0A1.%20What%20is%20the%20name%20of%20your%20company%3F%0A%0A2.%20What%20are%20the%20concepts%20and%20goals%20of%20your%20project%3F%0A%0A3.%20What%20is%20the%20proposed%20budget%20of%20this%20project%3F" class="button button-primary button-large">Email Us</a></p>

							</div>
							
						</div>

						<div class="postbox">

							<h3 class="hndle cursor_initial">Support</h3>

							<div class="inside">

								<p>Need help with this plugin? Visit the Wordpress plugin page for support..</p>

								<p><a href="https://wordpress.org/support/plugin/oxsn-search-modal" target="_blank" class="button button-primary button-large">Support</a></p>

							</div>
							
						</div>

					</div>

				</div>

			</div>

		</div>

	<?php 

	}

}


?><?php


/* OXSN Shortcodes */

//[oxsn_search_modal class=""]
if ( ! function_exists ( 'oxsn_search_modal_shortcode' ) ) {

	add_shortcode('oxsn_search_modal', 'oxsn_search_modal_shortcode');
	function oxsn_search_modal_shortcode( $atts, $content = null ) {
		$a = shortcode_atts( array(
			'class' => '',
			'id' => '',
		), $atts );

		$oxsn_search_modal_class = esc_attr($a['class']);
		if ($oxsn_search_modal_class != '') :

			$oxsn_search_modal_class = ' class="oxsn_search_modal oxsn_search_modal_toggle_in ' . $oxsn_search_modal_class . '" ';

		else : 

			$oxsn_search_modal_class = ' class="oxsn_search_modal" ';

		endif;

		$oxsn_search_modal_id = esc_attr($a['id']);
		if ($oxsn_search_modal_id != '') :

			$oxsn_search_modal_id = ' id="' . $oxsn_search_modal_id . '" ';

		endif;

		return '<div ' . $oxsn_search_modal_id . ' ' . $oxsn_search_modal_class . ' >' . do_shortcode($content) . '</div>';

	}

}


?><?php


/* OXSN Quicktags */

if ( ! function_exists ( 'oxsn_search_modal_quicktags' ) ) {

	add_action( 'admin_print_footer_scripts', 'oxsn_search_modal_quicktags' );
	function oxsn_search_modal_quicktags() {

		if ( wp_script_is( 'quicktags' ) ) {

		?>

			<script type="text/javascript">

				QTags.addButton( 'oxsn_search_modal_quicktag', '[oxsn_search_modal]', '[oxsn_search_modal class=""]', '[/oxsn_search_modal]', 'oxsn_search_modal', 'Quicktags SEARCH MODAL', 301 );

			</script>

		<?php

		}

	}

}


?><?php


/* OXSN Include CSS */

if ( ! function_exists ( 'oxsn_search_modal_inc_css' ) ) {

	add_action( 'wp_enqueue_scripts', 'oxsn_search_modal_inc_css' );
	function oxsn_search_modal_inc_css() {

		wp_enqueue_style( 'oxsn_search_modal_css', oxsn_search_modal_plugin_dir_url . 'inc/css/search_modal.css', array(), '1.0.0', 'all' ); 

	}

}


?><?php


/* OXSN Include JS */

if ( ! function_exists ( 'oxsn_search_modal_inc_js' ) ) {

	add_action( 'wp_enqueue_scripts', 'oxsn_search_modal_inc_js' );
	function oxsn_search_modal_inc_js() {

		wp_enqueue_script( 'oxsn_search_modal_js', oxsn_search_modal_plugin_dir_url . 'inc/js/search_modal.js', array(), '1.0.0', 'all' ); 

	}

}


?><?php


/* OXSN Include in Footer */

if ( ! function_exists ( 'oxsn_search_modal_footer_inc' ) ) {

	add_action( 'wp_footer', 'oxsn_search_modal_footer_inc');
	function oxsn_search_modal_footer_inc() { 

		$oxsn_search_modal_return =
			'<div class="oxsn_search_modal">' .
				'<div class="oxsn_search_modal_table">' .
					'<div class="oxsn_search_modal_table_cell">' .
						'<form method="get" action="' . esc_url( home_url( '/' ) ) . '" class="oxsn_search_modal_search_form">' .
							'<div class="oxsn_search_modal_search_form_input_group">' .
								'<input type="text" name="s" placeholder="Search" value="" />' .
								'<span class="oxsn_search_modal_search_form_input_group_btn">' .
									'<button class="oxsn_search_modal_search_form_btn" type="submit"><i class="oxsn_search_modal_search_form_search_icon"></i></button>' .
								'</span>' .
							'</div>' .
						'</form>' .
						'<div class="oxsn_search_modal_toggle_out">x</div>' .
					'</div>' .
				'</div>' .
			'</div>';

		echo $oxsn_search_modal_return;

	}

}


?>