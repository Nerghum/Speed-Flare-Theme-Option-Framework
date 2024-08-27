<?php
/**
 * Speed Flare Theme Option Framework
 * 
 * Copyright (c) 2024 Nerghum
 * Email: nerghum@gmail.com
 * Website: https://nerghum.com
 *
 * This is a lightweight and fast WordPress custom theme admin panel framework.
 * It is so lite you don't have to use any third-party heavy plugins that make your theme load slow.
 */
if (!class_exists('Theme_Options_Framework')) {
    /**
     * Theme Options Framework class
     */
    class Theme_Options_Framework
    {
        private $menus = []; // Stores menu configurations and fields

        /**
         * Constructor: Hooks actions for the admin menu and scripts
         */
        public function __construct()
        {
            add_action('admin_menu', [$this, 'add_admin_menu']);
            add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
            add_action('wp_ajax_save_theme_options', [$this, 'save_theme_options']);
            add_action('admin_post_export_theme_options', [$this, 'export_theme_options']);
            add_action('admin_post_import_theme_options', [$this, 'import_theme_options']);
        }

        /**
         * Exports theme options as a JSON file
         */
        public function export_theme_options()
        {
            // Verify nonce for security
            check_admin_referer('export_theme_options_nonce');
            
            // Prepare options for export
            $options = [];
            foreach ($this->menus as $menu_name => $fields) {
                foreach ($fields as $field) {
                    $options[$field['id']] = get_option($field['id'], $field['default'] ?? '');
                }
            }

            // Output JSON file
            $json = json_encode($options, JSON_PRETTY_PRINT);
            header('Content-disposition: attachment; filename=theme-options.json');
            header('Content-type: application/json');
            echo $json;
            exit;
        }

        /**
         * Imports theme options from a JSON file
         */
        public function import_theme_options()
        {
            // Verify nonce for security
            check_admin_referer('import_theme_options_nonce');
            
            if (!isset($_FILES['import_file']) || $_FILES['import_file']['error'] !== UPLOAD_ERR_OK) {
                wp_redirect(add_query_arg('import', 'error', admin_url('admin.php?page=theme-options')));
                exit;
            }

            $file = $_FILES['import_file'];
            $json = file_get_contents($file['tmp_name']);
            $options = json_decode($json, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                foreach ($options as $key => $value) {
                    update_option($key, $value);
                }
                wp_redirect(add_query_arg('import', 'success', admin_url('admin.php?page=theme-options')));
            } else {
                wp_redirect(add_query_arg('import', 'error', admin_url('admin.php?page=theme-options')));
            }

            exit;
        }

        /**
         * Adds admin menu page for theme options
         */
        public function add_admin_menu()
        {
            add_menu_page(
                'Theme Options',              // Page title
                'Theme Options',              // Menu title
                'manage_options',             // Capability required
                'theme-options',              // Menu slug
                [$this, 'render_admin_page'], // Function to display the page
                'dashicons-admin-generic',    // Icon
                60                            // Position
            );
        }

        /**
         * Enqueues admin styles and scripts
         */
        public function enqueue_scripts()
        {
            wp_enqueue_style('theme-options-framework-css', get_template_directory_uri() . '/admin/theme-options-framework.css');
            wp_enqueue_script('theme-options-framework-js', get_template_directory_uri() . '/admin/theme-options-framework.js', ['jquery', 'media-views'], false, true);
            
            // Enqueue media library scripts
            wp_enqueue_media();
            
            wp_localize_script('theme-options-framework-js', 'ajax_object', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce'    => wp_create_nonce('save_theme_options_nonce')
            ]);
        }

        /**
         * Registers a new theme options menu
         *
         * @param string $menu_name The name of the menu
         */
        public function register_theme_menu($menu_name)
        {
            $this->menus[$menu_name] = [];
        }

        /**
         * Adds a new field to a specific theme options menu
         *
         * @param string $menu_name The name of the menu
         * @param array  $field     The field configuration
         */
        public function add_theme_field($menu_name, $field)
        {
            if (isset($this->menus[$menu_name])) {
                $this->menus[$menu_name][] = $field;
            }
        }

        /**
         * Sanitizes a menu name to be used as an HTML ID or class
         *
         * @param string $name The menu name
         * @return string Sanitized menu name
         */
        public function sanitize_menu_name($name)
        {
            $name = strtolower($name);
            $name = str_replace(' ', '-', $name);
            return $name;
        }

        /**
         * Renders the admin page for theme options
         */
        public function render_admin_page()
        {
            echo '<div class="wrap">';
            echo '<h1>Speed Flare Theme Option</h1>';
            echo '<div id="sf-theme-options-framework">';
            echo '<div class="sf-vertical-menu">';
            
            // Render menu items
            foreach ($this->menus as $menu_name => $fields) {
                echo '<a href="#" class="sf-menu-item" data-menu="' . $this->sanitize_menu_name($menu_name) . '">' . esc_html($menu_name) . '</a>';
            }
            
            // Add Import/Export menu
            echo '<a href="#" class="sf-menu-item" data-menu="import-export">Import/Export</a>';
            echo '</div>';
            echo '<div class="sf-menu-content"><form id="theme-option-setting" action="#">';
            
            // Render menu sections and fields
            foreach ($this->menus as $menu_name => $fields) {
                echo '<div class="sf-menu-section" id="section-' . $this->sanitize_menu_name($menu_name) . '">';
                foreach ($fields as $field) {
                    $this->render_field($field);
                }
                echo '</div>';
            }

            // Add Import/Export content
            echo '</form><div class="sf-menu-section" id="section-import-export">';
            echo '<h2>Import/Export</h2>';
            if (isset($_GET['import'])) {
                if ($_GET['import'] === 'success') {
                    echo '<div class="notice notice-success is-dismissible"><p>Options imported successfully.</p></div>';
                } elseif ($_GET['import'] === 'error') {
                    echo '<div class="notice notice-error is-dismissible"><p>There was an error importing options. Please check the file format.</p></div>';
                }
            }
            echo '<form id="export-form" method="post" action="' . esc_url(admin_url('admin-post.php')) . '">';
            echo '<input type="hidden" name="action" value="export_theme_options">';
            wp_nonce_field('export_theme_options_nonce');
            echo '<button type="submit" class="button button-secondary">Export Theme Options</button>';
            echo '</form>';
            echo '<form id="import-form" method="post" enctype="multipart/form-data" action="' . esc_url(admin_url('admin-post.php')) . '">';
            echo '<input type="hidden" name="action" value="import_theme_options">';
            wp_nonce_field('import_theme_options_nonce');
            echo '<input type="file" name="import_file" />';
            echo '<button type="submit" class="button button-primary">Import Theme Options</button>';
            echo '</form>';
            echo '</div>';
            echo '<button id="sf-save-options" class="button button-primary">Save</button>';
            echo '</div>';
            echo '</div><p style="text-align:right;">Developed By <a href="https://nerghum.com">nerghum</a>. For support - <a href="mailto:nerghum@gmail.com">Contact Here</a></p>';
        }

        /**
         * Renders a specific field based on its type
         *
         * @param array $field Field configuration
         */
        public function render_field($field)
        {
            // Get the value from options or use default value
            $value = (get_option($field['id']) != null) ? get_option($field['id']) : $field['default'] ;


            echo '<div class="form-group">';
            echo '<label for="' . esc_attr($field['id']) . '">' . esc_html($field['name']) . '</label>';
            
            switch ($field['type']) {
                case 'text':
                    echo '<input type="text" id="' . esc_attr($field['id']) . '" name="' . esc_attr($field['id']) . '" value="' . esc_attr($value) . '">';
                    break;
                case 'checkbox':
                    echo '<input type="checkbox" id="' . esc_attr($field['id']) . '" name="' . esc_attr($field['id']) . '" ' . (($value == 1) ? 'checked' : '') . ' value="' . esc_attr($value) . '">';
                    break;
                case 'image':
                    echo '<input type="hidden" id="' . esc_attr($field['id']) . '" name="' . esc_attr($field['id']) . '" value="' . esc_attr($value) . '">';
                    echo '<button type="button" class="button upload-image-button">Upload Image</button>';
                    if ($value) {
                        echo '<img src="' . wp_get_attachment_url($value) . '" style="max-width: 100px; display: block; margin-top: 10px;">';
                    }
                    break;
                case 'true/false':
                    echo '<label class="sf_switch"><input name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" type="checkbox" ' . (($value == 1) ? 'checked' : '') . '><span class="sf_slider"></span></label>';
                    break;
                case 'textarea':
                    echo '<textarea name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" rows="8" cols="50">' . esc_textarea($value) . '</textarea>';
                    break;
                case 'dropdown':
                case 'select':
                    if (!empty($field['options']) && is_array($field['options'])) {
                        echo '<select name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '">';
                        foreach ($field['options'] as $key => $label) {
                            echo '<option value="' . esc_attr($key) . '"' . selected($value, $key, false) . '>' . esc_html($label) . '</option>';
                        }
                        echo '</select>';
                    }
                    break;
                default:
                    echo '<input type="'.$field['type'].'" id="' . esc_attr($field['id']) . '" name="' . esc_attr($field['id']) . '" value="' . esc_attr($value) . '">';
                    break;
            }
            echo '</div>';
        }

        /**
         * Handles saving of theme options via AJAX
         */
        public function save_theme_options()
        {
            check_ajax_referer('save_theme_options_nonce', 'nonce');

            foreach ($_POST as $key => $value) {
                if (strpos($key, 'image') !== false) {
                    // Save image ID
                    update_option($key, intval($value));
                } else {
                    update_option($key, sanitize_text_field($value));
                }
            }

            wp_send_json_success('Options saved successfully.');
        }
    }
}
