<?php
if (!defined('ABSPATH')) {
	exit;
}

// Check if file inclided in context of Bradmax_Player_Plugin class.
if (!isset($custom_player_exists)) {
	exit;
}
?>
<div class="wrap">
	<h2>Bradmax Player - v<?php echo esc_html(self::PLUGIN_VERSION); ?></h2>

	<?php if(empty($upload_info) && !$custom_player_exists): ?>
	<?php self::show_help_tip(); ?>
	<?php endif; ?>

	<?php if(isset($upload_info['error'])): ?>
	<div class="update-nag" style="margin-bottom: 20px;">
		Cannot upload file. <?php echo esc_html($upload_info['error']); ?>
	</div>
	<?php endif; ?>

	<?php if(!empty($upload_info['success'])): ?>
	<div class="update-nag" style="margin-bottom: 20px;">
		File uploaded successfully.
	</div>
	<?php endif; ?>

	<?php if($custom_player_exists): ?>
	<?php $custom_player_info = self::get_customized_player_info(); ?>
	<?php $modif_time = new \DateTime(); $modif_time->setTimestamp($custom_player_info['modification_ts']); ?>
	<h3>Customized player info</h3>

	<table class="form-table">
		<tr>
			<th scope="row"><label for="bradmax_player_file">Player version:</label></th>
			<td><?php echo esc_html($custom_player_info['version']); ?></td>
		</tr>
		<tr>
			<th scope="row"><label for="bradmax_player_file">Player skin:</label></th>
			<td><?php echo esc_html($custom_player_info['skin']); ?></td>
		</tr>
		<tr>
			<th scope="row"><label for="bradmax_player_file">File uploaded at:</label></th>
			<td><?php echo esc_html($modif_time->format('Y-m-d H:i:s')); ?></td>
		</tr>
	</table>
	<form action="options-general.php?page=bradmax-player-settings" method="post"  style="margin-bottom: 60px;"
		onsubmit="return confirm('Do you really want to remove current player file and use default one ? This cannot be undone.')">
		<?php wp_nonce_field( 'remove_player' ); ?>
		<?php submit_button( 'Remove customized player and use default', 'primary', 'remove_player' ); ?>
	</form>
	<?php endif; ?>

	<h3>Upload customized player</h3>
	<form action="options-general.php?page=bradmax-player-settings" method="post" enctype="multipart/form-data">
		<?php wp_nonce_field( 'bradmax_player_file' ); ?>
		<table class="form-table">
			<tr>
				<th scope="row"><label for="bradmax_player_file">Select customized Bradmax player file</label></th>
				<td><input type="file" name="bradmax_player_file" id="bradmax_player_file"></td>
			</tr>
		</table>
		<?php submit_button( 'Upload', 'primary', 'upload' ); ?>
	</form>
</div>