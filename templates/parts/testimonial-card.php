<?php
	extract(
		wp_parse_args($args, [
			"testimonial" => null,
			"line_clamp" => 1,
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

	$atts["style"] = "--line-clamp: " . $line_clamp;


	$att_string = implode(" ", array_map(function ($key, $value) {
		return "$key='$value'";
	}, array_keys($atts), $atts));

	if (!empty($testimonial)):
		$content = $testimonial->post_content;
		$name = $testimonial->post_title;
		$case_study = get_field("case_study", $testimonial->ID);
?>
	<blockquote <?= $att_string; ?> >
		<cite>
			<div>
				<img src="/wp-content/uploads/2024/06/google-logo-brandmark.png" alt="Google Logo">

				<?php get_template_part("templates/parts/stars", null); ?>
			</div>
			

				<?php if (!empty(get_field("location", $testimonial->ID))): ?>
					<p class="location"><?= get_field("location", $testimonial->ID); ?></p>
				<?php endif; ?>

				<h3><?= $name; ?></h3>	

			<?php if (!empty($case_study)): ?>
				<p><a href="<?= get_permalink($case_study); ?>">See the Project</a></p>
			<?php endif; ?>

		</cite>
		<div class="content">
			<?= $content; ?>
		</div>
		<!-- <button class="testimonial-lightbox-trigger">Read Testimonial</button> -->
	</blockquote>
<?php else: ?>
	<p>There has been an error.</p>
<?php endif; ?>