<?php
/**
 * Plugin Name: nebulaONE AI Embed Plugin
 * Description: A plugin to embed a nebulaONE AI instance in your WordPress site.
 * Version: 1.1
 * Author: Cloudforce
 * Text Domain: nebulaone-embed
 * Domain Path: /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-nebulaone-activator.php';
require plugin_dir_path( __FILE__ ) . 'admin/class-nebulaone-admin.php';
require plugin_dir_path( __FILE__ ) . 'public/class-nebulaone-public.php';

/**
 * Register activation hook.
 * This will run once when the plugin is activated.
 */
function activate_nebulaone_embed_plugin() {
    NebulaOne_Activator::activate();
}
register_activation_hook( __FILE__, 'activate_nebulaone_embed_plugin' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then this is all that is needed to be called to kick off the plugin.
 */
function run_nebulaone_embed_plugin() {
    // These lines are causing the error because NebulaOne_Admin and NebulaOne_Public
    // do not have a 'run()' method. Their constructors handle all necessary hooks.
    $plugin_admin = new NebulaOne_Admin();
    // $plugin_admin->run(); // REMOVE OR COMMENT OUT THIS LINE

    $plugin_public = new NebulaOne_Public();
    // $plugin_public->run(); // REMOVE OR COMMENT OUT THIS LINE
}
run_nebulaone_embed_plugin();

// Add a settings link in the plugin list page.
function nebulaone_embed_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=nebulaone-embed-settings">' . esc_html__( 'Settings', 'nebulaone-embed' ) . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'nebulaone_embed_settings_link' );