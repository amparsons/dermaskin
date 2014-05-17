<div class="metaarea">
	
    <?php
		$config = array(
		"editor_selector" => "tinymce_data"
		);
		wp_tiny_mce( false, $config);
    ?>
    
     <script>
	 jQuery(document).ready(function($)
	 {
	  tinyMCE.execCommand('mceAddControl', true, "subtitle");
	 });
	 </script>
     
	<label for="subtitle">Heading for the second coloured strip:</label>
	<textarea type="text" id="subtitle" name="subtitle"><?php echo $subtitle; ?></textarea>
</div>