<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<form id="the_form">
	<div class="g-recaptcha" data-sitekey="6LduTmspAAAAACnlnH2_rBd_AT49bjJiqmJp4ylt" data-callback="recaptchaValidate"></div>
	<button class="" id="submit_button" type="submit">Submit</button>
</form>
<script>
	const form = document.getElementById('the_form')
	form.addEventListener('submit', (event)=>{
		event.preventDefault()
		const formData = new FormData(form)
		let jsonData = {}
		formData.forEach((value, key)=>{
			jsonData[key] = value
		})
		fetch('<?=home_url()?>/wp-json/get-a-quote/v1/form-request',{
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-WP-Nonce':		'<?=wp_create_nonce('wp_rest')?>',
			},
			body: JSON.stringify(jsonData),
		})
		.then(res=>res.json())
		.then(obj=>console.log(obj))
	})

	function recaptchaValidate(){
		const submitBtn = document.getElementById('submit_button')
		if(submitBtn.classList.contains("hidden")){
			submitBtn.classList.remove("hidden")
		}
	}
</script>