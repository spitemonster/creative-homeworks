<?php 
extract(
	wp_parse_args($args, [
	  "post" => null,
	  "atts" => null
	])
  );

  if (empty($atts)) {
	$atts = ["class" => "post-card"];
  } else {
	$atts["class"] = $atts["class"] . " post-card";
  }

  $att_string = implode(" ", array_map(function ($key, $value) {
	return "$key='$value'";
}, array_keys($atts), $atts));

  if (!empty($post)) :

	$image = get_the_post_thumbnail_url($post, 'medium');

	if (empty($image)) {
		$image = function_exists('get_field') ? wp_get_attachment_image_url(get_field("fallback_image", "options"), 'medium') : '';
	}

	$tags = get_the_terms($post->id, "tag");
	$excerpt = get_the_excerpt($post);
	$type = get_post_type_object( $post->post_type );
    $post_type_slug = $type->rewrite['slug'];
?>
<a <?= $att_string; ?> href="<?= get_permalink( $post ); ?>">
	<figure>
		<img width="100%" style="aspect-ratio: 3/2;" src="<?= $image; ?>" alt="placeholder image!" />
		<figcaption>
			<?php if (!empty($tags)): ?>
				<ul class="tags">
					<?php foreach ($tags as $tag): ?>
						<li><?= $tag->name; ?></li>
					<?php endforeach ?>
				</ul>
			<?php endif; ?>
			<p class="has-h-6-font-size title"><?= $post->post_title; ?></p>
			<?php if (!empty($excerpt)): ?>
				<p class="excerpt">
				<?= $excerpt; ?>
				</p>
			<?php endif; ?>
		</figcaption>
	</figure>
</a>
<?php else: ?>
	<p>There has been an error.</p>
<?php endif; ?>