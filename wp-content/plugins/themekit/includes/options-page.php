<?php
add_action( 'admin_menu', 'themekit_admin_menu' );
add_action( 'admin_init', 'themekit_settings_init' );


function themekit_admin_menu(  ) { 

	add_options_page( 'ThemeKit By LineThemes', 'ThemeKit', 'manage_options', 'themekit_settings', 'themekit_options_page' );

}


function themekit_settings_init(  ) { 

	register_setting( 'themekit_settings', 'themekit_settings' );

	add_settings_section(
		'themekit_google_maps_section', 
		__( 'Google Maps API', 'linethemes' ), 
		'themekit_settings_section_callback', 
		'themekit_settings'
	);

	add_settings_field( 
		'maps_api', 
		__( 'API Key', 'linethemes' ), 
		'themekit_google_maps_settings', 
		'themekit_settings', 
		'themekit_google_maps_section' 
	);


}


function themekit_google_maps_settings(  ) { 

	$options = get_option( 'themekit_settings' );
	?>
	<input type='text' name='themekit_settings[maps_api]' value='<?php echo $options['maps_api']; ?>'>
	<p class="description">The Google Maps JavaScript API v3 does not require an API key to function correctly. However, Google strongly encourages you to load the Maps API using an APIs Console key which allows you to monitor your Maps API usage. <a href="https://developers.google.com/maps/documentation/javascript/tutorial#api_key" target="_blank" class="new-window">Learn how to obtain an API key</a>.</p>
	<?php

}


function themekit_settings_section_callback(  ) { 

	

}


function themekit_options_page(  ) { 

	?>
	
	<div class="wrap">
		<form action='options.php' method='post'>

			<h1>ThemeKit Settings</h1>

			<?php
			settings_fields( 'themekit_settings' );
			do_settings_sections( 'themekit_settings' );
			submit_button();
			?>

		</form>
	</div>

	<?php

}
