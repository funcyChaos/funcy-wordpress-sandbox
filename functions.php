<?php

add_filter('um_account_page_default_tabs_hook', function($tabs){
	$tabs[100]['profile']['icon'] = 'um-faicon-users';
	$tabs[100]['profile']['title'] = 'Profile';
	$tabs[100]['profile']['custom'] = true;
	$tabs[100]['profile']['show_button'] = false;
	return $tabs;
}, 100 );
	
/* make our new tab hookable */

add_action('um_account_tab__profile', function($info){
	global $ultimatemember;
	extract( $info );
	$output = $ultimatemember->account->get_tab_output('profile');
	if ( $output ) { echo $output; }
});

/* Finally we add some content in the tab */

add_filter('um_account_content_hook_profile', function($output){
	ob_start();
	?>
	<div class="um-field">
		<?=do_shortcode('[ultimatemember form_id="11"]')?>
	</div>
	<?php
	$output .= ob_get_contents();
	ob_end_clean();
	return $output;
});