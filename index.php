<script>
	fetch('<?=admin_url('admin-ajax.php')?>', {
		method: "POST",
		headers: {
			'content-Type': 'application/x-www-form-urlencoded; charset-UTF-8'
		},
		body: 'action=admin-ajax&nonce=<?=wp_create_nonce('super_secret_code')?>',
		body: 'action=admin-ajax',
	})
	.then(res=>res.json())
	.then(obj=>console.log(obj))
</script>