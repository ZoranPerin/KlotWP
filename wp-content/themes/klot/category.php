<?php get_header(); ?>

	<h1>
		Category:
		<?php single_cat_title(); ?>
	</h1>

	<?php get_template_part('/template-parts/loop'); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
