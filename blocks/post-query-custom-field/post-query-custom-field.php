<?php

	extract(wp_parse_args($args, [
		"post" => $post,
		"block" => null,
		"is_preview" => null,
		"class_name" => null,
		"style" => ''
	]));

	if (!function_exists('get_field')) {
		return "can't get field";
	}


	$class = implode(" ", array_filter([
		"post-query-custom-field",
		$class_name
	]));

	$style = get_block_styles($block);

	$atts = array_filter(["class" => $class, "id" => $id, "style" => $style]);
	$att_string = implode(" ", array_map(function ($key, $value) {
		return "$key='$value'";
	}, array_keys($atts), $atts));

	$field_name = get_field("custom_field");

	// Add a condition here for the block to render; this is just a placeholder
	if(!empty($att_string)):
?>

	<div <?= $att_string ?>>
		<?= get_the_ID(); ?>
		<?= get_the_permalink(); ?>
		<?= get_field($field_name, get_the_ID()); ?>
	</div>

<?php elseif ($is_preview): ?>
	<p class="d-inline-block p-2 border border-danger text-danger">Please populate all required fields to preview.</p>
<?php endif; ?>