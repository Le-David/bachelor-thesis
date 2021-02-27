<?php 

/**
 * Custom gutenberg "aisdeMediaContent" block
 */

function aside_media_content() {

    wp_register_script(
        'aside-media-content', // $handle - (string)(Required) Name of the script.
        get_template_directory_uri() . '/build/scripts/index.js', // $src - (string|bool) (Required) Full URL of the script, or path of the script relative to the WordPress root directory.
        array( 'wp-i18n', 'wp-blocks' ) // $deps - (string[]) (Optional) An array of registered script handles this script depends on.
    );

    register_block_type(
        'gutenberg-block/aside-media-content', // namespace/block-name - (Required structure block name) the namespace and name/slug of the block
        array(
            'editor_script' => 'aside-media-content', // assign the name of the registered script to "editor_script" to handle the block
        )
    );
}

add_action( 'init', 'aside_media_content' ); // call function "aside_media_content" when templates initialize
