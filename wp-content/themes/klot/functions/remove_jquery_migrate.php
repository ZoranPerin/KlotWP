<?php

// remove jquery migrate
function dequeue_jquery_migrate(&$scripts){
    if(!is_admin()){
        $scripts->remove('jquery');
        $scripts->add('jquery', false, array('jquery-core'), '1.10.2');
    }
}
add_filter('wp_default_scripts', 'dequeue_jquery_migrate');

?>
