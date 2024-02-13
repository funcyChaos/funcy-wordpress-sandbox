<?php

add_action('rest_api_init', function(){
	register_rest_route('get-a-quote/v1', '/form-request', [
		[
			'methods'	=> 'POST',
			'callback'	=> function (WP_REST_Request $req){
				if(check_if_valid_recaptcha($req->get_param('g-recaptcha-response
				'))){
					return ['response'=>'success'];
				}else{
					return ['response'=>'failed'];
				}
			},
			'permission_callback' => '__return_true',
		]
	]);
});

function check_if_valid_recaptcha($recaptcha){
	$recaptcha_response = json_decode(file_get_contents(
		"https://www.google.com/recaptcha/api/siteverify",
		false,
		stream_context_create([
			'http'	=> [
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content'	=> http_build_query([
					'secret'		=> 'RECAPTCHA_KEY_SALT',
					'response'	=> $recaptcha,
					'remoteip'	=> $_SERVER['REMOTE_ADDR']
				]),
			]
		])
	), true);
	if ($recaptcha_response['success'])
		return true;
	else
		return false;
}