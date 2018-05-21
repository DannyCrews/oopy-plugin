<div class="wrap">
	<h1>Oopy Plugin</h1>
	<?php settings_errors(); ?>

	<form method="post" action="options.php">
		<?php
			settings_fields( 'oopy_options_group' );
			do_settings_sections( 'oopy_plugin' );
			submit_button();
		?>
	</form>
</div>