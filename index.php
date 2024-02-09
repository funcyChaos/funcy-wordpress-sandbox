<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
		<script>
			document.addEventListener('DOMContentLoaded', ()=>{
				var post = new wp.api.models.Post( { id: 1 } );
				console.log(post)
				// post.fetch();
				// post.getCategories().done( function( postCategories ) {
				// 	// ... do something with the categories.
				// 	// The new post has an single Category: Uncategorized
				// 	console.log( postCategories );
				// 	// response -> "Uncategorized"
				// } );
				// console.log(wp.api.models, wp.api.collections)
			})
		</script>
		<?php wp_footer();?>
	</body>
</html>