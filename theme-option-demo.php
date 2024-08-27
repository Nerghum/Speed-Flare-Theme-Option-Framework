<?php
/**
 * Speed Flare Theme Option Framework
 * Demo FILE
 * Copyright (c) 2024 Nerghum
 * Email: nerghum@gmail.com
 * Website: https://nerghum.com
 *
 * This is a lightweight and fast WordPress custom theme admin panel framework.
 * It is so lite you don't have to use any third-party heavy plugins that make your theme load slow.
 */

// Ensure this file is included only once to prevent multiple instantiations
if (!class_exists('Theme_Options_Framework')) {
    require_once get_template_directory() . '/path-to/theme-options-framework.php'; // Adjust the path as needed
}

// Instantiate the Theme Options Framework class
$theme_options = new Theme_Options_Framework();

// Define a function to register menus and fields
function register_single_menu_fields($theme_options) {
    // Register 'General Settings' menu
    $theme_options->register_theme_menu('General Settings');

    // Add fields to 'General Settings' menu

    // Image Upload Field
    $theme_options->add_theme_field('General Settings', [
        'name' => 'Site Logo',
        'type' => 'image', // Field type: image upload
        'id'   => 'theme_option_site_logo',
        'default' => '' // Default value (empty string for no default image)
    ]);

    // Text Field
    $theme_options->add_theme_field('General Settings', [
        'name' => 'Site Title',
        'type' => 'text', // Field type: single-line text input
        'id'   => 'theme_option_site_title',
        'default' => 'My Awesome Site' // Default value for the text field
    ]);

    // Color Picker Field
    $theme_options->add_theme_field('General Settings', [
        'name' => 'Primary Color',
        'type' => 'color', // Field type: color picker
        'id'   => 'theme_option_primary_color',
        'default' => '#0073aa' // Default value (a shade of blue)
    ]);

    // True/False Toggle Field
    $theme_options->add_theme_field('General Settings', [
        'name' => 'Enable Feature',
        'type' => 'true/false', // Field type: toggle switch (true/false)
        'id'   => 'theme_option_enable_feature',
        'default' => 0 // Default value (0 for false, 1 for true)
    ]);

    // Dropdown Field
    $theme_options->add_theme_field('General Settings', [
        'name' => 'Font Selection',
        'type' => 'dropdown', // Field type: dropdown menu
        'id'   => 'theme_option_font_selection',
        'options' => [
            'Arial' => 'Arial',
            'Helvetica' => 'Helvetica',
            'Georgia' => 'Georgia',
            'Times New Roman' => 'Times New Roman',
            'Courier New' => 'Courier New',
        ],
        'default' => 'Arial' // Default value (Arial font)
    ]);

    // Textarea Field
    $theme_options->add_theme_field('General Settings', [
        'name' => 'Custom CSS',
        'type' => 'textarea', // Field type: multi-line text input
        'id'   => 'theme_option_custom_css',
        'default' => '' // Default value (empty string for no default CSS)
    ]);

    // Checkbox Field
    $theme_options->add_theme_field('General Settings', [
        'name' => 'Enable Custom Scripts',
        'type' => 'checkbox', // Field type: checkbox (true/false)
        'id'   => 'theme_option_enable_custom_scripts',
        'default' => '0' // Default value (0 for unchecked, 1 for checked)
    ]);

    // Radio Buttons Field
    $theme_options->add_theme_field('General Settings', [
        'name' => 'Header Layout',
        'type' => 'radio', // Field type: radio buttons (single selection from multiple options)
        'id'   => 'theme_option_header_layout',
        'options' => [
            'default' => 'Default',
            'centered' => 'Centered',
            'split' => 'Split'
        ],
        'default' => 'default' // Default value (Default layout)
    ]);

    // URL Field
    $theme_options->add_theme_field('General Settings', [
        'name' => 'Website URL',
        'type' => 'url', // Field type: URL input
        'id'   => 'theme_option_website_url',
        'default' => 'https://google.com' // Default value (empty string for no default URL)
    ]);

    // Email Field
    $theme_options->add_theme_field('General Settings', [
        'name' => 'Admin Email',
        'type' => 'email', // Field type: email input
        'id'   => 'theme_option_admin_email',
        'default' => '' // Default value (empty string for no default email)
    ]);
}

// Call the function to register the menu and fields
register_single_menu_fields($theme_options);

?>
