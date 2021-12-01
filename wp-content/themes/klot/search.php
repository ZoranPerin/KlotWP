<?php get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1>
					<?php echo sprintf( __( '%s Search Results for ', 'wp_theme' ), $wp_query->found_posts ); echo get_search_query(); ?>
				</h1>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
