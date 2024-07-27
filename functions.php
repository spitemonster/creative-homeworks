<?php

define('LOCAL_DOMAIN', 'creativehomeworks.local');
define('THEME_VERSION', '0.0.1');

//includes
array_map(
    function ($file) {
        $filepath = "/includes/{$file}.php";
        require_once get_stylesheet_directory() . $filepath;
    },
    [
        'blocks',
        'icons',
        'options-pages',
        'post-types',
        'taxonomies',
        'user-roles',
        'utilities'
    ]
);

add_action('init', function() {
	register_block_style(
		'core/group',
		array(
			'name'  => 'breakout',
			'label' => __( 'Breakout', 'textdomain' ),
		)
	);

	register_block_style(
		'core/group',
		array(
			'name'  => 'constrained',
			'label' => __( 'Constrained', 'textdomain' ),
		)
	);

	register_block_style(
		'core/image',
		array(
			'name'  => 'grayscale',
			'label' => __( 'Grayscale', 'textdomain' ),
		)
	);

	register_block_style(
		'core/post-featured-image',
		array(
			'name'  => 'rounded-top',
			'label' => __( 'Rounded Top', 'textdomain' ),
		)
	);

	register_block_style(
		'core/media-text',
		array(
			'name' => 'image-fill',
			'label' => __('Image Fill', 'textdomain')
		)
	);

	register_block_style(
		'core/list',
		array(
			'name' => 'check-icon',
			'label' => __('Check Icon', 'textdomain')
		)
	);

	register_block_style(
		'core/list-item',
		array(
			'name' => 'check-icon',
			'label' => __('Check Icon', 'textdomain')
		)
	);

	register_nav_menus([
		'primary_navigation' => __('Primary Navigation', 'textdomain'),
		'footer_navigation' => __('Footer Navigation', 'textdomain'),
	]);
});

add_action('after_setup_theme', function () {
    add_post_type_support('page', 'excerpt');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
    ]);

    remove_theme_support('core-block-patterns');

	add_theme_support('editor-styles');
	add_theme_support( 'wp-block-styles' );
});

add_action('admin_init', function() {
	add_editor_style('assets/css/main.css');
	add_editor_style('assets/css/editor.css');
});

add_action('widgets_init', function () {
    register_sidebar([
        'name' => 'Site Logo',
        'id' => 'site-logo',
        'description' =>
            'Place a site logo block or image block here to display the logo in the header.',
        'before_widget' => '<div class="site-logo__wrap">',
        'after_widget' => '</div>',
    ]);
});

add_action(
    'wp_enqueue_scripts',
    function () {
        wp_enqueue_style(
            'main-css',
            asset_path('css/main.css'),
            [],
            THEME_VERSION,
            'all'
        );
		
        wp_enqueue_script_module(
            'main-js',
            asset_path('js/main.js'),
            [],
            THEME_VERSION,
            true
        );
    },
    10
);

add_action("wp_body_open", function() {
	$show_announcement_bar = function_exists('get_field') ? get_field("display_announcement_bar", "options") == "true" : false;

	if ($show_announcement_bar) {
		get_template_part("templates/parts/announcement-bar");
	}
});

add_filter( 'post_thumbnail_html', function( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
if ( empty( $html ) ) {
	$image = function_exists('get_field') ? wp_get_attachment_image_url(get_field("fallback_image", "options"), 'medium') : '';
	return sprintf(
		'<img src="%s" height="%s" width="%s" />',
		$image,
		get_option( 'thumbnail_size_w' ),
		get_option( 'thumbnail_size_h' )
	);
}

return $html;
}, 20, 5 );

