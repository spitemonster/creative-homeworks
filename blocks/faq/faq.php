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
		"faq",
		$class_name
	]));

	$style = get_block_styles($block);

	$atts = array_filter(["class" => $class, "id" => $id, "style" => $style]);
	$att_string = implode(" ", array_map(function ($key, $value) {
		return "$key='$value'";
	}, array_keys($atts), $atts));

	$faqs = get_field("faqs");

	// Add a condition here for the block to render; this is just a placeholder
	if(!empty($faqs)):
?>

	<div <?= $att_string ?>>
		<?php foreach ($faqs as $faq): ?>
			<details>
				<summary><?= $faq->post_title; ?></summary>
				<div class="faq-content">
					<?= $faq->post_content; ?>
				</div>
			</details>
		<?php endforeach; ?>
	</div>

<?php elseif ($is_preview): ?>
	<p class="d-inline-block p-2 border border-danger text-danger">Please populate all required fields to preview.</p>
<?php endif; ?>