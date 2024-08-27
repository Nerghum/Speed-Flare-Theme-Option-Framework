# Speed-Flare-Theme-Option-Framework
This is a lightweight and fast WordPress custom theme admin panel framework.

## About
Speed Flare Theme Option is a simple yet powerful admin panel for your WordPress themes. It's designed to be lightweight and fast, so you don't have to worry about slowing down your site with heavy plugins. With Speed Flare, you can easily customize your theme options without sacrificing performance.


**Creator**: Nerghum  
**Email**: [nerghum@gmail.com](mailto:nerghum@gmail.com)  
**Website**: [https://nerghum.com](https://nerghum.com)  


## Features

    Customizable theme options
    Lightweight and fast design
    No dependencies on 3rd-party plugins
    Easy to use and manage
    Easy Import/Export design Data
    True/False input (slide button)

Single Menu Interface: Manage all theme settings from a single menu named "General Settings."
Variety of Input Types: Includes text, image, color, true/false, dropdown, textarea, checkbox, radio, URL, and email fields.
User-Friendly: Simple and intuitive interface for easy configuration.
Performance-Focused: Built to be minimal and efficient, ensuring your theme remains fast and responsive


## Installation
Download or clone the code from git.
Extract the contents to your WordPress custom themes directory (usually wp-content/themes/your-theme/admin).
Require file
    => require_once get_template_directory() . '/admin/theme-options-framework.php';
    => require_once get_template_directory() . '/admin/theme-option-demo.php';
Edit theme-option-demo.php for your require input field, or Create new.

## Usage
    To register a new Menu for theme option use - $theme_options->register_theme_menu('General Settings');
    Assign input to menu

    
    $theme_options->add_theme_field('General Settings', [
        'name' => 'Text Input',
        'type' => 'text',
        'id'   => 'theme_option_text_input_test',
        'default' => ''
    ]);

    - You can use any Html input type inside 'type'. id will be the wordpress option fields name.
    - To view option use get_option('theme_option_text_input_test');
    - Check theme-option-demo.php for all input type. Also theme-options.php has standred possible all input for theme setting option.

After setup    
To use Speed Flare, simply navigate to wp-admin > Theme Options in your WordPress admin panel.


## Contributing
Feel free to submit issues or pull requests if you find bugs or have suggestions for improvements.

## License
This project is licensed under the MIT License - see the LICENSE file for details.

## Contact
For support or questions, please open an issue on the GitHub repository or contact nerghum@gmail.com.
