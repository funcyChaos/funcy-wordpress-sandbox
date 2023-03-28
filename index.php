<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
		<?php
			wp_head();
		?>
	</head>
	<body>
		<?php
			wp_footer();
		?>

		<script>
			console.log(wp.api.models)
			console.log(wp.api.collections)
		
			fetch('<?=home_url()?>/wp-json/api-endpoint/v1/endpoint/5',{
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-WP-Nonce':		'<?=wp_create_nonce('wp_rest')?>',
				},
				body: JSON.stringify({json: 'payload'}),
			})
			.then(res=>res.json())
			.then(obj=>console.log(obj))
		
			fetch('<?=admin_url('admin-ajax.php')?>', {
				method: 'POST',
				headers: {
					'content-Type': 'application/x-www-form-urlencoded; charset-UTF-8'
				},
				body: 'action=admin-ajax&nonce=<?=wp_create_nonce('super_secret_code')?>',
			})
			.then(res=>res.json())
			.then(obj=>console.log(obj))
		</script>
	</body>
</html>
