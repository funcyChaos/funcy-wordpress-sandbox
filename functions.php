<?php

/**
 * Add admin-ajax 'action' or endpoint.
 * The url for this endpoint is /wp-admin/admin-ajax.php?action=admin-ajax
 */

add_action('wp_ajax_admin-ajax', function(){
	if(!wp_verify_nonce($_REQUEST['nonce'], 'super_secret_code')){
		wp_send_json(['response'=>'bad nonce']);
		wp_die();
	}
	wp_send_json(['response'=>'success']);
	wp_die();
});

add_action('wp_ajax_nopriv_admin-ajax', function(){
	wp_send_json(['response'=>'nopriv']);
	wp_die();
});

/**
 * Add REST API endpoint. Supposed to be faster than admin-ajax, but the last known benchmark, at time of writing, says it is actually slower.
 
 * This route works out to /wp-json/api-endpoint/v1/endpoint/{param}
 */

add_action('rest_api_init', function(){
	register_rest_route('api-endpoint/v1', '/endpoint/(?P<param>\d+)', [
		[
			'methods'	=> 'GET',
			'callback'	=> function (WP_REST_Request $req){
				return [
					'response'	=> 'GET successful',
					'request'		=> $req['param'],
				];
			}
		],
		[
			'methods'	=> 'POST',
			'callback'	=> function (WP_REST_Request $req){
				return [
					'response'	=> 'POST successful',
					'request'		=> $req['param'],
					'json'			=> $req->get_param('json'),
					'nonce'			=> $req->get_header('X-WP-Nonce'),
				];
			},
			'permission_callback' => function(){
				return current_user_can('edit_others_posts');
			}
		]
	]);
});