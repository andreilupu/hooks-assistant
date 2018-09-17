<?php
/*
Plugin Name: Hooks Assistant
Plugin URI: http://themeisle.com
Description: A brief description of the Plugin.
Version: 1.0.0
Author: ThemeIsle
Author URI: http://themeisle.com
License: A "Slug" license name e.g. GPL2
*/

define( 'HOOKS_ASSISTANT_VERSION', '1.0.0' );

function hooks_assistant_enable_button( $wp_admin_bar ){
	$args = array(
		'id' => 'hooks-assistant',
		'title' => 'Hooks Assistant',
		'href' => 'http://example.com/',
		'meta' => array()
	);
	$wp_admin_bar->add_node($args);
}

add_action( 'admin_bar_menu', 'hooks_assistant_enable_button', 90 );

/**
 * @TODO add markup for each hook
 */
function hooks_assistant_get_hooks( $hook ) {
	global $wp_actions;
	$render = false;

	if( isset( $wp_actions[$hook] ) ) {
		?>
        <div class="ha-element">
            <div class="ha-toggle"><span><?php echo $hook; ?></span></div>
            <div class="ha-editor-wrapper">
                <div class="ha-editor">
                    <textarea></textarea>
                </div>
                <span class="ha-save-btn">Save changes</span>
            </div>
        </div>

		<?php
	}

}
add_filter( 'all', 'hooks_assistant_get_hooks' );


function hooks_assistant_enqueue_scripts() {
	wp_enqueue_style( 'hooks-assistant-style', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), HOOKS_ASSISTANT_VERSION );
	wp_enqueue_script( 'hooks-assistant-scripts', plugin_dir_url( __FILE__ ) . 'js/script.js', array( 'jquery', 'code-editor' ), HOOKS_ASSISTANT_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'hooks_assistant_enqueue_scripts' );

/**
 * @TODO: class for saving code using options
 */