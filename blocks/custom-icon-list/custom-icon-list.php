<?php

	extract(wp_parse_args($args, [
		"post" => $post,
		"block" => null,
		"is_preview" => null,
		"class_name" => null,
		"style" => ''
	]));

	$class = implode(" ", array_filter([
		"custom-icon-list",
		$class_name
	]));

	$style = get_block_styles($block);

	$atts = array_filter(["class" => $class, "id" => $id, "style" => $style]);
	$att_string = implode(" ", array_map(function ($key, $value) {
		return "$key='$value'";
	}, array_keys($atts), $atts));

	$items = get_field("items");

	// Add a condition here for the block to render; this is just a placeholder
	if(!empty($items)):
?>

	<ul <?= $att_string ?>>
		<?php foreach ($items as $item): ?>
			<li data-icon="<?= $item["icon"]; ?>">
				<?= $item["content"]; ?>
			</li>
		<?php endforeach; ?>
	</ul>

<?php elseif ($is_preview): ?>
	<p class="d-inline-block p-2 border border-danger text-danger">Please populate all required fields to preview.</p>
<?php endif; ?>