<?php
/**
 * Title: Hidden post meta
 * Slug: creative-homeworks/hidden-post-meta
 * Inserter: no
 *
 * @package creative-homeworks
 * @since 1.0.0
 */
?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"flex","justifyContent":"left"}} -->
<div class="wp-block-group">
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group">
	<!-- wp:post-author-name {"isLink":true} /-->
	<!-- wp:post-date /-->
	</div>
	<!-- /wp:group -->
	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:post-terms {"term":"category","prefix":"<?php echo esc_html__( 'Categories: ', 'creative-homeworks' )?>"} /-->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
