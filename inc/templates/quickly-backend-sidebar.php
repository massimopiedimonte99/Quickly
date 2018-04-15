<?php if(!current_user_can( 'manage_options' )): ?>
	<h3 class="text-center">Sorry, you do not have permission to access this page!</h3>
<?php endif; ?>

<form action="options.php" method="POST">
	<?php
		settings_fields( 'quickly-sidebar' );
		do_settings_sections( 'sidebar-settings' );
		submit_button( 'Submit', 'secondary' );
	?>
</form>