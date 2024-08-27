<?php
/**
 * Speed Flare Theme Option Framework
 * Demo With All option
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
function register_menus_and_fields($theme_options) {
    // Register 'General Settings' menu
    $theme_options->register_theme_menu('General Settings');

    // Add fields to 'General Settings' menu
    $theme_options->add_theme_field('General Settings', [
        'name' => 'Site Logo',
        'type' => 'image', // Field type: image upload
        'id'   => 'theme_option_site_logo',
        'default' => '' // Default value (empty string for no default image)
    ]);

    $theme_options->add_theme_field('General Settings', [
        'name' => 'Site Title',
        'type' => 'text', // Field type: single-line text input
        'id'   => 'theme_option_site_title',
        'default' => 'My Awesome Site' // Default value for the text field
    ]);

    $theme_options->add_theme_field('General Settings', [
        'name' => 'Site Tagline',
        'type' => 'text', // Field type: single-line text input
        'id'   => 'theme_option_site_tagline',
        'default' => 'Just another WordPress site' // Default value for the text field
    ]);

    $theme_options->add_theme_field('General Settings', [
        'name' => 'Favicon',
        'type' => 'image', // Field type: image upload
        'id'   => 'theme_option_favicon',
        'default' => '' // Default value (empty string for no default favicon)
    ]);

    $theme_options->add_theme_field('General Settings', [
        'name' => 'Header Background Color',
        'type' => 'color', // Field type: color picker
        'id'   => 'theme_option_header_bg_color',
        'default' => '#ffffff' // Default value (white color)
    ]);

    $theme_options->add_theme_field('General Settings', [
        'name' => 'Full width',
        'type' => 'true/false', // Field type: toggle switch (true/false)
        'id'   => 'theme_option_header_full_width',
        'default' => 0 // Default value (0 for false, 1 for true)
    ]);

    $theme_options->add_theme_field('General Settings', [
        'name' => 'Primary Color',
        'type' => 'color', // Field type: color picker
        'id'   => 'theme_option_primary_color',
        'default' => '#0073aa' // Default value (a shade of blue)
    ]);

    $theme_options->add_theme_field('General Settings', [
        'name' => 'Secondary Color',
        'type' => 'color', // Field type: color picker
        'id'   => 'theme_option_secondary_color',
        'default' => '#333333' // Default value (dark gray)
    ]);

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

    // Register 'Advanced Settings' menu
    $theme_options->register_theme_menu('Advanced Settings');

    // Add fields to 'Advanced Settings' menu
    $theme_options->add_theme_field('Advanced Settings', [
        'name' => 'Custom CSS',
        'type' => 'textarea', // Field type: multi-line text input
        'id'   => 'theme_option_custom_css',
        'default' => '' // Default value (empty string for no default CSS)
    ]);

    $theme_options->add_theme_field('Advanced Settings', [
        'name' => 'Custom JavaScript',
        'type' => 'textarea', // Field type: multi-line text input
        'id'   => 'theme_option_custom_js',
        'default' => '' // Default value (empty string for no default JavaScript)
    ]);

    $theme_options->add_theme_field('Advanced Settings', [
        'name' => 'Enable Site-wide Analytics',
        'type' => 'checkbox', // Field type: checkbox (true/false)
        'id'   => 'theme_option_enable_analytics',
        'default' => '0' // Default value (0 for unchecked, 1 for checked)
    ]);

    $theme_options->add_theme_field('Advanced Settings', [
        'name' => 'Custom Header Scripts',
        'type' => 'textarea', // Field type: multi-line text input
        'id'   => 'theme_option_custom_header_scripts',
        'default' => '' // Default value (empty string for no default header scripts)
    ]);

    $theme_options->add_theme_field('Advanced Settings', [
        'name' => 'Custom Footer Scripts',
        'type' => 'textarea', // Field type: multi-line text input
        'id'   => 'theme_option_custom_footer_scripts',
        'default' => '' // Default value (empty string for no default footer scripts)
    ]);

    $theme_options->add_theme_field('Advanced Settings', [
        'name' => 'Enable Maintenance Mode',
        'type' => 'checkbox', // Field type: checkbox (true/false)
        'id'   => 'theme_option_enable_maintenance_mode',
        'default' => '0' // Default value (0 for unchecked, 1 for checked)
    ]);

    $theme_options->add_theme_field('Advanced Settings', [
        'name' => 'Admin Email',
        'type' => 'email', // Field type: email input
        'id'   => 'theme_option_admin_email',
        'default' => '' // Default value (empty string for no default email)
    ]);

    // Register 'Social Settings' menu
    $theme_options->register_theme_menu('Social Settings');

    // Add fields to 'Social Settings' menu
    $theme_options->add_theme_field('Social Settings', [
        'name' => 'Facebook',
        'type' => 'url', // Field type: URL input
        'id'   => 'theme_option_social_facebook',
        'default' => '' // Default value (empty string for no default URL)
    ]);

    $theme_options->add_theme_field('Social Settings', [
        'name' => 'Twitter',
        'type' => 'url', // Field type: URL input
        'id'   => 'theme_option_social_twitter',
        'default' => '' // Default value (empty string for no default URL)
    ]);

    $theme_options->add_theme_field('Social Settings', [
        'name' => 'Instagram',
        'type' => 'url', // Field type: URL input
        'id'   => 'theme_option_social_instagram',
        'default' => '' // Default value (empty string for no default URL)
    ]);

    $theme_options->add_theme_field('Social Settings', [
        'name' => 'LinkedIn',
        'type' => 'url', // Field type: URL input
        'id'   => 'theme_option_social_linkedin',
        'default' => '' // Default value (empty string for no default URL)
    ]);

    $theme_options->add_theme_field('Social Settings', [
        'name' => 'YouTube',
        'type' => 'url', // Field type: URL input
        'id'   => 'theme_option_social_youtube',
        'default' => '' // Default value (empty string for no default URL)
    ]);

    $theme_options->add_theme_field('Social Settings', [
        'name' => 'Pinterest',
        'type' => 'url', // Field type: URL input
        'id'   => 'theme_option_social_pinterest',
        'default' => '' // Default value (empty string for no default URL)
    ]);

    $theme_options->add_theme_field('Social Settings', [
        'name' => 'Snapchat',
        'type' => 'url', // Field type: URL input
        'id'   => 'theme_option_social_snapchat',
        'default' => '' // Default value (empty string for no default URL)
    ]);

    $theme_options->add_theme_field('Social Settings', [
        'name' => 'TikTok',
        'type' => 'url', // Field type: URL input
        'id'   => 'theme_option_social_tiktok',
        'default' => '' // Default value (empty string for no default URL)
    ]);

    // Register 'Footer Settings' menu
    $theme_options->register_theme_menu('Footer Settings');

    // Add fields to 'Footer Settings' menu
    $theme_options->add_theme_field('Footer Settings', [
        'name' => 'Footer Text',
        'type' => 'textarea', // Field type: multi-line text input
        'id'   => 'theme_option_footer_text',
        'default' => 'Default Footer Text' // Default value for the footer text field
    ]);

    $theme_options->add_theme_field('Footer Settings', [
        'name' => 'Footer Logo',
        'type' => 'image', // Field type: image upload
        'id'   => 'theme_option_footer_logo',
        'default' => '' // Default value (empty string for no default image)
    ]);

    $theme_options->add_theme_field('Footer Settings', [
        'name' => 'Footer Background Color',
        'type' => 'color', // Field type: color picker
        'id'   => 'theme_option_footer_bg_color',
        'default' => '#ffffff' // Default value (white color)
    ]);

    $theme_options->add_theme_field('Footer Settings', [
        'name' => 'Footer Widgets Enabled',
        'type' => 'checkbox', // Field type: checkbox (true/false)
        'id'   => 'theme_option_footer_widgets_enabled',
        'default' => '1' // Default value (1 for checked, 0 for unchecked)
    ]);

    // Register 'Header Settings' menu
    $theme_options->register_theme_menu('Header Settings');

    // Add fields to 'Header Settings' menu
    $theme_options->add_theme_field('Header Settings', [
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

    $theme_options->add_theme_field('Header Settings', [
        'name' => 'Header Image',
        'type' => 'image', // Field type: image upload
        'id'   => 'theme_option_header_image',
        'default' => '' // Default value (empty string for no default image)
    ]);

    $theme_options->add_theme_field('Header Settings', [
        'name' => 'Sticky Header',
        'type' => 'checkbox', // Field type: checkbox (true/false)
        'id'   => 'theme_option_sticky_header',
        'default' => '0' // Default value (0 for unchecked, 1 for checked)
    ]);

    $theme_options->add_theme_field('Header Settings', [
        'name' => 'Header Padding',
        'type' => 'text', // Field type: single-line text input
        'id'   => 'theme_option_header_padding',
        'default' => '10px' // Default value (padding size)
    ]);

    // Register 'Typography Settings' menu
    $theme_options->register_theme_menu('Typography Settings');

    // Add fields to 'Typography Settings' menu
    $theme_options->add_theme_field('Typography Settings', [
        'name' => 'Body Font',
        'type' => 'dropdown', // Field type: dropdown menu
        'id'   => 'theme_option_body_font',
        'options' => [
            'Arial' => 'Arial',
            'Helvetica' => 'Helvetica',
            'Georgia' => 'Georgia',
            'Times New Roman' => 'Times New Roman',
            'Courier New' => 'Courier New',
        ],
        'default' => 'Arial' // Default value (Arial font)
    ]);

    $theme_options->add_theme_field('Typography Settings', [
        'name' => 'Heading Font',
        'type' => 'dropdown', // Field type: dropdown menu
        'id'   => 'theme_option_heading_font',
        'options' => [
            'Arial' => 'Arial',
            'Helvetica' => 'Helvetica',
            'Georgia' => 'Georgia',
            'Times New Roman' => 'Times New Roman',
            'Courier New' => 'Courier New',
        ],
        'default' => 'Arial' // Default value (Arial font)
    ]);

    $theme_options->add_theme_field('Typography Settings', [
        'name' => 'Font Size',
        'type' => 'text', // Field type: single-line text input
        'id'   => 'theme_option_font_size',
        'default' => '16px' // Default value (font size in pixels)
    ]);

    // Register 'Custom Scripts' menu
    $theme_options->register_theme_menu('Custom Scripts');

    // Add fields to 'Custom Scripts' menu
    $theme_options->add_theme_field('Custom Scripts', [
        'name' => 'Header Custom Script',
        'type' => 'textarea', // Field type: multi-line text input
        'id'   => 'theme_option_header_custom_script',
        'default' => '' // Default value (empty string for no default script)
    ]);

    $theme_options->add_theme_field('Custom Scripts', [
        'name' => 'Footer Custom Script',
        'type' => 'textarea', // Field type: multi-line text input
        'id'   => 'theme_option_footer_custom_script',
        'default' => '' // Default value (empty string for no default script)
    ]);
}

// Call the function to register menus and fields
register_menus_and_fields($theme_options);

?>
