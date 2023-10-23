<?php
/*
Plugin Name: Generic Plugin_ plugin
Description: Site specific code changes for my website
Plugin URI: 
Version: 1.4
Text Domain: generic-plugin
*/

// Start Adding Functions Below this Line

// Function to remove website field from comments form
function generic_plugin__website_remove_from_comments($fields) {
    // Check if 'url' key exists
    if (isset($fields['url'])) {
        // Remove 'url' field from array
        unset($fields['url']);
    }
    // Return modified fields
    return $fields;
}

// Function to register a new custom post type
function generic_plugin_register_custom_post_type($slug, $name, $singular_name) {
    // Register new post type
    register_post_type($name,
        array(
            'labels' => array(
                'name' => __($name, 'generic-plugin'),
                'singular_name' => __($singular_name, 'generic-plugin')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => $slug),
            'show_in_rest' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'comments', 'author'),
        )
    );
}

// Function to create 'Profile' custom post type
function generic_plugin__create_profiletype() {
    generic_plugin__register_custom_post_type('profiles', 'Profiles', 'Profile');
}

// Function to create 'DataPosts' custom post type
function generic_plugin__create_dataposttype() {
    generic_plugin__register_custom_post_type('data', 'DataPosts', 'DataPost');
}

// Function to create 'Biography' custom post type
function generic_plugin__create_biographytype() {
    generic_plugin__register_custom_post_type('biographies', 'Biographies', 'Biography');
}

// Hook functions to WordPress 'init' action
add_action('init', 'generic_plugin__create_profiletype');
add_action('init', 'generic_plugin__create_dataposttype');
add_action('init', 'generic_plugin__create_biographytype');

// Hook to modify comment form fields
add_filter('comment_form_default_fields', 'generic_plugin__website_remove_from_comments');

// Stop Adding Functions Below this Line
?>
