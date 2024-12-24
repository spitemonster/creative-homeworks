<?php
/**
 * Title: Testimonial Query
 * Slug: creative-homeworks/testimonial-query
 * Categories: testimonials
 * Block Types: core/post-conent, core/query, core/post-title
 *
 * @package creative-homeworks
 * @since 1.0.0
 */
?>
<!-- wp:query {"query":{"perPage":5,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"layout":{"type":"constrained"}} -->
<div class="wp-block-query archive-testimonials">
	
	<!-- wp:post-template -->
	 <blockquote class="testimonial-card">
		<cite>
		<div>
				<img src="/wp-content/uploads/2024/06/google-logo-brandmark.png" alt="Google Logo">

				<?php get_template_part("templates/parts/stars", null); ?>
			</div>
				<!-- wp:post-title {"level":3} /-->
		</cite>
		<div class="content">
			<?= get_the_excerpt() ?>
		</div>
		<a class="read-more" href="<?= get_the_permalink() ?>">Read more</a>
	</blockquote>
	<!-- /wp:post-template -->
	<!-- wp:query-no-results -->
	<!-- wp:paragraph --><p><?php esc_html_e( 'No results found.', 'creative-homeworks'); ?></p><!-- /wp:paragraph -->
	<!-- /wp:query-no-results -->
	<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"space-between"}} -->
	<!-- wp:query-pagination-previous /-->
	<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->
</div>
<!-- /wp:query -->
