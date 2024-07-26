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
		"posts-grid",
		$class_name
	]));

	$style = get_block_styles($block);

	$atts = array_filter(["class" => $class, "id" => $id, "style" => $style]);
	$att_string = implode(" ", array_map(function ($key, $value) {
		return "$key='$value'";
	}, array_keys($atts), $atts));

	$manual = get_field("manual") == "true";

	$included_types = ['post', 'case-study'];

	if ($manual) {
		$posts = get_field("posts");
	} else {
		$type = get_field("post_type");

		if ($type == "all") {
			$posts = get_posts([
				"numberposts" => 8,
				"post_type" => $included_types
			]);
		} else {
			$posts = get_posts([
				"numberposts" => 8,
				"post_type" => $type
			]);
		}
	}
	// Add a condition here for the block to render; this is just a placeholder
	if(!empty($posts)):
?>
<ul <?= $att_string; ?>>
	<?php foreach ($posts as $post): ?>
		<li>
			<?php get_template_part("templates/parts/post-card", null, [ "post" => $post ]) ?>
		</li>
	<?php endforeach; ?>
</ul>

<?php elseif ($is_preview): ?>
	<p class="d-inline-block p-2 border border-danger text-danger">Please populate all required fields to preview.</p>
<?php endif; ?>