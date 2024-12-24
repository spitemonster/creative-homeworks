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
		"testimonials",
		$class_name
	]));

	$style = get_block_styles($block);

	$testimonials = get_field("testimonials");
	$line_clamp = get_field("line_clamp");
	$columns = get_field("columns");

	$line_clamp = empty($line_clamp) ? 1 : $line_clamp;

	$columns = empty($columns) ? 3 : $columns;

	if (empty($style)) {
		$style = '--columns: ' . $columns;
	} else {
		$style .= " --columns: " . $columns;
	}

	$atts = array_filter(["class" => $class, "id" => $id, "style" => $style]);
	$att_string = implode(" ", array_map(function ($key, $value) {
		return "$key='$value'";
	}, array_keys($atts), $atts));

	

	// Add a condition here for the block to render; this is just a placeholder
	if(!empty($testimonials)):
?>
<div>
<ul <?= $att_string ?>>
	<?php foreach ($testimonials as $testimonial): ?>
					<li><?php get_template_part("templates/parts/testimonial-card", null, [ "testimonial" => $testimonial, "line_clamp" => $line_clamp ]); ?></li>
			<?php endforeach; ?>
	</ul>
	<a href="/testimonials">See all 50+ reviews</a>
</div>
	

<?php elseif ($is_preview): ?>
	<p class="d-inline-block p-2 border border-danger text-danger">Please populate all required fields to preview.</p>
<?php endif; ?>