<?php
	extract(
		wp_parse_args($args, [
			"testimonial" => null,
			"atts" => null
		])
	);

	if (!function_exists('get_field')) {
		return "can't get field";
	}

	if (empty($atts)) {
		$atts = ["class" => "testimonial-card"];
	} else {
		$atts["class"] = $atts["class"] . " testimonial-card";
	}

	$att_string = implode(" ", array_map(function ($key, $value) {
		return "$key='$value'";
	}, array_keys($atts), $atts));

	if (!empty($testimonial)):
		$content = $testimonial->post_content;
		$name = $testimonial->post_title;
		$case_study = get_field("case_study", $testimonial->ID);
?>
	<blockquote <?= $att_string; ?> >
		<?= $content; ?>
		<cite>
			<img src="https://randomuser.me/api/portraits/women/4.jpg">
			<div>
			<p><?= $name; ?></p>
			<?php if (!empty($case_study)): ?>
				<p><a href="<?= get_permalink($case_study); ?>">See the Project</a></p>
			<?php endif; ?>
			</div>
		</cite>
	</blockquote>
<?php else: ?>
	<p>There has been an error.</p>
<?php endif; ?>