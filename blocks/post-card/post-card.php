<?php

	if (!function_exists("get_field")) {
		die("cannot run without ACF");
	}

	extract(wp_parse_args($args, [
		"post" => $post,
		"block" => null,
		"is_preview" => null,
		"class_name" => null,
		"style" => ''
	]));

	$class = implode(" ", array_filter([
		$class_name
	]));

	// construct an attributes array from class, id and block styles
	$atts = array_filter(["class" => $class, "id" => $id, "style" => get_block_styles($block)]);
	$post = get_field("post");

	// Add a condition here for the block to render; this is just a placeholder
	if(!empty($post)):
?>

	<?php get_template_part("templates/parts/post-card", null, [
		"atts" => $atts,
		"post" => $post
	]); ?>

<?php elseif ($is_preview): ?>
	<p class="d-inline-block p-2 border border-danger text-danger">Please populate all required fields to preview.</p>
<?php endif; ?>