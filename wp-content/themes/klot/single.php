<?php get_header(); ?>

	<?php
	if (have_posts()):
		while (have_posts()) :
			the_post();
	?>

		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1>
						<?php the_title(); ?>
					</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<?php the_time('F j, Y'); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<img src="<?php the_post_thumbnail_url(); ?>" />
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<?php the_content();?>
				</div>
			</div>
		</div>

	<?php
		endwhile;
	endif;
	?>

<?php get_footer(); ?>
