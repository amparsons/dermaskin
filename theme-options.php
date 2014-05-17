<?php

function director_settings_page() {
?>
<div class="wrap">
<h2>Director Theme Settings</h2>
<form id="landingOptions" method="post" action= ▶
"options.php">
<?php settings_fields( 'director-settings-group' ); ?>
<table class="form-table">
<tr valign="top">
<th scope="row">Logo:</th>
<td>
<input type="text" name="director_logo" value= ▶
"<?php print get_option('director_logo'); ?>" />
<br/>
*Upload using the Media Uploader and paste the URL
here.
</td>
</tr>
<tr valign="top">
<th scope="row">Facebook Link:</th>
<td>
<input type="text" name="director_facebook"
value="<?php print get_option('director_facebook');
?>" />
</td>
</tr>
<tr valign="top">
<th scope="row">Twitter Link:</th>
<td>
<input type="text" name="director_twitter" value= ▶
"<?php print get_option('director_twitter'); ?>" />
</td>
</tr>
<tr>
<th scope="row">Display RSS Icon:</th>
<td>
<input type="checkbox" name="director_rss" <?php
if(get_option('director_rss') == true){ print
"checked"; } ?> />
</td>
</tr>
<tr>
<th scope="row">Google Analytics Code:</th>
<td>
<textarea name="director_analytics"><?php print
get_option('director_analytics'); ?></textarea>
</td>
</tr>
</table>
<p class="submit">
<input type="submit" class="button-primary" value= ▶
"<?php _e('Save Changes') ?>" />
</p>
</form>
</div>
<?php } ?>
