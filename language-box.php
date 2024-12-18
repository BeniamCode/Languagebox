<?php
/*
Plugin Name: Language Box
Description: A simple plugin to display language boxes on your WordPress site.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Language_Box_Plugin {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_shortcode('language_box', array($this, 'render_language_box'));
    }

    public function add_admin_menu() {
        add_menu_page(
            'Language Box',
            'Language Box',
            'manage_options',
            'language-box-admin',
            array($this, 'admin_page'),
            'dashicons-translation',
            6
        );
    }

    public function admin_page() {
        require_once plugin_dir_path(__FILE__) . 'admin/index.php';
    }

    public function enqueue_scripts() {
        wp_enqueue_style('language-box-style', plugins_url('/css/style.css', __FILE__));
        wp_enqueue_script('language-box-script', plugins_url('/js/script.js', __FILE__), array('wp-element'), null, true);
    }

    public function render_language_box($atts) {
        $atts = shortcode_atts(array(
            'language' => 'en',
            'content'  => 'Hello World!'
        ), $atts);

        return '<div id="language-box-app" data-language="' . esc_attr($atts['language']) . '" data-content="' . esc_attr($atts['content']) . '"></div>';
    }
}

new Language_Box_Plugin();
