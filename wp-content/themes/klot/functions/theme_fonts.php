<?php

// fonts
function google_fonts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400;1,700&display=swap', false);
}
add_action( 'wp_enqueue_scripts', 'google_fonts' );

?>
