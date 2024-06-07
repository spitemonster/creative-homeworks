<?php

	extract(wp_parse_args($args, [
		"post" => $post,
		"block" => null,
		"is_preview" => null,
		"class_name" => null,
		"style" => ''
	]));

	$img = get_field("image");
	$width = get_field("width");
	$alignment = get_field("alignment");

	$class_name = $class_name . " " . $alignment;

	$class = implode(" ", array_filter([
		"breakout-image",
		$class_name
	]));

	$style = get_block_styles($block);

	$atts = array_filter(["class" => $class, "id" => $id, "style" => $style]);
	$att_string = implode(" ", array_map(function ($key, $value) {
		return "$key='$value'";
	}, array_keys($atts), $atts));

	

	// Add a condition here for the block to render; this is just a placeholder
	if(!empty($img)):
?>
	<img <?= $att_string; ?> src="<?= $img["url"]; ?>" role="presentation" style="--width: <?= $width ?>vw" />

<?php elseif ($is_preview): ?>
	<p class="d-inline-block p-2 border border-danger text-danger">Please populate all required fields to preview.</p>
<?php endif; ?>