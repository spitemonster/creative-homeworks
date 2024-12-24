<?php

	extract(wp_parse_args($args, [
		"post" => $post,
		"block" => null,
		"is_preview" => null,
		"class_name" => null,
		"style" => ''
	]));

	$class = implode(" ", array_filter([
		"stars",
		$class_name
	]));

	$style = get_block_styles($block);

	$atts = array_filter(["class" => $class, "id" => $id, "style" => $style]);
	$att_string = implode(" ", array_map(function ($key, $value) {
		return "$key='$value'";
	}, array_keys($atts), $atts));

	// Add a condition here for the block to render; this is just a placeholder
	if(!empty($rating)):
?>
<span <?= $att_string ?> style="--rating: <?= $rating; ?>">
	<?php get_template_part("templates/parts/stars", null); ?>
	</span>
<?php elseif ($is_preview): ?>
	<p class="d-inline-block p-2 border border-danger text-danger">Please populate all required fields to preview.</p>
<?php endif; ?>