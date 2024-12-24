<?php

add_action('init', function() {

	$block_styles = [
		['core/group', 'breakout', __( 'Breakout', 'creativehomeworks' )],
		['core/group', 'constrained', __( 'Constrained', 'creativehomeworks' )],
		['core/group', 'contained-half', __( 'Contained Half', 'creativehomeworks' )],
		['core/columns', 'breakout', __('Breakout', 'creativehomeworks')],
		['core/image', 'grayscale', __( 'Grayscale', 'creativehomeworks' )],
		['core/image', 'caption-visible', __( 'Caption Visible', 'creativehomeworks' )],
		['core/post-featured-image', 'rounded-top', __( 'Rounded Top', 'creativehomeworks' )],
		['core/media-text', 'image-fill', __('Image Fill', 'creativehomeworks')],
		['core/media-text', 'image-fill-alt', __('Image Fill Mobile Reverse', 'creativehomeworks')],
		['core/list', 'check-icon', __('Check Icon', 'creativehomeworks')],
		['core/list-item', 'check-icon', __('Check Icon', 'creativehomeworks')],
	];
	
	foreach ($block_styles as $style) {
		register_block_style($style[0], [
			'name' => $style[1],
			'label' => $style[2]
		]);
	}
});