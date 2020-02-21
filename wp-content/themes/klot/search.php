<?php get_header(); ?>

	<h1>
		<?php echo sprintf( __( '%s Search Results for ', 'wp_theme' ), $wp_query->found_posts ); echo get_search_query(); ?>
	</h1>

	<?php get_template_part('/template-parts/loop'); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
