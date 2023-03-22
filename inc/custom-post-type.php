<?php

/**
 * Bare minimum to make a custom post type and a
 * Custom taxonomy along with it
*/
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