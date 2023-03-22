<?php

add_action('init', function(){
	register_post_type('custom_post_type', [
		'public'			=> true,
		'label'				=> 'Custom Post Type',
		'taxonomies'	=> ['category'],
	]);
	register_taxonomy(
		'custom_taxonomy',
		'custom_post_type',
		array(
			'label' => 'Custom Taxonomy'
		)
	);
});