<script>
	fetch('<?=home_url()?>/wp-json/api-endpoint/v1/endpoint')
	.then(res=>res.json())
	.then(obj=>console.log(obj))
</script>
