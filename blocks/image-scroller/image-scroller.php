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
		"image-scroller",
		$class_name
	]));

	$style = get_block_styles($block);

	$atts = array_filter(["class" => $class, "id" => $id, "style" => $style]);
	$att_string = implode(" ", array_map(function ($key, $value) {
		return "$key='$value'";
	}, array_keys($atts), $atts));

	$images = get_field('images');

	if(!empty($images)):
?>

	<div <?= $att_string ?>>
		<ul>
			<?php foreach ($images as $image): ?>
				<li>
					<?php if (!empty($image['link'])) :?>
						<a href="<?= $image['link'] ?>">
					<?php endif; ?>
						<img src="<?= wp_get_attachment_image_url($image['image'], 'medium'); ?>" alt="<?= get_post_meta($image['image'], '_wp_attachment_image_alt', TRUE); ?>">
					<?php if (!empty($image['link'])) :?>
						</a>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

<?php elseif ($is_preview): ?>
	<p class="d-inline-block p-2 border border-danger text-danger">Please populate all required fields to preview.</p>
<?php endif; ?>