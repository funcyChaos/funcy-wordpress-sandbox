<?php

/**
 * Add admin-ajax "action" or endpoint. Arguably more secure than a REST endpoint.
 * The url for this endpoint is /wp-admin/admin-ajax.php?action=admin-ajax
 */

add_action('wp_ajax_admin-ajax', function(){
	if(!wp_verify_nonce($_REQUEST['nonce'], 'super_secret_code')){
		exit(json_encode(['response'=>'bad nonce']));
	}
	echo json_encode(['response'=>'success']);
	die();
});	
add_action('wp_ajax_nopriv_admin-ajax', function(){
	echo json_encode(['response'=>'nopriv']);
});

/**
 * Add REST API endpoint. Supposed to be faster than admin-ajax, but the last known benchmark, at time of writing, says it is actually slower
 * This route is available at /wp-json/api-endpoint and /wp-json/api-endpoint/endpoint/{param}
 */

add_action('rest_api_init', function(){
	register_rest_route('api-endpoint', '/endpoint/(?P<param>\d+)', array(
		array(
			'methods'	=> 'GET',
			'callback'	=> function ($req){
				return ['response'=>'GET successful', 'request'=>$req['param']];
			}
		),
		array(
			'methods'	=> 'POST',
			'callback'	=> function ($req){
				return ['response'=>'POST successful', 'request'=>$req['param']];
			}
		)
	));
});