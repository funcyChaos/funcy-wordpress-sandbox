<script>
	console.log('<?=home_url()?>')
	fetch('<?=home_url()?>/wp-json/api-endpoint/endpoint/5',{
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