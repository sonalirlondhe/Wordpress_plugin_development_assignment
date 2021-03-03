<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @package Wp_Book
 * @link    https://github.com/sonalirlondhe/
 * @since   1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       WP Book
 * Plugin URI:        https://learn.wpeka.com/topic/plugin-development-assignment/
 * Description:       This plugin is a wordpress plugin development assignment.
 * Version:           1.0.0
 * Author:            Sonali Londhe
 * Author URI:        https://github.com/sonalirlondhe/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-book
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC') ) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('WP_BOOK_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-book-activator.php
 */
function activate_wp_book()
{
    include_once plugin_dir_path(__FILE__) . 'includes/class-wp-book-activator.php';
    Wp_Book_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-book-deactivator.php
 */
function deactivate_wp_book()
{
    include_once plugin_dir_path(__FILE__) .
        'includes/class-wp-book-deactivator.php';
    Wp_Book_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_wp_book');
register_deactivation_hook(__FILE__, 'deactivate_wp_book');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-wp-book.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_wp_book()
{

    $plugin = new Wp_Book();
    $plugin->run();

}
run_wp_book();

/**
 * This function create a custom post type called 'Book'
 */
function render_custom_post_wp_book()
{
    $labels = array(
        'name'                  => _x(
            'Books',
            'Post type general name',
            'textdomain'
        ),
        'singular_name'         => _x(
            'Book',
            'Post type singular name',
            'textdomain'
        ),
        'menu_name'             => _x(
            'Books',
            'Admin Menu text',
            'textdomain'
        ),
        'name_admin_bar'        => _x(
            'Book',
            'Add New on Toolbar',
            'textdomain'
        ),
        'add_new'               => __(
            'Add New',
            'textdomain'
        ),
        'add_new_item'          => __(
            'Add New Book',
            'textdomain'
        ),
        'new_item'              => __(
            'New Book',
            'textdomain'
        ),
        'edit_item'             => __(
            'Edit Book',
            'textdomain'
        ),
        'view_item'             => __(
            'View Book',
            'textdomain'
        ),
        'all_items'             => __(
            'All Books',
            'textdomain'
        ),
        'search_items'          => __(
            'Search Books',
            'textdomain'
        ),
        'parent_item_colon'     => __(
            'Parent Books:',
            'textdomain'
        ),
        'not_found'             => __(
            'No books found.',
            'textdomain'
        ),
        'not_found_in_trash'    => __(
            'No books found in Trash.',
            'textdomain'
        ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'book' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'supports'           => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'comments' ),
        'menu_position'      => 5,

    );
    register_post_type('Book', $args);

}
add_action('init', 'render_custom_post_wp_book');



