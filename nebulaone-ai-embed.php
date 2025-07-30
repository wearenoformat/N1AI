<?php
/*
Plugin Name: NebulaOne AI Embed
Plugin URI: https://noformat.com/nebulaone-ai-plugin
Description: A chat interface for NebulaOne AI, seamlessly integrated into your WordPress site.
Version: 1.0.1
Author: Noformat
Author URI: https://noformat.com
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: nebulaone-ai
Domain Path: /languages

Update URI: https://raw.githubusercontent.com/wearenoformat/N1AI/main/update.json
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-nebulaone-ai.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is initiated from this class,
 * calling it here will activate the plugin.
 */
function run_nebulaone_ai() {
    $plugin = new NebulaOne_AI();
    $plugin->run();
}
run_nebulaone_ai();

/**
 * GitHub Plugin Updater.
 * This class handles checking for updates to the plugin on GitHub.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-nebulaone-ai-updater.php';

// Initialize the plugin updater
add_action( 'init', 'nebulaone_ai_init_updater' );
function nebulaone_ai_init_updater() {
    // For a public repo, no PAT is strictly required for release info.
    // If you experience rate limiting on downloads or need more robust access,
    // you could reintroduce it, but it's not essential for public repos.
    $github_pat = ''; // No PAT needed for public repo access
    $branch_to_monitor = 'plugin-refactoring'; // Specify the branch for testing

    new NebulaOne_AI_Updater( __FILE__, 'wearenoformat', 'N1AI', $github_pat, $branch_to_monitor );
}