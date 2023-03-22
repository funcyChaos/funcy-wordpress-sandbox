<?php

add_action('init', function(){
	require get_template_directory() . '/inc/custom-post-type.php';
});