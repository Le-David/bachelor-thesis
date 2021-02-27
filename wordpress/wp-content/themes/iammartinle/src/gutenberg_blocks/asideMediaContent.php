<?php 

/**
 * Custom gutenberg "aisdeMediaContent" block
 */

function aside_media_content() {

    wp_register_script(
        'aside-media-content-script', // $handle - (string)(Required) Name of the script.
        get_template_directory_uri() . '/build/scripts/index.js', // $src - (string|bool) (Required) Full URL of the script, or path of the script relative to the WordPress root directory.
        array( 'wp-i18n', 'wp-blocks', 'wp-block-editor' ) // $deps - (string[]) (Optional) An array of registered script handles this script depends on.
    );

    wp_register_style(
        'aside-media-content-styleEditor', // $handle - (string)(Required) Name of the stylesheet.
        get_template_directory_uri() . '/build/styles/styleEditor.css', // $src - (string|bool) (Required) Full URL of the stylesheet, or path of the script relative to the WordPress root directory.
        array( 'wp-edit-blocks' ) // (string[]) (Optional) An array of registered stylesheet handles this stylesheet depends on. Default value: array()
    );

    wp_register_style(
        'aside-media-content-style',
        get_template_directory_uri() . '/build/styles/style.css',
        array()
    );

    register_block_type(
        'gutenberg-block/aside-media-content', // namespace/block-name - (Required structure block name) the namespace and name/slug of the block
        array(
            'apiVersion' => 2,
            'editor_script' => 'aside-media-content-script', // assign the name of the registered script to "editor_script" to handle the block
            'editor_styles' => 'aside-media-content-styleEditor', // assign the name of the registered style to "editor_styles" to style the block
            'style' => 'aside-media-content-style' // assign the name of the registered style to "style" to style the block on frontend
        )
    );
}

add_action( 'init', 'aside_media_content' ); // call function "aside_media_content" when templates initialize
