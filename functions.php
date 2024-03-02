<?php

add_action('rest_api_init', function(){
	register_rest_route('api-endpoint/v1', '/endpoint', [
		[
			'methods'	=> 'GET',
			'callback'	=> function (WP_REST_Request $req){
				$api = json_decode(file_get_contents(
					"https://pokeapi.co/api/v2/pokemon/ditto",
					false,
					stream_context_create([
						'http'	=> [
							'method'  => 'GET',
						]
					])
				), true);

				return [
					'data'			=> $api,
					'response'	=> 'GET successful',
					'request'		=> $req['param'],
				];
			},
			'permission_callback' => '__return_true',
		],
	]);
});