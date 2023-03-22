<?php

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