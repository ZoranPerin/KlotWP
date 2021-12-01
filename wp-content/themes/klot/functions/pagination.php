<?php

// pagination
function wp_pagination($numpages = '', $pagerange = '', $paged='') {

	if (empty($pagerange)) {
		$pagerange = 2;
	}
	global $paged;
	if (empty($paged)) {
		$paged = 1;
	}
	if ($numpages == '') {
		global $wp_query;
		$numpages = $wp_query->max_num_pages;
		if(!$numpages) {
			$numpages = 1;
		}
	}

	$pagination_args = array(
		'base'            => get_pagenum_link(1) . '%_%',
		'format'          => '/page/%#%',
		'total'           => $numpages,
		'current'         => $paged,
		'show_all'        => false,
		'end_size'        => 1,
		'mid_size'        => $pagerange,
		'prev_next'       => true,
		'prev_text'       => __(''),
		'next_text'       => __(''),
		'type'            => 'plain',
		'add_args'        => false,
		'add_fragment'    => ''
	);

	$paginate_links = paginate_links($pagination_args);

	if ($paginate_links) {
		echo "<div class='pagination'>";
		echo $paginate_links;
		echo "<span class='page-numbers'></span>";
		echo "</div>";
	}
}
add_action('init', 'wp_pagination');

?>
