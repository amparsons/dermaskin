<div class="wrapper">
    <footer>
    	<ul>
        	<li>&copy; Dermaskin Clinics - All Rights Reserved</li>
            <?php
				wp_nav_menu(
					array(
					'menu' => 'footer',
					'container' => ''
				));
			?>
        </ul>
        <p>Call us on <span><a href="tel:02920090809">02920 09 08 09</a></span> or email us at <a href='&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#105;&#110;&#102;&#111;&#64;&#100;&#101;&#114;&#109;&#97;&#115;&#107;&#105;&#110;&#46;&#99;&#111;&#46;&#117;&#107;'>&#105;&#110;&#102;&#111;&#64;&#100;&#101;&#114;&#109;&#97;&#115;&#107;&#105;&#110;&#46;&#99;&#111;&#46;&#117;&#107;</a></p>
    </footer>
</div>

<script src="<?php bloginfo('template_directory'); ?>/js/libs/slideshow.js"></script>


<!-- Debugger - remove for production -->
<!-- <script src="https://getfirebug.com/firebug-lite.js"></script> -->

<!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID.
     mathiasbynens.be/notes/async-analytics-snippet -->


<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

</body>
</html>