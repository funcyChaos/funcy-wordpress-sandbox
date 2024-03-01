<?php

add_action('rest_api_init', function(){
	register_rest_route('email/v1', '/email', [
		[
			'methods'	=> 'GET',
			'callback'	=> function (WP_REST_Request $req){
				ob_start();
				?><h1>Hello, World!</h1><?php
				$content = ob_get_clean();
				$email_success = wp_mail(get_bloginfo('admin_email'), 'email', $content, ['Content-Type: text/html; charset=UTF-8']);
				if($email_success){
					return ['response' => 'success'];
				}else{
					return ['response' => 'failed'];
				}
			},
			'permission_callback' => '__return_true',
		]
	]);
});