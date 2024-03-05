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

// Saving this for later

add_action('save_post', function($post_id){
	if(get_post_type($post_id) == 'porch'){
		$key = map_api_key;
		$address = urlencode(get_field('porch_address', $post_id));
		$url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$key}";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		curl_close($curl);
	
		$data = json_decode($response, true);
		$latitude = $data['results'][0]['geometry']['location']['lat'];
		$longitude = $data['results'][0]['geometry']['location']['lng'];
		update_field('latitude', $latitude, $post_id);
		update_field('longitude', $longitude, $post_id);
	}
}, 10, 1);