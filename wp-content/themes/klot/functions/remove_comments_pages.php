<?php

// remove comments from pages
function remove_comment_support() {
	remove_post_type_support('page', 'comments');
}
add_action('init', 'remove_comment_support', 100);

?>
