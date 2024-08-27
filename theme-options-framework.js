// Speed Flare Theme Option Framework
// 
// Copyright (c) 2024 Nerghum
// Email: nerghum@gmail.com
// Website: https://nerghum.com
//
// This is a lightweight and fast WordPress custom theme admin panel framework.
// It is so lite you don't have to use any third-party heavy plugins that make your theme load slow.


jQuery(document).ready(function($) {
    var frame;

    // Media uploader
    $('.upload-image-button').on('click', function(e) {
        e.preventDefault();

        var button = $(this);
        var input = button.siblings('input[type="hidden"]');
        
        // If the media frame already exists, reopen it
        if (frame) {
            frame.open();
            return;
        }

        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Image',
            button: {
                text: 'Use this image'
            },
            multiple: false // Restrict selection to a single image
        });

        // When an image is selected, run a callback
        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            input.val(attachment.id); // Set the image ID in the hidden input
            button.siblings('img').remove(); // Remove any existing image
            button.after('<img src="' + attachment.url + '" style="max-width: 100px; display: block; margin-top: 10px;">'); // Display the selected image
        });

        // Open the media frame
        frame.open();
    });

    // Menu interactions
    $('.sf-menu-item').on('click', function(e) {
        e.preventDefault();
        $('.sf-menu-item').removeClass('active'); // Remove active class from all menu items
        $(this).addClass('active'); // Add active class to the clicked menu item
        var menu = $(this).data('menu');
        $('.sf-menu-section').hide(); // Hide all menu sections
        $('#section-' + menu).show(); // Show the section corresponding to the clicked menu item
    });

    // Save button functionality
    $('#sf-save-options').on('click', function() {
        var data = {
            action: 'save_theme_options', // Action for the AJAX request
            nonce: ajax_object.nonce // Security nonce
        };

        // Collect all form data
        $('#theme-option-setting').find('input, select, textarea, button').each(function() {
            var inputId = $(this).attr('name');
            var inputType = $(this).attr('type');
            var inputValue;

            // Handle different input types
            if (inputType === 'checkbox') {
                inputValue = $(this).is(':checked') ? '1' : '0'; // Checkbox value
            } else if (inputType === 'radio') {
                if ($(this).is(':checked')) {
                    inputValue = $(this).val(); // Radio button value
                } else {
                    return; // Skip unchecked radio buttons
                }
            } else {
                inputValue = $(this).val(); // Text, select, and textarea values
            }

            if (inputId) {
                data[inputId] = inputValue; // Add the input value to the data object
            }
        });

        // Debugging: Log the data object to the console
        console.log(data);

        // Make the AJAX request to save the options
        $.post(ajax_object.ajax_url, data, function(response) {
            alert(response.data); // Show a message based on the response
        });
    });

    // Trigger click on the first menu item by default
    $('.sf-menu-item').first().trigger('click');
});
