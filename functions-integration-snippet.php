<?php
/**
 * Integration snippet for the Hello Elementor child theme.
 * Copy this hook into your existing child-theme functions.php.
 * Do not replace your entire functions.php with this file.
 */
add_action( 'wp_enqueue_scripts', function () {
    if ( ! is_category() ) {
        return;
    }

    $relative_path = '/assets/css/category-archive.css';
    $file_path     = get_stylesheet_directory() . $relative_path;

    if ( file_exists( $file_path ) ) {
        wp_enqueue_style(
            'hello-elementor-category-archive',
            get_stylesheet_directory_uri() . $relative_path,
            array(),
            (string) filemtime( $file_path )
        );
    }
}, 20 );
